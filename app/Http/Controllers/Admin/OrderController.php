<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Notifications\NewOrderNotification;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('client')
            ->latest()
            ->paginate(10);

        return view(
            'admin.orders.index',
            compact('orders')
        );
    }

    public function show(Order $order)
    {$order->load(['client', 'items.product']);

    return view('admin.orders.show', compact('order'));
}
    

   public function edit(Order $order)
{
    // Charge la relation 'client' ou 'user' si définie dans le modèle Order
    $order->load(['client', 'user']);

    return view('admin.orders.edit', compact('order'));
}

   public function update(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:pending,processing,shipped,completed,cancelled',
    ]);

    $order->update([
        'status' => $request->status
    ]);

    return redirect()->route('admin.orders.index')
        ->with('success', "La commande #{$order->id} a été mise à jour avec succès.");
}
   public function confirm(Order $order)
    {
        $order->update([
            'status' => 'completed'
        ]);

        return redirect()
            ->route('admin.orders.show', $order->id)
            ->with('success', "La commande #{$order->id} a été marquée comme livrée.");
    

    $order->load('items.product');

    DB::transaction(function () use ($order) {

        $total = 0;

        // Vérification du stock
        foreach ($order->items as $item) {

            $product = Product::lockForUpdate()
                ->findOrFail($item->product_id);

            if ($item->quantity > $product->stock) {
                abort(
                    422,
                    "Stock insuffisant pour : {$product->name}"
                );
            }

            $total += $item->price * $item->quantity;
        }

        // Création de la vente
        $sale = Sale::create([
            'client_id' => $order->client_id,
            'total' => $total,
            'payment_method' => $order->payment_method,
        ]);

        // Création des lignes de vente + réduction du stock
        foreach ($order->items as $item) {

            $product = Product::lockForUpdate()
                ->findOrFail($item->product_id);

            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'subtotal' => $item->price * $item->quantity,
            ]);

            $product->decrement(
                'stock',
                $item->quantity
            );
        }

        // Commande confirmée
        $order->update([
            'status' => 'confirmed',
        ]);
    });

    return redirect()
        ->route('admin.orders.index')
        ->with(
            'success',
            'Commande confirmée et stock mis à jour.'
        );
}
public function validateOrder($id)
    {
        $order = Order::findOrFail($id);

        // 1. Mise à jour du statut
        $order->update([
            'status' => 'confirmed' // ou 'validated'
        ]);

        // 2. Notification au client
        if ($order->client && $order->client->user) {
            $order->client->user->notify(new OrderStatusUpdatedNotification($order));
        }

        return redirect()->back()->with('success', 'Commande #' . $order->id . ' confirmée avec succès !');
    }

}