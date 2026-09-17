

<?php $__env->startSection('title', 'Ajouter un client'); ?>

<?php $__env->startSection('page-title', 'Ajouter un client'); ?>

<?php $__env->startSection('content'); ?>

<div class="card shadow-sm border-0">

    <div class="card-body">

        <h4 class="mb-4">
            <i class="bi bi-person-plus text-primary"></i>
            Nouveau client
        </h4>

        <form method="POST"
              action="<?php echo e(route('admin.clients.store')); ?>">

            <?php echo csrf_field(); ?>

            <div class="row g-3">

                <div class="col-md-6">

                    <label class="form-label">
                        Nom *
                    </label>

                    <input type="text"
                           name="nom"
                           value="<?php echo e(old('nom')); ?>"
                           class="form-control"
                           required>

                    <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger small">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Prénom
                    </label>

                    <input type="text"
                           name="prenom"
                           value="<?php echo e(old('prenom')); ?>"
                           class="form-control">

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Téléphone
                    </label>

                    <input type="text"
                           name="telephone"
                           value="<?php echo e(old('telephone')); ?>"
                           class="form-control"
                           placeholder="77 000 00 00">

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Email
                    </label>

                    <input type="email"
                           name="email"
                           value="<?php echo e(old('email')); ?>"
                           class="form-control">

                </div>

                <div class="col-12">

                    <label class="form-label">
                        Adresse
                    </label>

                    <textarea name="adresse"
                              rows="3"
                              class="form-control"><?php echo e(old('adresse')); ?></textarea>

                </div>

                <div class="col-12">

                    <div class="form-check">

                        <input type="checkbox"
                               name="is_active"
                               value="1"
                               class="form-check-input"
                               id="is_active"
                               checked>

                        <label class="form-check-label"
                               for="is_active">

                            Client actif

                        </label>

                    </div>

                </div>

            </div>

            <div class="mt-4">

                <button type="submit"
                        class="btn btn-primary">

                    <i class="bi bi-check-lg"></i>
                    Enregistrer

                </button>

                <a href="<?php echo e(route('admin.clients.index')); ?>"
                   class="btn btn-secondary">

                    Annuler

                </a>

            </div>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/clients/create.blade.php ENDPATH**/ ?>