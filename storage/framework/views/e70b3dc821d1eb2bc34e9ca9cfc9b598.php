

<?php $__env->startSection('title', 'Modifier un produit'); ?>

<?php $__env->startSection('page-title', 'Modifier un produit'); ?>

<?php $__env->startSection('content'); ?>

<div class="card shadow-sm border-0">

    <div class="card-body">

        <h4 class="mb-4">
            <i class="bi bi-pencil-square text-warning"></i>
            Modifier le produit
        </h4>

        <form action="<?php echo e(route('admin.products.update', $product)); ?>"
              method="POST"
              enctype="multipart/form-data">

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

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
                           value="<?php echo e(old('name', $product->name)); ?>"
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
                            class="form-select <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                        <option value="">
                            -- Choisir une catégorie --
                        </option>

                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option value="<?php echo e($category->id); ?>"
                                <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>>

                                <?php echo e($category->name); ?>


                            </option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>

                    <?php $__errorArgs = ['category_id'];
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
                        Prix (FCFA)
                    </label>

                    <input type="number"
                           name="price"
                           class="form-control <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           min="0"
                           step="1"
                           value="<?php echo e(old('price', $product->price)); ?>"
                           required>

                    <?php $__errorArgs = ['price'];
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
                        Stock
                    </label>

                    <input type="number"
                           name="stock"
                           class="form-control <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           min="0"
                           value="<?php echo e(old('stock', $product->stock)); ?>"
                           required>

                    <?php $__errorArgs = ['stock'];
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


                
                <div class="col-12">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea name="description"
                              class="form-control"
                              rows="4"><?php echo e(old('description', $product->description)); ?></textarea>

                </div>


                
                <div class="col-md-6">

                    <label class="form-label">
                        Image actuelle
                    </label>

                    <?php if($product->image && file_exists(public_path('images/products/' . $product->image))): ?>

                        <div>
                            <img src="<?php echo e(asset('images/products/' . $product->image)); ?>"
                                 alt="<?php echo e($product->name); ?>"
                                 width="150"
                                 height="150"
                                 class="rounded img-thumbnail"
                                 style="object-fit: cover;">
                        </div>

                    <?php else: ?>

                        <p class="text-muted">
                            Aucune image.
                        </p>

                    <?php endif; ?>

                </div>


                
                <div class="col-md-6">

                    <label class="form-label">
                        Remplacer l'image
                    </label>

                    <input type="file"
                           name="image"
                           class="form-control"
                           accept="image/*">

                    <small class="text-muted">
                        JPG, JPEG, PNG ou WEBP — maximum 2 Mo.
                    </small>

                </div>

            </div>


            
            <div class="mt-4">

                <button type="submit"
                        class="btn btn-warning">

                    <i class="bi bi-check-lg"></i>
                    Enregistrer les modifications

                </button>

                <a href="<?php echo e(route('admin.products.index')); ?>"
                   class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>
                    Retour

                </a>

            </div>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>