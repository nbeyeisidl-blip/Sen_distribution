<?php

use Illuminate\Support\Facades\Route;

// ======================================================
// CONTROLLER AUTHENTIFICATION UNIFIÉE
// ======================================================
use App\Http\Controllers\AuthController;

// ======================================================
// CONTROLLERS ADMIN
// ======================================================
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\FournisseurController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\StockMovementController;
use App\Http\Controllers\Admin\StockEntryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\NotificationController;

// ======================================================
// CONTROLLERS CLIENT
// ======================================================
use App\Http\Controllers\Client\ClientHomeController;
use App\Http\Controllers\Client\ClientProductController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ClientCategoryController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;

// ======================================================
// CONTROLLERS CAISSIER
// ======================================================
use App\Http\Controllers\Cashier\CashierController;
use App\Http\Controllers\Cashier\SaleController as CashierSaleController;

// ======================================================
// CONTROLLERS MAGASINIER
// ======================================================
use App\Http\Controllers\Storekeeper\StorekeeperController;
use App\Http\Controllers\Storekeeper\ProductController as StorekeeperProductController;


// REDIRECTION RACINE
Route::get('/', function () {
    return redirect()->route('client.home');
});


// ======================================================
// AUTHENTIFICATION UNIFIÉE
// ======================================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.submit');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
});


// ======================================================
// ESPACE ADMIN
// ======================================================
Route::middleware(['admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Resources
        Route::resource('products', AdminProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('clients', ClientController::class);
        Route::resource('fournisseurs', FournisseurController::class);

        Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
        Route::get('/sales/create', [SaleController::class, 'create'])->name('sales.create');
        Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
        Route::get('/sales/{sale}', [SaleController::class, 'show'])->name('sales.show');

        Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
        Route::get('/stock-movements', [StockMovementController::class, 'index'])->name('stock_movements.index');

        Route::resource('stock_entries', StockEntryController::class)
            ->only(['index', 'create', 'store', 'show']);

        Route::resource('orders', AdminOrderController::class)
            ->only(['index', 'show', 'edit', 'update']);

        Route::post('/orders/{order}/confirm', [AdminOrderController::class, 'confirm'])->name('orders.confirm');

        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.markRead');
        Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
    Route::get('/sales/{sale}/edit', [SaleController::class, 'edit'])->name('sales.edit');
    Route::put('/sales/{sale}', [SaleController::class, 'update'])->name('sales.update');
    Route::delete('/sales/{sale}', [SaleController::class, 'destroy'])->name('sales.destroy');
    });


// ======================================================
// ESPACE CAISSIER
// ======================================================
Route::middleware(['auth'])
    ->prefix('cashier')
    ->name('cashier.')
    ->group(function () {

        // Point de Vente / Dashboard
        Route::get('/dashboard', [CashierController::class, 'dashboard'])->name('dashboard');
        Route::get('/sales/create', [CashierController::class, 'createSale'])->name('sales.create');
        Route::post('/sales', [CashierController::class, 'storeSale'])->name('sales.store');
        
        // Ventes & Factures
        Route::get('/sales', [CashierSaleController::class, 'index'])->name('sales.index');
        Route::get('/sales/{sale}', [CashierSaleController::class, 'show'])->name('sales.show');
        Route::get('/sales/{sale}/receipt', [CashierSaleController::class, 'receipt'])->name('sales.receipt');
        Route::get('/invoices', [CashierController::class, 'invoicesList'])->name('invoices.index');
        Route::get('/sales/{id}/invoice', [CashierController::class, 'invoice'])->name('invoice');

        // Gestion Clients & Produits
        Route::get('/orders', [CashierController::class, 'orders'])->name('orders.index');
        Route::get('/clients', [CashierController::class, 'clients'])->name('clients.index');
        Route::post('/clients', [CashierController::class, 'storeClient'])->name('clients.store');
        Route::get('/products', [CashierController::class, 'products'])->name('products.index');

        // Notifications
        Route::get('/notifications', [CashierController::class, 'notifications'])->name('notifications.index');
        Route::post('/notifications/{id}/read', [CashierController::class, 'markAsRead'])->name('notifications.markRead');
        Route::post('/notifications/read-all', [CashierController::class, 'markAllAsRead'])->name('notifications.markAll');
    });


// ======================================================
// ESPACE CLIENT
// ======================================================
Route::prefix('client')->name('client.')->group(function () {

    Route::get('/', [ClientHomeController::class, 'index'])->name('home');
    Route::get('/products', [ClientProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ClientProductController::class, 'show'])->name('products.show');
    Route::get('/categories', [ClientCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{id}', [ClientCategoryController::class, 'show'])->name('categories.show');

    // Panier en session
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Commande (Utilisateur connecté)
    Route::middleware(['auth'])->group(function () {
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
        Route::get('/orders', [ClientOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [ClientOrderController::class, 'show'])->name('orders.show');
    });
});


// ======================================================
// ESPACE MAGASINIER
// ======================================================
Route::prefix('storekeeper')->name('storekeeper.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [StorekeeperController::class, 'dashboard'])->name('dashboard');
    
    // Gestion du Stock
    Route::get('/stock', [StorekeeperController::class, 'stock'])->name('stock.index');
    Route::get('/stock/entry', [StorekeeperController::class, 'stockEntryForm'])->name('stock.entry');
    Route::post('/stock/entry', [StorekeeperController::class, 'storeStockEntry'])->name('stock.storeEntry');

    // Produits Magasinier
    Route::resource('products', StorekeeperProductController::class)->only(['index', 'store', 'update', 'destroy']);

    // Mouvements, Fournisseurs, Réapprovisionnement, Rapports et Notifications
    Route::get('/movements', [StorekeeperController::class, 'stock'])->name('movements.index');
    Route::get('/suppliers', [StorekeeperController::class, 'suppliers'])->name('suppliers.index');
    Route::get('/restock', [StorekeeperController::class, 'restock'])->name('restock.index');
    Route::post('/restock', [StorekeeperController::class, 'storeRestockRequest'])->name('restock.store');
    Route::get('/reports', [StorekeeperController::class, 'reports'])->name('reports.index');
    Route::get('/notifications', [StorekeeperController::class, 'notifications'])->name('notifications.index');
});