

<?php $__env->startSection('content'); ?>
<style>
    :root {
        --primary-orange: #f68b1e;
        --primary-orange-hover: #e07b12;
        --bg-gray: #f1f1f2;
    }

    body {
        background-color: var(--bg-gray);
    }

    /* Cartes principales */
    .product-detail-box, .delivery-box, .categories-box {
        background: #fff;
        border-radius: 4px;
        border: 1px solid #e0e0e0;
    }

    /* Image du produit */
    .product-main-img-wrapper {
        background: #fff;
        border: 1px solid #f0f0f0;
        border-radius: 4px;
        height: 380px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px;
        position: relative;
    }
    .product-main-img-wrapper img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
    }

    /* Typography & Prix */
    .product-title-detail {
        font-size: 1.3rem;
        font-weight: 600;
        color: #282828;
        line-height: 1.3;
    }
    .price-main {
        font-size: 1.8rem;
        font-weight: 800;
        color: #282828;
    }
    .price-old-detail {
        font-size: 1rem;
        color: #75757a;
        text-decoration: line-through;
    }
    .badge-discount-detail {
        background-color: #fef3e6;
        color: var(--primary-orange);
        font-weight: 700;
        font-size: 0.85rem;
        padding: 4px 8px;
        border-radius: 2px;
    }

    /* Boutons */
    .btn-add-cart-jumia {
        background-color: var(--primary-orange);
        color: #fff;
        font-weight: 700;
        font-size: 0.95rem;
        border: none;
        border-radius: 4px;
        padding: 12px;
        text-transform: uppercase;
        transition: background 0.2s ease;
    }
    .btn-add-cart-jumia:hover {
        background-color: var(--primary-orange-hover);
        color: #fff;
    }

    /* Sidebar Livraison & Service */
    .delivery-item {
        display: flex;
        align-items: flex-start;
        padding-bottom: 12px;
        margin-bottom: 12px;
        border-bottom: 1px solid #f0f0f0;
    }
    .delivery-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    /* Style des Catégories en bulles */
    .category-item-card {
        transition: transform 0.2s ease;
        border: 1px solid transparent;
    }
    .category-item-card:hover {
        transform: translateY(-3px);
    }
    .category-img-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: #f8f9fa;
        border: 1px solid #eee;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        padding: 6px;
    }
    .category-img-circle img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    /* Cartes Similaires */
    .similar-item-card {
        background: #fff;
        border: 1px solid #f0f0f0;
        border-radius: 4px;
        transition: transform 0.2s ease;
    }
    .similar-item-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
</style>

