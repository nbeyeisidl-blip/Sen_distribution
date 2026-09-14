<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Liste des commandes du client connecté
     */
    public function index()
    {
        $orders = Order::where('client_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('client.orders.index', compact('orders'));
    }

    /**
     * Détails d'une commande spécifique
     */
 public function show($id)
{
    $order = Order::with(['items.product'])
        ->where('id', $id)
        ->firstOrFail();

    return view('client.orders.show', compact('order'));
}
}