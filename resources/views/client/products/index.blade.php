@extends('client.layouts.app')

@section('content')
<div class="container py-4">

    {{-- En-tête de la page --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Catalogue des Produits</h1>
            <p class="text-muted small mb-0">Découvrez l'ensemble de nos articles disponibles chez SEN DISTRIBUTION</p>
        </div>
        <a href="{{ route('client.cart.index') }}" class="btn btn-outline-primary position-relative">
            <i class="bi bi-cart3 me-1"></i> Mon Panier
            @if(session('cart') && count(session('cart')) > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ count(session('cart')) }}
                </span>
            @endif
        </a>
    </div>

    <div class="row">

        {{-- BARRE LATÉRALE : FILTRES & CATÉGORIES --}}
        <div class="col-lg-3 mb-4">

            {{-- 1. Recherche par mot-clé --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-bold py-3 border-bottom">
                    <i class="bi bi-search me-2 text-primary"></i>Rechercher
                </div>
                <div class="card-body">
                    <form action="{{ route('client.products.index') }}" method="GET">
                        @if(request('category_id'))
                            <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                        @endif
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Nom du produit..." value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- 2. Bloc des Catégories --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-bold py-3 border-bottom">
                    <i class="bi bi-grid-fill me-2 text-primary"></i>Catégories
                </div>
                <div class="list-group list-group-flush">
                    {{-- Toutes les catégories --}}
                    <a href="{{ route('client.products.index') }}" 
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ !request('category_id') ? 'active fw-bold' : '' }}">
                        <span>Toutes les catégories</span>
                        <span class="badge {{ !request('category_id') ? 'bg-white text-primary' : 'bg-secondary' }} rounded-pill">
                            {{ $totalProductsCount ?? 0 }}
                        </span>
                    </a>

                    {{-- Liste dynamique des catégories --}}
                    @foreach($categories as $category)
                        <a href="{{ route('client.products.index', array_merge(request()->except('page'), ['category_id' => $category->id])) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ request('category_id') == $category->id ? 'active fw-bold' : '' }}">
                            <span>{{ $category->name }}</span>
                            <span class="badge {{ request('category_id') == $category->id ? 'bg-white text-primary' : 'bg-light text-dark border' }} rounded-pill">
                                {{ $category->products_count }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- 3. Filtre par prix --}}
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold py-3 border-bottom">
                    <i class="bi bi-sliders me-2 text-primary"></i>Filtrer par Prix
                </div>
                <div class="card-body">
                    <form action="{{ route('client.products.index') }}" method="GET">
                        @if(request('category_id'))
                            <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                        @endif
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <div class="mb-3">
                            <label class="form-label small text-muted">Prix Max (FCFA)</label>
                            <input type="number" name="max_price" class="form-control" placeholder="ex: 20000" value="{{ request('max_price') }}">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-outline-primary btn-sm fw-bold">Appliquer le filtre</button>
                            @if(request()->hasAny(['category_id', 'search', 'max_price']))
                                <a href="{{ route('client.products.index') }}" class="btn btn-link btn-sm text-decoration-none text-center text-muted">Réinitialiser</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

        </div>

        {{-- GRILLE DES PRODUITS --}}
        <div class="col-lg-9">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="text-muted mb-0">Affichage de <strong>{{ $products->count() }}</strong> produit(s)</p>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                @forelse($products as $product)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm position-relative">
                            
                            {{-- Image Produit --}}
                            <div class="bg-light text-center p-3 rounded-top d-flex align-items-center justify-content-center" style="height: 180px;">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-product.png') }}" 
                                     alt="{{ $product->name }}" 
                                     class="img-fluid" 
                                     style="max-height: 150px; object-fit: contain;">
                            </div>

                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <span class="badge bg-light text-secondary border mb-2">
                                        {{ $product->category->name ?? 'Général' }}
                                    </span>
                                    <h5 class="card-title fw-bold h6 text-truncate mb-2" title="{{ $product->name }}">
                                        {{ $product->name }}
                                    </h5>
                                    <p class="text-primary fw-bold fs-5 mb-2">
                                        {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                    </p>
                                </div>

                                <div>
                                    <div class="mb-3">
                                        @if($product->stock > 0)
                                            <span class="badge bg-success bg-opacity-10 text-success">
                                                <i class="bi bi-check-circle me-1"></i>En stock ({{ $product->stock }})
                                            </span>
                                        @else
                                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                                <i class="bi bi-x-circle me-1"></i>Rupture de stock
                                            </span>
                                        @endif
                                    </div>

                                    <div class="d-grid gap-2">
                                        <a href="{{ route('client.products.show', $product->id) }}" class="btn btn-outline-secondary btn-sm">
                                            Voir détail
                                        </a>
                                        <form action="{{ route('client.cart.add', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm w-100 fw-bold" @if($product->stock <= 0) disabled @endif>
                                                <i class="bi bi-cart-plus me-1"></i>Ajouter au panier
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="p-5 bg-light rounded shadow-sm">
                            <i class="bi bi-box-seam display-1 text-muted mb-3 d-block"></i>
                            <h4 class="fw-bold">Aucun produit trouvé</h4>
                            <p class="text-muted">Essayez de modifier vos critères de recherche ou de sélection de catégorie.</p>
                            <a href="{{ route('client.products.index') }}" class="btn btn-primary fw-bold mt-2">
                                Voir tous les produits
                            </a>
                        </div>
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