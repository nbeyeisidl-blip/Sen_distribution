<?php

namespace App\Http\Controllers\Cashier; // Ajustez le namespace selon votre structure

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Nombre total de ventes
        $totalSalesCount = Sale::count();
    

        // 2. Montant total des ventes du mois en cours
        $monthlyTotalAmount = Sale::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('total'); // Remplacez 'total' par 'total_amount' si c'est le nom dans votre table

        // 3. Commandes en attente (statut pending / en attente)
        $pendingOrdersCount = Sale::where('status', 'pending')
            ->orWhere('status', 'en attente')
            ->count();

        // 4. Dernières ventes avec relations
        $recentSales = Sale::with(['client', 'items.product'])
            ->latest()
            ->take(5)
            ->get();

        // 5. Top des produits les plus vendus
        $topProducts = SaleItem::select('product_id', DB::raw('SUM(quantity) as total_qty'), DB::raw('SUM(quantity * price) as total_amount'))
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->take(5)
            ->get();

        return view('cashier.dashboard', compact(
    'totalSalesCount',
    'monthlyTotalAmount',
    'pendingOrdersCount',
    'recentSales'
));
    }
}