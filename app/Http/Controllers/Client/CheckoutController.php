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
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('client.cart.index')
                ->with('error', 'Votre panier est vide.');
        }

        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return view('client.checkout.index', compact('cart', 'total'));
    }
    public function store(Request $request)
{
    // 1. Validation du formulaire
    $request->validate([
        'shipping_address' => 'required|string',
        'phone'            => 'required|string',
        'payment_method'   => 'required|string',
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

    // 4. Définition de l'utilisateur connecté (CORRECTION ICI)
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

        // Créer la commande
        $order = Order::create([
            'client_id'        => $client->id,
            'total'            => $totalAmount,
            'status'           => 'pending',
            'payment_method'   => $request->payment_method,
            'shipping_address' => $request->shipping_address,
            'phone'            => $request->phone,
        ]);

        // Décrémenter les stocks des produits
        foreach ($cart as $productId => $item) {
            Product::where('id', $productId)->decrement('stock', $item['quantity']);
        }

        // Notification des administrateurs
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new NewOrderNotification($order));

        // Vider le panier de la session
        session()->forget('cart');
    });

    return redirect()->route('client.home')->with('success', 'Votre commande a été enregistrée avec succès !');
}
}