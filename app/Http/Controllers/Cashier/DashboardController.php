<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $todaySales = Sale::whereDate('created_at', today())->count();

        $todayTotal = Sale::whereDate('created_at', today())
            ->sum('total');

        $products = Product::count();

        $lowStock = Product::where('stock', '<=', 5)->count();

        $recentSales = Sale::with('client')
            ->latest()
            ->take(5)
            ->get();

        return view('cashier.dashboard', compact(
            'todaySales',
            'todayTotal',
            'products',
            'lowStock',
            'recentSales'
        ));
    }
}