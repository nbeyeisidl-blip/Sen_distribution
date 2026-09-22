
<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <!-- Fil d'Ariane -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="<?php echo e(route('client.home')); ?>" class="text-decoration-none text-muted">Accueil</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('client.orders.index')); ?>" class="text-decoration-none text-muted">Mes commandes</a></li>
            <li class="breadcrumb-item active fw-semibold" aria-current="page">Suivi commande</li>
        </ol>
    </nav>

    <!-- En-tête de la commande -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h3 class="fw-bold mb-1">Commande n° SD-<?php echo e(date('Y')); ?>-<?php echo e(str_pad($order->id, 5, '0', STR_PAD_LEFT)); ?></h3>
            <p class="text-muted small mb-0">Passée le <?php echo e($order->created_at->translatedFormat('d F Y à H:i')); ?></p>
        </div>
        <div>
            <?php
                $statusBadges = [
                    'pending' => ['bg' => 'bg-warning text-dark', 'label' => 'En attente'],
                    'validated' => ['bg' => 'bg-info text-dark', 'label' => 'Validée'],
                    'shipped' => ['bg' => 'bg-primary', 'label' => 'Expédiée'],
                    'shipping' => ['bg' => 'bg-success bg-opacity-75 text-white', 'label' => 'En livraison'],
                    'delivered' => ['bg' => 'bg-success', 'label' => 'Livrée'],
                    'cancelled' => ['bg' => 'bg-danger', 'label' => 'Annulée']
                ];
                $currentBadge = $statusBadges[$order->status] ?? ['bg' => 'bg-secondary', 'label' => 'En traitement'];
            ?>
            <span class="badge <?php echo e($currentBadge['bg']); ?> px-3 py-2 rounded-2 fs-6">
                <?php echo e($currentBadge['label']); ?>

            </span>
        </div>
    </div>

    <!-- Barre d'étapes de la commande -->
    <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-body p-4">
            <h6 class="fw-bold mb-4">Étapes de la commande</h6>

            <?php
                $steps = [
                    'pending'   => 'En attente',
                    'validated' => 'Validée',
                    'shipped'   => 'Expédiée',
                    'shipping'  => 'En livraison',
                    'delivered' => 'Livrée',
                ];

                $stepKeys = array_keys($steps);
                $currentIndex = array_search($order->status, $stepKeys);
                if ($currentIndex === false) { $currentIndex = 0; }
            ?>

            <div class="position-relative m-4">
                <div class="progress" style="height: 3px;">
                    <div class="progress-bar bg-dark" role="progressbar" 
                         style="width: <?php echo e(($currentIndex / (count($steps) - 1)) * 100); ?>%;"></div>
                </div>

                <div class="d-flex justify-content-between position-absolute top-0 start-0 w-100 translate-middle-y">
                    <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $stepIndex = array_search($key, $stepKeys);
                            $isCompleted = $stepIndex <= $currentIndex;
                        ?>
                        <div class="text-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2 <?php echo e($isCompleted ? 'bg-dark text-white' : 'bg-white text-muted border border-2'); ?>" 
                                 style="width: 32px; height: 32px; font-size: 14px;">
                                <?php if($isCompleted): ?>
                                    <i class="bi bi-check-lg"></i>
                                <?php else: ?>
                                    <i class="bi bi-circle"></i>
                                <?php endif; ?>
                            </div>
                            <div class="fw-semibold small <?php echo e($isCompleted ? 'text-dark' : 'text-muted'); ?>"><?php echo e($label); ?></div>
                            <div class="text-muted extra-small" style="font-size: 11px;">
                                <?php if($isCompleted): ?>
                                    <?php echo e($order->updated_at->format('d M Y')); ?><br><?php echo e($order->updated_at->format('H:i')); ?>

                                <?php else: ?>
                                    --
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Informations de livraison -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Informations de livraison</h6>
                    
                    <div class="row mb-2">
                        <span class="text-muted col-4">Livreur :</span>
                        <span class="fw-semibold col-8"><?php echo e($order->courier_name ?? 'Iba Beye'); ?></span>
                    </div>
                    <div class="row mb-2">
                        <span class="text-muted col-4">Téléphone :</span>
                        <span class="fw-semibold col-8"><?php echo e($order->courier_phone ?? '77 456 00 00'); ?></span>
                    </div>
                    <div class="row mb-2">
                        <span class="text-muted col-4">Adresse :</span>
                        <span class="fw-semibold col-8"><?php echo e($order->address); ?>, <?php echo e($order->city); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Articles commandés -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Articles commandés (<?php echo e($order->orderItems ? $order->orderItems->count() : 0); ?>)</h6>
                    
                    <div class="list-group list-group-flush">
                        <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="list-group-item d-flex align-items-center justify-content-between px-0 py-3">
                                <div class="d-flex align-items-center">
                                    <?php if(!empty($item->product->image)): ?>
                                        <img src="<?php echo e(asset('storage/' . $item->product->image)); ?>" alt="<?php echo e($item->product->name); ?>" class="rounded me-3 border" style="width: 50px; height: 50px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-light rounded border me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <i class="bi bi-bag text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <div class="fw-semibold text-dark"><?php echo e($item->product->name ?? 'Produit'); ?></div>
                                    </div>
                                </div>
                                <div class="text-muted me-4">x<?php echo e($item->quantity); ?></div>
                                <div class="fw-bold text-dark"><?php echo e(number_format($item->price * $item->quantity, 0, ',', ' ')); ?> FCFA</div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions du bas -->
    <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-3">
        <a href="<?php echo e(route('client.orders.index')); ?>" class="btn btn-outline-secondary rounded-2 px-3 py-2 text-decoration-none">
            <i class="bi bi-arrow-left me-2"></i>Retour à mes commandes
        </a>

        <div class="d-flex align-items-center gap-2 text-muted">
            <i class="bi bi-headset fs-3"></i>
            <div>
                <div class="fw-bold text-dark small">Besoin d'aide ?</div>
                <div class="small">Contactez notre support 24h/7</div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/client/orders/show.blade.php ENDPATH**/ ?>