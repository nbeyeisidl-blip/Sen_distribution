

<?php $__env->startSection('title', 'Gestion des ventes'); ?>

<?php $__env->startSection('page-title', 'Gestion des ventes'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold mb-1">Gestion des ventes</h3>
        <p class="text-muted mb-0">
            Consultez l'historique des ventes.
        </p>
    </div>

    <a href="<?php echo e(route('admin.sales.create')); ?>"
       class="btn btn-primary">

        <i class="bi bi-cart-plus"></i>
        Nouvelle vente

    </a>

</div>

<?php if(session('success')): ?>

    <div class="alert alert-success alert-dismissible fade show">

        <i class="bi bi-check-circle"></i>
        <?php echo e(session('success')); ?>


        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>

    </div>

<?php endif; ?>

<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">
<tr>
                <th class="border-0 fw-semibold">N° Vente</th>
                <th class="border-0 fw-semibold">Client</th>
                <th class="border-0 fw-semibold">Date</th>
                <th class="border-0 fw-semibold">Montant</th>
                <th class="border-0 fw-semibold">Paiement</th>
                <th class="border-0 fw-semibold text-center">Action</th>
            </tr>

                </thead>

                <tbody>
    <?php $__empty_1 = true; $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            
            <td class="fw-semibold text-dark">
                <?php echo e($sale->code ?? 'VTS-' . str_pad($sale->id, 5, '0', STR_PAD_LEFT)); ?>

            </td>
            
            
            <td>
                <?php if(is_object($sale->client)): ?>
                    <?php echo e($sale->client->name ?? $sale->client->nom ?? 'Client de passage'); ?>

                <?php elseif(is_array($sale->client)): ?>
                    <?php echo e($sale->client['name'] ?? $sale->client['nom'] ?? 'Client de passage'); ?>

                <?php else: ?>
                    <?php echo e($sale->client_name ?? 'Client de passage'); ?>

                <?php endif; ?>
            </td>

            
            <td class="text-muted">
                <?php echo e($sale->created_at ? $sale->created_at->format('d/m/Y') : '-'); ?>

            </td>
            
            
            <td class="fw-bold text-dark">
                <?php echo e(number_format($sale->total_amount ?? $sale->total ?? $sale->montant ?? 0, 0, ',', ' ')); ?> FCFA
            </td>
            
            
            <td>
                <span class="badge bg-info-subtle text-info px-2 py-1 rounded-2">
                    <?php echo e($sale->payment_method ?? $sale->mode_paiement ?? 'Espèces'); ?>

                </span>
            </td>
            
            
            <td class="text-center">
               <a href="<?php echo e(route('admin.sales.edit', $sale->id)); ?>" class="btn btn-sm btn-warning">Éditer</a>

<form action="<?php echo e(route('admin.sales.destroy', $sale->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous vraiment supprimer cette vente ?')">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
    <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
</form> 
            
            <a href="<?php echo e(route('admin.sales.show', $sale->id)); ?>" class="btn btn-sm btn-light border rounded-circle p-1">
                    <i class="bi bi-eye text-secondary"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="6" class="text-center text-muted py-4">Aucune vente enregistrée.</td>
        </tr>
    <?php endif; ?>
</tbody>

            </table>

        </div>

        <div class="mt-3">

            <?php echo e($sales->links()); ?>


        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/sales/index.blade.php ENDPATH**/ ?>