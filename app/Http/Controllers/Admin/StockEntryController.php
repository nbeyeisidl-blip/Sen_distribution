<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use App\Models\Product;
use App\Models\StockEntry;
use App\Models\StockEntryItem;
use Illuminate\Http\Request;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;

class StockEntryController extends Controller
{
    public function index()
    {
        $entries = StockEntry::with('fournisseur', 'items')
            ->latest()
            ->paginate(10);

        return view(
            'admin.stock_entries.index',
            compact('entries')
        );
    }

    public function create()
    {
        $fournisseurs = Fournisseur::orderBy('nom')->get();

        $products = Product::orderBy('name')->get();

        return view(
            'admin.stock_entries.create',
            compact('fournisseurs', 'products')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'fournisseur_id' => 'nullable|exists:fournisseurs,id',

            'observation' => 'nullable|string',

            'products' => 'required|array|min:1',

            'products.*.id' =>
                'required|exists:products,id',

            'products.*.quantity' =>
                'required|integer|min:0',

            'products.*.purchase_price' =>
                'required|numeric|min:0',
        ]);

        $selectedProducts = collect($request->products)
            ->filter(function ($item) {
                return (int) $item['quantity'] > 0;
            })
            ->values();

        if ($selectedProducts->isEmpty()) {
            return back()
                ->withInput()
                ->withErrors([
                    'products' =>
                        'Veuillez sélectionner au moins un produit.'
                ]);
        }

        $entry = DB::transaction(function () use (
            $request,
            $selectedProducts
        ) {

            $entry = StockEntry::create([
                'fournisseur_id' =>
                    $request->fournisseur_id,

                'total' => 0,

                'observation' =>
                    $request->observation,
            ]);

            $total = 0;

            foreach ($selectedProducts as $item) {

                $product = Product::lockForUpdate()
                    ->findOrFail($item['id']);

                $quantity = (int) $item['quantity'];

                $purchasePrice =
                    (float) $item['purchase_price'];

                $subtotal =
                    $quantity * $purchasePrice;

                StockEntryItem::create([
                    'stock_entry_id' => $entry->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'purchase_price' => $purchasePrice,
                    'subtotal' => $subtotal,
                ]);

                /*
                 * AUGMENTATION AUTOMATIQUE DU STOCK
                 */
                $product->increment(
                    'stock',
                    $quantity
                );
                StockMovement::create([
    'product_id' => $product->id,
    'type' => 'entrée',
    'quantity' => $quantity,
    'reference' => 'Entrée #' . $entry->id,
    'description' => 'Entrée de stock fournisseur',
]);

                $total += $subtotal;
            }

            $entry->update([
                'total' => $total,
            ]);

            return $entry;
        });

        return redirect()
            ->route(
                'admin.stock_entries.show',
                $entry->id
            )
            ->with(
                'success',
                'Entrée de stock enregistrée avec succès.'
            );
    }

    public function show(StockEntry $stockEntry)
    {
        $stockEntry->load([
            'fournisseur',
            'items.product'
        ]);

        return view(
            'admin.stock_entries.show',
            compact('stockEntry')
        );
    }
}