

<?php $__env->startSection('title', 'Ajouter une catégorie'); ?>

<?php $__env->startSection('page-title', 'Ajouter une catégorie'); ?>

<?php $__env->startSection('content'); ?>

<div class="card shadow-sm border-0">

    <div class="card-body">

        <h4 class="mb-4">
            <i class="bi bi-plus-circle text-primary"></i>
            Nouvelle catégorie
        </h4>

        <form method="POST"
              action="<?php echo e(route('admin.categories.store')); ?>">

            <?php echo csrf_field(); ?>

            <div class="mb-3">

                <label class="form-label">
                    Nom de la catégorie
                </label>

                <input type="text"
                       name="name"
                       value="<?php echo e(old('name')); ?>"
                       class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       placeholder="Exemple : Alimentation"
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


            <div class="mb-3">

                <label class="form-label">
                    Description
                </label>

                <textarea name="description"
                          rows="4"
                          class="form-control"><?php echo e(old('description')); ?></textarea>

            </div>


            <div class="form-check mb-4">

                <input type="checkbox"
                       name="is_active"
                       value="1"
                       class="form-check-input"
                       id="is_active"
                       checked>

                <label class="form-check-label"
                       for="is_active">

                    Catégorie active

                </label>

            </div>


            <button type="submit"
                    class="btn btn-primary">

                <i class="bi bi-check-lg"></i>
                Enregistrer

            </button>

            <a href="<?php echo e(route('admin.categories.index')); ?>"
               class="btn btn-secondary">

                Annuler

            </a>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/categories/create.blade.php ENDPATH**/ ?>