


<?php $__env->startSection('content'); ?>
<div class="container py-4">

    
    <div class="p-5 mb-4 bg-primary text-white rounded-3 shadow-sm position-relative overflow-hidden" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
        <div class="row align-items-center py-3">
            <div class="col-md-7">
                <h1 class="display-5 fw-bold mb-3">Vos produits, notre priorité</h1>
                <p class="fs-5 mb-4">Découvrez nos meilleurs produits au meilleur prix et faites-vous livrer en toute sécurité partout au Sénégal.</p>
                <a href="#catalogue" class="btn btn-warning btn-lg fw-bold text-dark px-4 shadow-sm">
                    Découvrir nos produits <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
            <div class="col-md-5 text-center d-none d-md-block">
                <i class="bi bi-basket3-fill display-1 text-white opacity-25"></i>
            </div>
        </div>
    </div>

    
    <div class="row text-center my-4 g-3">
        <div class="col-6 col-md-3">
            <div class="p-3 border rounded bg-light h-100 shadow-sm">
                <i class="bi bi-truck fs-2 text-primary mb-2"></i>
                <h6 class="fw-bold mb-1">Livraison rapide</h6>
                <small class="text-muted">100% sécurisée</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="p-3 border rounded bg-light h-100 shadow-sm">
                <i class="bi bi-shield-check fs-2 text-primary mb-2"></i>
                <h6 class="fw-bold mb-1">Paiement sécurisé</h6>
                <small class="text-muted">Mobile & Espèces</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="p-3 border rounded bg-light h-100 shadow-sm">
                <i class="bi bi-tags fs-2 text-primary mb-2"></i>
                <h6 class="fw-bold mb-1">Meilleurs prix</h6>
                <small class="text-muted">Prix très avantageux</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="p-3 border rounded bg-light h-100 shadow-sm">
                <i class="bi bi-headset fs-2 text-primary mb-2"></i>
                <h6 class="fw-bold mb-1">Service client</h6>
                <small class="text-muted">Support 24/7</small>
            </div>
        </div>
    </div>

    
    <div class="row pt-3" id="catalogue">
        
        
        <div class="col-lg-3 mb-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-bold py-3">
                    <i class="bi bi-funnel me-2"></i>Catégories
                </div>
                <div class="list-group list-group-flush">
                    <a href="<?php echo e(route('client.home')); ?>" class="list-group-item list-group-item-action <?php echo e(!request('category_id') ? 'active fw-bold' : ''); ?>">
                        Tous nos produits
                    </a>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('client.home', ['category_id' => $category->id])); ?>" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?php echo e(request('category_id') == $category->id ? 'active fw-bold' : ''); ?>">
                            <?php echo e($category->name); ?>

                            <span class="badge bg-secondary rounded-pill"><?php echo e($category->products_count ?? $category->products->count()); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold py-3">
                    <i class="bi bi-currency-dollar me-2"></i>Filtrer par prix
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('client.home')); ?>" method="GET">
                        <?php if(request('category_id')): ?>
                            <input type="hidden" name="category_id" value="<?php echo e(request('category_id')); ?>">
                        <?php endif; ?>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Prix Maximum (FCFA)</label>
                            <input type="number" name="max_price" class="form-control" placeholder="ex: 20000" value="<?php echo e(request('max_price')); ?>">
                        </div>
                        <button type="submit" class="btn btn-outline-primary btn-sm w-100 fw-bold">Filtrer</button>
                    </form>
                </div>
            </div>
        </div>

        
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold m-0">Nos Produits</h4>
                <span class="text-muted small"><?php echo e($products->count()); ?> produit(s) disponible(s)</span>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm position-relative product-card">
                            
                            <div class="bg-light text-center p-3 rounded-top" style="height: 200px;">
                                <img src="<?php echo e($product->image && file_exists(public_path('images/products/' . $product->image)) ? asset('images/products/' . $product->image) : asset('images/default-product.png')); ?>" 
                                     alt="<?php echo e($product->name); ?>" 
                                     class="img-fluid h-100" 
                                     style="object-fit: contain;">
                            </div>

                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <span class="badge bg-light text-dark border mb-2"><?php echo e($product->category->name ?? 'Général'); ?></span>
                                    <h5 class="card-title fw-bold h6 text-truncate mb-2"><?php echo e($product->name); ?></h5>
                                    <p class="text-primary fw-bold fs-5 mb-2">
                                        <?php echo e(number_format($product->price, 0, ',', ' ')); ?> FCFA
                                    </p>
                                </div>

                                <div>
                                    <div class="mb-2">
                                        <?php if($product->stock > 0): ?>
                                            <span class="badge bg-success bg-opacity-10 text-success">En stock</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger bg-opacity-10 text-danger">Rupture</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <a href="<?php echo e(route('client.products.show', $product->id)); ?>" class="btn btn-outline-secondary btn-sm">
                                            Détails
                                        </a>
                                        <form action="<?php echo e(route('client.cart.add', $product->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-success btn-sm w-100 fw-bold" <?php if($product->stock <= 0): ?> disabled <?php endif; ?>>
                                                <i class="bi bi-cart-plus me-1"></i> Ajouter au panier
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-box-seam display-1 text-muted"></i>
                        <p class="mt-3 text-muted fs-5">Aucun produit disponible pour le moment.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/client/home.blade.php ENDPATH**/ ?>