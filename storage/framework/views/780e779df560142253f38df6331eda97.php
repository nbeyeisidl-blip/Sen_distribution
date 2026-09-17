

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Historique des Factures</h1>
            <p class="text-muted small mb-0">Liste globale des ventes et reçus de caisse</p>
        </div>
        <a href="<?php echo e(route('cashier.sales.create')); ?>" class="btn btn-primary fw-bold">
            <i class="bi bi-plus-lg me-1"></i> Nouvelle vente
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0">
                    <thead class="table-light small text-muted">
                        <tr>
                            <th>N° Facture</th>
                            <th>Client</th>
                            <th>Date & Heure</th>
                            <th>Mode de paiement</th>
                            <th>Montant Total</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="fw-bold text-primary">
                                    VTE-<?php echo e(str_pad($order->id, 5, '0', STR_PAD_LEFT)); ?>

                                </td>
                                <td><?php echo e($order->client->name ?? $order->client->nom ?? 'Client Comptoir'); ?></td>
                                <td class="small text-muted"><?php echo e($order->created_at->format('d/m/Y H:i')); ?></td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?php echo e(ucfirst($order->payment_method ?? 'Espèces')); ?>

                                    </span>
                                </td>
                                <td class="fw-bold"><?php echo e(number_format($order->total, 0, ',', ' ')); ?> FCFA</td>
                                <td class="text-end">
                                    <a href="<?php echo e(route('cashier.invoice', $order->id)); ?>" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-printer me-1"></i> Voir / Imprimer
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    Aucune facture trouvée.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if($orders->hasPages()): ?>
            <div class="card-footer bg-white py-3">
                <?php echo e($orders->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cashier.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/cashier/sales/invoices_list.blade.php ENDPATH**/ ?>