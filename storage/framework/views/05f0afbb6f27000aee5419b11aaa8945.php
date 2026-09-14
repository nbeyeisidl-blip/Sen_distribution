

<?php $__env->startSection('title', 'Gestion des commandes'); ?>

<?php $__env->startSection('page-title', 'Gestion des commandes'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold">
                <i class="bi bi-cart-check"></i>
                Gestion des commandes
            </h3>

            <p class="text-muted">
                Consultez et gérez les commandes des clients.
            </p>
        </div>

    </div>


    <?php if(session('success')): ?>

        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>

    <?php endif; ?>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>
                            <th>N°</th>
                            <th>Client</th>
                            <th>Total</th>
                            <th>Paiement</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr>

                            <td>
                                <strong>
                                    #<?php echo e($order->id); ?>

                                </strong>
                            </td>

                            <td>

                                <?php if($order->client): ?>

                                    <?php echo e($order->client->prenom); ?>

                                    <?php echo e($order->client->nom); ?>


                                <?php else: ?>

                                    Client inconnu

                                <?php endif; ?>

                            </td>

                            <td>
                                <strong>
                                    <?php echo e(number_format($order->total, 0, ',', ' ')); ?>

                                    FCFA
                                </strong>
                            </td>

                            <td>
                                <?php echo e($order->payment_method ?? '-'); ?>

                            </td>

                            <td>

                                <?php switch($order->status):

                                    case ('pending'): ?>
                                        <span class="badge bg-warning text-dark">
                                            En attente
                                        </span>
                                        <?php break; ?>

                                    <?php case ('confirmed'): ?>
                                        <span class="badge bg-primary">
                                            Confirmée
                                        </span>
                                        <?php break; ?>

                                    <?php case ('processing'): ?>
                                        <span class="badge bg-info">
                                            En préparation
                                        </span>
                                        <?php break; ?>

                                    <?php case ('shipped'): ?>
                                        <span class="badge bg-secondary">
                                            Expédiée
                                        </span>
                                        <?php break; ?>

                                    <?php case ('delivered'): ?>
                                        <span class="badge bg-success">
                                            Livrée
                                        </span>
                                        <?php break; ?>

                                    <?php case ('cancelled'): ?>
                                        <span class="badge bg-danger">
                                            Annulée
                                        </span>
                                        <?php break; ?>

                                <?php endswitch; ?>

                            </td>

                            <td>
                                <?php echo e($order->created_at->format('d/m/Y H:i')); ?>

                            </td>

                            <td>

                                <a href="<?php echo e(route('admin.orders.show', $order)); ?>"
                                   class="btn btn-sm btn-info">

                                    <i class="bi bi-eye"></i>

                                </a>

                                <a href="<?php echo e(route('admin.orders.edit', $order)); ?>"
                                   class="btn btn-sm btn-warning">

                                    <i class="bi bi-pencil"></i>

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>

                            <td colspan="7"
                                class="text-center py-5">

                                <i class="bi bi-cart-x fs-1 text-muted"></i>

                                <p class="text-muted mt-2">
                                    Aucune commande trouvée.
                                </p>

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                <?php echo e($orders->links()); ?>


            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>