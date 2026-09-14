<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientCategoryController extends Controller
{
    public function index()
{
    $categories = Category::withCount(['products' => function ($query) {
        $query->where('stock', '>', 0);
    }])->get();

    return view('client.categories.index', compact('categories'));
}



public function show(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        // Récupération de toutes les catégories avec décompte de stock
        $categories = Category::withCount(['products' => function ($query) {
            $query->where('stock', '>', 0);
        }])->get();

        // Requête sur les produits de la catégorie active
        $productsQuery = Product::where('category_id', $category->id)->where('stock', '>', 0);

        if ($request->filled('max_price')) {
            $productsQuery->where('price', '<=', $request->max_price);
        }

        $products = $productsQuery->latest()->paginate(9);
        $totalProductsCount = Product::where('stock', '>', 0)->count();

        return view('client.categories.show', compact('category', 'categories', 'products', 'totalProductsCount'));
    }
}