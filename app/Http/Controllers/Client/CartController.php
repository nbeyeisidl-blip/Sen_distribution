<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Affiche le panier
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        return view('client.cart.index', compact('cart'));
    }

    /**
     * Ajoute un produit au panier
     */
    public function add(Request $request, Product $product)
    {
        
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => $product->price,
                'image'    => $product->image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Produit ajouté au panier.');
    }

    /**
     * Mettre à jour la quantité d'un produit
     */
    public function update(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = max(
                1,
                (int) $request->quantity
            );
        }

        return back()->with('success', 'Panier mis à jour.');
    }

    /**
     * Supprimer un produit du panier
     */
    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        unset($cart[$productId]);

        session()->put('cart', $cart);

        return back()->with('success', 'Produit supprimé du panier.');
    }

    /**
     * Vider totalement le panier
     */
    public function clear()
    {
        session()->forget('cart');

        return back()->with('success', 'Panier vidé.');
    }
}