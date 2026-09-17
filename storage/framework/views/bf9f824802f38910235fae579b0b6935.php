

<?php $__env->startSection('title', 'Gestion des ventes'); ?>
<?php $__env->startSection('page-title', 'Gestion des ventes'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Gestion des ventes</h3>
        <p class="text-muted mb-0">Consultez l'historique complet des ventes.</p>
    </div>

    <a href="<?php echo e(route('admin.sales.create')); ?>" class="btn btn-primary">
        <i class="bi bi-cart-plus me-1"></i> Nouvelle vente
    </a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-check-circle me-1"></i> <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="border-0 fw-semibold ps-4">N° Vente</th>
                        <th class="border-0 fw-semibold">Client</th>
                        <th class="border-0 fw-semibold">Date</th>
                        <th class="border-0 fw-semibold">Montant</th>
                        <th class="border-0 fw-semibold">Paiement</th>
                        <th class="border-0 fw-semibold text-center pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            
                            <td class="ps-4 fw-semibold text-dark">
                                <?php echo e($sale->code ?? 'VTS-' . str_pad($sale->id, 5, '0', STR_PAD_LEFT)); ?>

                            </td>
                            
                            
<td>
    <?php if($sale->client): ?>
        <strong><?php echo e($sale->client->nom); ?> <?php echo e($sale->client->prenom ?? ''); ?></strong>
    <?php elseif(!empty($sale->client_name)): ?>
        <strong><?php echo e($sale->client_name); ?></strong>
    <?php else: ?>
        <span class="text-muted">Client de passage</span>
    <?php endif; ?>
</td>

                            
                            <td class="text-muted">
                                <?php echo e($sale->created_at ? $sale->created_at->format('d/m/Y H:i') : '-'); ?>

                            </td>
                            
                            
                            <td class="fw-bold text-dark">
                                <?php echo e(number_format($sale->total, 0, ',', ' ')); ?> FCFA
                            </td>
                            
                            
                            <td>
                                <span class="badge bg-info-subtle text-info px-2 py-1 rounded-2">
                                    <?php echo e($sale->payment_method); ?>

                                </span>
                            </td>
                            
                            
                            <td class="text-center pe-4">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="<?php echo e(route('admin.sales.show', $sale->id)); ?>" 
                                       class="btn btn-outline-secondary" 
                                       title="Voir les détails">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="<?php echo e(route('admin.sales.edit', $sale->id)); ?>" 
                                       class="btn btn-outline-warning" 
                                       title="Éditer">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="<?php echo e(route('admin.sales.destroy', $sale->id)); ?>" 
                                          method="POST" 
                                          class="d-inline" 
                                          onsubmit="return confirm('Voulez-vous vraiment supprimer cette vente ?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" 
                                                class="btn btn-outline-danger" 
                                                title="Supprimer">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Aucune vente enregistrée.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($sales->hasPages()): ?>
            <div class="p-3 border-top">
                <?php echo e($sales->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/sales/index.blade.php ENDPATH**/ ?>