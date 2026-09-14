<?php

namespace App\Http\Controllers\Storekeeper;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::latest()->paginate(10);
        return view('storekeeper.products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create($request->only(['name', 'price', 'stock']));

        return redirect()->route('storekeeper.products.index')->with('success', 'Produit ajouté !');
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->only(['name', 'price', 'stock']));

        return redirect()->route('storekeeper.products.index')->with('success', 'Produit mis à jour !');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->route('storekeeper.products.index')->with('success', 'Produit supprimé !');
    }
}