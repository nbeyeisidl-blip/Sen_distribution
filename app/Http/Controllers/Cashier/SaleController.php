<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Liste des ventes du caissier
     */
    public function index()
    {
        $sales = Sale::with('client')
            ->latest()
            ->paginate(10);

        return view('cashier.sales.index', compact('sales'));
    }

    /**
     * Formulaire de création de vente
     */
    public function create()
    {
        // Récupérer les utilisateurs ayant le rôle 'client' (ou User::all() selon la structure)
        $clients = User::where('role', 'client')->get(); 
        $products = Product::where('stock', '>', 0)->get();

        return view('cashier.sales.create', compact('clients', 'products'));
    }

    /**
     * Enregistrer une nouvelle vente
     */
    public function store(Request $request)
{
    // Validation souple pour s'adapter au formulaire
    $request->validate([
        'client_id' => 'nullable|exists:users,id',
        'products'  => 'required|array|min:1',
    ]);

    DB::transaction(function () use ($request) {
        $totalAmount = 0;
        $itemsToInsert = [];

        // 1. Calcul du total et préparation des articles
        foreach ($request->products as $item) {
            $product = Product::findOrFail($item['id'] ?? $item['product_id']);
            $quantity = $item['quantity'];
            $price = $product->price;
            $subtotal = $price * $quantity;

            $totalAmount += $subtotal;

            $itemsToInsert[] = [
                'product_id' => $product->id,
                'quantity'   => $quantity,
                'price'      => $price,
                'subtotal'   => $subtotal,
            ];

            // Décrémenter le stock
            $product->decrement('stock', $quantity);
        }

        // 2. Création de la vente avec le montant TOTAL réel
        // 2. Création de la vente avec le montant TOTAL réel
$sale = Sale::create([
    'user_id'    => auth()->id(), // Remplacer user_id par caissier_id
    'client_id'      => $request->client_id ?? null,
    'total'   => $totalAmount,
    'payment_method' => $request->payment_method ?? 'espèces',
]);

        // 3. Enregistrement des lignes de vente
        foreach ($itemsToInsert as $line) {
            $sale->items()->create($line);
        }

        return $sale;
    });

    return redirect()->route('cashier.sales.index')
        ->with('success', 'Vente enregistrée avec succès !');
}

    /**
     * Détails d'une vente
     */
    public function show(Sale $sale)
    {
        $sale->load([
            'client',
            'user',
            'items.product'
        ]);

        return view('cashier.sales.show', compact('sale'));
    }

    /**
     * Affichage et impression du reçu de vente
     */
    public function receipt($id)
    {
        $sale = Sale::with(['client', 'user', 'items.product'])->findOrFail($id);

        return view('cashier.sales.receipt', compact('sale'));
    }
}