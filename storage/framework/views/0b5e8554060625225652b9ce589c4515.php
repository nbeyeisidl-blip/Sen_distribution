

<?php $__env->startSection('title', 'Gestion des fournisseurs'); ?>

<?php $__env->startSection('page-title', 'Gestion des fournisseurs'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold mb-1">
            Gestion des fournisseurs
        </h3>

        <p class="text-muted mb-0">
            Gérez vos fournisseurs.
        </p>
    </div>

    <a href="<?php echo e(route('admin.fournisseurs.create')); ?>"
       class="btn btn-primary">

        <i class="bi bi-person-plus"></i>
        Ajouter un fournisseur

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


<div class="card border-0 shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Entreprise</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $fournisseurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fournisseur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>

                        <td>
                            <?php echo e($fournisseur->id); ?>

                        </td>

                        <td>
                            <strong>
                                <?php echo e($fournisseur->nom); ?>

                            </strong>
                        </td>

                        <td>
                            <?php echo e($fournisseur->entreprise ?? '-'); ?>

                        </td>

                        <td>
                            <?php echo e($fournisseur->telephone ?? '-'); ?>

                        </td>

                        <td>
                            <?php echo e($fournisseur->email ?? '-'); ?>

                        </td>

                        <td>

                            <a href="<?php echo e(route('admin.fournisseurs.show', $fournisseur)); ?>"
                               class="btn btn-sm btn-info">

                                <i class="bi bi-eye"></i>

                            </a>

                            <a href="<?php echo e(route('admin.fournisseurs.edit', $fournisseur)); ?>"
                               class="btn btn-sm btn-warning">

                                <i class="bi bi-pencil"></i>

                            </a>

                            <form action="<?php echo e(route('admin.fournisseurs.destroy', $fournisseur)); ?>"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Voulez-vous supprimer ce fournisseur ?');">

                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button type="submit"
                                        class="btn btn-sm btn-danger">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>

                        <td colspan="6"
                            class="text-center py-4">

                            Aucun fournisseur enregistré.

                        </td>

                    </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

        <?php echo e($fournisseurs->links()); ?>


    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/fournisseurs/index.blade.php ENDPATH**/ ?>