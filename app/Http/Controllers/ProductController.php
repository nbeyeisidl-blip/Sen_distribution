<?php

namespace App\Http\Controllers;

use App\Models\Product; // Importation du modèle Product

use Illuminate\Http\Request;
use App\Models\Category;
class ProductController extends Controller
{
    public function index(Request $request)
{
    $query = Product::query();

    if ($request->has('category') && !empty($request->category)) {
        // 1. On cherche la catégorie cliquée (ex: HOMME)
        $category = Category::where('slug', $request->category)
                    ->orWhere('id', $request->category)
                    ->first();

        if ($category) {
            // 2. On récupère les IDs de toutes ses sous-catégories (ex: Chemise, Chaussures...)
            $categoryIds = $category->children()->pluck('id')->toArray();
            
            // 3. On ajoute aussi l'ID de la catégorie principale elle-même
            $categoryIds[] = $category->id;

            // 4. On filtre les produits qui appartiennent à l'un de ces IDs
            $query->whereIn('category_id', $categoryIds);
        }
    }

    $products = $query->latest()->paginate(12);

    return view('client.products.index', compact('products'));
}
}