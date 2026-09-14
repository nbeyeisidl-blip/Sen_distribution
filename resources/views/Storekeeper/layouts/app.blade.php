<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magasinier - SEN DISTRIBUTION</title>
    
    {{-- CSS Bootstrap 5 & Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { min-height: 100vh; background-color: #0d6efd; color: white; }
        .sidebar a { color: rgba(255, 255, 255, 0.8); text-decoration: none; padding: 12px 20px; display: flex; align-items: center; border-radius: 8px; margin-bottom: 4px; font-weight: 500; }
        .sidebar a:hover, .sidebar a.active { color: white; background-color: rgba(255, 255, 255, 0.15); }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        {{-- BARRE DE NAVIGATION LATÉRALE (SIDEBAR) --}}
        <div class="col-md-3 col-lg-2 sidebar p-3 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex align-items-center gap-2 mb-4 px-2">
                    <i class="bi bi-box-seam-fill fs-3"></i>
                    <span class="fw-bold fs-5">SEN DISTRIBUTION</span>
                </div>

                <nav class="nav flex-column">
    {{-- Tableau de bord --}}
    <a href="{{ route('storekeeper.dashboard') }}" class="{{ request()->routeIs('storekeeper.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2 me-2"></i> Tableau de bord
    </a>

    {{-- Produits --}}
    <a href="{{ route('storekeeper.products.index') }}" class="{{ request()->routeIs('storekeeper.products.*') ? 'active' : '' }}">
        <i class="bi bi-box me-2"></i> Produits
    </a>

    {{-- Stock --}}
    <a href="{{ route('storekeeper.stock.index') }}" class="{{ request()->routeIs('storekeeper.stock.index') ? 'active' : '' }}">
        <i class="bi bi-diagram-3 me-2"></i> Stock
    </a>

    {{-- Entrée de stock --}}
    <a href="{{ route('storekeeper.stock.entry') }}" class="{{ request()->routeIs('storekeeper.stock.entry') ? 'active' : '' }}">
        <i class="bi bi-arrow-down-right-square me-2"></i> Entrée de stock
    </a>

    {{-- Mouvements --}}
    <a href="{{ route('storekeeper.movements.index') }}" class="{{ request()->routeIs('storekeeper.movements.*') ? 'active' : '' }}">
        <i class="bi bi-arrow-left-right me-2"></i> Mouvements
    </a>
<a href="{{ route('storekeeper.suppliers.index') }}" class="nav-link {{ request()->routeIs('storekeeper.suppliers.*') ? 'active' : '' }}">
    <i class="bi bi-truck me-2"></i> Fournisseurs
</a>
<a href="{{ route('storekeeper.restock.index') }}" class="{{ request()->routeIs('storekeeper.restock.*') ? 'active' : '' }}">
    <i class="bi bi-arrow-repeat me-2"></i> Réapprovisionnement
</a>
<a href="{{ route('storekeeper.reports.index') }}" class="{{ request()->routeIs('storekeeper.reports.*') ? 'active' : '' }}">
    <i class="bi bi-file-earmark-bar-graph me-2"></i> Rapports
</a>
<a href="{{ route('storekeeper.notifications.index') }}" class="nav-link {{ request()->routeIs('storekeeper.notifications.*') ? 'active' : '' }}">
    <i class="bi bi-bell me-2"></i> Notifications
</a>
                </nav>
            </div>

            <div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100 fw-bold d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                    </button>
                </form>
            </div>
        </div>

        {{-- CONTENU PRINCIPAL --}}
        <div class="col-md-9 col-lg-10 p-4">
            @yield('content')
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>