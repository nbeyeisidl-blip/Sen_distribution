

<?php $__env->startSection('content'); ?>
<style>
    :root {
        --primary-jumia: #f68b1e;
        --primary-hover: #e07b12;
        --bg-gray: #f1f1f2;
    }

    body {
        background-color: var(--bg-gray);
    }

    /* Style général des cartes e-commerce */
    .jumia-card {
        background: #fff;
        border-radius: 4px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        position: relative;
        border: 1px solid #f0f0f0;
    }
    .jumia-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12) !important;
        border-color: transparent;
    }

    /* Wrapper de l'image */
    .img-wrapper {
        position: relative;
        height: 190px;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        overflow: hidden;
    }
    .img-wrapper img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
    }

    /* Badges style Jumia */
    .badge-discount {
        position: absolute;
        top: 8px;
        right: 8px;
        background-color: #fef3e6;
        color: var(--primary-jumia);
        font-weight: 700;
        font-size: 0.75rem;
        padding: 4px 6px;
        border-radius: 2px;
    }
    .badge-express {
        position: absolute;
        top: 8px;
        left: 8px;
        background-color: #000;
        color: #fff;
        font-size: 0.65rem;
        font-weight: 800;
        text-transform: uppercase;
        padding: 2px 6px;
        border-radius: 2px;
    }

    /* Typography Produit */
    .product-title {
        font-size: 0.85rem;
        color: #282828;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 2.6em;
        line-height: 1.3;
        margin-bottom: 6px;
        text-decoration: none;
    }
    .product-title:hover {
        color: var(--primary-jumia);
    }

    .price-current {
        font-size: 1.1rem;
        font-weight: 700;
        color: #282828;
    }
    .price-old {
        font-size: 0.8rem;
        color: #75757a;
        text-decoration: line-through;
        margin-left: 6px;
    }

    /* Bouton Ajouter au panier */
    .btn-add-jumia {
        background-color: var(--primary-jumia);
        color: #fff;
        border: none;
        font-weight: 600;
        font-size: 0.85rem;
        border-radius: 4px;
        padding: 8px;
        width: 100%;
        text-transform: uppercase;
        transition: background 0.2s ease;
    }
    .btn-add-jumia:hover {
        background-color: var(--primary-hover);
        color: #fff;
    }
    .btn-add-jumia:disabled {
        background-color: #ccc;
        color: #666;
    }

    /* Filtres Sidebar */
    .sidebar-block {
        background: #fff;
        border-radius: 4px;
        padding: 16px;
        margin-bottom: 16px;
    }
    .sidebar-title {
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        border-bottom: 1px solid #f0f0f0;
        padding-bottom: 10px;
        margin-bottom: 12px;
    }
</style>

