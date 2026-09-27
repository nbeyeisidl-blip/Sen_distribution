

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-box-seam me-2"></i>Gestion de Stock</h2>
        <a href="<?php echo e(route('storekeeper.stock.entry')); ?>" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Entrée de Stock
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <form action="<?php echo e(route('storekeeper.stock.index')); ?>" method="GET" class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher un produit..." value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Rechercher</button>
                </div>
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nom du produit</th>
                            <th>Prix Unitaire</th>
                            <th>Stock Actuel</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($product->id); ?></td>
                                <td class="fw-bold"><?php echo e($product->name); ?></td>
                                <td><?php echo e(number_format($product->price, 0, ',', ' ')); ?> FCFA</td>
                                <td>
                                    <span class="fs-6 fw-bold"><?php echo e($product->stock); ?></span>
                                </td>
                                <td>
                                    <?php if($product->stock <= 0): ?>
                                        <span class="badge bg-danger">Rupture de stock</span>
                                    <?php elseif($product->stock <= 5): ?>
                                        <span class="badge bg-warning text-dark">Stock Faible</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">En Stock</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4">Aucun produit trouvé.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            <?php echo e($products->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('storekeeper.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/storekeeper/stock/index.blade.php ENDPATH**/ ?>