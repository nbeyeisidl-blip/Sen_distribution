

<?php $__env->startSection('content'); ?>

<div class="container-fluid py-4">

    
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">
                <i class="bi bi-box-arrow-in-down"></i>
                Entrée de stock #<?php echo e($stockEntry->id); ?>

            </h2>

            <p class="text-muted mb-0">
                Détails de l'entrée de stock
            </p>
        </div>

        <a href="<?php echo e(route('admin.stock_entries.index')); ?>"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>
            Retour
        </a>

    </div>


    
    <div class="row g-4 mb-4">

        
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Fournisseur
                    </h6>

                    <?php if($stockEntry->fournisseur): ?>

                        <h5 class="fw-bold">
                            <?php echo e($stockEntry->fournisseur->nom); ?>

                        </h5>

                    <?php else: ?>

                        <span class="text-muted">
                            Aucun fournisseur
                        </span>

                    <?php endif; ?>

                </div>

            </div>

        </div>


        
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Date
                    </h6>

                    <h5 class="fw-bold">

                        <?php echo e($stockEntry->created_at
                            ? $stockEntry->created_at->format('d/m/Y H:i')
                            : '-'); ?>


                    </h5>

                </div>

            </div>

        </div>


        
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Total
                    </h6>

                    <h4 class="fw-bold text-primary">

                        <?php echo e(number_format(
                            $stockEntry->total,
                            0,
                            ',',
                            ' '
                        )); ?>


                        FCFA

                    </h4>

                </div>

            </div>

        </div>

    </div>


    
    <?php if($stockEntry->observation): ?>

        <div class="alert alert-info">

            <strong>
                <i class="bi bi-info-circle"></i>
                Observation :
            </strong>

            <?php echo e($stockEntry->observation); ?>


        </div>

    <?php endif; ?>


    
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <h5 class="mb-0 fw-bold">

                <i class="bi bi-box-seam"></i>
                Produits reçus

            </h5>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>#</th>

                            <th>Produit</th>

                            <th>Quantité</th>

                            <th>Prix d'achat</th>

                            <th>Sous-total</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $stockEntry->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <tr>

                                <td>
                                    <?php echo e($item->id); ?>

                                </td>

                                <td>

                                    <?php if($item->product): ?>

                                        <strong>
                                            <?php echo e($item->product->name); ?>

                                        </strong>

                                    <?php else: ?>

                                        <span class="text-danger">
                                            Produit supprimé
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <span class="badge bg-primary">

                                        <?php echo e($item->quantity); ?>


                                    </span>

                                </td>

                                <td>

                                    <?php echo e(number_format(
                                        $item->purchase_price,
                                        0,
                                        ',',
                                        ' '
                                    )); ?>


                                    FCFA

                                </td>

                                <td class="fw-bold">

                                    <?php echo e(number_format(
                                        $item->subtotal,
                                        0,
                                        ',',
                                        ' '
                                    )); ?>


                                    FCFA

                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>

                                <td colspan="5"
                                    class="text-center py-4">

                                    <i class="bi bi-inbox fs-1 text-muted"></i>

                                    <p class="text-muted mb-0">
                                        Aucun produit dans cette entrée.
                                    </p>

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>


                    <tfoot>

                        <tr>

                            <th colspan="4"
                                class="text-end">

                                TOTAL

                            </th>

                            <th class="text-primary">

                                <?php echo e(number_format(
                                    $stockEntry->total,
                                    0,
                                    ',',
                                    ' '
                                )); ?>


                                FCFA

                            </th>

                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/stock_entries/show.blade.php ENDPATH**/ ?>