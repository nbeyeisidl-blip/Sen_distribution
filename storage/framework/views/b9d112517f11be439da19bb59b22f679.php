

<?php $__env->startSection('title', 'Gestion des catégories'); ?>

<?php $__env->startSection('page-title', 'Gestion des catégories'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold mb-1">Catégories</h3>
        <p class="text-muted mb-0">
            Gérez les catégories de vos produits.
        </p>
    </div>

    <a href="<?php echo e(route('admin.categories.create')); ?>"
       class="btn btn-primary">

        <i class="bi bi-plus-lg"></i>
        Ajouter une catégorie

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


<?php if(session('error')): ?>

    <div class="alert alert-danger alert-dismissible fade show">

        <i class="bi bi-exclamation-triangle"></i>
        <?php echo e(session('error')); ?>


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
              action="<?php echo e(route('admin.categories.index')); ?>"
              class="row g-2 mb-4">

            <div class="col-md-8">

                <input type="text"
                       name="search"
                       class="form-control"
                       value="<?php echo e($search); ?>"
                       placeholder="Rechercher une catégorie...">

            </div>

            <div class="col-md-2">

                <button class="btn btn-dark w-100">

                    <i class="bi bi-search"></i>
                    Rechercher

                </button>

            </div>

            <div class="col-md-2">

                <a href="<?php echo e(route('admin.categories.index')); ?>"
                   class="btn btn-outline-secondary w-100">

                    Réinitialiser

                </a>

            </div>

        </form>


        <!-- TABLE -->

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>#</th>
                        <th>Nom</th>
                        <th>Slug</th>
                        <th>Produits</th>
                        <th>Statut</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr>

                            <td>
                                <?php echo e($category->id); ?>

                            </td>

                            <td>
                                <strong>
                                    <?php echo e($category->name); ?>

                                </strong>
                            </td>

                            <td>
                                <span class="text-muted">
                                    <?php echo e($category->slug); ?>

                                </span>
                            </td>

                            <td>

                                <span class="badge bg-primary">
                                    <?php echo e($category->products_count); ?>

                                </span>

                            </td>

                            <td>

                                <?php if($category->is_active): ?>

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-secondary">
                                        Inactive
                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <a href="<?php echo e(route('admin.categories.edit', $category)); ?>"
                                   class="btn btn-sm btn-warning">

                                    <i class="bi bi-pencil"></i>

                                </a>


                                <form action="<?php echo e(route('admin.categories.destroy', $category)); ?>"
                                      method="POST"
                                      class="d-inline">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Voulez-vous supprimer cette catégorie ?')">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>

                            <td colspan="6"
                                class="text-center py-5">

                                <i class="bi bi-tags fs-1 text-muted"></i>

                                <p class="text-muted mt-2">
                                    Aucune catégorie trouvée.
                                </p>

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>


        <div class="mt-3">

            <?php echo e($categories->links()); ?>


        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>