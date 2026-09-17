<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\StockMovement;
use App\Models\User;
use App\Notifications\LowStockNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class SaleController extends Controller
{
    /**
     * Liste des ventes
     */
    public function index()
    {
        $sales = Sale::with('client')->latest()->paginate(10);
        return view('admin.sales.index', compact('sales'));
    }

    public function create()
    {
        $clients = User::where('role', 'client')->get();
        $products = Product::where('stock', '>', 0)->orderBy('name')->get();

        return view('admin.sales.create', compact('clients', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id'      => ['nullable', 'exists:clients,id'],
            'client_name'    => ['nullable', 'string', 'max:255'],
            'payment_method' => ['required', 'string', 'max:50'],
            'products'       => ['required', 'array'],
            'products.*.id'  => ['required', 'exists:products,id'],
            'products.*.quantity' => ['required', 'integer', 'min:0'],
        ]);

        $selectedProducts = collect($request->products)
            ->filter(fn($item) => (int)$item['quantity'] > 0)
            ->values();

        if ($selectedProducts->isEmpty()) {
            return back()->withInput()->withErrors(['products' => 'Veuillez sélectionner au moins un produit.']);
        }

        try {
            $sale = DB::transaction(function () use ($request, $selectedProducts) {
                $sale = Sale::create([
                    'client_id'      => $request->client_id,
                    'total'          => 0,
                    'payment_method' => $request->payment_method,
                ]);

                $grandTotal = 0;

                foreach ($selectedProducts as $item) {
                    $product = Product::lockForUpdate()->findOrFail($item['id']);
                    $quantity = (int) $item['quantity'];

                    if ($quantity > $product->stock) {
                        throw new Exception("Stock insuffisant pour le produit : {$product->name}");
                    }

                    $price = (float) $product->price;
                    $subtotal = $price * $quantity;

                    SaleItem::create([
                        'sale_id'    => $sale->id,
                        'product_id' => $product->id,
                        'quantity'   => $quantity,
                        'price'      => $price,
                        'subtotal'   => $subtotal,
                    ]);

                    $product->decrement('stock', $quantity);
                    $product->refresh();

                    if ($product->stock <= 5) {
                        User::where('role', 'admin')->get()->each(
                            fn($admin) => $admin->notify(new LowStockNotification($product))
                        );
                    }

                    StockMovement::create([
                        'product_id'  => $product->id,
                        'type'        => 'sortie',
                        'quantity'    => $quantity,
                        'reference'   => 'Vente #' . $sale->id,
                        'description' => 'Sortie suite à une vente',
                    ]);

                    $grandTotal += $subtotal;
                }

                $sale->update(['total' => $grandTotal]);

                return $sale;
            });

            return redirect()->route('admin.sales.show', $sale->id)
                             ->with('success', 'Vente enregistrée avec succès.');

        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Afficher une vente
     */
    public function show(Sale $sale)
    {
        $sale->load(['client', 'items.product']);
        return view('admin.sales.show', compact('sale'));
    }

    /**
     * Formulaire d'édition de vente
     */
    public function edit(Sale $sale)
    {
        $sale->load('items');
        $clients = Client::where('is_active', 1)->orderBy('nom')->get();
        $products = Product::orderBy('name')->get();

        return view('admin.sales.edit', compact('sale', 'clients', 'products'));
    }

    /**
     * Mettre à jour une vente (avec réajustement de stock)
     */
    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'client_id' => ['nullable', 'exists:clients,id'],
            'payment_method' => ['required', 'string', 'max:50'],
            'products' => ['required', 'array'],
            'products.*.id' => ['required', 'exists:products,id'],
            'products.*.quantity' => ['required', 'integer', 'min:0'],
        ]);


        // 1. Déterminer le nom du client à enregistrer
    $clientName = 'Client de passage';

    if ($request->filled('client_id')) {
        // Si un client a été choisi dans la liste déroulante
        $client = Client::find($request->client_id);
        $clientName = $client ? $client->name : 'Client comptoir';
    } elseif ($request->filled('client_name')) {
        $clientName = $request->client_name;
    }

    // 2. Création de la vente
    $sale = Sale::create([
        'code' => 'VTS-' . str_pad(Sale::count() + 1, 5, '0', STR_PAD_LEFT),
        'user_id' => auth()->id(), // L'admin ou caissier qui a fait la vente
        'client_id' => $request->client_id ?? null,
        'client_name' => $clientName, // <-- Enregistre la valeur choisie et non "admin"
        'total' => $request->total,
        'payment_method' => $request->payment_method,
    ]);


        $selectedProducts = collect($request->products)
            ->filter(fn($item) => (int)$item['quantity'] > 0)
            ->values();

        try {
            DB::transaction(function () use ($request, $sale, $selectedProducts) {
                // 1. Restituer le stock initial des articles de cette vente
                foreach ($sale->items as $item) {
                    $product = Product::lockForUpdate()->find($item->product_id);
                    if ($product) {
                        $product->increment('stock', $item->quantity);
                        
                        StockMovement::create([
                            'product_id' => $product->id,
                            'type' => 'entrée',
                            'quantity' => $item->quantity,
                            'reference' => 'Annulation Vente #' . $sale->id,
                            'description' => 'Restitution de stock pour modification de vente',
                        ]);
                    }
                }

                // 2. Supprimer les anciennes lignes de vente
                $sale->items()->delete();

                // 3. Réenregistrer les nouveaux articles et déduire le stock
                $grandTotal = 0;
                foreach ($selectedProducts as $item) {
                    $product = Product::lockForUpdate()->findOrFail($item['id']);
                    $quantity = (int) $item['quantity'];

                    if ($quantity > $product->stock) {
                        throw new \Exception("Stock insuffisant pour : {$product->name}");
                    }

                    $price = (float) $product->price;
                    $subtotal = $price * $quantity;

                    SaleItem::create([
                        'sale_id' => $sale->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $price,
                        'subtotal' => $subtotal,
                    ]);

                    $product->decrement('stock', $quantity);

                    StockMovement::create([
                        'product_id' => $product->id,
                        'type' => 'sortie',
                        'quantity' => $quantity,
                        'reference' => 'Modification Vente #' . $sale->id,
                        'description' => 'Sortie suite à la modification de vente',
                    ]);

                    $grandTotal += $subtotal;
                }

                // 4. Mettre à jour l'en-tête de la vente
                $sale->update([
                    'client_id' => $request->client_id,
                    'payment_method' => $request->payment_method,
                    'total' => $grandTotal,
                ]);
            });

            return redirect()->route('admin.sales.index')->with('success', 'Vente modifiée avec succès.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Supprimer une vente et réintégrer les stocks
     */
    public function destroy(Sale $sale)
    {
        try {
            DB::transaction(function () use ($sale) {
                // Restituer les stocks
                foreach ($sale->items as $item) {
                    $product = Product::lockForUpdate()->find($item->product_id);
                    if ($product) {
                        $product->increment('stock', $item->quantity);

                        StockMovement::create([
                            'product_id' => $product->id,
                            'type' => 'entrée',
                            'quantity' => $item->quantity,
                            'reference' => 'Suppression Vente #' . $sale->id,
                            'description' => 'Réintégration du stock suite à la suppression de la vente',
                        ]);
                    }
                }

                // Supprimer les lignes puis la vente
                $sale->items()->delete();
                $sale->delete();
            });

            return redirect()->route('admin.sales.index')->with('success', 'Vente supprimée et stocks réintégrés.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}