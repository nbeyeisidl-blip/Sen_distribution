<?php

namespace App\Http\Controllers\Storekeeper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class StorekeeperController extends Controller
{
    // Tableau de bord Magasinier
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');
        $lowStockCount = Product::where('stock', '<=', 5)->count();

        return view('Storekeeper.dashboard', compact('totalProducts', 'totalStock', 'lowStockCount'));
    }

    // Vue Liste / État du stock
    public function stock(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(10);

        return view('storekeeper.stock.index', compact('products'));
    }

    // Formulaire Entrée de stock
    public function stockEntryForm()
    {
        $products = Product::orderBy('name', 'asc')->get();

        return view('storekeeper.stock.entry', compact('products'));
    }

    // Traitement de l'Entrée de stock
    public function storeStockEntry(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $product->increment('stock', $request->quantity);

        return redirect()->route('storekeeper.stock.index')
            ->with('success', 'Entrée de stock enregistrée avec succès !');
    }

    // Liste des fournisseurs
    public function suppliers(Request $request)
{
    $query = Fournisseur::query();

    if ($request->filled('search')) {
        $search = $request->search;
        // Groupement propre de la clause OR
        $query->where(function ($q) use ($search) {
            $q->where('nom', 'LIKE', "%{$search}%")
              ->orWhere('telephone', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%");
        });
    }

    // Utilisation d'un paginate restreint
    $fournisseurs = $query->latest()->paginate(10);

    return view('storekeeper.suppliers.index', compact('fournisseurs'));
}
    // Liste des produits nécessitant un réapprovisionnement (Stock <= 5)
    public function restock()
    {
        // Récupérer les produits dont le stock est faible ou nul
        $lowStockProducts = Product::where('stock', '<=', 5)->orderBy('stock', 'asc')->paginate(10);
        $fournisseurs = Fournisseur::orderBy('nom', 'asc')->get();

        return view('storekeeper.restock.index', compact('lowStockProducts', 'fournisseurs'));
    }

    // Traitement d'une demande de réapprovisionnement
    public function storeRestockRequest(Request $request)
    {
        $request->validate([
            'product_id'    => 'required|exists:products,id',
            'quantity'      => 'required|integer|min:1',
            'fournisseur_id'=> 'nullable|exists:fournisseurs,id',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Si vous réapprovisionnez directement le stock
        $product->increment('stock', $request->quantity);

        return redirect()->route('storekeeper.restock.index')
            ->with('success', 'Réapprovisionnement enregistré avec succès (+ ' . $request->quantity . ' unités pour ' . $product->name . ') !');
    }

    // Page des rapports & statistiques du stock
    public function reports()
    {
        // Métriques globales
        $totalProducts    = Product::count();
        $totalStockUnits  = Product::sum('stock');
        $lowStockProducts = Product::where('stock', '<=', 5)->count();
        $outOfStock       = Product::where('stock', '<=', 0)->count();

        // Répartition du stock par catégorie
        $categoriesStats = Category::withCount('products')
            ->withSum('products as total_stock', 'stock')
            ->get();

        // Top 5 des produits avec le plus de stock
        $topStockProducts = Product::orderBy('stock', 'desc')->take(5)->get();

        return view('storekeeper.reports.index', compact(
            'totalProducts',
            'totalStockUnits',
            'lowStockProducts',
            'outOfStock',
            'categoriesStats',
            'topStockProducts'
        ));
    }

    // Page de notifications et alertes stock
    public function notifications()
    {
        // Produits en rupture de stock (Stock = 0)
        $outOfStockProducts = Product::where('stock', '<=', 0)->get();

        // Produits en stock critique (0 < Stock <= 5)
        $lowStockProducts = Product::where('stock', '>', 0)
            ->where('stock', '<=', 5)
            ->get();

        // Total des notifications d'alerte
        $totalNotifications = $outOfStockProducts->count() + $lowStockProducts->count();

        return view('storekeeper.notifications.index', compact(
            'outOfStockProducts',
            'lowStockProducts',
            'totalNotifications'
        ));
    }
}