<?php
namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Client;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CashierController extends Controller
{
    public function dashboard()
{
    $today = now()->today();

    // Nombre de ventes du jour
    $salesCount = Order::whereDate('created_at', $today)->count();

    // Total des ventes (inclure completed et confirmed)
    $totalAmount = Order::whereMonth('created_at', now()->month)
        ->whereIn('status', ['completed', 'confirmed', 'paid'])
        ->sum('total');

    $pendingOrders = Order::where('status', 'pending')->count();

    $recentSales = Order::with(['client', 'items.product'])
        ->latest()
        ->take(6)
        ->get();

    $topProducts = Product::select('products.id', 'products.name', 'products.price', DB::raw('SUM(order_items.quantity) as total_qty'))
        ->join('order_items', 'products.id', '=', 'order_items.product_id')
        ->groupBy('products.id', 'products.name', 'products.price')
        ->orderByDesc('total_qty')
        ->take(4)
        ->get();

    return view('cashier.dashboard', compact(
        'salesCount',
        'totalAmount',
        'pendingOrders',
        'recentSales',
        'topProducts'
    ));
}
   public function createSale()
    {
        $clients = Client::all();
        $products = Product::where('stock', '>', 0)->get();

        return view('cashier.sales.create', compact('clients', 'products'));
    }

    // Traitement et enregistrement de la vente
    public function storeSale(Request $request)
{
    $request->validate([
        'client_id'      => 'required',
        'items'          => 'required|array|min:1',
        'payment_method' => 'required|string',
    ]);

    $order = DB::transaction(function () use ($request) {
        $subtotal = 0;
        foreach ($request->items as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // app/Http/Controllers/Cashier/CashierController.php

$discount = $request->discount ?? 0;
$total = max(0, $subtotal - $discount);

// 1. Enregistrement avec le statut COMPLETED
$order = Order::create([
    'client_id'      => $request->client_id,
    'total'          => $total,
    'status'         => 'completed',
    'payment_method' => $request->payment_method,
]);

        // 2. Création des lignes d'articles et mise à jour du stock
        foreach ($request->items as $item) {
            Product::where('id', $item['product_id'])->decrement('stock', $item['quantity']);

            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }

        return $order;
    });

    // 3. Redirection explicite vers la vue Facture de la vente créée
    return redirect()->route('cashier.invoice', $order->id)
        ->with('success', 'Vente effectuée et validée avec succès !');
}
//ge et impression du reçu / facture
    public function invoice($id)
{
    // Chargement de la commande avec le client et les articles
    $order = Order::with(['client', 'items.product'])->findOrFail($id);

    return view('cashier.sales.invoice', compact('order'));
}
// Afficher la liste / historique de toutes les factures
public function invoicesList()
{
    $orders = Order::with('client')
        ->latest()
        ->paginate(15);

    return view('cashier.sales.invoices_list', compact('orders'));
}
// Afficher la liste complète des commandes
public function orders(Request $request)
{
    $query = Order::with(['client', 'items.product'])->latest();

    // Filtre par statut si sélectionné
    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status);
    }

    // Filtre par recherche (ID ou Nom du client)
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('id', 'like', "%{$search}%")
              ->orWhereHas('client', function($qClient) use ($search) {
                  $qClient->where('name', 'like', "%{$search}%")
                          ->orWhere('nom', 'like', "%{$search}%");
              });
        });
    }

    $orders = $query->paginate(10);

    return view('cashier.orders.index', compact('orders'));
}

// Affichage de la liste des clients
public function clients(Request $request)
{
    $query = Client::latest();

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
    }

    $clients = $query->paginate(10);

    return view('cashier.clients.index', compact('clients'));
}

// Enregistrement d'un nouveau client
public function storeClient(Request $request)
{
    $request->validate([
        'name'  => 'required|string|max:255',
        'phone' => 'nullable|string|max:50',
        'email' => 'nullable|email|max:255',
    ]);

    Client::create([
        'name'  => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
    ]);

    return redirect()->back()->with('success', 'Client ajouté avec succès !');
}

// Liste des produits et consultation du catalogue en caisse
public function products(Request $request)
{
    $query = Product::with('category')->latest();

    // Filtre par catégorie
    if ($request->has('category_id') && $request->category_id != '') {
        $query->where('category_id', $request->category_id);
    }

    // Filtre par terme de recherche (Nom du produit ou Référence)
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where('name', 'like', "%{$search}%");
    }

    $products = $query->paginate(12);
    $categories = Category::all();

    return view('cashier.products.index', compact('products', 'categories'));
}



// 1. Afficher la liste des notifications
public function notifications()
{
    $notifications = Notification::where('notifiable_id', auth()->id())
        ->latest()
        ->paginate(15);

    return view('cashier.notifications.index', compact('notifications'));
}

// 2. Marquer une notification comme lue
public function markAsRead($id)
{
    $notification = Notification::where('notifiable_id', auth()->id())
        ->findOrFail($id);

    $notification->update(['read_at' => now()]);

    return redirect()->back()->with('success', 'Notification marquée comme lue.');
}

// 3. Tout marquer comme lu
public function markAllAsRead()
{
    Notification::where('notifiable_id', auth()->id())
        ->whereNull('read_at')
        ->update(['read_at' => now()]);

    return redirect()->back()->with('success', 'Toutes les notifications ont été marquées comme lues.');
}
}