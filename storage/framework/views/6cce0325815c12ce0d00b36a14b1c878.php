

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <h6 class="fw-bold mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Veuillez corriger les champs suivants :</h6>
            <ul class="mb-0 ps-3">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="mb-4">
        <h2 class="fw-bold"><i class="bi bi-credit-card me-2"></i>Caisse & Finalisation</h2>
        <p class="text-muted">Veuillez vérifier vos informations de livraison et valider votre commande.</p>
    </div>
    <form action="<?php echo e(route('client.checkout.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="row g-4">
            
            <!-- Informations de Livraison & Paiement -->
            <div class="col-lg-7">
                <!-- Adresse de Livraison -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3"><i class="bi bi-geo-alt me-2 text-primary"></i>Adresse de livraison</h5>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label fw-semibold">Prénom</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="first_name" name="first_name" value="<?php echo e(old('first_name', Auth::user()->first_name ?? '')); ?>" required>
                                <?php $__errorArgs = ['first_name'];
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

                            <div class="col-md-6">
                                <label for="last_name" class="form-label fw-semibold">Nom</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="last_name" name="last_name" value="<?php echo e(old('last_name', Auth::user()->name ?? '')); ?>" required>
                                <?php $__errorArgs = ['last_name'];
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

                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-semibold">Téléphone</label>
                                <input type="tel" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="phone" name="phone" value="<?php echo e(old('phone', Auth::user()->phone ?? '')); ?>" placeholder="77 000 00 00" required>
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

                            <div class="col-md-6">
                                <label for="city" class="form-label fw-semibold">Ville / Région</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="city" name="city" value="<?php echo e(old('city', 'Dakar')); ?>" required>
                                <?php $__errorArgs = ['city'];
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

                            <div class="col-12">
                                <label for="address" class="form-label fw-semibold">Adresse exacte</label>
                                <textarea class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="address" name="address" rows="2" placeholder="Quartier, rue, numéro de maison..." required><?php echo e(old('address')); ?></textarea>
                                <?php $__errorArgs = ['address'];
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
                        </div>
                    </div>
                </div>

                <!-- Mode de Paiement -->
<div class="card border-0 shadow-sm rounded-3 mb-4">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-3"><i class="bi bi-wallet2 me-2 text-primary"></i>Mode de paiement <span class="text-danger">*</span></h5>

        <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="alert alert-danger py-2 small mb-3">
                <i class="bi bi-exclamation-triangle me-1"></i> Veuillez choisir un mode de paiement.
            </div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <div class="d-flex flex-column gap-3">
            
            <!-- Wave -->
            <label class="form-check p-3 border rounded-3 d-flex align-items-center justify-content-between cursor-pointer payment-option">
                <div class="d-flex align-items-center">
                    <input class="form-check-input me-3" type="radio" name="payment_method" id="payment_wave" value="wave" <?php echo e(old('payment_method') == 'wave' ? 'checked' : ''); ?> required>
                    <div>
                        <div class="fw-bold text-dark">Wave</div>
                        <div class="text-muted small">Paiement instantané via votre compte Wave</div>
                    </div>
                </div>
                <span class="badge bg-info text-dark fw-bold px-3 py-2">Wave</span>
            </label>

            <!-- Orange Money -->
            <label class="form-check p-3 border rounded-3 d-flex align-items-center justify-content-between cursor-pointer payment-option">
                <div class="d-flex align-items-center">
                    <input class="form-check-input me-3" type="radio" name="payment_method" id="payment_om" value="orange_money" <?php echo e(old('payment_method') == 'orange_money' ? 'checked' : ''); ?>>
                    <div>
                        <div class="fw-bold text-dark">Orange Money</div>
                        <div class="text-muted small">Paiement mobile sécurisé par code #144#</div>
                    </div>
                </div>
                <span class="badge bg-warning text-dark fw-bold px-3 py-2">OM</span>
            </label>

            <!-- Paiement à la livraison -->
            <label class="form-check p-3 border rounded-3 d-flex align-items-center justify-content-between cursor-pointer payment-option">
                <div class="d-flex align-items-center">
                    <input class="form-check-input me-3" type="radio" name="payment_method" id="payment_cash" value="cash" <?php echo e(old('payment_method', 'cash') == 'cash' ? 'checked' : ''); ?>>
                    <div>
                        <div class="fw-bold text-dark">Paiement à la livraison</div>
                        <div class="text-muted small">Payez en espèces dès réception de votre colis</div>
                    </div>
                </div>
                <i class="bi bi-cash-stack fs-3 text-success"></i>
            </label>

        </div>
    </div>
</div>
            </div>

            <!-- Récapitulatif du Panier -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-3 sticky-top" style="top: 20px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3 border-bottom pb-2"><i class="bi bi-bag-check me-2 text-primary"></i>Récapitulatif de la commande</h5>

                        <ul class="list-group list-group-flush mb-3">
                            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <?php if(!empty($item['image'])): ?>
    <img src="<?php echo e(Str::startsWith($item['image'], 'http') ? $item['image'] : asset('images/products/' . ltrim(basename($item['image']), '/'))); ?>" 
         alt="<?php echo e($item['name']); ?>" 
         class="rounded me-3 border" 
         style="width: 50px; height: 50px; object-fit: cover;">
<?php else: ?>
    <div class="bg-light rounded border me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
        <i class="bi bi-image text-muted"></i>
    </div>
                                        <?php endif; ?>
                                        <div>
                                            <h6 class="my-0 fw-semibold"><?php echo e($item['name']); ?></h6>
                                            <small class="text-muted">Quantité : <?php echo e($item['quantity']); ?> × <?php echo e(number_format($item['price'], 0, ',', ' ')); ?> FCFA</small>
                                        </div>
                                    </div>
                                    <span class="fw-semibold text-dark"><?php echo e(number_format($item['price'] * $item['quantity'], 0, ',', ' ')); ?> FCFA</span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Sous-total</span>
                            <span class="fw-semibold"><?php echo e(number_format($total, 0, ',', ' ')); ?> FCFA</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Frais de livraison</span>
                            <span class="text-success fw-semibold">À définir à la livraison</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="fw-bold fs-5">Total</span>
                            <strong class="text-primary fs-4"><?php echo e(number_format($total, 0, ',', ' ')); ?> FCFA</strong>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-pill shadow-sm">
                            <i class="bi bi-check-circle me-2"></i> Confirmer la commande
                        </button>

                        <a href="<?php echo e(route('client.cart.index')); ?>" class="btn btn-link w-100 mt-2 text-decoration-none text-muted small">
                            <i class="bi bi-arrow-left me-1"></i> Modifier le panier
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/client/checkout/index.blade.php ENDPATH**/ ?>