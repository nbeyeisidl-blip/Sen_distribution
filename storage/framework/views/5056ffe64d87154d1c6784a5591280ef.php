<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo $__env->yieldContent('title', 'Caissier - SEN DISTRIBUTION'); ?>
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>

        body {
            background: #f5f7fb;
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: #063b78;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
        }

        .sidebar .logo {
            padding: 25px;
            font-size: 21px;
            font-weight: bold;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 13px 22px;
        }

        .sidebar a:hover {
            background: #0d5db8;
        }

        .content {
            margin-left: 240px;
            padding: 25px;
        }

        .topbar {
            background: white;
            padding: 15px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .card-stat {
            border: none;
            border-radius: 14px;
        }

    </style>

</head>

<body>

<div class="sidebar">

    <div class="logo">
        <i class="bi bi-shop"></i>
        SEN DISTRIBUTION
    </div>

    <hr>

    <a href="<?php echo e(route('cashier.dashboard')); ?>">
        <i class="bi bi-speedometer2 me-2"></i>
        Tableau de bord
    </a>
<?php
    // Utilisation des colonnes standards Laravel (notifiable_id et read_at)
    $unreadCount = \App\Models\Notification::where('notifiable_id', auth()->id())
        ->whereNull('read_at')
        ->count();
?>

<a href="<?php echo e(route('cashier.notifications.index')); ?>" class="nav-link text-white d-flex justify-content-between align-items-center <?php echo e(request()->routeIs('cashier.notifications.*') ? 'active bg-primary' : ''); ?>">
    <div>
        <i class="bi bi-bell me-2"></i>
        Notifications
    </div>
    <?php if($unreadCount > 0): ?>
        <span class="badge bg-danger rounded-pill"><?php echo e($unreadCount); ?></span>
    <?php endif; ?>
</a>
    <a href="<?php echo e(route('cashier.sales.create')); ?>">
        <i class="bi bi-cart-plus me-2"></i>
        Nouvelle vente
    </a>

    <a href="<?php echo e(route('cashier.sales.index')); ?>">
        <i class="bi bi-receipt me-2"></i>
        Mes ventes
    </a>

    <a href="<?php echo e(route('cashier.orders.index')); ?>" >
    <i class="bi bi-cart-check me-2"></i>
    Commandes
</a>
<a href="<?php echo e(route('cashier.clients.index')); ?>" >
    <i class="bi bi-cart-check me-2"></i>
    Clients
</a>
<a href="<?php echo e(route('cashier.products.index')); ?>">
    <i class="bi bi-box-seam me-2"></i>
    Produits
</a>
<a href="<?php echo e(route('cashier.invoices.index')); ?>">
    <i class="bi bi-printer me-2"></i>
    Factures
</a>

    <form method="POST"
          action="<?php echo e(route('admin.logout')); ?>"
          class="mt-4">

        <?php echo csrf_field(); ?>

        <button class="btn btn-danger mx-3 w-75">
            <i class="bi bi-box-arrow-right"></i>
            Déconnexion
        </button>

    </form>

</div>


<div class="content">

    <div class="topbar d-flex justify-content-between">

        <div>
            <h5 class="mb-0">
                <?php echo $__env->yieldContent('page-title', 'Tableau de bord'); ?>
            </h5>
        </div>

        <div>
            <i class="bi bi-person-circle fs-4"></i>

            <?php if(auth()->guard()->check()): ?>
                <?php echo e(auth()->user()->name); ?>

            <?php endif; ?>
        </div>

    </div>

    <?php if(session('success')): ?>

        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>

    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>

</div>

</body>

</html><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/cashier/layouts/app.blade.php ENDPATH**/ ?>