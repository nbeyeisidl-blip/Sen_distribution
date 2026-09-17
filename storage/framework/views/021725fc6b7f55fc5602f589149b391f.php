

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Catalogue Produits</h1>
            <p class="text-muted small mb-0">Consultation du stock et des prix - SEN DISTRIBUTION</p>
        </div>
        <a href="<?php echo e(route('cashier.sales.create')); ?>" class="btn btn-primary fw-bold">
            <i class="bi bi-cart-plus me-1"></i> Aller à la caisse
        </a>
    </div>

    
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="<?php echo e(route('cashier.products.index')); ?>" method="GET" class="row g-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 bg-light" 
                               placeholder="Rechercher un produit par nom..." 
                               value="<?php echo e(request('search')); ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="category_id" class="form-select bg-light" onchange="this.form.submit()">
                        <option value="">Toutes les catégories</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php echo e(request('category_id') == $category->id ? 'selected' : ''); ?>>
                                <?php echo e($category->name ?? $category->libelle); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100 fw-bold">Filtrer</button>
                </div>
            </form>
        </div>
    </div>

    
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0">
                    <thead class="table-light small text-muted">
                        <tr>
                            <th>Produit</th>
                            <th>Catégorie</th>
                            <th>Prix Unitaire</th>
                            <th>Stock Disponible</th>
                            <th>Statut du stock</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="fw-bold text-dark">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded p-2 me-2 text-primary">
                                            <i class="bi bi-box-seam fs-5"></i>
                                        </div>
                                        <div>
                                            <span><?php echo e($product->name); ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?php echo e($product->category->name ?? $product->category->libelle ?? 'Alimentaire'); ?>

                                    </span>
                                </td>
                                <td class="fw-bold text-primary">
                                    <?php echo e(number_format($product->price, 0, ',', ' ')); ?> FCFA
                                </td>
                                <td class="fw-bold">
                                    <?php echo e($product->stock); ?>

                                </td>
                                <td>
                                    <?php if($product->stock > 10): ?>
                                        <span class="badge bg-success-subtle text-success border border-success fw-semibold">
                                            En stock
                                        </span>
                                    <?php elseif($product->stock > 0): ?>
                                        <span class="badge bg-warning-subtle text-warning border border-warning fw-semibold">
                                            Stock faible
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger fw-semibold">
                                            Rupture de stock
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <a href="<?php echo e(route('cashier.sales.create')); ?>" class="btn btn-sm btn-outline-primary fw-bold">
                                        <i class="bi bi-plus-circle me-1"></i> Vendre
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-box fs-3 d-block mb-2"></i>
                                    Aucun produit trouvé dans le catalogue.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        
        <?php if($products->hasPages()): ?>
            <div class="card-footer bg-white py-3">
                <?php echo e($products->links()); ?>

            </div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cashier.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/cashier/products/index.blade.php ENDPATH**/ ?>