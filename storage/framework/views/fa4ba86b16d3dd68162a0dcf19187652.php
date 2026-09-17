

<?php $__env->startSection('title', 'Nouvelle vente'); ?>
<?php $__env->startSection('page-title', 'Nouvelle vente'); ?>

<?php $__env->startSection('content'); ?>


<form method="POST" action="<?php echo e(route('admin.sales.store')); ?>">
    <?php echo csrf_field(); ?>

    <div class="row">
        
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-4"><i class="bi bi-cart-plus"></i> Produits</h5>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Produit</th>
                                    <th>Prix</th>
                                    <th>Stock</th>
                                    <th width="150">Quantité</th>
                                    <th>Sous-total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="product-row" data-price="<?php echo e($product->price); ?>">
                                        <td>
                                            <strong><?php echo e($product->name); ?></strong>
                                            <input type="hidden" name="products[<?php echo e($loop->index); ?>][id]" value="<?php echo e($product->id); ?>">
                                        </td>
                                        <td><?php echo e(number_format($product->price, 0, ',', ' ')); ?> FCFA</td>
                                        <td><span class="badge bg-primary"><?php echo e($product->stock); ?></span></td>
                                        <td>
                                            <input type="number" 
                                                   name="products[<?php echo e($loop->index); ?>][quantity]" 
                                                   class="form-control quantity" 
                                                   min="0" 
                                                   max="<?php echo e($product->stock); ?>" 
                                                   value="<?php echo e(old('products.'.$loop->index.'.quantity', 0)); ?>">
                                        </td>
                                        <td><strong class="subtotal">0 FCFA</strong></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-4">
            
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3"><i class="bi bi-person"></i> Client</h5>
                    <select name="client_id" id="client_id" class="form-select">
                        <option value="">Client comptoir / Client de passage</option>
                        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($client->id); ?>">
                                <?php echo e($client->nom); ?> <?php echo e($client->prenom ?? ''); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3"><i class="bi bi-credit-card"></i> Paiement</h5>
                    <select name="payment_method" class="form-select" required>
                        <option value="Espèces">Espèces</option>
                        <option value="Wave">Wave</option>
                        <option value="Orange Money">Orange Money</option>
                        <option value="Carte bancaire">Carte bancaire</option>
                    </select>
                </div>
            </div>

            
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <span>Nombre d'articles</span>
                        <strong id="total-items">0</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fs-5">TOTAL</span>
                        <strong class="fs-4 text-primary" id="total">0 FCFA</strong>
                    </div>

                    
                    <button type="submit" class="btn btn-success w-100 py-2">
                        <i class="bi bi-check-circle me-1"></i> Enregistrer la vente
                    </button>
                    <a href="<?php echo e(route('admin.sales.index')); ?>" class="btn btn-outline-secondary w-100 mt-2">
                        Annuler
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('.product-row');
    const totalElement = document.getElementById('total');
    const itemsElement = document.getElementById('total-items');

    function calculateTotal() {
        let total = 0;
        let items = 0;

        rows.forEach(function(row) {
            const price = parseFloat(row.dataset.price);
            const quantityInput = row.querySelector('.quantity');
            const subtotalElement = row.querySelector('.subtotal');
            const quantity = parseInt(quantityInput.value) || 0;

            const subtotal = price * quantity;
            total += subtotal;
            items += quantity;

            subtotalElement.textContent = subtotal.toLocaleString('fr-FR') + ' FCFA';
        });

        totalElement.textContent = total.toLocaleString('fr-FR') + ' FCFA';
        itemsElement.textContent = items;
    }

    rows.forEach(function(row) {
        const quantityInput = row.querySelector('.quantity');
        quantityInput.addEventListener('input', calculateTotal);
        quantityInput.addEventListener('change', calculateTotal);
    });

    calculateTotal();
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/sales/create.blade.php ENDPATH**/ ?>