<div class="container py-3">

    
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?php echo e(route('client.products.index')); ?>" class="text-decoration-none text-dark">Accueil</a></li>
            <?php if(isset($product->category)): ?>
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('client.products.index', ['category_id' => $product->category->id])); ?>" class="text-decoration-none text-dark">
                        <?php echo e($product->category->name); ?>

                    </a>
                </li>
            <?php endif; ?>
            <li class="breadcrumb-item active text-truncate" aria-current="page" style="max-width: 250px;"><?php echo e($product->name); ?></li>
        </ol>
    </nav>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-3" role="alert">
            <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    
    <?php if(isset($categories) && $categories->count() > 0): ?>
        <div class="categories-box p-3 shadow-sm mb-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="fw-bold text-uppercase small mb-0"><i class="bi bi-grid-fill text-warning me-2"></i>Explorer d'autres catégories</h6>
                <a href="<?php echo e(route('client.products.index')); ?>" class="text-warning text-decoration-none extra-small fw-bold" style="font-size: 0.75rem;">Voir tout <i class="bi bi-chevron-right"></i></a>
            </div>
            <div class="row row-cols-3 row-cols-sm-4 row-cols-md-6 g-2 text-center">
                <?php $__currentLoopData = $categories->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col">
                        <a href="<?php echo e(route('client.products.index', ['category_id' => $category->id])); ?>" class="category-item-card text-decoration-none d-block p-1">
                            <div class="category-img-circle mb-1">
                                <?php if(isset($category->image) && file_exists(public_path('images/categories/' . $category->image))): ?>
                                    <img src="<?php echo e(asset('images/categories/' . $category->image)); ?>" alt="<?php echo e($category->name); ?>">
                                <?php else: ?>
                                    <i class="bi bi-box-seam fs-4 text-warning"></i>
                                <?php endif; ?>
                            </div>
                            <span class="d-block text-dark fw-bold extra-small text-truncate" style="font-size: 0.75rem;"><?php echo e($category->name); ?></span>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>

    
    <div class="row g-3">

        
        <div class="col-lg-9">
            <div class="product-detail-box p-3 shadow-sm">
                <div class="row g-4">

                    
                    <div class="col-md-5">
                        <div class="product-main-img-wrapper">
                            <span class="badge bg-dark text-white position-absolute top-0 start-0 m-2 px-2 py-1 extra-small fw-bold">EXPRESS</span>
                            <img src="<?php echo e($product->image && file_exists(public_path('images/products/' . $product->image)) ? asset('images/products/' . $product->image) : asset('images/default-product.png')); ?>" 
                                 alt="<?php echo e($product->name); ?>">
                        </div>
                    </div>

                    
                    <div class="col-md-7">
                        <div class="text-muted small text-uppercase mb-1">
                            Catégorie : <span class="fw-bold text-dark"><?php echo e($product->category->name ?? 'Général'); ?></span>
                        </div>

                        <h1 class="product-title-detail mb-2"><?php echo e($product->name); ?></h1>

                        <div class="d-flex align-items-center mb-3">
                            <div class="text-warning me-2 small">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                            <span class="text-primary small me-2">(4.5 / 5)</span>
                            <span class="text-muted small">| <?php echo e($product->comments ? $product->comments->count() : 12); ?> avis vérifiés</span>
                        </div>

                        <hr class="my-2">

                        <div class="my-3">
                            <div class="d-flex align-items-center gap-2">
                                <span class="price-main"><?php echo e(number_format($product->price, 0, ',', ' ')); ?> FCFA</span>
                                
                                <?php if(isset($product->old_price) && $product->old_price > $product->price): ?>
                                    <?php
                                        $discount = round((($product->old_price - $product->price) / $product->old_price) * 100);
                                    ?>
                                    <span class="price-old-detail"><?php echo e(number_format($product->old_price, 0, ',', ' ')); ?> FCFA</span>
                                    <span class="badge-discount-detail">-<?php echo e($discount); ?>%</span>
                                <?php endif; ?>
                            </div>

                            <div class="mt-1">
                                <?php if($product->stock > 0): ?>
                                    <span class="text-success small fw-bold"><i class="bi bi-check-circle-fill me-1"></i>En stock (<?php echo e($product->stock); ?> unités)</span>
                                <?php else: ?>
                                    <span class="text-danger small fw-bold"><i class="bi bi-x-circle-fill me-1"></i>Rupture de stock</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <hr class="my-2">

                        <form action="<?php echo e(route('client.cart.add', $product->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="row g-2 mb-3">
        <div class="col-4">
            <label class="form-label">Quantité</label>
            <input type="number" name="quantity" value="1" min="1" max="<?php echo e($product->stock); ?>" class="form-control">
        </div>
        <?php if($product->size): ?>
            <div class="col-4">
                <label class="form-label">Taille</label>
                <select name="size" class="form-select">
                    <option value="<?php echo e($product->size); ?>"><?php echo e($product->size); ?></option>
                </select>
            </div>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-success w-100 py-2">
        <i class="fas fa-shopping-bag me-2"></i> Ajouter au panier
    </button>
