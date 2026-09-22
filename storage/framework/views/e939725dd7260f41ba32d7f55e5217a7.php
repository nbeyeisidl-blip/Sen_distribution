

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Gestion des Produits</h2>
        <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Ajouter un produit
        </a>
    </div>

    <!-- Message de succès -->
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Tableau des produits -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Prix</th>
                            <th>Stock</th>
                            <th>Attributs (Taille/Couleur/Sexe)</th>
                            
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <!-- Image -->
                                <td>
                                    <?php if($product->image): ?>
                                        <img src="<?php echo e(asset('images/products/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    <?php else: ?>
                                        <span class="badge bg-light text-secondary border">Pas d'image</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Nom -->
                                <td>
                                    <strong><?php echo e($product->name); ?></strong>
                                </td>

                                <!-- Catégorie -->
                                <td>
                                    <span class="badge bg-secondary">
                                        <?php echo e($product->category->name ?? 'Sans catégorie'); ?>

                                    </span>
                                </td>

                                <!-- Prix -->
                                <td>
                                    <strong><?php echo e(number_format($product->price, 0, ',', ' ')); ?> FCFA</strong>
                                </td>

                                <!-- Stock -->
                                <td>
                                    <?php if($product->stock > 5): ?>
                                        <span class="badge bg-success"><?php echo e($product->stock); ?> en stock</span>
                                    <?php elseif($product->stock > 0): ?>
                                        <span class="badge bg-warning text-dark">Reste <?php echo e($product->stock); ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Rupture</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Attributs -->
                                <td>
                                    <small class="d-block text-muted">
                                        <strong>Sexe :</strong> <?php echo e(ucfirst($product->gender)); ?>

                                    </small>
                                    <?php if($product->size): ?>
                                        <small class="d-block text-muted"><strong>Taille :</strong> <?php echo e($product->size); ?></small>
                                    <?php endif; ?>
                                    <?php if($product->color): ?>
                                        <small class="d-block text-muted"><strong>Couleur :</strong> <?php echo e($product->color); ?></small>
                                    <?php endif; ?>
                                </td>

                  
                                <!-- Actions -->
                                <td class="text-end">
    <div class="d-flex justify-content-end gap-2">
        <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" class="btn btn-sm btn-primary">
            Modifier
        </a>

        <form action="<?php echo e(route('admin.products.destroy', $product->id)); ?>" method="POST" onsubmit="return confirm('Supprimer ce produit ?');">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn btn-sm btn-danger">
                Supprimer
            </button>
        </form>
    </div>
</td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    Aucun produit trouvé. <a href="<?php echo e(route('admin.products.create')); ?>">Ajouter un premier produit</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        <?php if($products->hasPages()): ?>
            <div class="card-footer d-flex justify-content-end">
                <?php echo e($products->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/products/index.blade.php ENDPATH**/ ?>