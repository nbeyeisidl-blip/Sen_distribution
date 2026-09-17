

<?php $__env->startSection('content'); ?>
<div class="container py-4">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Catalogue des Produits</h1>
            <p class="text-muted small mb-0">Découvrez l'ensemble de nos articles disponibles chez SEN DISTRIBUTION</p>
        </div>
        <a href="<?php echo e(route('client.cart.index')); ?>" class="btn btn-outline-primary position-relative">
            <i class="bi bi-cart3 me-1"></i> Mon Panier
            <?php if(session('cart') && count(session('cart')) > 0): ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?php echo e(count(session('cart'))); ?>

                </span>
            <?php endif; ?>
        </a>
    </div>

    <div class="row">

        
        <div class="col-lg-3 mb-4">

            
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-bold py-3 border-bottom">
                    <i class="bi bi-search me-2 text-primary"></i>Rechercher
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('client.products.index')); ?>" method="GET">
                        <?php if(request('category_id')): ?>
                            <input type="hidden" name="category_id" value="<?php echo e(request('category_id')); ?>">
                        <?php endif; ?>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Nom du produit..." value="<?php echo e(request('search')); ?>">
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-bold py-3 border-bottom">
                    <i class="bi bi-grid-fill me-2 text-primary"></i>Catégories
                </div>
                <div class="list-group list-group-flush">
                    
                    <a href="<?php echo e(route('client.products.index')); ?>" 
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?php echo e(!request('category_id') ? 'active fw-bold' : ''); ?>">
                        <span>Toutes les catégories</span>
                        <span class="badge <?php echo e(!request('category_id') ? 'bg-white text-primary' : 'bg-secondary'); ?> rounded-pill">
                            <?php echo e($totalProductsCount ?? 0); ?>

                        </span>
                    </a>

                    
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('client.products.index', array_merge(request()->except('page'), ['category_id' => $category->id]))); ?>" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?php echo e(request('category_id') == $category->id ? 'active fw-bold' : ''); ?>">
                            <span><?php echo e($category->name); ?></span>
                            <span class="badge <?php echo e(request('category_id') == $category->id ? 'bg-white text-primary' : 'bg-light text-dark border'); ?> rounded-pill">
                                <?php echo e($category->products_count); ?>

                            </span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold py-3 border-bottom">
                    <i class="bi bi-sliders me-2 text-primary"></i>Filtrer par Prix
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('client.products.index')); ?>" method="GET">
                        <?php if(request('category_id')): ?>
                            <input type="hidden" name="category_id" value="<?php echo e(request('category_id')); ?>">
                        <?php endif; ?>
                        <?php if(request('search')): ?>
                            <input type="hidden" name="search" value="<?php echo e(request('search')); ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label class="form-label small text-muted">Prix Max (FCFA)</label>
                            <input type="number" name="max_price" class="form-control" placeholder="ex: 20000" value="<?php echo e(request('max_price')); ?>">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-outline-primary btn-sm fw-bold">Appliquer le filtre</button>
                            <?php if(request()->hasAny(['category_id', 'search', 'max_price'])): ?>
                                <a href="<?php echo e(route('client.products.index')); ?>" class="btn btn-link btn-sm text-decoration-none text-center text-muted">Réinitialiser</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        
        <div class="col-lg-9">

            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="text-muted mb-0">Affichage de <strong><?php echo e($products->count()); ?></strong> produit(s)</p>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm position-relative">
                            
                             
                            <div class="bg-light text-center p-3 rounded-top" style="height: 200px;">
                                <img src="<?php echo e($product->image && file_exists(public_path('images/products/' . $product->image)) ? asset('images/products/' . $product->image) : asset('images/default-product.png')); ?>" 
                                     alt="<?php echo e($product->name); ?>" 
                                     class="img-fluid h-100" 
                                     style="object-fit: contain;">
                            </div>

                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <span class="badge bg-light text-secondary border mb-2">
                                        <?php echo e($product->category->name ?? 'Général'); ?>

                                    </span>
                                    <h5 class="card-title fw-bold h6 text-truncate mb-2" title="<?php echo e($product->name); ?>">
                                        <?php echo e($product->name); ?>

                                    </h5>
                                    <p class="text-primary fw-bold fs-5 mb-2">
                                        <?php echo e(number_format($product->price, 0, ',', ' ')); ?> FCFA
                                    </p>
                                </div>

                                <div>
                                    <div class="mb-3">
                                        <?php if($product->stock > 0): ?>
                                            <span class="badge bg-success bg-opacity-10 text-success">
                                                <i class="bi bi-check-circle me-1"></i>En stock (<?php echo e($product->stock); ?>)
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                                <i class="bi bi-x-circle me-1"></i>Rupture de stock
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <a href="<?php echo e(route('client.products.show', $product->id)); ?>" class="btn btn-outline-secondary btn-sm">
                                            Voir détail
                                        </a>
                                        <form action="<?php echo e(route('client.cart.add', $product->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-success btn-sm w-100 fw-bold" <?php if($product->stock <= 0): ?> disabled <?php endif; ?>>
                                                <i class="bi bi-cart-plus me-1"></i>Ajouter au panier
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12 text-center py-5">
                        <div class="p-5 bg-light rounded shadow-sm">
                            <i class="bi bi-box-seam display-1 text-muted mb-3 d-block"></i>
                            <h4 class="fw-bold">Aucun produit trouvé</h4>
                            <p class="text-muted">Essayez de modifier vos critères de recherche ou de sélection de catégorie.</p>
                            <a href="<?php echo e(route('client.products.index')); ?>" class="btn btn-primary fw-bold mt-2">
                                Voir tous les produits
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            
            <?php if(method_exists($products, 'links')): ?>
                <div class="d-flex justify-content-center mt-4">
                    <?php echo e($products->withQueryString()->links()); ?>

                </div>
            <?php endif; ?>

        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/client/products/index.blade.php ENDPATH**/ ?>