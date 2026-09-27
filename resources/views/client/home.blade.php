@extends('client.layouts.app')
@section('title', 'SEN DISTRIBUTION - Votre Boutique en Ligne')

@section('content')

<style>
    body {
        background-color: #f4f6f9;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        color: #212529;
    }

    /* BANNIÈRE AVEC IMAGES HAUTE DÉFINITION ET OVERLAY SOMBRE */
    .hero-slider .carousel-item {
        height: 380px;
        border-radius: 20px;
        overflow: hidden;
        position: relative;
    }
    .hero-slider .carousel-item::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.7) 100%);
    }
    .hero-slider img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 5s ease;
    }
    .hero-slider .carousel-item.active img {
        transform: scale(1.05);
    }
    .carousel-caption-custom {
        position: absolute;
        z-index: 2;
        bottom: 30px;
        left: 30px;
        max-width: 600px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }

    /* STYLE DES BOUTONS CLIQUABLES DANS LA BANNIÈRE */
    .btn-hero-action {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 22px;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .btn-hero-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.3);
    }

    /* BOUTONS NAVIGATION DU CARROUSEL */
    .carousel-control-prev, .carousel-control-next {
        z-index: 3;
        width: 5%;
    }

    /* SECTION 2 COLONNES (CATÉGORIES & PRODUITS) */
    .section-box {
        background: #ffffff;
        border-radius: 20px;
        padding: 24px;
        border: 1px solid #e9ecef;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.03);
        height: 100%;
    }

    /* CATÉGORIES (COLONNE GAUCHE) */
    .cat-card-item {
        background: #f8f9fa;
        border-radius: 14px;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: #212529;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }
    .cat-card-item:hover {
        background: #0d6efd;
        color: #ffffff;
        border-color: #0d6efd;
        transform: translateX(6px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
    }
    .cat-icon-circle {
        width: 42px;
        height: 42px;
        background: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0d6efd;
        font-size: 18px;
        transition: all 0.3s ease;
    }
    .cat-card-item:hover .cat-icon-circle {
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
    }

    /* PRODUITS (COLONNE DROITE) */
    .product-mini-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e9ecef;
        padding: 14px;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .product-mini-card:hover {
        box-shadow: 0 12px 24px rgba(0,0,0,0.08);
        transform: translateY(-5px);
        border-color: #dbe2ef;
    }
    .product-thumb {
        height: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 12px;
        padding: 10px;
        margin-bottom: 12px;
    }
    .product-thumb img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
    }
    .price-tag {
        font-size: 1.15rem;
        font-weight: 800;
        color: #0d6efd;
    }
    .btn-buy {
        background: #ff6b00;
        color: white;
        font-weight: 700;
        border: none;
        border-radius: 10px;
        padding: 10px;
        width: 100%;
        transition: background 0.2s ease, transform 0.1s ease;
    }
    .btn-buy:hover {
        background: #e05d00;
        color: white;
        transform: scale(1.02);
    }

    /* BARRE DE CONFIANCE */
    .trust-bar {
        background: #ffffff;
        border-radius: 18px;
        padding: 20px;
        border: 1px solid #e9ecef;
    }
</style>

<div class="container my-4">

    {{-- 1. CARROUSEL BANNIÈRE AVEC BOUTONS CLIQUABLES SUR L'IMAGE --}}
    <div class="mb-5">
        <div id="bannerCarousel" class="carousel slide hero-slider shadow" data-bs-ride="carousel">
            <div class="carousel-indicators" style="z-index: 4;">
                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner">
                {{-- Slide 1 --}}
                <div class="carousel-item active" data-bs-interval="4000">
                    <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=1600&auto=format&fit=crop" alt="Boutique en ligne SEN DISTRIBUTION">
                    <div class="carousel-caption-custom text-start">
                        <span class="badge bg-warning text-dark mb-2 px-3 py-2 fs-6 rounded-pill fw-bold">
                            <i class="bi bi-fire me-1"></i> Offre Spéciale
                        </span>
                        <h2 class="fw-bold text-white display-6">Des offres imbattables tous les jours</h2>
                        <p class="fs-6 text-white-50 mb-3">Profitez des meilleurs prix sur une large gamme de produits.</p>
                        
                        {{-- Bouton cliquable --}}
                        <a href="{{ route('client.products.index') }}" class="btn-hero-action bg-warning text-dark">
                            <i class="bi bi-bag-fill"></i> Découvrir les offres
                        </a>
                    </div>
                </div>

                {{-- Slide 2 --}}
                <div class="carousel-item" data-bs-interval="4000">
                    <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=1600&auto=format&fit=crop" alt="Nouveautés">
                    <div class="carousel-caption-custom text-start">
                        <span class="badge bg-primary mb-2 px-3 py-2 fs-6 rounded-pill fw-bold">
                            <i class="bi bi-star-fill me-1"></i> Arrivage Récent
                        </span>
                        <h2 class="fw-bold text-white display-6">Qualité Garantie & Certifiée</h2>
                        <p class="fs-6 text-white-50 mb-3">Commandez en toute sécurité auprès de vendeurs de confiance.</p>
                        
                        {{-- Bouton cliquable --}}
                        <a href="{{ route('client.products.index') }}" class="btn-hero-action bg-primary text-white">
                            <i class="bi bi-grid-3x3-gap-fill"></i> Voir le catalogue
                        </a>
                    </div>
                </div>

                {{-- Slide 3 --}}
                <div class="carousel-item" data-bs-interval="4000">
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=1600&auto=format&fit=crop" alt="Livraison à domicile">
                    <div class="carousel-caption-custom text-start">
                        <span class="badge bg-success mb-2 px-3 py-2 fs-6 rounded-pill fw-bold">
                            <i class="bi bi-truck me-1"></i> Service Rapide
                        </span>
                        <h2 class="fw-bold text-white display-6">Livraison Express à Domicile</h2>
                        <p class="fs-6 text-white-50 mb-3">Recevez vos colis rapidement avec paiement à la réception.</p>
                        
                        {{-- Bouton cliquable (WhatsApp) --}}
                        <a href="https://wa.me/221770000000" target="_blank" class="btn-hero-action bg-success text-white">
                            <i class="bi bi-whatsapp"></i> Commander sur WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>

    {{-- 2. SUR LA MÊME LIGNE : DEUX COLONNES (CATÉGORIES À GAUCHE & PRODUITS À DROITE) --}}
    <div class="row g-4 mb-5 align-items-stretch">
        
        {{-- COLONNE GAUCHE : CATÉGORIES --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 p-3 position-relative">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0 text-dark">
            <i class="bi bi-grid-fill text-primary me-2"></i>Catégories
        </h5>
        <a href="{{ route('client.categories.index') }}" class="text-decoration-none small text-muted">Tout voir</a>
    </div>

    @php
        $parentCategories = \App\Models\Category::whereNull('parent_id')->with('children')->get();
    @endphp

    <div class="list-group list-group-flush position-static">
        @forelse($parentCategories as $parent)
            <div class="category-menu-item">
                <a href="{{ route('client.products.index', ['category' => $parent->slug]) }}" 
                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 rounded-2 py-2 mb-1">
                    <span class="fw-semibold">
                        <i class="bi bi-folder2-open text-primary me-2"></i>{{ $parent->name }}
                    </span>
                    @if($parent->children->isNotEmpty())
                        <i class="bi bi-chevron-right text-muted small"></i>
                    @endif
                </a>

                {{-- Volet qui déborde proprement sur la droite --}}
                @if($parent->children->isNotEmpty())
                    <div class="category-dropdown-panel bg-white shadow-lg border rounded-3 p-3">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <h6 class="fw-bold text-uppercase text-primary mb-0">{{ $parent->name }}</h6>
                            <a href="{{ route('client.products.index', ['category' => $parent->slug]) }}" class="small text-decoration-none fw-bold">
                                Voir tout <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>

                        <div class="row g-2">
                            @foreach($parent->children as $child)
                                <div class="col-6">
                                    <a href="{{ route('client.home', ['category' => $parent->id]) }}"
                                       class="subcat-link d-flex align-items-center p-2 rounded text-decoration-none text-dark bg-light">
                                        <i class="bi bi-tag-fill text-primary me-2 fs-6"></i>
                                        <span class="small fw-semibold text-truncate">{{ $child->name }}</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <p class="text-muted small">Aucune catégorie disponible</p>
        @endforelse
    </div>
</div>
        </div>

        {{-- COLONNE DROITE : PRODUITS --}}
        <div class="col-lg-8">
            <div class="section-box">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="fw-bold text-dark m-0">
                        <i class="bi bi-bag-check-fill text-danger me-2"></i> Nos Produits
                    </h5>
                    <a href="{{ route('client.products.index') }}" class="text-decoration-none small fw-bold text-primary">Voir le catalogue</a>
                </div>

                <div class="row g-3">
                    @foreach($products as $product)
                        <div class="col-6 col-sm-6 col-md-4">
                            <div class="product-mini-card">
                                <div class="product-thumb">
                                    <a href="{{ route('client.products.show', $product->id) }}" class="w-100 h-100 d-flex align-items-center justify-content-center">
                                        <img src="{{ $product->image && file_exists(public_path('images/products/' . $product->image)) ? asset('images/products/' . $product->image) : 'https://via.placeholder.com/150' }}" 
                                             alt="{{ $product->name }}">
                                    </a>
                                </div>

                                <div>
                                    <h6 class="fw-bold text-dark mb-1 text-truncate" title="{{ $product->name }}">
                                        {{ $product->name }}
                                    </h6>
                                    <div class="price-tag mb-2">
                                        {{ number_format($product->price, 0, ',', ' ') }} <small class="fs-6 text-muted">FCFA</small>
                                    </div>
                                    
                                    <form action="{{ route('client.cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-buy d-flex align-items-center justify-content-center gap-1">
                                            <i class="bi bi-cart-plus-fill"></i>
                                            <span>Acheter</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    {{-- BARRE DE CONFIANCE --}}
    <div class="trust-bar mb-4">
        <div class="row text-center g-3">
            <div class="col-6 col-md-3">
                <i class="bi bi-truck text-primary fs-2 d-block mb-1"></i>
                <strong class="d-block text-dark">Livraison Express</strong>
                <span class="text-muted small">Directement chez vous</span>
            </div>
            <div class="col-6 col-md-3">
                <i class="bi bi-cash-coin text-success fs-2 d-block mb-1"></i>
                <strong class="d-block text-dark">Paiement à la Livraison</strong>
                <span class="text-muted small">Payez après réception</span>
            </div>
            <div class="col-6 col-md-3">
                <i class="bi bi-shield-check text-warning fs-2 d-block mb-1"></i>
                <strong class="d-block text-dark">Qualité Garantie</strong>
                <span class="text-muted small">Articles authentiques</span>
            </div>
            <div class="col-6 col-md-3">
                <i class="bi bi-whatsapp text-success fs-2 d-block mb-1"></i>
                <strong class="d-block text-dark">Assistance WhatsApp</strong>
                <span class="text-muted small">Support réactif 7j/7</span>
            </div>
        </div>
    </div>

</div>

@endsection