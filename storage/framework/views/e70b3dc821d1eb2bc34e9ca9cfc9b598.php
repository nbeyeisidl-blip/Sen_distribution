

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Modifier le produit : <?php echo e($product->name); ?></h2>
        <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-secondary">Retour</a>
    </div>

    <form action="<?php echo e(route('admin.products.update', $product->id)); ?>" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label class="form-label">Nom du produit</label>
            <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $product->name)); ?>" required>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Prix (FCFA)</label>
                <input type="number" step="0.01" name="price" class="form-control" value="<?php echo e(old('price', $product->price)); ?>" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" value="<?php echo e(old('stock', $product->stock)); ?>" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Catégorie</label>
                <select name="category_id" class="form-select" required>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e($product->category_id == $category->id ? 'selected' : ''); ?>>
                            <?php echo e($category->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Sexe / Public</label>
                <select name="gender" class="form-select">
                    <option value="mixte" <?php echo e($product->gender == 'mixte' ? 'selected' : ''); ?>>Mixte / Unisexe</option>
                    <option value="homme" <?php echo e($product->gender == 'homme' ? 'selected' : ''); ?>>Homme</option>
                    <option value="femme" <?php echo e($product->gender == 'femme' ? 'selected' : ''); ?>>Femme</option>
                    <option value="enfant" <?php echo e($product->gender == 'enfant' ? 'selected' : ''); ?>>Enfant</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Taille</label>
                <input type="text" name="size" class="form-control" value="<?php echo e(old('size', $product->size)); ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Couleur</label>
                <input type="text" name="color" class="form-control" value="<?php echo e(old('color', $product->color)); ?>">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Changer l'image (optionnel)</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            <?php if($product->image): ?>
                <div class="mt-2">
                    <img src="<?php echo e(asset('images/products/' . $product->image)); ?>" alt="Image actuelle" width="80" class="rounded">
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="3" class="form-control"><?php echo e(old('description', $product->description)); ?></textarea>
        </div>

        <button type="submit" class="btn btn-success">Mettre à jour le produit</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>