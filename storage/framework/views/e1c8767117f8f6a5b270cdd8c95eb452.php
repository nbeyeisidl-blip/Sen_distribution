


<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Tableau de bord</h1>
            <p class="text-muted small mb-0">Interface Caissier - SEN DISTRIBUTION</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="position-relative">
                <i class="bi bi-bell fs-4"></i>
                <?php if(auth()->user()->unreadNotifications->count() > 0): ?>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                <?php endif; ?>
            </div>
            <div class="d-flex align-items-center gap-2 border-start ps-3">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                    <i class="bi bi-person-fill fs-5"></i>
                </div>
                <span class="fw-semibold text-dark"><?php echo e(auth()->user()->name ?? 'Caissier'); ?></span>
            </div>
        </div>
    </div>

    
    <div class="row g-3 mb-4">
        
        
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <span class="text-muted small fw-semibold">Ventes</span>
                    <h2 class="fw-bold text-dark my-2"><?php echo e($salesCount ?? 0); ?></h2>
                </div>
            </div>
        </div>

        
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <span class="text-muted small fw-semibold">Ventes du mois - Montant</span>
                    <h2 class="fw-bold text-primary my-2">
                        <?php echo e(number_format($totalAmount ?? 0, 0, ',', ' ')); ?> <span class="fs-6 text-dark">FCFA</span>
                    </h2>
                </div>
            </div>
        </div>

        
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <span class="text-muted small fw-semibold">Commandes en attente</span>
                    <h2 class="fw-bold text-dark my-2"><?php echo e($pendingOrders ?? 0); ?></h2>
                </div>
            </div>
        </div>

    </div>

    
    <div class="row g-4">

        
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold text-dark mb-0">Dernières ventes</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light small text-muted">
                            <tr>
                                <th>N° Vente</th>
                                <th>Client</th>
                                <th>Produit</th>
                                <th>Montant</th>
                                <th>Paiement</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentSales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="fw-bold text-secondary">VTE-<?php echo e(str_pad($sale->id, 5, '0', STR_PAD_LEFT)); ?></td>
                                    <td><?php echo e($sale->client->name ?? $sale->client->nom ?? 'Client Comptoir'); ?></td>
                                    <td><?php echo e($sale->items->first()->product->name ?? $sale->items->first()->product->nom ?? 'Articles multiples'); ?></td>
                                    <td class="fw-bold"><?php echo e(number_format($sale->total, 0, ',', ' ')); ?> FCFA</td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            <?php echo e(ucfirst($sale->payment_method ?? 'Espèces')); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <?php if($sale->status === 'completed' || $sale->status === 'confirmed'): ?>
                                            <span class="text-success"><i class="bi bi-check-lg me-1"></i>Payé</span>
                                        <?php else: ?>
                                            <span class="text-warning"><i class="bi bi-clock me-1"></i>En attente</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        Aucune vente enregistrée récemment.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
        <div class="col-lg-4">

            
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold text-dark mb-0">Top produits vendus</h6>
                </div>
                <div class="list-group list-group-flush">
                    <?php $__empty_1 = true; $__currentLoopData = $topProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="fw-bold text-muted me-2"><?php echo e($index + 1); ?>.</span>
                            <span class="fw-semibold text-dark flex-grow-1"><?php echo e($product->name ?? $product->nom); ?></span>
                            <span class="badge bg-light text-dark border fw-normal">
                                <?php echo e(number_format($product->price, 0, ',', ' ')); ?> FCFA
                            </span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="list-group-item text-center text-muted py-3">
                            Aucun produit vendu.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="text-center">
                <a href="<?php echo e(route('cashier.sales.create')); ?>" class="btn btn-primary btn-lg w-100 py-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-cart-plus fs-4"></i>
                    <span>Nouvelle vente</span>
                </a>
                <small class="text-muted d-block mt-2">Créer une nouvelle vente en caisse</small>
            </div>

        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cashier.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/cashier/dashboard.blade.php ENDPATH**/ ?>