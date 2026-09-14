

<?php $__env->startSection('title', 'Validation de la commande'); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <h2 class="fw-bold mb-4"><i class="bi bi-credit-card me-2"></i>Validation de votre commande</h2>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <!-- Formulaire de Livraison -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4">
                <h4 class="h5 fw-bold mb-3">Informations de livraison & Paiement</h4>
                <hr class="mb-4">

                <form action="<?php echo e(route('client.checkout.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <!-- Adresse de livraison -->
                    <div class="mb-3">
                        <label for="shipping_address" class="form-label fw-semibold">Adresse de livraison <span class="text-danger">*</span></label>
                        <textarea name="shipping_address" id="shipping_address" class="form-control <?php $__errorArgs = ['shipping_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3" placeholder="Saisissez votre adresse complète (Quartier, Rue, Ville...)" required><?php echo e(old('shipping_address')); ?></textarea>
                        <?php $__errorArgs = ['shipping_address'];
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

                    <!-- Numéro de téléphone -->
                    <div class="mb-3">
                        <label for="phone" class="form-label fw-semibold">Numéro de téléphone <span class="text-danger">*</span></label>
                        <input type="text" name="phone" id="phone" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Ex: +221 77 000 00 00" value="<?php echo e(old('phone')); ?>" required>
                        <?php $__errorArgs = ['phone'];
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

                    <!-- Notes additionnelles -->
                    <div class="mb-4">
                        <label for="notes" class="form-label fw-semibold">Notes / Instructions spécifiques (Optionnel)</label>
                        <textarea name="notes" id="notes" class="form-control <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="2" placeholder="Indications complémentaires pour le livreur..."><?php echo e(old('notes')); ?></textarea>
                        <?php $__errorArgs = ['notes'];
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

                    <!-- Mode de paiement -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Mode de paiement</label>
                        <div class="form-check p-3 border rounded mb-2 bg-light">
                            <input class="form-check-input" type="radio" name="payment_method" id="pay_cash" value="cash" checked>
                            <label class="form-check-label fw-bold" for="pay_cash">
                                <i class="bi bi-cash-stack text-success me-2"></i>Paiement à la livraison
                            </label>
                            <p class="text-muted small mb-0 mt-1">Payez en espèces lorsque le livreur arrive chez vous.</p>
                        </div>
                    </div>

                    <!-- Bouton de confirmation -->
                    <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm fw-bold">
                        <i class="bi bi-check-circle me-2"></i>Confirmer la commande
                    </button>
                </form>
            </div>
        </div>

        <!-- Récapitulatif du Panier -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm p-4 bg-light">
                <h4 class="h5 fw-bold mb-3">Résumé du panier</h4>
                <hr>

                <ul class="list-group list-group-flush mb-3 bg-transparent">
                    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            <div>
                                <h6 class="my-0 fw-semibold"><?php echo e($item['name']); ?></h6>
                                <small class="text-muted">Quantité : <?php echo e($item['quantity']); ?> x <?php echo e(number_format($item['price'], 0, ',', ' ')); ?> FCFA</small>
                            </div>
                            <span class="fw-bold text-dark"><?php echo e(number_format($item['price'] * $item['quantity'], 0, ',', ' ')); ?> FCFA</span>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted">Sous-total</span>
                    <span class="fw-bold"><?php echo e(number_format($total, 0, ',', ' ')); ?> FCFA</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Frais de livraison</span>
                    <span class="text-success fw-bold">Calculés à la livraison</span>
                </div>

                <div class="d-flex justify-content-between align-items-center p-3 bg-white rounded border">
                    <span class="h5 mb-0 fw-bold">Total Général</span>
                    <span class="h4 mb-0 fw-bold text-primary"><?php echo e(number_format($total, 0, ',', ' ')); ?> FCFA</span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/client/checkout/index.blade.php ENDPATH**/ ?>