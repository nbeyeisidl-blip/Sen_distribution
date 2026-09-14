<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $__env->yieldContent('title', 'Administration'); ?> - SEN DISTRIBUTION</title>

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
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="logo">
        <i class="bi bi-shop"></i>
        SEN DISTRIBUTION
    </div>

    <a href="<?php echo e(route('admin.dashboard')); ?>"
       class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
        <i class="bi bi-speedometer2"></i>
        Dashboard
    </a>

    <a href="<?php echo e(route('admin.products.index')); ?>"
   class="<?php echo e(request()->routeIs('admin.products.*') ? 'active' : ''); ?>">

    <i class="bi bi-box-seam"></i>
    Produits

</a>

    <a href="<?php echo e(route('admin.categories.index')); ?>"
   class="<?php echo e(request()->routeIs('admin.categories.*') ? 'active' : ''); ?>">

    <i class="bi bi-tags"></i>
    Catégories

</a>

   <a href="<?php echo e(route('admin.clients.index')); ?>"
   class="<?php echo e(request()->routeIs('admin.clients.*') ? 'active' : ''); ?>">

    <i class="bi bi-people"></i>
    Clients

</a>

   <a href="<?php echo e(route('admin.fournisseurs.index')); ?>">

    <i class="bi bi-truck"></i>

    Fournisseurs

</a>

    <a href="<?php echo e(route('admin.sales.index')); ?>"
   class="<?php echo e(request()->routeIs('admin.sales.*') ? 'active' : ''); ?>">

    <i class="bi bi-cart3"></i>
    Ventes

</a>

   <a href="<?php echo e(route('admin.stock.index')); ?>"
   class="nav-link">

    <i class="bi bi-box-seam"></i>

    Gestion du stock

</a>

<a href="<?php echo e(route('admin.stock_movements.index')); ?>"
   class="nav-link">

    <i class="bi bi-clock-history"></i>

    Historique du stock

</a>

   <a href="<?php echo e(route('admin.orders.index')); ?>"
   class="nav-link">

    <i class="bi bi-cart-check"></i>

    Commandes

</a>


    <hr class="text-secondary">

    <a href="#">
        <i class="bi bi-gear"></i>
        Paramètres
    </a>

    <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
        <?php echo csrf_field(); ?>

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
            <?php echo $__env->yieldContent('page-title', 'Tableau de bord'); ?>
        </h5>
        <a href="<?php echo e(route('admin.notifications.index')); ?>"
        class="position-relative text-dark text-decoration-none me-4">

        <i class="bi bi-bell fs-4"></i>

        <?php
        $unreadNotifications = auth()->user()
            ->unreadNotifications
            ->count();
        ?>

        <?php if($unreadNotifications > 0): ?>

        <span class="position-absolute top-0 start-100
                     translate-middle badge rounded-pill bg-danger">

            <?php echo e($unreadNotifications); ?>


        </span>

     <?php endif; ?>

        </a>

        <div>
            <i class="bi bi-person-circle fs-4"></i>

            <span class="ms-2">
                <?php echo e(Auth::user()->name); ?>

            </span>
        </div>

    </div>


    <!-- PAGE -->
    <div class="dashboard-content">

        <?php echo $__env->yieldContent('content'); ?>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>