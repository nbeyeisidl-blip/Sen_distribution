 

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Détails de la vente #<?php echo e(str_pad($sale->id, 5, '0', STR_PAD_LEFT)); ?></h1>
        <div>
            <a href="<?php echo e(route('cashier.sales.receipt', $sale->id)); ?>" class="btn btn-secondary me-2">
                <i class="bi bi-printer"></i> Imprimer Reçu
            </a>
            <a href="<?php echo e(route('cashier.sales.index')); ?>" class="btn btn-outline-secondary">
                Retour à la liste
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Informations Générales
                </div>
                <div class="card-body">
                    <p><strong>Date :</strong> <?php echo e($sale->created_at->format('d/m/Y H:i')); ?></p>
                    <p><strong>Caissier :</strong> <?php echo e($sale->user->name ?? 'N/A'); ?></p>
                    <p><strong>Client :</strong> <?php echo e($sale->client->name ?? 'Client de passage'); ?></p>
                    <p><strong>Moyen de paiement :</strong> <?php echo e(ucfirst($sale->payment_method ?? 'Espèces')); ?></p>
                    <hr>
                    <h5 class="text-success"><strong>Total :</strong> <?php echo e(number_format($sale->total_amount, 0, ',', ' ')); ?> FCFA</h5>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Produits Achetés
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Prix unitaire</th>
                                <th>Quantité</th>
                                <th>Sous-total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $sale->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->product->name ?? 'Produit supprimé'); ?></td>
                                    <td><?php echo e(number_format($item->price, 0, ',', ' ')); ?> FCFA</td>
                                    <td><?php echo e($item->quantity); ?></td>
                                    <td><?php echo e(number_format($item->subtotal, 0, ',', ' ')); ?> FCFA</td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cashier.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/cashier/sales/show.blade.php ENDPATH**/ ?>