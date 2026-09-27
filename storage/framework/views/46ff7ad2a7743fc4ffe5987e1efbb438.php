

<?php $__env->startSection('title', 'Gestion des clients'); ?>

<?php $__env->startSection('page-title', 'Gestion des clients'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold mb-1">Clients</h3>
        <p class="text-muted mb-0">
            Gérez vos clients.
        </p>
    </div>

    <a href="<?php echo e(route('admin.clients.create')); ?>"
       class="btn btn-primary">

        <i class="bi bi-person-plus"></i>
        Ajouter un client

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

        <form method="GET"
              action="<?php echo e(route('admin.clients.index')); ?>"
              class="row g-2 mb-4">

            <div class="col-md-8">

                <input type="text"
                       name="search"
                       value="<?php echo e($search); ?>"
                       class="form-control"
                       placeholder="Rechercher un client...">

            </div>

            <div class="col-md-2">

                <button class="btn btn-dark w-100">

                    <i class="bi bi-search"></i>
                    Rechercher

                </button>

            </div>

            <div class="col-md-2">

                <a href="<?php echo e(route('admin.clients.index')); ?>"
                   class="btn btn-outline-secondary w-100">

                    Réinitialiser

                </a>

            </div>

        </form>


        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>#</th>
                        <th>Client</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Adresse</th>
                        <th>Statut</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr>

                            <td>
                                <?php echo e($client->id); ?>

                            </td>

                            <td>

                                <strong>
                                    <?php echo e($client->nom); ?>

                                    <?php echo e($client->prenom); ?>

                                </strong>

                            </td>

                            <td>
                                <?php echo e($client->telephone ?? '-'); ?>

                            </td>

                            <td>
                                <?php echo e($client->email ?? '-'); ?>

                            </td>

                            <td>
                                <?php echo e($client->adresse ?? '-'); ?>

                            </td>

                            <td>

                                <?php if($client->is_active): ?>

                                    <span class="badge bg-success">
                                        Actif
                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-secondary">
                                        Inactif
                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <a href="<?php echo e(route('admin.clients.edit', $client)); ?>"
                                   class="btn btn-sm btn-warning">

                                    <i class="bi bi-pencil"></i>

                                </a>

                                <form action="<?php echo e(route('admin.clients.destroy', $client)); ?>"
                                      method="POST"
                                      class="d-inline">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Voulez-vous supprimer ce client ?')">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>

                            <td colspan="7"
                                class="text-center py-5">

                                <i class="bi bi-people fs-1 text-muted"></i>

                                <p class="text-muted mt-2">
                                    Aucun client trouvé.
                                </p>

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            <?php echo e($clients->links()); ?>


        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/clients/index.blade.php ENDPATH**/ ?>