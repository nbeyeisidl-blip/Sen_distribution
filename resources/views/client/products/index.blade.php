@extends('client.layouts.app')

@section('content')
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

    {{-- Bandeau Promo Super Affaires --}}
    <div class="bg-warning bg-gradient text-dark p-3 rounded-2 mb-4 d-flex justify-content-between align-items-center shadow-sm">
        <div class="d-flex align-items-center">
            <i class="bi bi-lightning-charge-fill display-6 text-danger me-3"></i>
            <div>
                <h5 class="fw-bold mb-0 text-uppercase">Ventes Flash & Meilleurs Prix</h5>
                <small class="text-dark">Profitez des remises exclusives SEN DISTRIBUTION aujourd'hui</small>
            </div>
        </div>
        <a href="{{ route('client.cart.index') }}" class="btn btn-dark btn-sm fw-bold px-3">
            <i class="bi bi-cart3 me-1"></i> Panier ({{ session('cart') ? count(session('cart')) : 0 }})
        </a>
    </div>

    <div class="row g-3">

        {{-- SIDEBAR : FILTRES STYLE JUMIA --}}
        <div class="col-lg-3">

            {{-- 1. Catégories --}}
            <div class="sidebar-block shadow-sm">
                <div class="sidebar-title">
                    <i class="bi bi-list me-2 text-warning"></i>Catégories
                </div>
                <div class="nav flex-column nav-pills">
                    <a href="{{ route('client.products.index') }}" 
                       class="nav-link py-1 px-2 text-dark small d-flex justify-content-between align-items-center {{ !request('category_id') ? 'fw-bold text-warning' : '' }}">
                        <span>Toutes les catégories</span>
                        <span class="badge bg-light text-dark border">{{ $totalProductsCount ?? 0 }}</span>
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('client.products.index', array_merge(request()->except('page'), ['category_id' => $category->id])) }}" 
                           class="nav-link py-1 px-2 text-dark small d-flex justify-content-between align-items-center {{ request('category_id') == $category->id ? 'fw-bold text-warning' : '' }}">
                            <span>{{ $category->name }}</span>
                            <span class="badge bg-light text-dark border">{{ $category->products_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- 2. Recherche --}}
            <div class="sidebar-block shadow-sm">
                <div class="sidebar-title">
                    <i class="bi bi-search me-2 text-warning"></i>Recherche
                </div>
                <form action="{{ route('client.products.index') }}" method="GET">
                    @if(request('category_id'))
                        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                    @endif
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Ex: TV, Téléphone..." value="{{ request('search') }}">
                        <button class="btn btn-warning btn-sm text-white" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            {{-- 3. Filtre par Prix --}}
            <div class="sidebar-block shadow-sm">
                <div class="sidebar-title">
                    <i class="bi bi-cash-stack me-2 text-warning"></i>Prix (FCFA)
                </div>
                <form action="{{ route('client.products.index') }}" method="GET">
                    @if(request('category_id'))
                        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                    @endif
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <div class="mb-2">
                        <input type="number" name="max_price" class="form-control form-control-sm" placeholder="Prix maximum FCFA" value="{{ request('max_price') }}">
                    </div>
                    <button type="submit" class="btn btn-outline-dark btn-sm w-100 fw-bold">Appliquer</button>
                </form>
            </div>

        </div>

        {{-- GRILLE DES PRODUITS JUMIA / ALIBABA --}}
        <div class="col-lg-9">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="bg-white p-3 rounded-2 shadow-sm mb-3 d-flex justify-content-between align-items-center">
                <span class="text-dark fw-bold small">{{ $products->count() }} produit(s) trouvé(s)</span>
                <span class="badge bg-warning text-dark"><i class="bi bi-truck me-1"></i>Livraison rapide partout au Sénégal</span>
            </div>

            {{-- Grille 4 colonnes compacte --}}
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-2">
                @forelse($products as $product)
                    <div class="col">
                        <div class="jumia-card h-100 p-2 d-flex flex-column justify-content-between">
                            
                            <div>
                                {{-- Conteneur Image --}}
                                <div class="img-wrapper mb-2">
                                    <span class="badge-express">EXPRESS</span>
                                    
                                    @if(isset($product->old_price) && $product->old_price > $product->price)
                                        @php
                                            $discount = round((($product->old_price - $product->price) / $product->old_price) * 100);
                                        @endphp
                                        <span class="badge-discount">-{{ $discount }}%</span>
                                    @endif

                                    <a href="{{ route('client.products.show', $product->id) }}">
                                        <img src="{{ $product->image && file_exists(public_path('images/products/' . $product->image)) ? asset('images/products/' . $product->image) : asset('images/default-product.png') }}" 
                                             alt="{{ $product->name }}">
                                    </a>
                                </div>

                                {{-- Titre du produit --}}
                                <a href="{{ route('client.products.show', $product->id) }}" class="product-title" title="{{ $product->name }}">
                                    {{ $product->name }}
                                </a>

                                {{-- Prix --}}
                                <div class="mb-1">
                                    <span class="price-current">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                                    @if(isset($product->old_price) && $product->old_price > $product->price)
                                        <span class="price-old">{{ number_format($product->old_price, 0, ',', ' ') }}</span>
                                    @endif
                                </div>

                                {{-- Étoiles d'évaluation & Stock --}}
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="text-warning extra-small" style="font-size: 0.7rem;">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </div>
                                    @if($product->stock > 0)
                                        <small class="text-success extra-small" style="font-size: 0.7rem;">En stock</small>
                                    @else
                                        <small class="text-danger extra-small" style="font-size: 0.7rem;">Épuisé</small>
                                    @endif
                                </div>
                            </div>

                            {{-- Bouton Ajouter au Panier --}}
                            <div>
                                <form action="{{ route('client.cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-add-jumia shadow-sm" @if($product->stock <= 0) disabled @endif>
                                        <i class="bi bi-cart-plus me-1"></i> J'achète
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 bg-white rounded-2 shadow-sm">
                        <i class="bi bi-shop display-1 text-muted mb-3 d-block"></i>
                        <h5 class="fw-bold">Aucun produit disponible</h5>
                        <p class="text-muted small">Modifiez votre recherche ou vos filtres pour voir plus d'articles.</p>
                        <a href="{{ route('client.products.index') }}" class="btn btn-warning text-white btn-sm fw-bold">
                            Réinitialiser la recherche
                        </a>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if(method_exists($products, 'links'))
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->withQueryString()->links() }}
                </div>
            @endif

        </div>

    </div>
</div>
@endsection