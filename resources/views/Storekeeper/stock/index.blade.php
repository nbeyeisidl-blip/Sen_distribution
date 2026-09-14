@extends('storekeeper.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-box-seam me-2"></i>Gestion de Stock</h2>
        <a href="{{ route('storekeeper.stock.entry') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Entrée de Stock
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <form action="{{ route('storekeeper.stock.index') }}" method="GET" class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher un produit..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Rechercher</button>
                </div>
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nom du produit</th>
                            <th>Prix Unitaire</th>
                            <th>Stock Actuel</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td class="fw-bold">{{ $product->name }}</td>
                                <td>{{ number_format($product->price, 0, ',', ' ') }} FCFA</td>
                                <td>
                                    <span class="fs-6 fw-bold">{{ $product->stock }}</span>
                                </td>
                                <td>
                                    @if($product->stock <= 0)
                                        <span class="badge bg-danger">Rupture de stock</span>
                                    @elseif($product->stock <= 5)
                                        <span class="badge bg-warning text-dark">Stock Faible</span>
                                    @else
                                        <span class="badge bg-success">En Stock</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">Aucun produit trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection