<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>@yield('title', 'Administration') - SEN DISTRIBUTION</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f5f6fa;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #212529;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
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

        .content {
            margin-left: 250px;
            min-height: 100vh;
        }

        .topbar {
            background: white;
            padding: 15px 25px;
            box-shadow: 0 2px 5px rgba(0,0,0,.08);
        }

        .dashboard-content {
            padding: 25px;
        }

        .stat-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,.06);
        }


        /* 1. Gestion globale pour mobile */
    html, body {
        max-width: 100%;
        overflow-x: hidden; /* Empêche le défilement horizontal indésirable de la page */
    }

    /* 2. Adaptation des tableaux sur tous les téléphones */
    .table-responsive {
        width: 100%;
        margin-bottom: 1rem;
        overflow-y: hidden;
        -ms-overflow-style: -ms-autohide-scrollbar;
        -webkit-overflow-scrolling: touch; /* Défilement fluide sur iOS / iPhone */
    }

    /* 3. Adaptation dynamique des cartes et formulaires */
    @media (max-width: 768px) {
        .container, .container-fluid {
            padding-left: 10px;
            padding-right: 10px;
        }

        /* Ajustement de la taille du texte et des boutons sur petit écran */
        h1, .h1 { font-size: 1.5rem; }
        h2, .h2 { font-size: 1.3rem; }
        
        .btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
        }
        
        /* Ajustement des images pour qu'elles ne dépassent jamais */
        img {
            max-width: 100%;
            height: auto;
        }
    }
    </style>

    @stack('styles')
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="logo">
        <i class="bi bi-shop"></i>
        SEN DISTRIBUTION
    </div>

    <a href="{{ route('admin.dashboard') }}"
       class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i>
        Dashboard
    </a>

    <a href="{{ route('admin.products.index') }}"
   class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">

    <i class="bi bi-box-seam"></i>
    Produits

</a>

    <a href="{{ route('admin.categories.index') }}"
   class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">

    <i class="bi bi-tags"></i>
    Catégories

</a>

   <a href="{{ route('admin.clients.index') }}"
   class="{{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">

    <i class="bi bi-people"></i>
    Clients

</a>

   <a href="{{ route('admin.fournisseurs.index') }}">

    <i class="bi bi-truck"></i>

    Fournisseurs

</a>

    <a href="{{ route('admin.sales.index') }}"
   class="{{ request()->routeIs('admin.sales.*') ? 'active' : '' }}">

    <i class="bi bi-cart3"></i>
    Ventes

</a>

   <a href="{{ route('admin.stock.index') }}"
   class="nav-link">

    <i class="bi bi-box-seam"></i>

    Gestion du stock

</a>

<a href="{{ route('admin.stock_movements.index') }}"
   class="nav-link">

    <i class="bi bi-clock-history"></i>

    Historique du stock

</a>

   <a href="{{ route('admin.orders.index') }}"
   class="nav-link">

    <i class="bi bi-cart-check"></i>

    Commandes

</a>


    <hr class="text-secondary">

    <a href="#">
        <i class="bi bi-gear"></i>
        Paramètres
    </a>

    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf

        <button type="submit"
                class="btn text-danger w-100 text-start px-4">
            <i class="bi bi-box-arrow-right"></i>
            Déconnexion
        </button>
    </form>

</div>


<!-- CONTENU -->
<div class="content">

    <!-- TOPBAR -->
    <div class="topbar d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            @yield('page-title', 'Tableau de bord')
        </h5>
        <a href="{{ route('admin.notifications.index') }}"
        class="position-relative text-dark text-decoration-none me-4">

        <i class="bi bi-bell fs-4"></i>

        @php
        $unreadNotifications = auth()->user()
            ->unreadNotifications
            ->count();
        @endphp

        @if($unreadNotifications > 0)

        <span class="position-absolute top-0 start-100
                     translate-middle badge rounded-pill bg-danger">

            {{ $unreadNotifications }}

        </span>

     @endif

        </a>

        <div>
            <i class="bi bi-person-circle fs-4"></i>

            <span class="ms-2">
                {{ Auth::user()->name }}
            </span>
        </div>

    </div>


    <!-- PAGE -->
    <div class="dashboard-content">

        @yield('content')

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>