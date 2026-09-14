```blade


<?php $__env->startSection('title', 'Mes commandes'); ?>

<?php $__env->startSection('content'); ?>

<div class="container">

    <h2 class="fw-bold mb-4">
        <i class="bi bi-bag-check"></i>
        Mes commandes
    </h2>

    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

        <div class="card border-0 shadow-sm mb-3">

            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-md-3">
                        <strong>
                            Commande #<?php echo e($order->id); ?>

                        </strong>
                    </div>

                    <div class="col-md-3">
                        <?php echo e($order->created_at->format('d/m/Y')); ?>

                    </div>

                    <div class="col-md-3">
                        <strong>
                            <?php echo e(number_format($order->total, 0, ',', ' ')); ?>

                            FCFA
                        </strong>
                    </div>

                    <div class="col-md-3 text-end">

                       <a href="<?php echo e(route('client.orders.show', $order->id)); ?>" class="btn btn-sm btn-primary">
                Voir la commande #<?php echo e($order->id); ?>

            </a>

                    </div>

                </div>

            </div>

        </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

        <div class="alert alert-info">
            Vous n'avez encore aucune commande.
        </div>

    <?php endif; ?>

    <?php echo e($orders->links()); ?>


</div>

<?php $__env->stopSection(); ?>
```

<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/client/orders/index.blade.php ENDPATH**/ ?>