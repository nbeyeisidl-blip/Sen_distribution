


<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4 py-3">

    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Tableau de bord Magasinier</h3>
            <p class="text-muted small mb-0">Gestion des stocks et suivi des mouvements — SEN DISTRIBUTION</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('storekeeper.stock.entry')); ?>" class="btn btn-primary btn-sm px-3 shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Entrée de stock
            </a>
            <a href="<?php echo e(route('storekeeper.restock.index')); ?>" class="btn btn-outline-secondary btn-sm px-3 shadow-sm">
                <i class="bi bi-arrow-repeat me-1"></i> Réapprovisionner
            </a>
        </div>
    </div>

    <!-- Cartes Statistiques KPi -->
    <div class="row g-3 mb-4">
        <!-- Total Produits -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-3 h-100 p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fw-semibold small text-uppercase">Total Produits</span>
                        <h2 class="fw-bold text-primary mb-0 mt-1"><?php echo e($totalProducts ?? 18); ?></h2>
                    </div>
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 text-primary d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                        <i class="bi bi-box-seam fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stock Total -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-3 h-100 p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fw-semibold small text-uppercase">Stock Total (Unités)</span>
                        <h2 class="fw-bold text-success mb-0 mt-1"><?php echo e($totalStock ?? 446); ?></h2>
                    </div>
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 text-success d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                        <i class="bi bi-layers fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ruptures / Alertes -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-3 h-100 p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fw-semibold small text-uppercase">Alertes Stock</span>
                        <h2 class="fw-bold text-warning mb-0 mt-1"><?php echo e($lowStockCount ?? 0); ?></h2>
                    </div>
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 text-warning d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                        <i class="bi bi-exclamation-triangle fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Entrées du mois -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-3 h-100 p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted fw-semibold small text-uppercase">Entrées du mois</span>
                        <h2 class="fw-bold text-info mb-0 mt-1"><?php echo e($monthlyEntries ?? 0); ?></h2>
                    </div>
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 text-info d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                        <i class="bi bi-arrow-down-left-square fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Principale : Tableau des Derniers Mouvements & Alertes -->
    <div class="row g-4">
        <!-- Derniers mouvements de stock -->
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 text-dark">Derniers Mouvements de Stock</h5>
                    <a href="<?php echo e(route('storekeeper.movements.index')); ?>" class="text-primary text-decoration-none small fw-semibold">Voir tout</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr class="small text-muted text-uppercase">
                                <th>Produit</th>
                                <th>Type</th>
                                <th class="text-center">Quantité</th>
                                <th>Date</th>
                                <th class="text-end">Auteur</th>
                            </tr>
                        </thead>
                        <tbody class="small">
    <?php $__empty_1 = true; $__currentLoopData = $recentMovements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td class="fw-bold"><?php echo e($product->name); ?></td>
            <td>
                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                    Entrée / Mise à jour
                </span>
            </td>
            <td class="text-center fw-semibold"><?php echo e($product->stock); ?></td>
            <td class="text-muted"><?php echo e($product->updated_at ? $product->updated_at->format('d/m/Y H:i') : '-'); ?></td>
            <td class="text-end">Magasinier</td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="5" class="text-center text-muted py-4">
                Aucun produit récent.
            </td>
        </tr>
    <?php endif; ?>
</tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Produits à Réapprovisionner -->
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 text-dark">Alertes de Stock</h5>
                    <span class="badge bg-warning text-dark rounded-pill"><?php echo e(count($lowStockProducts ?? [])); ?></span>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush small">
                        <?php $__empty_1 = true; $__currentLoopData = $lowStockProducts ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <div>
                                    <h6 class="fw-bold mb-0"><?php echo e($product->name); ?></h6>
                                    <small class="text-muted">Seuil min : <?php echo e($product->min_stock ?? 5); ?></small>
                                </div>
                                <span class="badge bg-danger rounded-pill px-3 py-2">
                                    Stock : <?php echo e($product->stock); ?>

                                </span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="list-group-item text-center text-muted py-4">
                                <i class="bi bi-check-circle text-success fs-3 d-block mb-1"></i>
                                Tous les stocks sont à niveau parfait !
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Storekeeper.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/storekeeper/dashboard.blade.php ENDPATH**/ ?>