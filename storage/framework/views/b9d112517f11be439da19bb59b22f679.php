


<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-0 text-gray-800">Catégories & Sous-Catégories</h2>
            <p class="text-muted mb-0 small">Organisation hiérarchique du catalogue</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="fas fa-plus me-1"></i> Ajouter une Catégorie / Sous-Catégorie
        </button>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Type</th>
                            <th>Catégorie Parente</th>
                            <th>Produits</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <?php if($category->parent_id): ?>
                                        <span class="text-muted ms-3">— </span><strong><?php echo e($category->name); ?></strong>
                                    <?php else: ?>
                                        <strong><i class="fas fa-folder me-1 text-warning"></i> <?php echo e($category->name); ?></strong>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($category->parent_id): ?>
                                        <span class="badge bg-info text-white">Sous-catégorie</span>
                                    <?php else: ?>
                                        <span class="badge bg-primary">Catégorie Principale</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($category->parent): ?>
                                        <span class="badge bg-light text-dark border"><?php echo e($category->parent->name); ?></span>
                                    <?php else: ?>
                                        <span class="text-muted small">Aucune (Principale)</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?php echo e($category->products_count); ?> produit(s)
                                    </span>
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-primary me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModal<?php echo e($category->id); ?>">
                                        Modifier
                                    </button>
                                    <form action="<?php echo e(route('admin.categories.destroy', $category->id)); ?>" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Voulez-vous supprimer cette catégorie ?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal de Modification -->
                            <div class="modal fade" id="editModal<?php echo e($category->id); ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="<?php echo e(route('admin.categories.update', $category->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title">Modifier : <?php echo e($category->name); ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Nom</label>
                                                    <input type="text" name="name" class="form-control" value="<?php echo e($category->name); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Catégorie Parente (Laissez vide si c'est une catégorie principale)</label>
                                                    <select name="parent_id" class="form-select">
                                                        <option value="">Aucune (Catégorie principale)</option>
                                                        <?php $__currentLoopData = $parentCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($parent->id != $category->id): ?>
                                                                <option value="<?php echo e($parent->id); ?>" <?php echo e($category->parent_id == $parent->id ? 'selected' : ''); ?>>
                                                                    <?php echo e($parent->name); ?>

                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Description</label>
                                                    <textarea name="description" class="form-control" rows="3"><?php echo e($category->description); ?></textarea>
                                              <div class="mb-3">
    <label class="form-label">Catégorie Parente</label>
    <select name="parent_id" class="form-select">
    <option value="">Aucune (Créer comme Catégorie Principale)</option>
    <?php $__currentLoopData = $parentCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($parent->id); ?>"><?php echo e($parent->name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    Aucune catégorie trouvée.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'Ajout -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo e(route('admin.categories.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une Catégorie / Sous-Catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nom de la catégorie</label>
                        <input type="text" name="name" class="form-control" placeholder="ex: Vêtements, Chaussures, Chemises..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Catégorie Parente</label>
                        <select name="parent_id" class="form-select">
                            <option value="" selected>Aucune (Créer comme Catégorie Principale)</option>
                            <?php $__currentLoopData = $parentCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($parent->id); ?>"><?php echo e($parent->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="form-text">Si vous choisissez un parent, cette catégorie deviendra une sous-catégorie.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Description optionnelle..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>