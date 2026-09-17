

<?php $__env->startSection('title', 'Gestion des produits'); ?>

<?php $__env->startSection('page-title', 'Gestion des produits'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold mb-1">Produits</h3>
        <p class="text-muted mb-0">
            Gérez les produits et les stocks.
        </p>
    </div>

    <a href="<?php echo e(route('admin.products.create')); ?>"
       class="btn btn-primary">
        <i class="bi bi-plus-lg"></i>
        Ajouter un produit
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

        <!-- RECHERCHE -->

        <form method="GET"
              action="<?php echo e(route('admin.products.index')); ?>"
              class="row g-2 mb-4">

            <div class="col-md-8">

                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Rechercher un produit..."
                       value="<?php echo e($search); ?>">

            </div>

            <div class="col-md-2">

                <button class="btn btn-dark w-100">
                    <i class="bi bi-search"></i>
                    Rechercher
                </button>

            </div>

            <div class="col-md-2">

                <a href="<?php echo e(route('admin.products.index')); ?>"
                   class="btn btn-outline-secondary w-100">
                    Réinitialiser
                </a>

            </div>

        </form>


        <!-- TABLE -->

        <div class="table-responsive">

            <table class="table align-middle">

                <thead class="table-light">

                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Produit</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr>

                            <td>
                                <?php echo e($product->id); ?>

                            </td>

                            <td>
    <?php if($product->image && file_exists(public_path('images/products/' . $product->image))): ?>
        <img src="<?php echo e(asset('images/products/' . $product->image)); ?>" 
             alt="<?php echo e($product->name); ?>" 
             width="50" height="50" 
             style="object-fit: cover; border-radius: 5px;">
    <?php else: ?>
        <span class="badge bg-secondary">Pas d'image</span>
    <?php endif; ?>
</td>

                            <td>
                                <strong>
                                    <?php echo e($product->name); ?>

                                </strong>
                            </td>

                            <td>
                                <?php echo e($product->category?->name ?? 'Sans catégorie'); ?>

                            </td>

                            <td>
                                <?php echo e(number_format($product->price, 0, ',', ' ')); ?>

                                FCFA
                            </td>

                            <td>

                                <?php if($product->stock <= 5): ?>

                                    <span class="badge bg-danger">
                                        <?php echo e($product->stock); ?>

                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-success">
                                        <?php echo e($product->stock); ?>

                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <a href="<?php echo e(route('admin.products.edit', $product)); ?>"
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>


                                <form action="<?php echo e(route('admin.products.destroy', $product)); ?>"
                                      method="POST"
                                      class="d-inline">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Voulez-vous supprimer ce produit ?')">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>

                            <td colspan="7"
                                class="text-center py-5">

                                <i class="bi bi-box-seam fs-1 text-muted"></i>

                                <p class="text-muted mt-2">
                                    Aucun produit trouvé.
                                </p>

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>


        <!-- PAGINATION -->

        <div class="mt-3">

            <?php echo e($products->links()); ?>


        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/products/index.blade.php ENDPATH**/ ?>