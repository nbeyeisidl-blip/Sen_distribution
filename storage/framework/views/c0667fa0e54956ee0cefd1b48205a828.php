

<?php $__env->startSection('title', 'Nouvelle entrée de stock'); ?>

<?php $__env->startSection('page-title', 'Nouvelle entrée de stock'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h3 class="fw-bold">
                        <i class="bi bi-box-arrow-in-down"></i>
                        Nouvelle entrée de stock
                    </h3>

                    <p class="text-muted">
                        Ajouter des produits au stock
                    </p>
                </div>

                <a href="<?php echo e(route('admin.stock.index')); ?>"
                   class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>
                    Retour

                </a>

            </div>


            

            <?php if($errors->any()): ?>

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <li><?php echo e($error); ?></li>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>

                </div>

            <?php endif; ?>


            <form method="POST"
                  action="<?php echo e(route('admin.stock_entries.store')); ?>">

                <?php echo csrf_field(); ?>


                

                <div class="row mb-4">

                    <div class="col-md-6">

                        <label class="form-label fw-bold">
                            Fournisseur
                        </label>

                        <select name="fournisseur_id"
                                class="form-select">

                            <option value="">
                                -- Aucun fournisseur --
                            </option>

                            <?php $__currentLoopData = $fournisseurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fournisseur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <option value="<?php echo e($fournisseur->id); ?>">

                                    <?php echo e($fournisseur->nom); ?>


                                    <?php if($fournisseur->entreprise): ?>
                                        - <?php echo e($fournisseur->entreprise); ?>

                                    <?php endif; ?>

                                </option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-bold">
                            Observation
                        </label>

                        <input type="text"
                               name="observation"
                               class="form-control"
                               placeholder="Ex : Réception marchandises">

                    </div>

                </div>


                

                <h5 class="fw-bold mb-3">
                    Produits reçus
                </h5>

                <div class="table-responsive">

                    <table class="table table-bordered align-middle">

                        <thead class="table-light">

                            <tr>

                                <th>Produit</th>

                                <th>Stock actuel</th>

                                <th width="200">
                                    Quantité reçue
                                </th>

                                <th width="220">
                                    Prix d'achat
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                <tr>

                                    <td>

                                        <input type="hidden"
                                               name="products[<?php echo e($product->id); ?>][id]"
                                               value="<?php echo e($product->id); ?>">

                                        <strong>
                                            <?php echo e($product->name); ?>

                                        </strong>

                                    </td>


                                    <td>

                                        <?php if($product->stock > 10): ?>

                                            <span class="badge bg-success">
                                                <?php echo e($product->stock); ?>

                                            </span>

                                        <?php elseif($product->stock > 0): ?>

                                            <span class="badge bg-warning text-dark">
                                                <?php echo e($product->stock); ?>

                                            </span>

                                        <?php else: ?>

                                            <span class="badge bg-danger">
                                                0
                                            </span>

                                        <?php endif; ?>

                                    </td>


                                    <td>

                                        <input type="number"
                                               name="products[<?php echo e($product->id); ?>][quantity]"
                                               class="form-control"
                                               min="0"
                                               value="0">

                                    </td>


                                    <td>

                                        <div class="input-group">

                                            <input type="number"
                                                   name="products[<?php echo e($product->id); ?>][purchase_price]"
                                                   class="form-control"
                                                   min="0"
                                                   step="0.01"
                                                   value="0">

                                            <span class="input-group-text">
                                                FCFA
                                            </span>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <tr>

                                    <td colspan="4"
                                        class="text-center py-4">

                                        <i class="bi bi-box-seam fs-1 text-muted"></i>

                                        <p class="text-muted mt-2">
                                            Aucun produit disponible.
                                        </p>

                                    </td>

                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>


                

                <div class="mt-4">

                    <button type="submit"
                            class="btn btn-success">

                        <i class="bi bi-check-circle"></i>

                        Enregistrer l'entrée

                    </button>

                    <a href="<?php echo e(route('admin.stock.index')); ?>"
                       class="btn btn-secondary">

                        Annuler

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/stock_entries/create.blade.php ENDPATH**/ ?>