<?php $__env->startSection('title', 'Historique des Ventes - Caissier'); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">Espace Caissier</h2>
            <p class="text-muted small mb-0">Historique et gestion des enregistrements de ventes</p>
        </div>
        <a href="<?php echo e(route('cashier.sales.create')); ?>" class="btn btn-success fw-bold shadow-sm">
            <i class="bi bi-plus-circle me-2"></i>Nouvelle Vente
        </a>
    </div>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-4"># N° Vente</th>
                            <th scope="col">Client</th>
                            <th scope="col">Date & Heure</th>
                            <th scope="col">Montant Total</th>
                            <th scope="col">Statut</th>
                            <th scope="col" class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="ps-4 fw-bold">#<?php echo e(str_pad($sale->id, 5, '0', STR_PAD_LEFT)); ?></td>
                                <td><?php echo e($sale->client->name ?? $sale->client_name ?? 'Client comptant'); ?></td>
                                <td><?php echo e($sale->created_at->format('d/m/Y H:i')); ?></td>
<td class="fw-bold text-dark"><?php echo e(number_format($sale->total_amount ?? $sale->total ?? $sale->montant_total ?? 0, 0, ',', ' ')); ?> FCFA</td>                                <td>
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                        Payée
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="<?php echo e(route('cashier.sales.show', $sale->id)); ?>" class="btn btn-sm btn-outline-primary me-1" title="Voir détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('cashier.sales.receipt', $sale->id)); ?>" target="_blank" class="btn btn-sm btn-outline-secondary" title="Imprimer reçu">
                                        <i class="bi bi-printer"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-receipt fs-1 d-block mb-2"></i>
                                    Aucune vente enregistrée pour le moment.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if($sales->hasPages()): ?>
            <div class="card-footer bg-white border-0 py-3">
                <?php echo e($sales->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/cashier/sales/index.blade.php ENDPATH**/ ?>