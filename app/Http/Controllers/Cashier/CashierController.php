<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Client;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CashierController extends Controller
{
    /**
     * Tableau de bord du caissier
     */
   public function dashboard()
{
    // 1. Récupérer les 5 dernières ventes réelles avec leurs relations
    $recentSales = Sale::with(['client', 'items.product'])
        ->latest()
        ->take(5)
        ->get();

    // 2. Calculer le total réel des ventes du mois en cours
    $monthlyTotal = Sale::whereYear('created_at', now()->year)
        ->whereMonth('created_at', now()->month)
        ->sum('total'); // Remplacez 'total' par 'total_amount' si c'est le nom de votre colonne

    // 3. Nombre de ventes du mois
    $salesCount = Sale::whereYear('created_at', now()->year)
        ->whereMonth('created_at', now()->month)
        ->count();

    return view('cashier.dashboard', compact('recentSales', 'monthlyTotal', 'salesCount'));
}
public function orders()
{
    // Charge les relations et calcule automatiquement le nombre d'articles (items)
    $orders = Sale::with(['client', 'items'])
        ->withCount('items') // Crée un attribut virtual $order->items_count
        ->latest()
        ->paginate(10);

    return view('cashier.orders.index', compact('orders'));
}
    public function products()
    {
        $products = Product::latest()->paginate(12);

        return view('cashier.products.index', compact('products'));
    }
 public function invoices()
    {
        $orders = Sale::with('client')
            ->latest()
            ->paginate(10);

        return view('cashier.sales.invoices_list', compact('orders'));
    }

    /**
     * Affiche le détail et le reçu d'une facture spécifique.
     */
public function invoice($id)
{
    $order = Sale::with(['client', 'items', 'saleItems'])->findOrFail($id);

    // DEBOGAGE : supprimez cette ligne après verification
    dd($order->toArray());

    return view('cashier.sales.invoice', compact('order'));
}
    /**
     * Liste des factures / ventes
     */
   public function invoicesList()
{
    // Récupère les ventes/commandes
    $orders = Sale::with('client')->latest()->paginate(15);

    // Transmet $orders à la vue
    return view('cashier.sales.invoices_list', compact('orders'));
}
    /**
     * Affiche l'interface Point de Vente (POS)
     */
    public function create(Request $request)
    {
        $products = Product::where('stock', '>', 0)->get();
        $clients = Client::all();
        $cart = session()->get('cart', []);

        if ($request->has('product_id')) {
            $productId = $request->query('product_id');
            $product = Product::find($productId);

            if ($product && $product->stock > 0) {
                if (isset($cart[$productId])) {
                    if ($cart[$productId]['quantity'] < $product->stock) {
                        $cart[$productId]['quantity']++;
                    }
                } else {
                    $cart[$productId] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => 1,
                    ];
                }

                session()->put('cart', $cart);
            }

            return redirect()->route('cashier.sales.create');
        }

        $subtotal = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);

        return view('cashier.sales.create', compact('products', 'clients', 'cart', 'subtotal'));
    }

    /**
     * Valide et enregistre la vente
     */
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Le panier est vide.');
        }

        $request->validate([
            'client_id' => 'nullable|exists:clients,id',
            'payment_method' => 'required|string',
            'discount' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $subtotal = array_reduce($cart, function ($sum, $item) {
                return $sum + ($item['price'] * $item['quantity']);
            }, 0);

            $discount = $request->input('discount', 0) ?? 0;
            $totalNet = max(0, $subtotal - $discount);

            $sale = Sale::create([
                'client_id' => $request->filled('client_id') ? $request->client_id : null,
                'user_id' => auth()->id(),
                'total' => $totalNet,
                'discount' => $discount,
                'payment_method' => $request->payment_method,
                'sale_date' => now(),
            ]);

            foreach ($cart as $id => $item) {
                $product = Product::lockForUpdate()->find($id);

                if ($product && $product->stock >= $item['quantity']) {
                    if (class_exists('App\Models\SaleDetail')) {
                        SaleDetail::create([
                            'sale_id' => $sale->id,
                            'product_id' => $product->id,
                            'quantity' => $item['quantity'],
                            'price' => $item['price'],
                            'total' => $item['price'] * $item['quantity'],
                        ]);
                    }

                    $product->decrement('stock', $item['quantity']);
                } else {
                    throw new \Exception("Stock insuffisant pour le produit : " . $item['name']);
                }
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('cashier.sales.create')->with('success', 'Vente enregistrée avec succès !');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erreur lors de la vente : ' . $e->getMessage());
        }
    }

    /**
     * Supprime un produit du panier
     */
    public function removeCartItem($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cashier.sales.create');
    }

    /**
     * Vide complètement le panier
     */
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->route('cashier.sales.create');
    }
}