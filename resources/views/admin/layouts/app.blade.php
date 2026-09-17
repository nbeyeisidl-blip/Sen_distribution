<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>@yield('title', 'Administration') - SEN DISTRIBUTION</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f5f6fa;
        }

        /* --- SIDEBAR RESPONSIVE --- */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #212529;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 1050;
            transition: transform 0.3s ease-in-out;
            overflow-y: auto;
        }

        .sidebar .logo {
            padding: 20px;
            color: white;
            font-size: 22px;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid #343a40;
        }

        .sidebar a {
            display: block;
            padding: 13px 20px;
            color: #adb5bd;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #0d6efd;
            color: white;
        }

        .sidebar i {
            margin-right: 10px;
        }

        /* --- CONTENU --- */
        .content {
            margin-left: 250px;
            min-height: 100vh;
            transition: margin-left 0.3s ease-in-out;
        }

        .topbar {
            background: white;
            padding: 15px 25px;
            box-shadow: 0 2px 5px rgba(0,0,0,.08);
        }

        .dashboard-content {
            padding: 25px;
        }

        /* OVERLAY SOMBRE POUR MOBILE */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.5);
            z-index: 1040;
        }

        /* --- ADAPTATION MOBILE (< 768px) --- */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%); /* Masquer la sidebar hors écran */
            }

            .sidebar.show {
                transform: translateX(0); /* Afficher la sidebar */
            }

            .sidebar-overlay.show {
                display: block;
            }

            .content {
                margin-left: 0; /* Supprimer la marge gauche sur mobile */
            }

            .dashboard-content {
                padding: 15px 10px;
            }

            h1, .h1 { font-size: 1.4rem; }
            h2, .h2 { font-size: 1.2rem; }
            .btn { padding: 0.4rem 0.6rem; font-size: 0.875rem; }
        }

        html, body {
            max-width: 100%;
            overflow-x: hidden;
        }

        .table-responsive {
            width: 100%;
            margin-bottom: 1rem;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
        }
    </style>

    @stack('styles')
</head>

<body>

<!-- OVERLAY POUR FERMER LA SIDEBAR SUR MOBILE -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div class="logo d-flex justify-content-between align-items-center px-3">
        <span><i class="bi bi-shop"></i> SEN DISTRIBUTION</span>
        <button class="btn text-white d-md-none p-0" id="closeSidebar">
            <i class="bi bi-x-lg fs-4"></i>
        </button>
    </div>

    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
        <i class="bi bi-box-seam"></i> Produits
    </a>

    <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
        <i class="bi bi-tags"></i> Catégories
    </a>

    <a href="{{ route('admin.clients.index') }}" class="{{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Clients
    </a>

    <a href="{{ route('admin.fournisseurs.index') }}" class="{{ request()->routeIs('admin.fournisseurs.*') ? 'active' : '' }}">
        <i class="bi bi-truck"></i> Fournisseurs
    </a>

    <a href="{{ route('admin.sales.index') }}" class="{{ request()->routeIs('admin.sales.*') ? 'active' : '' }}">
        <i class="bi bi-cart3"></i> Ventes
    </a>

    <a href="{{ route('admin.stock.index') }}" class="{{ request()->routeIs('admin.stock.*') ? 'active' : '' }}">
        <i class="bi bi-box-seam"></i> Gestion du stock
    </a>

    <a href="{{ route('admin.stock_movements.index') }}" class="{{ request()->routeIs('admin.stock_movements.*') ? 'active' : '' }}">
        <i class="bi bi-clock-history"></i> Historique du stock
    </a>

    <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
        <i class="bi bi-cart-check"></i> Commandes
    </a>

    <hr class="text-secondary">

    <a href="#">
        <i class="bi bi-gear"></i> Paramètres
    </a>

    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="btn text-danger w-100 text-start px-4">
            <i class="bi bi-box-arrow-right"></i> Déconnexion
        </button>
    </form>
</div>

<!-- CONTENU -->
<div class="content">

    <!-- TOPBAR -->
    <div class="topbar d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <!-- BOUTON HAMBURGER VISIBLE UNIQUEMENT SUR MOBILE -->
            <button class="btn btn-dark d-md-none me-3" id="toggleSidebar">
                <i class="bi bi-list fs-4"></i>
            </button>
            <h5 class="mb-0 fs-6 fs-md-5">
                @yield('page-title', 'Tableau de bord')
            </h5>
        </div>

        <div class="d-flex align-items-center">
            <a href="{{ route('admin.notifications.index') }}" class="position-relative text-dark text-decoration-none me-3 me-md-4">
                <i class="bi bi-bell fs-5 fs-md-4"></i>
                @php
                    $unreadNotifications = auth()->user()->unreadNotifications->count();
                @endphp
                @if($unreadNotifications > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem;">
                        {{ $unreadNotifications }}
                    </span>
                @endif
            </a>

            <div class="d-flex align-items-center">
                <i class="bi bi-person-circle fs-5 fs-md-4"></i>
                <span class="ms-2 d-none d-sm-inline font-weight-bold">
                    {{ Auth::user()->name }}
                </span>
            </div>
        </div>
    </div>

    <!-- PAGE CONTENT -->
    <div class="dashboard-content">
        @yield('content')
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Gestion du menu hamburger mobile
    const toggleBtn = document.getElementById('toggleSidebar');
    const closeBtn = document.getElementById('closeSidebar');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function openSidebar() {
        sidebar.classList.add('show');
        overlay.classList.add('show');
    }

    function closeSidebarMenu() {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
    }

    if (toggleBtn) toggleBtn.addEventListener('click', openSidebar);
    if (closeBtn) closeBtn.addEventListener('click', closeSidebarMenu);
    if (overlay) overlay.addEventListener('click', closeSidebarMenu);
</script>

@stack('scripts')

</body>
</html>