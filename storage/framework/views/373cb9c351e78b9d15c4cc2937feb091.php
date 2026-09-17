

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Gestion des Produits</h1>
            <p class="text-muted small mb-0">Catalogue et suivi des articles - SEN DISTRIBUTION</p>
        </div>
        <button type="button" class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <i class="bi bi-plus-lg me-1"></i> Nouveau Produit
        </button>
    </div>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="<?php echo e(route('storekeeper.products.index')); ?>" method="GET" class="row g-3">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Rechercher par nom..." value="<?php echo e(request('search')); ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-secondary w-100 fw-bold">Filtrer</button>
                </div>
            </form>
        </div>
    </div>

    
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small text-muted">
                        <tr>
                            <th>ID</th>
                            <th>Désignation</th>
                            <th>Prix Unitaire</th>
                            <th>Stock Disponible</th>
                            <th>Statut Stock</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="fw-bold text-secondary">#PRD-<?php echo e(str_pad($product->id, 4, '0', STR_PAD_LEFT)); ?></td>
                                <td>
                                    <div class="fw-bold text-dark"><?php echo e($product->name ?? $product->nom); ?></div>
                                </td>
                                <td class="fw-semibold text-primary">
                                    <?php echo e(number_format($product->price, 0, ',', ' ')); ?> FCFA
                                </td>
                                <td class="fw-bold fs-6">
                                    <?php echo e($product->stock); ?>

                                </td>
                                <td>
                                    <?php if($product->stock <= 0): ?>
                                        <span class="badge bg-danger">Rupture</span>
                                    <?php elseif($product->stock <= 5): ?>
                                        <span class="badge bg-warning text-dark">Stock Faible</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Disponible</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editModal<?php echo e($product->id); ?>">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="<?php echo e(route('storekeeper.products.destroy', $product->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression de ce produit ?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            
                            <div class="modal fade" id="editModal<?php echo e($product->id); ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="<?php echo e(route('storekeeper.products.update', $product->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold">Modifier le produit</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Nom du produit</label>
                                                    <input type="text" name="name" class="form-control" value="<?php echo e($product->name ?? $product->nom); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Prix (FCFA)</label>
                                                    <input type="number" name="price" class="form-control" value="<?php echo e($product->price); ?>" required min="0">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Quantité en stock</label>
                                                    <input type="number" name="stock" class="form-control" value="<?php echo e($product->stock); ?>" required min="0">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary fw-bold">Mettre à jour</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    Aucun produit trouvé dans le catalogue.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if(method_exists($products, 'hasPages') && $products->hasPages()): ?>
            <div class="card-footer bg-white py-3">
                <?php echo e($products->links()); ?>

            </div>
        <?php endif; ?>
    </div>

</div>


<div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo e(route('storekeeper.products.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Ajouter un nouveau produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Désignation / Nom</label>
                        <input type="text" name="name" class="form-control" placeholder="ex: Parfum Dior Sauvage" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Prix unitaire (FCFA)</label>
                        <input type="number" name="price" class="form-control" placeholder="ex: 25000" required min="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Stock initial</label>
                        <input type="number" name="stock" class="form-control" placeholder="ex: 50" required min="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary fw-bold">Enregistrer le produit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('storekeeper.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/storekeeper/products/index.blade.php ENDPATH**/ ?>