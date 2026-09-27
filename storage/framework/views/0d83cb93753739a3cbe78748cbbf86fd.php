

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1"><i class="bi bi-file-earmark-bar-graph me-2"></i>Rapports d'Inventaire</h1>
            <p class="text-muted small mb-0">Analyse globale et vue synthétique des stocks - SEN DISTRIBUTION</p>
        </div>
        <button onclick="window.print()" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-printer me-1"></i> Imprimer le rapport
        </button>
    </div>

    
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm border-start border-primary border-4">
                <div class="card-body">
                    <span class="text-muted small text-uppercase fw-bold">Total Produits</span>
                    <h3 class="fw-bold my-1"><?php echo e(number_format($totalProducts)); ?></h3>
                    <span class="text-muted small">Références enregistrées</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm border-start border-success border-4">
                <div class="card-body">
                    <span class="text-muted small text-uppercase fw-bold">Stock Total</span>
                    <h3 class="fw-bold my-1 text-success"><?php echo e(number_format($totalStockUnits)); ?></h3>
                    <span class="text-muted small">Unités en magasin</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm border-start border-warning border-4">
                <div class="card-body">
                    <span class="text-muted small text-uppercase fw-bold">Alertes Stock</span>
                    <h3 class="fw-bold my-1 text-warning"><?php echo e($lowStockProducts); ?></h3>
                    <span class="text-muted small">Seuil critique (&le; 5)</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm border-start border-danger border-4">
                <div class="card-body">
                    <span class="text-muted small text-uppercase fw-bold">Ruptures</span>
                    <h3 class="fw-bold my-1 text-danger"><?php echo e($outOfStock); ?></h3>
                    <span class="text-muted small">Produits épuisés</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title fw-bold mb-0"><i class="bi bi-folder me-2"></i>Répartition du Stock par Catégorie</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light small">
                                <tr>
                                    <th>Catégorie</th>
                                    <th class="text-center">Nombre de Produits</th>
                                    <th class="text-end">Total Unités</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $categoriesStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="fw-bold"><?php echo e($cat->name); ?></td>
                                        <td class="text-center"><span class="badge bg-light text-dark border"><?php echo e($cat->products_count); ?></span></td>
                                        <td class="text-end fw-bold"><?php echo e(number_format($cat->total_stock ?? 0)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="3" class="text-center py-3 text-muted">Aucune donnée disponible.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title fw-bold mb-0"><i class="bi bi-trophy me-2"></i>Top 5 - plus gros volumes</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <?php $__empty_1 = true; $__currentLoopData = $topStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <div>
                                    <span class="fw-bold text-dark d-block"><?php echo e($prod->name); ?></span>
                                    <small class="text-muted">ID: #PRD-<?php echo e(str_pad($prod->id, 4, '0', STR_PAD_LEFT)); ?></small>
                                </div>
                                <span class="badge bg-primary rounded-pill px-3 py-2 fs-6"><?php echo e($prod->stock); ?> unités</span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="list-group-item text-center py-3 text-muted">Aucun produit.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('storekeeper.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/storekeeper/reports/index.blade.php ENDPATH**/ ?>