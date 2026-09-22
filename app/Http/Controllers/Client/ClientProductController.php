<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ClientProductController extends Controller
{
    /**
     * Catalogue
     */
    public function index(Request $request)
    {
        $query = Product::where('stock', '>', 0);

        // Recherche
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Catégorie
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view(
            'client.products.index',
            compact('products', 'categories')
        );
    }


    /**
     * Détail produit
     */
    public function show($id)
{
   $product = Product::with(['comments.user'])->findOrFail($id);

    // Récupérer 4 produits de la même catégorie pour les suggestions
    $similarProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->take(4)
        ->get();

    return view('client.products.show', compact('product', 'similarProducts'));
}
}