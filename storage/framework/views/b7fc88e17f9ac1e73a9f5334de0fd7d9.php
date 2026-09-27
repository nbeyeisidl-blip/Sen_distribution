

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-truck me-2"></i>Liste des Fournisseurs</h2>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <form action="<?php echo e(route('storekeeper.suppliers.index')); ?>" method="GET" class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher nom, téléphone, email..." value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Rechercher
                    </button>
                </div>
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nom / Raison Sociale</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Adresse</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $fournisseurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fournisseur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($fournisseur->id); ?></td>
                                <td class="fw-bold"><?php echo e($fournisseur->nom); ?></td>
                                <td><?php echo e($fournisseur->telephone ?? 'N/A'); ?></td>
                                <td><?php echo e($fournisseur->email ?? 'N/A'); ?></td>
                                <td><?php echo e($fournisseur->adresse ?? 'N/A'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4">Aucun fournisseur trouvé.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            <?php echo e($fournisseurs->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('storekeeper.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/storekeeper/suppliers/index.blade.php ENDPATH**/ ?>