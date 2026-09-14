@extends('client.layouts.app')

@section('content')
<div class="container py-4">

    {{-- 1. BANNIÈRE DE LA CATÉGORIE SÉLECTIONNÉE --}}
    <div class="p-4 mb-4 bg-primary text-white rounded shadow-sm" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('client.home') }}" class="text-white-50 text-decoration-none">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('client.products.index') }}" class="text-white-50 text-decoration-none">Boutique</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ $category->name }}</li>
                    </ol>
                </nav>
                <h1 class="h2 fw-bold mb-1">{{ $category->name }}</h1>
                <p class="mb-0 text-white-50">{{ $category->description ?? 'Découvrez tous nos articles disponibles dans cette catégorie.' }}</p>
            </div>
            <div class="d-none d-md-block text-end">
                <span class="badge bg-white text-primary fs-6 px-3 py-2 rounded-pill shadow-sm">
                    {{ $products->total() }} produit(s)
                </span>
            </div>
        </div>
    </div>

    <div class="row">

        {{-- 2. SIDEBAR LATÉRALE : FILTRES & LISTE DES CATÉGORIES --}}
        <div class="col-lg-3 mb-4">

            {{-- Bloc des Catégories --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-bold py-3 border-bottom">
                    <i class="bi bi-grid-fill me-2 text-primary"></i>Catégories
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('client.products.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span>Tous nos produits</span>
                        <span class="badge bg-secondary rounded-pill">{{ $totalProductsCount ?? 0 }}</span>
                    </a>

                    @foreach($categories as $cat)
                        <a href="{{ route('client.categories.show', $cat->id) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $category->id == $cat->id ? 'active fw-bold' : '' }}">
                            <span>{{ $cat->name }}</span>
                            <span class="badge {{ $category->id == $cat->id ? 'bg-white text-primary' : 'bg-light text-dark border' }} rounded-pill">
                                {{ $cat->products_count }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Filtre par Prix --}}
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold py-3 border-bottom">
                    <i class="bi bi-funnel me-2 text-primary"></i>Filtrer par Prix
                </div>
                <div class="card-body">
                    <form action="{{ route('client.categories.show', $category->id) }}" method="GET">
                        <div class="mb-3">
                            <label class="form-label small text-muted">Prix Maximum (FCFA)</label>
                            <input type="number" name="max_price" class="form-control" placeholder="ex: 15000" value="{{ request('max_price') }}">
                        </div>
                        <button type="submit" class="btn btn-outline-primary btn-sm w-100 fw-bold">
                            Appliquer le filtre
                        </button>
                    </form>
                </div>
            </div>

        </div>

        {{-- 3. GRILLE DES PRODUITS DE LA CATÉGORIE --}}
        <div class="col-lg-9">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                @forelse($products as $product)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm position-relative">
                            
                            {{-- Image Produit --}}
                            <div class="bg-light text-center p-3 rounded-top d-flex align-items-center justify-content-center" style="height: 190px;">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-product.png') }}" 
                                     alt="{{ $product->name }}" 
                                     class="img-fluid" 
                                     style="max-height: 160px; object-fit: contain;">
                            </div>

                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <span class="badge bg-light text-secondary border mb-2">{{ $category->name }}</span>
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
                                                En stock ({{ $product->stock }})
                                            </span>
                                        @else
                                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                                Rupture de stock
                                            </span>
                                        @endif
                                    </div>

                                    <div class="d-grid gap-2">
                                        <a href="{{ route('client.products.show', $product->id) }}" class="btn btn-outline-secondary btn-sm">
                                            Détails
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
                            <i class="bi bi-folder-x display-1 text-muted mb-3 d-block"></i>
                            <h4 class="fw-bold">Aucun produit dans ce rayon</h4>
                            <p class="text-muted">Il n'y a actuellement aucun produit disponible dans la catégorie {{ $category->name }}.</p>
                            <a href="{{ route('client.products.index') }}" class="btn btn-primary fw-bold">
                                Explorer toutes les catégories
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $products->withQueryString()->links() }}
            </div>

        </div>

    </div>
</div>
@endsection