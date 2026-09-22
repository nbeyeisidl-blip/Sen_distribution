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

        // Calcul du total général
        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return view('client.cart.index', compact('cart', 'total'));
    }

    /**
     * Ajoute un produit au panier
     */
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = $request->input('quantity', 1);

        // Récupérer le panier actuel en session
        $cart = session()->get('cart', []);

        // Si le produit existe déjà, on augmente la quantité
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            // Sinon, on l'ajoute avec toutes ses données (y compris l'image)
            $cart[$id] = [
                'name'     => $product->name,
                'price'    => $product->price,
                'quantity' => $quantity,
                'image'    => $product->image, // Chemin enregistré en BDD
            ];
        }

        // Sauvegarder le panier mis à jour dans la session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produit ajouté au panier avec succès !');
    }

    /**
     * Mettre à jour la quantité d'un produit
     */
    public function update(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $quantity = max(1, (int) $request->quantity);

            // Vérification du stock
            $product = Product::find($productId);
            if ($product && $product->stock < $quantity) {
                return back()->with('error', 'La quantité demandée dépasse le stock disponible.');
            }

            $cart[$productId]['quantity'] = $quantity;

            // CORRECTION CRITIQUE : Sauvegarder la modification en session
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Panier mis à jour.');
    }

    /**
     * Supprimer un produit du panier
     */
    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

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