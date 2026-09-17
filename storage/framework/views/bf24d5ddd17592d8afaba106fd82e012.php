


<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Notifications</h1>
            <p class="text-muted small mb-0">Centre d'alertes et messages système - SEN DISTRIBUTION</p>
        </div>
        <?php if($notifications->whereNull('read_at')->count() > 0): ?>
            <form action="<?php echo e(route('cashier.notifications.markAll')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-outline-primary fw-bold">
                    <i class="bi bi-check2-all me-1"></i> Tout marquer comme lu
                </button>
            </form>
        <?php endif; ?>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4">
            <i class="bi bi-check-circle-fill me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $isUnread = is_null($notification->read_at);
                        $data = is_array($notification->data) ? $notification->data : json_decode($notification->data, true);
                    ?>
                    <div class="list-group-item p-3 <?php echo e($isUnread ? 'bg-light' : 'bg-white'); ?>">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="d-flex align-items-start">
                                <div class="me-3 mt-1">
                                    <span class="badge bg-primary-subtle text-primary p-2 rounded-circle fs-6">
                                        <i class="bi bi-bell"></i>
                                    </span>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="mb-0 fw-bold text-dark me-2">
                                            <?php echo e($notification->title ?? $data['title'] ?? 'Notification'); ?>

                                        </h6>
                                        <?php if($isUnread): ?>
                                            <span class="badge bg-primary rounded-pill px-2 small">Nouveau</span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-muted small mb-1">
                                        <?php echo e($notification->message ?? $data['message'] ?? ''); ?>

                                    </p>
                                    <span class="text-muted extra-small" style="font-size: 0.75rem;">
                                        <i class="bi bi-clock me-1"></i><?php echo e($notification->created_at ? $notification->created_at->diffForHumans() : ''); ?>

                                    </span>
                                </div>
                            </div>

                            <?php if($isUnread): ?>
                                <form action="<?php echo e(route('cashier.notifications.markRead', $notification->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-light border text-secondary" title="Marquer comme lu">
                                        <i class="bi bi-check"></i>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center py-5">
                        <i class="bi bi-bell-slash fs-1 text-muted d-block mb-3"></i>
                        <p class="text-muted mb-0">Aucune notification pour le moment.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if($notifications->hasPages()): ?>
            <div class="card-footer bg-white py-3">
                <?php echo e($notifications->links()); ?>

            </div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cashier.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/cashier/notifications/index.blade.php ENDPATH**/ ?>