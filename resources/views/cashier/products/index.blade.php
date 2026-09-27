@extends('cashier.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">

    <!-- En-tête + Filtres -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold mb-1 text-dark">Catalogue Produits</h4>
            <p class="text-muted mb-0 small">Consultation du stock et des prix — SEN DISTRIBUTION</p>
        </div>
        <a href="{{ route('cashier.sales.create') }}" class="btn btn-primary px-3 py-2 rounded-3 fw-semibold shadow-sm">
            <i class="bi bi-cart-plus me-2"></i>Aller à la caisse
        </a>
    </div>

    <!-- Barre de recherche et filtre -->
    <form action="{{ route('cashier.products.index') }}" method="GET" class="card border-0 shadow-sm rounded-3 p-3 mb-4 bg-white">
        <div class="row g-2 align-items-center">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control bg-light border-start-0" placeholder="Rechercher un produit par nom..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <select name="category_id" class="form-select bg-light">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories ?? [] as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-dark w-100 fw-semibold">Filtrer</button>
            </div>
        </div>
    </form>

    <!-- Grille de Cartes Produits -->
    <div class="row g-3">
        @forelse($products as $product)
            <div class="col-6 col-md-4 col-lg-3 col-xl-2-4">
                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden product-card bg-white position-relative">
                    
                    <!-- Badge Statut du Stock -->
                    <span class="position-absolute top-0 end-0 m-2 badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }} bg-opacity-90 rounded-2 px-2 py-1 small">
                        {{ $product->stock > 0 ? 'En stock (' . $product->stock . ')' : 'Rupture' }}
                    </span>

                   <!-- Image du produit -->
<div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden product-card bg-white">
    <!-- Image attrayante avec conteneur adapté -->
    <div class="product-image-container">
        @if($product->image)
            <img src="{{ file_exists(public_path('images/products/' . $product->image)) ? asset('images/products/' . $product->image) : 'https://via.placeholder.com/150' }}" 
                 class="product-img" 
                 alt="{{ $product->name }}">
        @else
            <div class="text-center text-muted p-3">
                <i class="bi bi-image fs-1 d-block mb-1 opacity-50"></i>
                <span class="small">Sans image</span>
            </div>
        @endif
    </div>
</div>
 <!-- Corps de la carte -->
                    <div class="card-body p-3 d-flex flex-column justify-content-between">
                        <div>
                            <span class="badge bg-light text-secondary border mb-2 extra-small text-truncate d-inline-block style-cat">
                                {{ $product->category->name ?? 'Général' }}
                            </span>
                            <h6 class="card-title fw-bold text-dark mb-1 product-title" title="{{ $product->name }}">
                                {{ $product->name }}
                            </h6>
                        </div>

                        <div class="mt-3">
                            <div class="fw-bold text-primary fs-6 mb-2">
                                {{ number_format($product->price, 0, ',', ' ') }} FCFA
                            </div>
                            <a href="{{ route('cashier.sales.create', ['product_id' => $product->id]) }}" 
                               class="btn btn-outline-primary btn-sm w-100 fw-semibold rounded-2 {{ $product->stock <= 0 ? 'disabled' : '' }}">
                                <i class="bi bi-cart-plus me-1"></i>Vendre
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="p-4 bg-white rounded-3 shadow-sm d-inline-block">
                    <i class="bi bi-box-seam fs-1 text-muted d-block mb-2"></i>
                    <h6 class="fw-bold text-muted mb-0">Aucun produit trouvé dans le catalogue</h6>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if(method_exists($products, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    @endif

</div>
@endsection