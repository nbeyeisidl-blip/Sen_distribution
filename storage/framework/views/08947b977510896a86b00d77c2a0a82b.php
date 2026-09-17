<div class="product-list">
    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="product-card">
            <h3><?php echo e($product->nom); ?></h3>
            <p><?php echo e($product->description); ?></p>
            <span>Prix : <?php echo e($product->prix); ?> FCFA</span>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p>Aucun produit disponible pour le moment.</p>
    <?php endif; ?>
</div><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/welcome.blade.php ENDPATH**/ ?>