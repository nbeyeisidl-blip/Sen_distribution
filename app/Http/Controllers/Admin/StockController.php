<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where('name', 'like', "%{$search}%");
        }

        // Filtre stock
        if ($request->stock_status === 'low') {

            $query->where('stock', '>', 0)
                  ->where('stock', '<=', 10);

        } elseif ($request->stock_status === 'out') {

            $query->where('stock', 0);

        } elseif ($request->stock_status === 'available') {

            $query->where('stock', '>', 10);
        }

        $products = $query
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        // Statistiques
        $totalProducts = Product::count();

        $availableProducts = Product::where('stock', '>', 10)
            ->count();

        $lowStockProducts = Product::where('stock', '>', 0)
            ->where('stock', '<=', 10)
            ->count();

        $outOfStockProducts = Product::where('stock', 0)
            ->count();

        $totalStock = Product::sum('stock');

        return view(
            'admin.stock.index',
            compact(
                'products',
                'totalProducts',
                'availableProducts',
                'lowStockProducts',
                'outOfStockProducts',
                'totalStock'
            )
        );
    }
}