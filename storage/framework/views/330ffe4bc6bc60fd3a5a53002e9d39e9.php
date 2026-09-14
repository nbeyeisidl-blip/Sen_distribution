


<?php $__env->startSection('title', 'Modifier la vente #' . $sale->id); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Modifier la Vente #<?php echo e($sale->id); ?></h1>
        <a href="<?php echo e(route('admin.sales.index')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Retour à la liste
        </a>
    </div>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.sales.update', $sale->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="row">
            
            <div class="col-lg-4 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white py-3">
                        <h6 class="m-0 fw-bold">Informations de la Vente</h6>
                    </div>
                    <div class="card-body">
                        
                        <div class="mb-3">
                            <label for="client_id" class="form-label">Client</label>
                            <select name="client_id" id="client_id" class="form-select <?php $__errorArgs = ['client_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">Client de passage</option>
                                <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($client->id); ?>" <?php echo e(old('client_id', $sale->client_id) == $client->id ? 'selected' : ''); ?>>
                                        <?php echo e($client->nom); ?> <?php echo e($client->prenom); ?> <?php echo e($client->telephone ? '('.$client->telephone.')' : ''); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['client_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Mode de Paiement <span class="text-danger">*</span></label>
                            <select name="payment_method" id="payment_method" class="form-select <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="Espèces" <?php echo e(old('payment_method', $sale->payment_method) == 'Espèces' ? 'selected' : ''); ?>>Espèces</option>
                                <option value="Carte Bancaire" <?php echo e(old('payment_method', $sale->payment_method) == 'Carte Bancaire' ? 'selected' : ''); ?>>Carte Bancaire</option>
                                <option value="Orange Money" <?php echo e(old('payment_method', $sale->payment_method) == 'Orange Money' ? 'selected' : ''); ?>>Orange Money</option>
                                <option value="Wave" <?php echo e(old('payment_method', $sale->payment_method) == 'Wave' ? 'selected' : ''); ?>>Wave</option>
                                <option value="Virement" <?php echo e(old('payment_method', $sale->payment_method) == 'Virement' ? 'selected' : ''); ?>>Virement</option>
                            </select>
                            <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save me-1"></i> Mettre à jour la vente
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-8 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white py-3">
                        <h6 class="m-0 fw-bold">Produits de la Vente</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Produit</th>
                                        <th style="width: 150px;">Prix Unitaire</th>
                                        <th style="width: 150px;">Stock En Stock</th>
                                        <th style="width: 160px;">Quantité Vendue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // Transformer les items existants sous forme d'un tableau [product_id => quantity]
                                        $saleItems = $sale->items->pluck('quantity', 'product_id')->toArray();
                                    ?>

                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $qtyInSale = $saleItems[$product->id] ?? 0;
                                        ?>
                                        <tr>
                                            <td>
                                                <strong><?php echo e($product->name); ?></strong>
                                                <input type="hidden" name="products[<?php echo e($index); ?>][id]" value="<?php echo e($product->id); ?>">
                                            </td>
                                            <td><?php echo e(number_format($product->price, 0, ',', ' ')); ?> FCFA</td>
                                            <td>
                                                <span class="badge bg-secondary"><?php echo e($product->stock); ?></span>
                                            </td>
                                            <td>
                                                <input type="number" 
                                                       name="products[<?php echo e($index); ?>][quantity]" 
                                                       class="form-control" 
                                                       min="0" 
                                                       value="<?php echo e(old("products.{$index}.quantity", $qtyInSale)); ?>" 
                                                       placeholder="0">
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/sales/edit.blade.php ENDPATH**/ ?>