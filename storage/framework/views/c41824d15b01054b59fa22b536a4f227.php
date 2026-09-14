

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row bg-white p-4 rounded shadow-sm">
        
        <div class="col-md-6 text-center mb-4 mb-md-0">
            <div class="border rounded p-3 bg-light">
                <img src="<?php echo e($product->image && file_exists(public_path('images/products/' . $product->image)) ? asset('images/products/' . $product->image) : asset('images/default-product.png')); ?>" 
                     alt="<?php echo e($product->name); ?>" 
                     class="img-fluid rounded" 
                     style="max-height: 400px; object-fit: contain;">
            </div>
        </div>

        
        <div class="col-md-6 d-flex flex-column justify-content-between">
            <div>
                <span class="badge bg-secondary mb-2"><?php echo e($product->category->name ?? 'Général'); ?></span>
                <h1 class="fw-bold text-dark h2 mb-3"><?php echo e($product->name); ?></h1>
                
                <h3 class="text-primary fw-bold mb-3">
                    <?php echo e(number_format($product->price, 0, ',', ' ')); ?> FCFA
                </h3>

                <p class="text-muted mb-4">
    <?php if(!empty($product->description)): ?>
        <?php echo e($product->description); ?>

    <?php else: ?>
        Aucune description disponible pour ce produit.
    <?php endif; ?>
</p>

                <div class="mb-3">
                    <strong>Disponibilité :</strong>
                    <?php if($product->stock > 0): ?>
                        <span class="text-success fw-bold">En stock (<?php echo e($product->stock); ?> disponibles)</span>
                    <?php else: ?>
                        <span class="text-danger fw-bold">Rupture de stock</span>
                    <?php endif; ?>
                </div>
            </div>

            
            <form action="<?php echo e(route('client.cart.add', $product->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="d-flex align-items-center mb-4">
                    <label for="quantity" class="me-3 fw-bold">Quantité :</label>
                    <div class="input-group" style="width: 140px;">
                        <button class="btn btn-outline-secondary" type="button" onclick="decrementQty()">-</button>
                        <input type="number" id="quantity" name="quantity" class="form-control text-center" value="1" min="1" max="<?php echo e($product->stock); ?>">
                        <button class="btn btn-outline-secondary" type="button" onclick="incrementQty()">+</button>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success btn-lg fw-bold" <?php if($product->stock <= 0): ?> disabled <?php endif; ?>>
                        <i class="bi bi-cart-plus me-2"></i>Ajouter au panier
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function incrementQty() {
        let input = document.getElementById('quantity');
        let max = parseInt(input.getAttribute('max'));
        let val = parseInt(input.value);
        if (isNaN(max) || val < max) {
            input.value = val + 1;
        }
    }

    function decrementQty() {
        let input = document.getElementById('quantity');
        let val = parseInt(input.value);
        if (val > 1) {
            input.value = val - 1;
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/client/products/show.blade.php ENDPATH**/ ?>