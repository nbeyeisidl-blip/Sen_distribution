<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>
        @yield('title', 'SEN DISTRIBUTION')
    </title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f5f7fb;
            color: #283f5e;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        .navbar-brand {
            font-weight: 700;
            color: #2563eb !important;
        }

        .nav-link {
            font-weight: 500;
        }

        .hero-section {
            background: linear-gradient(135deg, #063b78, #0755a0);
            color: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .hero-section img {
            max-height: 230px;
            object-fit: contain;
        }

        .category-card, .product-card {
            border: none;
            border-radius: 12px;
            transition: 0.3s;
        }

        .category-card:hover, .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.10);
        }

        .product-image {
            height: 200px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 15px;
        }

        .price {
            color: #2563eb;
            font-size: 1.25rem;
            font-weight: 700;
        }

        .cart-badge {
            font-size: 0.7rem;
            padding: 0.25em 0.45em;
        }

        footer {
            margin-top: 60px;
        }

        /* 1. Gestion globale pour mobile */
        html, body {
            max-width: 100%;
            overflow-x: hidden;
        }

        /* 2. Adaptation des tableaux sur tous les téléphones */
        .table-responsive {
            width: 100%;
            margin-bottom: 1rem;
            overflow-y: hidden;
            -ms-overflow-style: -ms-autohide-scrollbar;
            -webkit-overflow-scrolling: touch;
        }

        /* 3. Style Menu Catégories Imbriquées (Style Jumia) */
        @media (min-width: 992px) {
            .dropdown-menu .dropend:hover > .dropdown-menu {
                display: block;
                position: absolute;
                top: 0;
                left: 100%;
                margin-top: -6px;
            }
        }

        /* 4. Adaptation dynamique des cartes et formulaires */
        @media (max-width: 768px) {
            .container, .container-fluid {
                padding-left: 10px;
                padding-right: 10px;
            }

            h1, .h1 { font-size: 1.5rem; }
            h2, .h2 { font-size: 1.3rem; }
            
            .btn {
                padding: 0.5rem 0.75rem;
                font-size: 0.9rem;
            }
            
            img {
                max-width: 100%;
                height: auto;
            }
        }


        /* Alignement du conteneur parent */
.category-item {
    position: relative;
}

/* Style du panneau flottant à la Jumia */
.jumia-megamenu {
    display: none;
    position: absolute;
    top: 0;
    left: 100%; /* S'affiche exactement à droite du bloc principal */
    width: 320px;
    min-height: 100%;
    z-index: 1050;
    margin-left: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
}

/* Affichage dynamique au survol */
.category-item:hover .jumia-megamenu {
    display: block;
}

/* Effet visuel au survol du bouton principal */
.category-item:hover > a {
    background-color: #e2e8f0 !important;
    color: #2563eb !important;
}

.hover-bg-light:hover {
    background-color: #f8f9fa;
}


/* Style des boutons d'onglet à gauche */
.custom-jumia-tabs .nav-link {
    color: #333;
    border-radius: 8px;
    transition: all 0.2s ease;
    border: 1px solid transparent;
}

.custom-jumia-tabs .nav-link:hover {
    background-color: #f1f5f9;
    color: #0d6efd;
}

/* Style de la catégorie active sélectionnée */
.custom-jumia-tabs .nav-link.active {
    background-color: #e7f1ff !important;
    color: #0d6efd !important;
    font-weight: bold;
    border-color: #b6d4fe;
}

.custom-jumia-tabs .nav-link.active .bi-chevron-right {
    color: #0d6efd !important;
}

/* Boîte des images de sous-catégories */
.jumia-img-box {
    height: 90px;
    transition: transform 0.2s ease;
}

.jumia-subcat-card:hover .jumia-img-box {
    transform: translateY(-3px);
    background-color: #e2e8f0 !important;
}

.jumia-subcat-card:hover span {
    color: #0d6efd !important;
}
    </style>

    @stack('styles')
</head>

<body>

<!-- =========================
     NAVBAR
