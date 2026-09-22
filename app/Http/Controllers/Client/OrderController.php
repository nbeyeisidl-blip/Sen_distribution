<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Liste des commandes du client connecté
     */
    public function index()
    {
        $user = Auth::user();

        // 1. Récupération du profil client associé à l'utilisateur connecté
        $client = Client::where('email', $user->email)->first();

        // 2. Requête sécurisée pour récupérer uniquement ses commandes
        $orders = Order::where(function ($query) use ($user, $client) {
            if ($client) {
                $query->where('client_id', $client->id);
            }
            if (!empty($user->phone)) {
                $query->orWhere('phone', $user->phone);
            }
            if (!empty($user->first_name)) {
                $query->orWhere('first_name', $user->first_name);
            }
        })
        ->latest()
        ->paginate(10);

        return view('client.orders.index', compact('orders'));
    }

    /**
     * Détail d'une commande spécifique avec vérification de sécurité
     */
    public function show($id)
{
    $user = Auth::user();
    
    // Récupération du client lié à l'utilisateur connecté
    $client = Client::where('email', $user->email)->first();

    // Récupération de la commande avec ses relations
    $order = Order::with('orderItems.product')->findOrFail($id);

    // Vérification assouplie : vérifie si l'ID client correspond OU si le téléphone/email correspond
    $belongsToUser = false;

    if ($client && $order->client_id == $client->id) {
        $belongsToUser = true;
    } elseif (!empty($user->phone) && $order->phone == $user->phone) {
        $belongsToUser = true;
    } elseif ($order->client_id == $user->id) { // Cas où client_id stocke directement user_id
        $belongsToUser = true;
    }

    // Si vous êtes en mode développement et souhaitez tester sans restriction,
    // vous pouvez temporairement commenter ces 3 lignes ci-dessous :
    if (!$belongsToUser) {
        abort(403, 'Vous n\'avez pas accès à cette commande.');
    }

    return view('client.orders.show', compact('order'));
}
}