

<?php $__env->startSection('title', 'Historique du stock'); ?>

<?php $__env->startSection('page-title', 'Historique du stock'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                <i class="bi bi-clock-history"></i>
                Historique du stock
            </h3>

            <p class="text-muted mb-0">
                Consultez tous les mouvements de stock.
            </p>
        </div>

        <a href="<?php echo e(route('admin.stock.index')); ?>"
           class="btn btn-secondary">

            <i class="bi bi-box-seam"></i>
            Gestion du stock

        </a>

    </div>


    

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form method="GET"
                  action="<?php echo e(route('admin.stock_movements.index')); ?>">

                <div class="row g-2">

                    <div class="col-md-6">

                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Rechercher un produit..."
                               value="<?php echo e(request('search')); ?>">

                    </div>

                    <div class="col-md-4">

                        <select name="type"
                                class="form-select">

                            <option value="">
                                Tous les mouvements
                            </option>

                            <option value="entrée"
                                <?php echo e(request('type') === 'entrée' ? 'selected' : ''); ?>>

                                🟢 Entrées

                            </option>

                            <option value="sortie"
                                <?php echo e(request('type') === 'sortie' ? 'selected' : ''); ?>>

                                🔴 Sorties

                            </option>

                        </select>

                    </div>

                    <div class="col-md-2">

                        <button type="submit"
                                class="btn btn-primary w-100">

                            <i class="bi bi-search"></i>
                            Filtrer

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

                            <th>Date</th>
                            <th>Produit</th>
                            <th>Type</th>
                            <th>Quantité</th>
                            <th>Référence</th>
                            <th>Description</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $movements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <tr>

                                <td>

                                    <?php echo e($movement->created_at
                                        ->format('d/m/Y H:i')); ?>


                                </td>

                                <td>

                                    <strong>
                                        <?php echo e($movement->product->name); ?>

                                    </strong>

                                </td>

                                <td>

                                    <?php if($movement->type === 'entrée'): ?>

                                        <span class="badge bg-success">

                                            <i class="bi bi-arrow-down-circle"></i>
                                            Entrée

                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-danger">

                                            <i class="bi bi-arrow-up-circle"></i>
                                            Sortie

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <?php if($movement->type === 'entrée'): ?>

                                        <strong class="text-success">
                                            +<?php echo e($movement->quantity); ?>

                                        </strong>

                                    <?php else: ?>

                                        <strong class="text-danger">
                                            -<?php echo e($movement->quantity); ?>

                                        </strong>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <?php echo e($movement->reference ?? '-'); ?>


                                </td>

                                <td>

                                    <?php echo e($movement->description ?? '-'); ?>


                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>

                                <td colspan="6"
                                    class="text-center py-4">

                                    <i class="bi bi-clock-history fs-1 text-muted"></i>

                                    <p class="text-muted mt-2">
                                        Aucun mouvement enregistré.
                                    </p>

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                <?php echo e($movements->links()); ?>


            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/stock_movements/index.blade.php ENDPATH**/ ?>