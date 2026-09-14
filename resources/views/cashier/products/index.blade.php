@extends('cashier.layouts.app')

@section('content')
<div class="container-fluid py-4">

    {{-- EN-TÊTE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Catalogue Produits</h1>
            <p class="text-muted small mb-0">Consultation du stock et des prix - SEN DISTRIBUTION</p>
        </div>
        <a href="{{ route('cashier.sales.create') }}" class="btn btn-primary fw-bold">
            <i class="bi bi-cart-plus me-1"></i> Aller à la caisse
        </a>
    </div>

    {{-- FILTRES ET RECHERCHE --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('cashier.products.index') }}" method="GET" class="row g-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 bg-light" 
                               placeholder="Rechercher un produit par nom..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="category_id" class="form-select bg-light" onchange="this.form.submit()">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name ?? $category->libelle }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100 fw-bold">Filtrer</button>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLEAU DES PRODUITS --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0">
                    <thead class="table-light small text-muted">
                        <tr>
                            <th>Produit</th>
                            <th>Catégorie</th>
                            <th>Prix Unitaire</th>
                            <th>Stock Disponible</th>
                            <th>Statut du stock</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td class="fw-bold text-dark">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded p-2 me-2 text-primary">
                                            <i class="bi bi-box-seam fs-5"></i>
                                        </div>
                                        <div>
                                            <span>{{ $product->name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $product->category->name ?? $product->category->libelle ?? 'Alimentaire' }}
                                    </span>
                                </td>
                                <td class="fw-bold text-primary">
                                    {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                </td>
                                <td class="fw-bold">
                                    {{ $product->stock }}
                                </td>
                                <td>
                                    @if($product->stock > 10)
                                        <span class="badge bg-success-subtle text-success border border-success fw-semibold">
                                            En stock
                                        </span>
                                    @elseif($product->stock > 0)
                                        <span class="badge bg-warning-subtle text-warning border border-warning fw-semibold">
                                            Stock faible
                                        </span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger fw-semibold">
                                            Rupture de stock
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('cashier.sales.create') }}" class="btn btn-sm btn-outline-primary fw-bold">
                                        <i class="bi bi-plus-circle me-1"></i> Vendre
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-box fs-3 d-block mb-2"></i>
                                    Aucun produit trouvé dans le catalogue.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- PAGINATION --}}
        @if($products->hasPages())
            <div class="card-footer bg-white py-3">
                {{ $products->links() }}
            </div>
        @endif
    </div>

</div>
@endsection