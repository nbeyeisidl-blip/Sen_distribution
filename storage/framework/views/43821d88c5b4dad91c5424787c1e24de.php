

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1"><i class="bi bi-bell me-2"></i>Centre de Notifications</h1>
            <p class="text-muted small mb-0">Alertes sur l'état des stocks et ruptures - SEN DISTRIBUTION</p>
        </div>
        <span class="badge bg-danger fs-6 px-3 py-2">
            <?php echo e($totalNotifications); ?> Alerte(s) active(s)
        </span>
    </div>

    
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-danger text-white py-3">
            <h5 class="card-title fw-bold mb-0">
                <i class="bi bi-x-circle-fill me-2"></i>Ruptures de Stock (<?php echo e($outOfStockProducts->count()); ?>)
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small">
                        <tr>
                            <th>Code ID</th>
                            <th>Produit</th>
                            <th>Stock</th>
                            <th>Statut</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $outOfStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="fw-bold text-secondary">#PRD-<?php echo e(str_pad($product->id, 4, '0', STR_PAD_LEFT)); ?></td>
                                <td class="fw-bold text-dark"><?php echo e($product->name); ?></td>
                                <td><span class="badge bg-danger fs-6">0</span></td>
                                <td><span class="text-danger fw-bold"><i class="bi bi-exclamation-triangle-fill me-1"></i>Épuisé</span></td>
                                <td class="text-end">
                                    <a href="<?php echo e(route('storekeeper.restock.index')); ?>" class="btn btn-sm btn-outline-danger fw-bold">
                                        Réapprovisionner
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center py-3 text-success fw-bold">
                                    <i class="bi bi-check-circle me-1"></i> Aucune rupture de stock signalée.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-warning text-dark py-3">
            <h5 class="card-title fw-bold mb-0">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>Stock Critique / Faible (<?php echo e($lowStockProducts->count()); ?>)
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small">
                        <tr>
                            <th>Code ID</th>
                            <th>Produit</th>
                            <th>Stock Restant</th>
                            <th>Seuil Critique</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $lowStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="fw-bold text-secondary">#PRD-<?php echo e(str_pad($product->id, 4, '0', STR_PAD_LEFT)); ?></td>
                                <td class="fw-bold text-dark"><?php echo e($product->name); ?></td>
                                <td><span class="badge bg-warning text-dark fs-6"><?php echo e($product->stock); ?></span></td>
                                <td class="text-muted">Seuil &le; 5</td>
                                <td class="text-end">
                                    <a href="<?php echo e(route('storekeeper.restock.index')); ?>" class="btn btn-sm btn-outline-warning text-dark fw-bold">
                                        Commander
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center py-3 text-success fw-bold">
                                    <i class="bi bi-check-circle me-1"></i> Aucun produit sous le seuil critique.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('storekeeper.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/storekeeper/notifications/index.blade.php ENDPATH**/ ?>