========================= -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">

        <a class="navbar-brand" href="{{ route('client.home') }}">
            <i class="bi bi-shop me-1"></i> SEN DISTRIBUTION
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarClient">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarClient">

            <ul class="navbar-nav mx-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.home') }}">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.products.index') }}">Produits</a>
                </li>

                <!-- Menu Déroulant Catégories & Sous-Catégories (Style Jumia) -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Catégories
                    </a>
                    <ul class="dropdown-menu shadow" aria-labelledby="categoriesDropdown">
                        @php
                            // Récupération dynamique des catégories principales et leurs enfants
                            $categoriesMenu = \App\Models\Category::whereNull('parent_id')->with('children')->get();
                        @endphp

                        @forelse($categoriesMenu as $parent)
                            <li class="dropend">
                                <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('client.products.index', ['category' => $parent->slug]) }}">
                                    <span>{{ $parent->name }}</span>
                                    @if($parent->children->isNotEmpty())
                                        <i class="bi bi-chevron-right ms-2 fs-7 text-muted"></i>
                                    @endif
                                </a>

                                {{-- Affichage des Sous-catégories rattachées --}}
                                @if($parent->children->isNotEmpty())
                                    <ul class="dropdown-menu shadow">
                                        @foreach($parent->children as $child)
                                            <li>
                                                <a class="dropdown-item" href="{{ route('client.products.index', ['category' => $child->slug]) }}">
                                                    {{ $child->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @empty
                            <li><span class="dropdown-item text-muted">Aucune catégorie</span></li>
                        @endforelse
                    </ul>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-3">

                <!-- Recherche -->
                <a href="{{ route('client.products.index') }}" class="text-dark">
                    <i class="bi bi-search fs-5"></i>
                </a>

                <!-- Panier avec Compteur -->
                <a href="{{ route('client.cart.index') }}" class="text-dark position-relative">
                    <i class="bi bi-cart3 fs-5"></i>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>

                <!-- Espace Compte / Auth Unifiée -->
                @auth
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle btn-sm fw-semibold" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name ?? 'Mon Compte' }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            
                            {{-- Lien visible uniquement pour les administrateurs --}}
                            @if(Auth::user()->role === 'admin')
                                <li>
                                    <a class="dropdown-item fw-bold text-primary" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>Tableau de bord Admin
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            @elseif(Auth::user()->role === 'cashier' || Auth::user()->role === 'caissier')
                                <li>
                                    <a class="dropdown-item fw-bold text-success" href="{{ route('cashier.dashboard') }}">
                                        <i class="bi bi-calculator me-2"></i>Espace Caissier
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            @endif

                            <li>
                                <a class="dropdown-item" href="{{ route('client.orders.index') }}">
                                    <i class="bi bi-bag-check me-2"></i>Mes Commandes
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>

        </div>
    </div>
</nav>


<!-- =========================
     CONTENU PRINCIPAL
========================= -->
<main class="container py-4">

    {{-- Message spécial de confirmation de commande --}}
    @if(session('order_id'))
        <div class="alert alert-success d-flex justify-content-between align-items-center shadow-sm p-3 mb-4 rounded">
            <div>
                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                <span class="fw-bold">Votre commande a bien été prise en compte !</span>
            </div>
            <a href="{{ route('client.orders.show', session('order_id')) }}" class="btn btn-primary fw-bold btn-sm">
                Voir la commande #{{ session('order_id') }}
            </a>
        </div>
    @endif

    {{-- Message de succès classique --}}
    @if(session('success') && !session('order_id'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Message d'erreur --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Insertion dynamique du contenu des pages enfant --}}
    @yield('content')

</main>


<!-- =========================
     FOOTER
========================= -->
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row g-4">

            <div class="col-md-4">
                <h5 class="fw-bold">
                    <i class="bi bi-shop me-1"></i> SEN DISTRIBUTION
                </h5>
                <p class="text-white-50 small">
                    Votre boutique en ligne pour acheter facilement vos produits de qualité en toute sécurité.
                </p>
            </div>

            <div class="col-md-4">
                <h6 class="fw-bold">Navigation</h6>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-1">
                        <a href="{{ route('client.home') }}" class="text-white-50 text-decoration-none">Accueil</a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('client.products.index') }}" class="text-white-50 text-decoration-none">Produits</a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('client.categories.index') }}" class="text-white-50 text-decoration-none">Catégories</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4">
                <h6 class="fw-bold">Contact</h6>
                <p class="text-white-50 small mb-1">
                    <i class="bi bi-telephone me-1"></i> +221 76 244 52 49
                </p>
                <p class="text-white-50 small mb-0">
                    <i class="bi bi-envelope me-1"></i> contact@sendistribution.com
                </p>
            </div>

        </div>

        <hr class="my-4 border-secondary">

        <p class="text-center text-white-50 small mb-0">
            © {{ date('Y') }} SEN DISTRIBUTION — Tous droits réservés.
        </p>
    </div>
</footer>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>