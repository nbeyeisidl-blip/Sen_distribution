

 

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Center de Notifications</h1>
            <p class="text-muted small mb-0">Gestion et suivi des alertes du système SEN DISTRIBUTION</p>
        </div>
        <?php if(auth()->user()->unreadNotifications->count() > 0): ?>
            <form action="<?php echo e(route('admin.notifications.markAllRead')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-outline-primary btn-sm fw-bold">
                    <i class="bi bi-check2-all me-1"></i> Tout marquer comme lu
                </button>
            </form>
        <?php endif; ?>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0 text-primary">
                <i class="bi bi-bell-fill me-2"></i>Toutes les notifications
            </h6>
            <span class="badge bg-primary rounded-pill">
                <?php echo e(auth()->user()->unreadNotifications->count()); ?> non lue(s)
            </span>
        </div>

        <div class="list-group list-group-flush">
            <?php $__empty_1 = true; $__currentLoopData = auth()->user()->notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="list-group-item list-group-item-action p-3 <?php echo e($notification->unread() ? 'bg-light border-start border-primary border-4' : ''); ?>">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center me-3">
                            
                            <div class="me-3 fs-3">
                                <?php if(($notification->data['type'] ?? '') === 'new_order'): ?>
                                    <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-circle">
                                        <i class="bi bi-cart-check"></i>
                                    </span>
                                <?php elseif(($notification->data['type'] ?? '') === 'low_stock'): ?>
                                    <span class="badge bg-warning bg-opacity-10 text-warning p-2 rounded-circle">
                                        <i class="bi bi-exclamation-triangle"></i>
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary p-2 rounded-circle">
                                        <i class="bi bi-bell"></i>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div>
                                <h6 class="fw-bold mb-1 text-dark">
                                    <?php echo e($notification->data['message'] ?? 'Nouvelle notification système'); ?>

                                </h6>
                                <p class="mb-1 text-muted small">
                                    Client : <strong><?php echo e($notification->data['client_nom'] ?? 'N/A'); ?></strong> 
                                    <?php if(isset($notification->data['total'])): ?>
                                        | Montant : <strong class="text-primary"><?php echo e(number_format($notification->data['total'], 0, ',', ' ')); ?> FCFA</strong>
                                    <?php endif; ?>
                                </p>
                                <span class="text-muted" style="font-size: 0.75rem;">
                                    <i class="bi bi-clock me-1"></i><?php echo e($notification->created_at->diffForHumans()); ?>

                                </span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <?php if(isset($notification->data['order_id'])): ?>
                                <a href="<?php echo e(route('admin.orders.show', $notification->data['order_id'])); ?>" class="btn btn-sm btn-primary fw-bold">
                                    Voir la commande
                                </a>
                            <?php endif; ?>

                            <?php if($notification->unread()): ?>
                                <form action="<?php echo e(route('admin.notifications.markRead', $notification->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-light border text-muted" title="Marquer comme lu">
                                        <i class="bi bi-check2"></i>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center py-5">
                    <i class="bi bi-bell-slash display-1 text-muted mb-3 d-block"></i>
                    <h5 class="fw-bold text-muted">Aucune notification</h5>
                    <p class="text-muted small">Vous n'avez reçu aucune alerte pour le moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/notifications/index.blade.php ENDPATH**/ ?>