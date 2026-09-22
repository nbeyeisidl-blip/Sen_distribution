<?php

    namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\User; // <--- Ajouter
use App\Notifications\NewOrderNotification; // <--- Ajouter
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification; // <--- Ajouter

class CheckoutController extends Controller

{

public function index()
    {
        // Récupérer le panier depuis la session
        $cart = session()->get('cart', []);

        // Si le panier est vide, rediriger vers la page du panier ou des produits
        if (empty($cart)) {
            return redirect()->route('client.cart.index')->with('error', 'Votre panier est vide.');
        }

        // Calculer le total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Passer $cart et $total à la vue
        return view('client.checkout.index', compact('cart', 'total'));
    }
   public function store(Request $request)
{
    // 1. Validation du formulaire
    $request->validate([
        'first_name'     => 'required|string|max:255',
        'last_name'      => 'required|string|max:255',
        'phone'          => 'required|string|max:20',
        'city'           => 'required|string|max:255',
        'address'        => 'required|string',
        'payment_method' => 'required|in:wave,orange_money,cash',
    ]);

    // 2. Récupération du panier
    $cart = session()->get('cart', []);
    if (empty($cart)) {
        return redirect()->route('client.cart.index')->with('error', 'Votre panier est vide.');
    }

    // 3. Calcul du montant total
    $totalAmount = 0;
    foreach ($cart as $item) {
        $totalAmount += $item['price'] * $item['quantity'];
    }

    // 4. Utilisateur connecté
    $user = auth()->user();

    // 5. Transaction en base de données
    DB::transaction(function () use ($request, $user, $cart, $totalAmount) {

        // Récupérer ou créer le profil Client
        $client = Client::firstOrCreate(
            ['email' => $user->email],
            [
                'nom'   => $user->name ?? $user->nom ?? 'Client',
                'phone' => $request->phone,
            ]
        );

        // Adresse complète de livraison
        $fullAddress = $request->address . ', ' . $request->city;

        // Créer la commande
        $order = Order::create([
            'client_id'        => $client->id,
            'total'            => $totalAmount,
            'status'           => 'pending',
            'payment_method'   => $request->payment_method,
            'shipping_address' => $request->shipping_address ?? $fullAddress,
            'first_name'       => $request->first_name,
            'last_name'        => $request->last_name,
            'phone'            => $request->phone,
            'city'             => $request->city,
            'address'          => $request->address,
        ]);

        // Décrémenter les stocks des produits
        foreach ($cart as $productId => $item) {
            Product::where('id', $productId)->decrement('stock', $item['quantity']);
        }

        // Notification des administrateurs
        $admins = User::where('role', 'admin')->get();
        if ($admins->isNotEmpty()) {
            Notification::send($admins, new NewOrderNotification($order));
        }

        // Vider le panier de la session
        session()->forget('cart');
    });

    return redirect()->route('client.orders.index')->with('success', 'Votre commande a été enregistrée avec succès !');
}
}