</form>

                    </div>

                </div>

                
                <div class="mt-4 pt-3 border-top">
                    <h5 class="fw-bold text-dark mb-3 text-uppercase small">Détails et Description du produit</h5>
                    <div class="text-secondary small leading-relaxed">
                        <?php if($product->description): ?>
                            <?php echo nl2br(e($product->description)); ?>

                        <?php else: ?>
                            <p class="text-muted">Aucune description disponible pour cet article.</p>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div class="mt-5 pt-4 border-top">
                    <h5 class="fw-bold text-dark mb-4 text-uppercase small">
                        <i class="bi bi-chat-square-text-fill text-warning me-2"></i>Avis et Commentaires Clients
                    </h5>

                    <div class="row g-4 mb-4">
                        <div class="col-md-4 text-center border-end">
                            <div class="display-5 fw-bold text-dark">4.5</div>
                            <div class="text-warning mb-2">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                            <span class="text-muted small">Basé sur <?php echo e($product->comments ? $product->comments->count() : 12); ?> avis</span>
                        </div>

                        <div class="col-md-8">
                            <h6 class="fw-bold mb-2 small text-uppercase">Laisser un avis sur ce produit</h6>
                            <form action="<?php echo e(route('client.comments.store', $product->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="mb-2">
                                    <label class="form-label small text-muted mb-1">Votre note :</label>
                                    <select name="rating" class="form-select form-select-sm" style="width: 150px;" required>
                                        <option value="5">⭐⭐⭐⭐⭐ (5/5)</option>
                                        <option value="4">⭐⭐⭐⭐ (4/5)</option>
                                        <option value="3">⭐⭐⭐ (3/5)</option>
                                        <option value="2">⭐⭐ (2/5)</option>
                                        <option value="1">⭐ (1/5)</option>
                                    </select>
                                </div>

                                <div class="mb-2">
                                    <textarea name="content" class="form-control form-control-sm" rows="3" placeholder="Donnez votre avis sur la qualité du produit, la livraison, etc." required></textarea>
                                </div>

                                <button type="submit" class="btn btn-warning btn-sm text-white fw-bold">
                                    <i class="bi bi-send me-1"></i> Publier mon avis
                                </button>
                            </form>
                        </div>
                    </div>

                    
                    <div class="comments-list mt-4">
                        <h6 class="fw-bold mb-3 small text-uppercase border-bottom pb-2">Commentaires récents</h6>

                        <?php if(isset($product->comments) && $product->comments->count() > 0): ?>
                            <?php $__currentLoopData = $product->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="comment-item border-bottom pb-3 mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="fw-bold text-dark small">
                                            <i class="bi bi-person-circle text-secondary me-1"></i>
                                            <?php echo e($comment->user->name ?? 'Client SEN'); ?>

                                        </span>
                                        <span class="text-muted extra-small" style="font-size: 0.75rem;">
                                            <?php echo e($comment->created_at ? $comment->created_at->format('d/m/Y') : ''); ?>

                                        </span>
                                    </div>

                                    <div class="text-warning extra-small mb-1" style="font-size: 0.75rem;">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <?php if($i <= ($comment->rating ?? 5)): ?>
                                                <i class="bi bi-star-fill"></i>
                                            <?php else: ?>
                                                <i class="bi bi-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>

                                    <p class="text-secondary small mb-0"><?php echo e($comment->content); ?></p>
                                </div>


                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="comment-item border-bottom pb-3 mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-bold text-dark small"><i class="bi bi-person-circle me-1 text-secondary"></i> Modou D.</span>
                                    <span class="text-muted extra-small" style="font-size: 0.75rem;">Il y a 2 jours</span>
                                </div>
                                <div class="text-warning extra-small mb-1" style="font-size: 0.75rem;">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>
                                <p class="text-secondary small mb-0">Produit très conforme à la description et livraison très rapide à Dakar !</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>

        
        <div class="col-lg-3">
            <div class="delivery-box shadow-sm mb-3 p-3">
                <h6 class="fw-bold text-uppercase small border-bottom pb-2 mb-3">Livraison & Retours</h6>

                <div class="delivery-item">
                    <i class="bi bi-truck display-6 text-warning me-3"></i>
                    <div>
                        <strong class="d-block text-dark small">Livraison Express SEN</strong>
                        <span class="text-muted extra-small" style="font-size: 0.75rem;">Livré sous 24h à 48h à Dakar & régions.</span>
                    </div>
                </div>

                <div class="delivery-item">
                    <i class="bi bi-arrow-counterclockwise display-6 text-warning me-3"></i>
                    <div>
                        <strong class="d-block text-dark small">Politique de retour</strong>
                        <span class="text-muted extra-small" style="font-size: 0.75rem;">Retour gratuit sous 7 jours.</span>
                    </div>
                </div>

                <div class="delivery-item">
                    <i class="bi bi-shield-check display-6 text-success me-3"></i>
                    <div>
                        <strong class="d-block text-dark small">Garantie & Sécurité</strong>
                        <span class="text-muted extra-small" style="font-size: 0.75rem;">Paiement à la livraison, Wave ou OM.</span>
                    </div>
                </div>
            </div>

            <div class="delivery-box shadow-sm p-3">
                <h6 class="fw-bold text-uppercase small border-bottom pb-2 mb-2">Vendeur</h6>
                <p class="fw-bold text-dark mb-1 small">SEN DISTRIBUTION</p>
                <p class="text-muted extra-small mb-2" style="font-size: 0.75rem;">Vendeur Officiel certifié</p>
                <div class="badge bg-success bg-opacity-10 text-success w-100 py-2">
                    <i class="bi bi-star-fill me-1"></i> 98% d'avis positifs
                </div>
            </div>
        </div>

    </div>

    
    <?php if(isset($similarProducts) && $similarProducts->count() > 0): ?>
        <div class="mt-4">
            <div class="bg-white p-3 rounded-2 border shadow-sm mb-3">
                <h5 class="fw-bold text-dark mb-0 text-uppercase small">Produits similaires</h5>
            </div>
            
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-5 g-2">
                <?php $__currentLoopData = $similarProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col">
                        <div class="similar-item-card h-100 p-2 d-flex flex-column justify-content-between">
                            <div>
                                <div class="bg-light rounded text-center p-2 mb-2" style="height: 130px; display: flex; align-items: center; justify-content: center;">
                                    <img src="<?php echo e($similar->image && file_exists(public_path('images/products/' . $similar->image)) ? asset('images/products/' . $similar->image) : asset('images/default-product.png')); ?>" 
                                         alt="<?php echo e($similar->name); ?>" 
                                         style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                </div>
                                <a href="<?php echo e(route('client.products.show', $similar->id)); ?>" class="text-dark text-decoration-none fw-bold small text-truncate d-block" title="<?php echo e($similar->name); ?>">
                                    <?php echo e($similar->name); ?>

                                </a>
                                <div class="text-dark fw-bold small mt-1">
                                    <?php echo e(number_format($similar->price, 0, ',', ' ')); ?> FCFA
                                </div>
                            </div>
                            <a href="<?php echo e(route('client.products.show', $similar->id)); ?>" class="btn btn-outline-warning btn-sm w-100 mt-2 fw-bold text-dark" style="font-size: 0.75rem;">
                                Voir
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>

</div>


<script>
    function incrementQty() {
        const input = document.getElementById('qtyInput');
        const max = parseInt(input.getAttribute('max')) || 99;
        let val = parseInt(input.value) || 1;
        if (val < max) {
            input.value = val + 1;
        }
    }

    function decrementQty() {
        const input = document.getElementById('qtyInput');
        let val = parseInt(input.value) || 1;
        if (val > 1) {
            input.value = val - 1;
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/client/products/show.blade.php ENDPATH**/ ?>