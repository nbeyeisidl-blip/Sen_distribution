<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Order;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $productsInStock = Product::where('stock', '>', 0)->count();
        $totalSalesAmount = Sale::sum('total');
        $pendingOrders = Order::where('status', 'pending')->count();

        $recentSales = Sale::with('client')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts', 
            'productsInStock', 
            'totalSalesAmount', 
            'pendingOrders',
            'recentSales'
        ));
    }
}