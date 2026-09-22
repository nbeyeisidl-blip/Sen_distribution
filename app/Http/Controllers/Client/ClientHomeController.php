<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ClientHomeController extends Controller
{
   public function index()
    {
        // 1. Catégories principales
        $categories = Category::withCount('products')->get();

        // 2. Ventes Flash (ex: produits récents limités à 6)
        $flashSales = Product::where('stock', '>', 0)
                             ->latest()
                             ->take(6)
                             ->get();

        // 3. Produits populaires / Recommandés (limités à 12)
        $products = Product::where('stock', '>', 0)
                           ->inRandomOrder()
                           ->take(12)
                           ->get();

        return view('client.home', compact('categories', 'flashSales', 'products'));
    }

}