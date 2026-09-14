

<?php $__env->startSection('title', 'Détail de la vente'); ?>

<?php $__env->startSection('page-title', 'Détail de la vente'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="fw-bold">
            Vente #<?php echo e($sale->id); ?>

        </h3>

        <p class="text-muted">
            <?php echo e($sale->created_at->format('d/m/Y à H:i')); ?>

        </p>

    </div>

    <button onclick="window.print()"
            class="btn btn-dark">

        <i class="bi bi-printer"></i>
        Imprimer

    </button>

</div>


<div class="card shadow-sm border-0">

    <div class="card-body p-4">

        

        <div class="row mb-4">

            <div class="col-md-6">

                <h3 class="fw-bold">
                    SEN DISTRIBUTION
                </h3>

                <p class="text-muted mb-0">
                    Gestion des ventes et des stocks
                </p>

            </div>

            <div class="col-md-6 text-md-end">

                <h4>
                    FACTURE
                </h4>

                <p class="mb-0">
                    N° #<?php echo e($sale->id); ?>

                </p>

                <p class="mb-0">
                    <?php echo e($sale->created_at->format('d/m/Y H:i')); ?>

                </p>

            </div>

        </div>

        <hr>


        

        <div class="row mb-4">

            <div class="col-md-6">

                <strong>Client :</strong>

                <?php if($sale->client): ?>

                    <p class="mb-0">

                        <?php echo e($sale->client->nom); ?>

                        <?php echo e($sale->client->prenom); ?>


                    </p>

                    <?php if($sale->client->telephone): ?>

                        <p class="mb-0">
                            <?php echo e($sale->client->telephone); ?>

                        </p>

                    <?php endif; ?>

                    <?php if($sale->client->email): ?>

                        <p class="mb-0">
                            <?php echo e($sale->client->email); ?>

                        </p>

                    <?php endif; ?>

                <?php else: ?>

                    <p class="text-muted">
                        Client comptoir
                    </p>

                <?php endif; ?>

            </div>

            <div class="col-md-6 text-md-end">

                <strong>
                    Mode de paiement :
                </strong>

                <p>
                    <?php echo e($sale->payment_method); ?>

                </p>

            </div>

        </div>


        

        <div class="table-responsive">

            <table class="table table-bordered">

                <thead class="table-light">

                    <tr>

                        <th>Produit</th>
                        <th class="text-center">Quantité</th>
                        <th class="text-end">Prix</th>
                        <th class="text-end">Sous-total</th>

                    </tr>

                </thead>

                <tbody>

                    <?php $__currentLoopData = $sale->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>

                            <td>
                                <?php echo e($item->product->name); ?>

                            </td>

                            <td class="text-center">
                                <?php echo e($item->quantity); ?>

                            </td>

                            <td class="text-end">

                                <?php echo e(number_format($item->price, 0, ',', ' ')); ?>

                                FCFA

                            </td>

                            <td class="text-end">

                                <?php echo e(number_format($item->subtotal, 0, ',', ' ')); ?>

                                FCFA

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>

            </table>

        </div>


        

        <div class="row justify-content-end">

            <div class="col-md-5">

                <div class="d-flex justify-content-between">

                    <span>
                        Total :
                    </span>

                    <strong class="fs-4">

                        <?php echo e(number_format($sale->total, 0, ',', ' ')); ?>

                        FCFA

                    </strong>

                </div>

            </div>

        </div>


        <hr>

        <div class="text-center text-muted">

            <p class="mb-0">
                Merci pour votre confiance.
            </p>

            <small>
                SEN DISTRIBUTION
            </small>

        </div>

    </div>

</div>


<style>

@media print {

    body * {
        visibility: hidden;
    }

    .card,
    .card * {
        visibility: visible;
    }

    .card {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        box-shadow: none !important;
    }

    .btn {
        display: none !important;
    }

}

</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/sales/show.blade.php ENDPATH**/ ?>