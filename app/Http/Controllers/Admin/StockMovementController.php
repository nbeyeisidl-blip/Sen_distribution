<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    public function index(Request $request)
    {
        $query = StockMovement::with('product')
            ->latest();

        // Recherche par nom de produit
        if ($request->filled('search')) {

            $search = $request->search;

            $query->whereHas('product', function ($q) use ($search) {

                $q->where(
                    'name',
                    'like',
                    '%' . $search . '%'
                );

            });
        }

        // Filtre entrée / sortie
        if ($request->filled('type')) {

            $query->where(
                'type',
                $request->type
            );
        }

        $movements = $query
            ->paginate(15)
            ->withQueryString();

        return view(
            'admin.stock_movements.index',
            compact('movements')
        );
    }
}