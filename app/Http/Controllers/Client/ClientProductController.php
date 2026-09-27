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
       $query = Product::where('stock', '>', 0);

        // On prend 'category_id' en priorité, sinon 'category'
        $catInput = $request->input('category_id') ?? $request->input('category');

        if (!empty($catInput)) {
            // Recherche la catégorie par son ID, son Slug ou son Nom ("Femme", "Homme", etc.)
            $category = Category::where('id', $catInput)
                        ->orWhere('slug', $catInput)
                        ->orWhere('name', $catInput)
                        ->first();

            if ($category) {
                // Récupère l'ID de la catégorie principale + les IDs de ses sous-catégories
                $childrenIds = $category->children()->pluck('id')->toArray();
                $allCategoryIds = array_merge([$category->id], $childrenIds);

                // Applique le filtre sur la base de données
                $query->whereIn('category_id', $allCategoryIds);
            }
        }

        $products = $query->latest()->paginate(12);
        $categories = Category::whereNull('parent_id')->with('children')->get();

        return view('client.products.index', compact('products', 'categories'));
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