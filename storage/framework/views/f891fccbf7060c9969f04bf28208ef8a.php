

<?php $__env->startSection('title', 'Ajouter un fournisseur'); ?>

<?php $__env->startSection('page-title', 'Ajouter un fournisseur'); ?>

<?php $__env->startSection('content'); ?>

<div class="card border-0 shadow-sm">

    <div class="card-body">

        <h4 class="fw-bold mb-4">
            Ajouter un fournisseur
        </h4>

        <form method="POST"
              action="<?php echo e(route('admin.fournisseurs.store')); ?>">

            <?php echo csrf_field(); ?>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Nom *
                    </label>

                    <input type="text"
                           name="nom"
                           class="form-control"
                           value="<?php echo e(old('nom')); ?>"
                           required>

                    <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Entreprise
                    </label>

                    <input type="text"
                           name="entreprise"
                           class="form-control"
                           value="<?php echo e(old('entreprise')); ?>">

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Téléphone
                    </label>

                    <input type="text"
                           name="telephone"
                           class="form-control"
                           value="<?php echo e(old('telephone')); ?>">

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Email
                    </label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           value="<?php echo e(old('email')); ?>">

                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>


                <div class="col-12 mb-3">

                    <label class="form-label">
                        Adresse
                    </label>

                    <textarea name="adresse"
                              class="form-control"
                              rows="3"><?php echo e(old('adresse')); ?></textarea>

                </div>

            </div>


            <button type="submit"
                    class="btn btn-success">

                <i class="bi bi-check-circle"></i>
                Enregistrer

            </button>

            <a href="<?php echo e(route('admin.fournisseurs.index')); ?>"
               class="btn btn-secondary">

                Annuler

            </a>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/fournisseurs/create.blade.php ENDPATH**/ ?>