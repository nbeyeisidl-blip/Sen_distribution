<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>
        <?php echo $__env->yieldContent('title', 'SEN DISTRIBUTION'); ?>
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
            padding: 40px;
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

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>

<!-- =========================
     NAVBAR
========================= -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">

        <a class="navbar-brand" href="<?php echo e(route('client.home')); ?>">
            <i class="bi bi-shop me-1"></i> SEN DISTRIBUTION
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarClient">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarClient">

            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('client.home')); ?>">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('client.products.index')); ?>">Produits</a>
                </li>
                 <li class="mb-1">
                        <a  class="nav-link" href="<?php echo e(route('client.categories.index')); ?>" class="text-white-50 text-decoration-none">Categories</a>
                    </li>
            </ul>

            <div class="d-flex align-items-center gap-3">

                <!-- Recherche -->
                <a href="<?php echo e(route('client.products.index')); ?>" class="text-dark">
                    <i class="bi bi-search fs-5"></i>
                </a>

                <!-- Panier avec Compteur -->
                <a href="<?php echo e(route('client.cart.index')); ?>" class="text-dark position-relative">
                    <i class="bi bi-cart3 fs-5"></i>
                    <?php if(session('cart') && count(session('cart')) > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge">
                            <?php echo e(count(session('cart'))); ?>

                        </span>
                    <?php endif; ?>
                </a>

                <!-- Espace Compte / Auth Unifiée -->
<?php if(auth()->guard()->check()): ?>
    <div class="dropdown">
        <button class="btn btn-outline-primary dropdown-toggle btn-sm fw-semibold" type="button" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle me-1"></i> <?php echo e(Auth::user()->name ?? 'Mon Compte'); ?>

        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
            
            
            <?php if(Auth::user()->role === 'admin'): ?>
                <li>
                    <a class="dropdown-item fw-bold text-primary" href="<?php echo e(route('admin.dashboard')); ?>">
                        <i class="bi bi-speedometer2 me-2"></i>Tableau de bord Admin
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
            <?php elseif(Auth::user()->role === 'cashier' || Auth::user()->role === 'caissier'): ?>
                <li>
                    <a class="dropdown-item fw-bold text-success" href="<?php echo e(route('cashier.dashboard')); ?>">
                        <i class="bi bi-calculator me-2"></i>Espace Caissier
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
            <?php endif; ?>

            <li>
                <a class="dropdown-item" href="<?php echo e(route('client.orders.index')); ?>">
                    <i class="bi bi-bag-check me-2"></i>Mes Commandes
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                    </button>
                </form>
            </li>
        </ul>
    </div>
<?php else: ?>
    
    <a href="<?php echo e(route('login')); ?>" class="btn btn-primary btn-sm fw-semibold">
        <i class="bi bi-box-arrow-in-right me-1"></i> Connexion
    </a>
<?php endif; ?>
            </div>

        </div>
    </div>
</nav>


<!-- =========================
     CONTENU PRINCIPAL
========================= -->
<main class="container py-4">

    
    <?php if(session('order_id')): ?>
        <div class="alert alert-success d-flex justify-content-between align-items-center shadow-sm p-3 mb-4 rounded">
            <div>
                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                <span class="fw-bold">Votre commande a bien été prise en compte !</span>
            </div>
            <a href="<?php echo e(route('client.orders.show', session('order_id'))); ?>" class="btn btn-primary fw-bold btn-sm">
                Voir la commande #<?php echo e(session('order_id')); ?>

            </a>
        </div>
    <?php endif; ?>

    
    <?php if(session('success') && !session('order_id')): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    
    <?php echo $__env->yieldContent('content'); ?>

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
                        <a href="<?php echo e(route('client.home')); ?>" class="text-white-50 text-decoration-none">Accueil</a>
                    </li>
                    <li class="mb-1">
                        <a href="<?php echo e(route('client.products.index')); ?>" class="text-white-50 text-decoration-none">Produits</a>
                    </li>
                     <li class="mb-1">
                        <a href="<?php echo e(route('client.categories.index')); ?>" class="text-white-50 text-decoration-none">Categories</a>
                    </li>
                    <li class="mb-1">
                        <a href="<?php echo e(route('client.cart.index')); ?>" class="text-white-50 text-decoration-none">Panier</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4">
                <h6 class="fw-bold">Contact</h6>
                <p class="text-white-50 small mb-1">
                    <i class="bi bi-telephone me-1"></i> +221 33 000 00 00
                </p>
                <p class="text-white-50 small mb-0">
                    <i class="bi bi-envelope me-1"></i> contact@sendistribution.com
                </p>
            </div>

        </div>

        <hr class="my-4 border-secondary">

        <p class="text-center text-white-50 small mb-0">
            © <?php echo e(date('Y')); ?> SEN DISTRIBUTION — Tous droits réservés.
        </p>
    </div>
</footer>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/client/layouts/app.blade.php ENDPATH**/ ?>