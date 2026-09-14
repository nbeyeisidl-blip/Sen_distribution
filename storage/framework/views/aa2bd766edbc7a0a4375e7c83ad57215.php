

<?php $__env->startSection('title', 'Mon panier - SEN DISTRIBUTION'); ?>

<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold">
            <i class="bi bi-cart3"></i>
            Mon panier
        </h2>

        <p class="text-muted">
            Vérifiez vos produits avant de commander.
        </p>
    </div>

    <a href="<?php echo e(route('client.products.index')); ?>" class="btn btn-outline-primary">
        <i class="bi bi-arrow-left"></i>
        Continuer mes achats
    </a>
</div>

<?php if(empty($cart)): ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body text-center py-5">
            <i class="bi bi-cart-x text-muted" style="font-size: 80px;"></i>
            <h4 class="mt-3">Votre panier est vide</h4>
            <p class="text-muted">Ajoutez des produits à votre panier.</p>
            <a href="<?php echo e(route('client.products.index')); ?>" class="btn btn-primary">
                Voir les produits
            </a>
        </div>
    </div>

<?php else: ?>

<div class="row g-4">

    <!-- PRODUITS -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <?php
                    $subtotal = 0;
                ?>

                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php
                        $totalItem = $item['price'] * $item['quantity'];
                        $subtotal += $totalItem;
                        $imageName = $item['image'] ?? null;
                    ?>

                    <div class="row align-items-center border-bottom py-3">

                        
                        <div class="col-md-2 text-center mb-2 mb-md-0">
                            <div class="bg-light p-2 rounded" style="height: 90px;">
                                <img src="<?php echo e($imageName && file_exists(public_path('images/products/' . $imageName)) ? asset('images/products/' . $imageName) : asset('images/default-product.png')); ?>" 
                                     alt="<?php echo e($item['name']); ?>" 
                                     class="img-fluid h-100" 
                                     style="object-fit: contain;">
                            </div>
                        </div>

                        
                        <div class="col-md-4">
                            <h6 class="fw-bold mb-1">
                                <?php echo e($item['name']); ?>

                            </h6>
                            <span class="text-primary fw-bold">
                                <?php echo e(number_format($item['price'], 0, ',', ' ')); ?> FCFA
                            </span>
                        </div>

                        
                        <div class="col-md-3">
                            <form action="<?php echo e(route('client.cart.update', $item['id'])); ?>" method="POST" class="d-flex">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>

                                <input type="number" 
                                       name="quantity" 
                                       value="<?php echo e($item['quantity']); ?>" 
                                       min="1" 
                                       class="form-control">

                                <button type="submit" class="btn btn-outline-primary ms-2">
                                    <i class="bi bi-check"></i>
                                </button>
                            </form>
                        </div>

                        
                        <div class="col-md-2 text-end">
                            <strong>
                                <?php echo e(number_format($totalItem, 0, ',', ' ')); ?> F
                            </strong>
                        </div>

                        
                        <div class="col-md-1 text-end">
                            <form action="<?php echo e(route('client.cart.remove', $item['id'])); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>

                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>

        <form action="<?php echo e(route('client.cart.clear')); ?>" method="POST" class="mt-3">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>

            <button type="submit" class="btn btn-outline-danger">
                <i class="bi bi-trash"></i>
                Vider le panier
            </button>
        </form>
    </div>

    <!-- RÉSUMÉ -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Résumé de la commande</h5>

                <div class="d-flex justify-content-between mb-3">
                    <span>Sous-total</span>
                    <strong><?php echo e(number_format($subtotal, 0, ',', ' ')); ?> FCFA</strong>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span>Livraison</span>
                    <strong>2 000 FCFA</strong>
                </div>

                <?php
                    $delivery = 2000;
                    $total = $subtotal + $delivery;
                ?>

                <hr>

                <div class="d-flex justify-content-between mb-4">
                    <strong>Total</strong>
                    <strong class="text-primary fs-4">
                        <?php echo e(number_format($total, 0, ',', ' ')); ?> FCFA
                    </strong>
                </div>

                <a href="<?php echo e(route('client.checkout.index')); ?>" class="btn btn-primary w-100 btn-lg">
                    <i class="bi bi-credit-card"></i>
                    Passer la commande
                </a>
            </div>
        </div>
    </div>

</div>

<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/client/cart/index.blade.php ENDPATH**/ ?>