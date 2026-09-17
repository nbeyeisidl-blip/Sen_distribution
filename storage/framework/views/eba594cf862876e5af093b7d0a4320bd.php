

<?php $__env->startSection('title', 'Ajouter un produit'); ?>

<?php $__env->startSection('page-title', 'Ajouter un produit'); ?>

<?php $__env->startSection('content'); ?>

<div class="card shadow-sm border-0">

    <div class="card-body">

        <h4 class="mb-4">
            <i class="bi bi-plus-circle text-primary"></i>
            Nouveau produit
        </h4>

        <form action="<?php echo e(route('admin.products.store')); ?>"
              method="POST"
              enctype="multipart/form-data">

            <?php echo csrf_field(); ?>

            <div class="row g-3">

                <div class="col-md-6">

                    <label class="form-label">
                        Nom du produit
                    </label>

                    <input type="text"
                           name="name"
                           class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e(old('name')); ?>"
                           required>

                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Catégorie
                    </label>

                    <select name="category_id"
                            class="form-select">

                        <option value="">
                            -- Choisir une catégorie --
                        </option>

                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option value="<?php echo e($category->id); ?>"
                                <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>>

                                <?php echo e($category->name); ?>


                            </option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Prix (FCFA)
                    </label>

                    <input type="number"
                           name="price"
                           class="form-control"
                           min="0"
                           step="1"
                           value="<?php echo e(old('price')); ?>"
                           required>

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Stock
                    </label>

                    <input type="number"
                           name="stock"
                           class="form-control"
                           min="0"
                           value="<?php echo e(old('stock', 0)); ?>"
                           required>

                </div>


                <div class="col-12">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea name="description"
                              class="form-control"
                              rows="4"><?php echo e(old('description')); ?></textarea>

                </div>


                <div class="mb-3">
        <label for="image" class="form-label">Image du produit</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*">
    </div>

            </div>


            <div class="mt-4">

                <button type="submit"
                        class="btn btn-primary">

                    <i class="bi bi-check-lg"></i>
                    Enregistrer

                </button>

                <a href="<?php echo e(route('admin.products.index')); ?>"
                   class="btn btn-secondary">

                    Annuler

                </a>

            </div>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/products/create.blade.php ENDPATH**/ ?>