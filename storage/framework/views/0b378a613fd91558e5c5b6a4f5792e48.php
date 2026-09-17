<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Magasinier - SEN DISTRIBUTION</title>
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { min-height: 100vh; background-color: #243c5e; color: white; }
        .sidebar a { color: rgba(255, 255, 255, 0.8); text-decoration: none; padding: 12px 20px; display: flex; align-items: center; border-radius: 8px; margin-bottom: 4px; font-weight: 500; }
        .sidebar a:hover, .sidebar a.active { color: white; background-color: rgba(255, 255, 255, 0.15); }
    
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
</head>
<body>

<div class="container-fluid">
    <div class="row">

        
        <div class="col-md-3 col-lg-2 sidebar p-3 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex align-items-center gap-2 mb-4 px-2">
                    <i class="bi bi-box-seam-fill fs-3"></i>
                    <span class="fw-bold fs-5">SEN DISTRIBUTION</span>
                </div>

                <nav class="nav flex-column">
    
    <a href="<?php echo e(route('storekeeper.dashboard')); ?>" class="<?php echo e(request()->routeIs('storekeeper.dashboard') ? 'active' : ''); ?>">
        <i class="bi bi-speedometer2 me-2"></i> Tableau de bord
    </a>

    
    <a href="<?php echo e(route('storekeeper.products.index')); ?>" class="<?php echo e(request()->routeIs('storekeeper.products.*') ? 'active' : ''); ?>">
        <i class="bi bi-box me-2"></i> Produits
    </a>

    
    <a href="<?php echo e(route('storekeeper.stock.index')); ?>" class="<?php echo e(request()->routeIs('storekeeper.stock.index') ? 'active' : ''); ?>">
        <i class="bi bi-diagram-3 me-2"></i> Stock
    </a>

    
    <a href="<?php echo e(route('storekeeper.stock.entry')); ?>" class="<?php echo e(request()->routeIs('storekeeper.stock.entry') ? 'active' : ''); ?>">
        <i class="bi bi-arrow-down-right-square me-2"></i> Entrée de stock
    </a>

    
    <a href="<?php echo e(route('storekeeper.movements.index')); ?>" class="<?php echo e(request()->routeIs('storekeeper.movements.*') ? 'active' : ''); ?>">
        <i class="bi bi-arrow-left-right me-2"></i> Mouvements
    </a>
<a href="<?php echo e(route('storekeeper.suppliers.index')); ?>" class="nav-link <?php echo e(request()->routeIs('storekeeper.suppliers.*') ? 'active' : ''); ?>">
    <i class="bi bi-truck me-2"></i> Fournisseurs
</a>
<a href="<?php echo e(route('storekeeper.restock.index')); ?>" class="<?php echo e(request()->routeIs('storekeeper.restock.*') ? 'active' : ''); ?>">
    <i class="bi bi-arrow-repeat me-2"></i> Réapprovisionnement
</a>
<a href="<?php echo e(route('storekeeper.reports.index')); ?>" class="<?php echo e(request()->routeIs('storekeeper.reports.*') ? 'active' : ''); ?>">
    <i class="bi bi-file-earmark-bar-graph me-2"></i> Rapports
</a>
<a href="<?php echo e(route('storekeeper.notifications.index')); ?>" class="nav-link <?php echo e(request()->routeIs('storekeeper.notifications.*') ? 'active' : ''); ?>">
    <i class="bi bi-bell me-2"></i> Notifications
</a>
                </nav>
            </div>

            <div>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger w-100 fw-bold d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                    </button>
                </form>
            </div>
        </div>

        
        <div class="col-md-9 col-lg-10 p-4">
            <?php echo $__env->yieldContent('content'); ?>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/storekeeper/layouts/app.blade.php ENDPATH**/ ?>