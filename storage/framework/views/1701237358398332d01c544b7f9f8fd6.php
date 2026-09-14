

<?php $__env->startSection('title', 'Gestion du stock'); ?>

<?php $__env->startSection('page-title', 'Gestion du stock'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">
                <i class="bi bi-box-seam"></i>
                Gestion du stock
            </h3>

            <p class="text-muted mb-0">
                Consultez et surveillez les stocks des produits.
            </p>

        </div>

        <a href="<?php echo e(route('admin.stock_entries.create')); ?>"
           class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>
            Entrée de stock

        </a>

    </div>


    

    <div class="row g-3 mb-4">

        <div class="col-md-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted mb-1">
                                Produits
                            </p>

                            <h3 class="fw-bold">
                                <?php echo e($totalProducts); ?>

                            </h3>

                        </div>

                        <i class="bi bi-box fs-1 text-primary"></i>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted mb-1">
                                Stock disponible
                            </p>

                            <h3 class="fw-bold text-success">
                                <?php echo e($availableProducts); ?>

                            </h3>

                        </div>

                        <i class="bi bi-check-circle fs-1 text-success"></i>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted mb-1">
                                Stock faible
                            </p>

                            <h3 class="fw-bold text-warning">
                                <?php echo e($lowStockProducts); ?>

                            </h3>

                        </div>

                        <i class="bi bi-exclamation-triangle fs-1 text-warning"></i>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted mb-1">
                                Rupture
                            </p>

                            <h3 class="fw-bold text-danger">
                                <?php echo e($outOfStockProducts); ?>

                            </h3>

                        </div>

                        <i class="bi bi-x-circle fs-1 text-danger"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    

    <div class="alert alert-info">

        <i class="bi bi-box-seam"></i>

        <strong>
            Quantité totale en stock :
        </strong>

        <?php echo e($totalStock); ?> produits

    </div>


    

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form method="GET"
                  action="<?php echo e(route('admin.stock.index')); ?>">

                <div class="row g-2">

                    <div class="col-md-6">

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>

                            <input type="text"
                                   name="search"
                                   class="form-control"
                                   placeholder="Rechercher un produit..."
                                   value="<?php echo e(request('search')); ?>">

                        </div>

                    </div>


                    <div class="col-md-4">

                        <select name="stock_status"
                                class="form-select">

                            <option value="">
                                Tous les stocks
                            </option>

                            <option value="available"
                                <?php echo e(request('stock_status') == 'available' ? 'selected' : ''); ?>>

                                Stock disponible

                            </option>

                            <option value="low"
                                <?php echo e(request('stock_status') == 'low' ? 'selected' : ''); ?>>

                                Stock faible

                            </option>

                            <option value="out"
                                <?php echo e(request('stock_status') == 'out' ? 'selected' : ''); ?>>

                                Rupture de stock

                            </option>

                        </select>

                    </div>


                    <div class="col-md-2">

                        <button type="submit"
                                class="btn btn-primary w-100">

                            <i class="bi bi-search"></i>
                            Rechercher

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>#</th>

                            <th>Produit</th>

                            <th>Prix</th>

                            <th>Stock</th>

                            <th>État</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <tr>

                                <td>
                                    <?php echo e($product->id); ?>

                                </td>

                                <td>

                                    <strong>
                                        <?php echo e($product->name); ?>

                                    </strong>

                                </td>

                                <td>

                                    <?php echo e(number_format(
                                        $product->price,
                                        0,
                                        ',',
                                        ' '
                                    )); ?>


                                    FCFA

                                </td>

                                <td>

                                    <span class="fw-bold">

                                        <?php echo e($product->stock); ?>


                                    </span>

                                </td>

                                <td>

                                    <?php if($product->stock == 0): ?>

                                        <span class="badge bg-danger">
                                            Rupture
                                        </span>

                                    <?php elseif($product->stock <= 10): ?>

                                        <span class="badge bg-warning text-dark">
                                            Stock faible
                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-success">
                                            Disponible
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <a href="<?php echo e(route(
                                        'admin.products.edit',
                                        $product
                                    )); ?>"
                                       class="btn btn-sm btn-warning">

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>

                                <td colspan="6"
                                    class="text-center py-4">

                                    <i class="bi bi-box-seam fs-1 text-muted"></i>

                                    <p class="text-muted mt-2 mb-0">
                                        Aucun produit trouvé.
                                    </p>

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>


            <div class="mt-3">

                <?php echo e($products->links()); ?>


            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/stock/index.blade.php ENDPATH**/ ?>