<div class="container py-3">

    
    <div class="bg-warning bg-gradient text-dark p-3 rounded-2 mb-4 d-flex justify-content-between align-items-center shadow-sm">
        <div class="d-flex align-items-center">
            <i class="bi bi-lightning-charge-fill display-6 text-danger me-3"></i>
            <div>
                <h5 class="fw-bold mb-0 text-uppercase">Ventes Flash & Meilleurs Prix</h5>
                <small class="text-dark">Profitez des remises exclusives SEN DISTRIBUTION aujourd'hui</small>
            </div>
        </div>
        <a href="<?php echo e(route('client.cart.index')); ?>" class="btn btn-dark btn-sm fw-bold px-3">
            <i class="bi bi-cart3 me-1"></i> Panier (<?php echo e(session('cart') ? count(session('cart')) : 0); ?>)
        </a>
    </div>

    <div class="row g-3">

        
        <div class="col-lg-3">

            
            <div class="sidebar-block shadow-sm">
                <div class="sidebar-title">
                    <i class="bi bi-list me-2 text-warning"></i>Catégories
                </div>
                <div class="nav flex-column nav-pills">
                    <a href="<?php echo e(route('client.products.index')); ?>" 
                       class="nav-link py-1 px-2 text-dark small d-flex justify-content-between align-items-center <?php echo e(!request('category_id') ? 'fw-bold text-warning' : ''); ?>">
                        <span>Toutes les catégories</span>
                        <span class="badge bg-light text-dark border"><?php echo e($totalProductsCount ?? 0); ?></span>
                    </a>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('client.products.index', array_merge(request()->except('page'), ['category_id' => $category->id]))); ?>" 
                           class="nav-link py-1 px-2 text-dark small d-flex justify-content-between align-items-center <?php echo e(request('category_id') == $category->id ? 'fw-bold text-warning' : ''); ?>">
                            <span><?php echo e($category->name); ?></span>
                            <span class="badge bg-light text-dark border"><?php echo e($category->products_count); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            
            <div class="sidebar-block shadow-sm">
                <div class="sidebar-title">
                    <i class="bi bi-search me-2 text-warning"></i>Recherche
                </div>
                <form action="<?php echo e(route('client.products.index')); ?>" method="GET">
                    <?php if(request('category_id')): ?>
                        <input type="hidden" name="category_id" value="<?php echo e(request('category_id')); ?>">
                    <?php endif; ?>
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Ex: TV, Téléphone..." value="<?php echo e(request('search')); ?>">
                        <button class="btn btn-warning btn-sm text-white" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            
            <div class="sidebar-block shadow-sm">
                <div class="sidebar-title">
                    <i class="bi bi-cash-stack me-2 text-warning"></i>Prix (FCFA)
                </div>
                <form action="<?php echo e(route('client.products.index')); ?>" method="GET">
                    <?php if(request('category_id')): ?>
                        <input type="hidden" name="category_id" value="<?php echo e(request('category_id')); ?>">
                    <?php endif; ?>
                    <?php if(request('search')): ?>
                        <input type="hidden" name="search" value="<?php echo e(request('search')); ?>">
                    <?php endif; ?>
                    <div class="mb-2">
                        <input type="number" name="max_price" class="form-control form-control-sm" placeholder="Prix maximum FCFA" value="<?php echo e(request('max_price')); ?>">
                    </div>
                    <button type="submit" class="btn btn-outline-dark btn-sm w-100 fw-bold">Appliquer</button>
                </form>
            </div>

        </div>

        
        <div class="col-lg-9">

            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="bg-white p-3 rounded-2 shadow-sm mb-3 d-flex justify-content-between align-items-center">
                <span class="text-dark fw-bold small"><?php echo e($products->count()); ?> produit(s) trouvé(s)</span>
                <span class="badge bg-warning text-dark"><i class="bi bi-truck me-1"></i>Livraison rapide partout au Sénégal</span>
            </div>

            
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-2">
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col">
                        <div class="jumia-card h-100 p-2 d-flex flex-column justify-content-between">
                            
                            <div>
                                
                                <div class="img-wrapper mb-2">
                                    <span class="badge-express">EXPRESS</span>
                                    
                                    <?php if(isset($product->old_price) && $product->old_price > $product->price): ?>
                                        <?php
                                            $discount = round((($product->old_price - $product->price) / $product->old_price) * 100);
                                        ?>
                                        <span class="badge-discount">-<?php echo e($discount); ?>%</span>
                                    <?php endif; ?>

                                    <a href="<?php echo e(route('client.products.show', $product->id)); ?>">
                                        <img src="<?php echo e($product->image && file_exists(public_path('images/products/' . $product->image)) ? asset('images/products/' . $product->image) : asset('images/default-product.png')); ?>" 
                                             alt="<?php echo e($product->name); ?>">
                                    </a>
                                </div>

                                
                                <a href="<?php echo e(route('client.products.show', $product->id)); ?>" class="product-title" title="<?php echo e($product->name); ?>">
                                    <?php echo e($product->name); ?>

                                </a>

                                
                                <div class="mb-1">
                                    <span class="price-current"><?php echo e(number_format($product->price, 0, ',', ' ')); ?> FCFA</span>
                                    <?php if(isset($product->old_price) && $product->old_price > $product->price): ?>
                                        <span class="price-old"><?php echo e(number_format($product->old_price, 0, ',', ' ')); ?></span>
                                    <?php endif; ?>
                                </div>

                                
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="text-warning extra-small" style="font-size: 0.7rem;">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </div>
                                    <?php if($product->stock > 0): ?>
                                        <small class="text-success extra-small" style="font-size: 0.7rem;">En stock</small>
                                    <?php else: ?>
                                        <small class="text-danger extra-small" style="font-size: 0.7rem;">Épuisé</small>
                                    <?php endif; ?>
                                </div>
                            </div>

                            
                            <div>
                                <form action="<?php echo e(route('client.cart.add', $product->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn-add-jumia shadow-sm" <?php if($product->stock <= 0): ?> disabled <?php endif; ?>>
                                        <i class="bi bi-cart-plus me-1"></i> J'achète
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12 text-center py-5 bg-white rounded-2 shadow-sm">
                        <i class="bi bi-shop display-1 text-muted mb-3 d-block"></i>
                        <h5 class="fw-bold">Aucun produit disponible</h5>
                        <p class="text-muted small">Modifiez votre recherche ou vos filtres pour voir plus d'articles.</p>
                        <a href="<?php echo e(route('client.products.index')); ?>" class="btn btn-warning text-white btn-sm fw-bold">
                            Réinitialiser la recherche
                        </a>
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