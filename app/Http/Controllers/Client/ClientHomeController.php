<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ClientHomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Initialisation de la requête pour les produits
        $query = Product::where('stock', '>', 0);

        // 2. Gestion du filtrage par catégorie (si sélectionnée)
        $catInput = $request->input('category_id') ?? $request->input('category');

        if (!empty($catInput)) {
            $category = Category::where('id', $catInput)
                        ->orWhere('slug', $catInput)
                        ->orWhere('name', $catInput)
                        ->first();

            if ($category) {
                $childrenIds = $category->children()->pluck('id')->toArray();
                $allCategoryIds = array_merge([$category->id], $childrenIds);

                $query->whereIn('category_id', $allCategoryIds);
            }
        }

        // 3. Produits filtrés (LIMITE À 8 PRODUITS)
        $products = $query->latest()->take(9)->get();

        // 4. Catégories parentes avec sous-catégories pour le menu
        $categories = Category::whereNull('parent_id')->with('children')->get();

        // 5. Ventes Flash (également LIMITE À 8 PRODUITS si souhaité)
        $flashSales = Product::where('stock', '>', 0)->latest()->take(8)->get();

        return view('client.home', compact('categories', 'flashSales', 'products'));
    }
}