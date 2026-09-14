@extends('admin.layouts.app')

@section('title', 'Gestion du stock')

@section('page-title', 'Gestion du stock')

@section('content')

<div class="container-fluid">

    {{-- TITRE --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">
                <i class="bi bi-box-seam"></i>
                Gestion du stock
            </h3>

            <p class="text-muted mb-0">
                Consultez et surveillez les stocks des produits.
            </p>

        </div>

        <a href="{{ route('admin.stock_entries.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>
            Entrée de stock

        </a>

    </div>


    {{-- STATISTIQUES --}}

    <div class="row g-3 mb-4">

        <div class="col-md-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted mb-1">
                                Produits
                            </p>

                            <h3 class="fw-bold">
                                {{ $totalProducts }}
                            </h3>

                        </div>

                        <i class="bi bi-box fs-1 text-primary"></i>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted mb-1">
                                Stock disponible
                            </p>

                            <h3 class="fw-bold text-success">
                                {{ $availableProducts }}
                            </h3>

                        </div>

                        <i class="bi bi-check-circle fs-1 text-success"></i>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted mb-1">
                                Stock faible
                            </p>

                            <h3 class="fw-bold text-warning">
                                {{ $lowStockProducts }}
                            </h3>

                        </div>

                        <i class="bi bi-exclamation-triangle fs-1 text-warning"></i>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted mb-1">
                                Rupture
                            </p>

                            <h3 class="fw-bold text-danger">
                                {{ $outOfStockProducts }}
                            </h3>

                        </div>

                        <i class="bi bi-x-circle fs-1 text-danger"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- TOTAL STOCK --}}

    <div class="alert alert-info">

        <i class="bi bi-box-seam"></i>

        <strong>
            Quantité totale en stock :
        </strong>

        {{ $totalStock }} produits

    </div>


    {{-- RECHERCHE ET FILTRE --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form method="GET"
                  action="{{ route('admin.stock.index') }}">

                <div class="row g-2">

                    <div class="col-md-6">

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>

                            <input type="text"
                                   name="search"
                                   class="form-control"
                                   placeholder="Rechercher un produit..."
                                   value="{{ request('search') }}">

                        </div>

                    </div>


                    <div class="col-md-4">

                        <select name="stock_status"
                                class="form-select">

                            <option value="">
                                Tous les stocks
                            </option>

                            <option value="available"
                                {{ request('stock_status') == 'available' ? 'selected' : '' }}>

                                Stock disponible

                            </option>

                            <option value="low"
                                {{ request('stock_status') == 'low' ? 'selected' : '' }}>

                                Stock faible

                            </option>

                            <option value="out"
                                {{ request('stock_status') == 'out' ? 'selected' : '' }}>

                                Rupture de stock

                            </option>

                        </select>

                    </div>


                    <div class="col-md-2">

                        <button type="submit"
                                class="btn btn-primary w-100">

                            <i class="bi bi-search"></i>
                            Rechercher

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- TABLEAU --}}

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>#</th>

                            <th>Produit</th>

                            <th>Prix</th>

                            <th>Stock</th>

                            <th>État</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($products as $product)

                            <tr>

                                <td>
                                    {{ $product->id }}
                                </td>

                                <td>

                                    <strong>
                                        {{ $product->name }}
                                    </strong>

                                </td>

                                <td>

                                    {{ number_format(
                                        $product->price,
                                        0,
                                        ',',
                                        ' '
                                    ) }}

                                    FCFA

                                </td>

                                <td>

                                    <span class="fw-bold">

                                        {{ $product->stock }}

                                    </span>

                                </td>

                                <td>

                                    @if($product->stock == 0)

                                        <span class="badge bg-danger">
                                            Rupture
                                        </span>

                                    @elseif($product->stock <= 10)

                                        <span class="badge bg-warning text-dark">
                                            Stock faible
                                        </span>

                                    @else

                                        <span class="badge bg-success">
                                            Disponible
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <a href="{{ route(
                                        'admin.products.edit',
                                        $product
                                    ) }}"
                                       class="btn btn-sm btn-warning">

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="text-center py-4">

                                    <i class="bi bi-box-seam fs-1 text-muted"></i>

                                    <p class="text-muted mt-2 mb-0">
                                        Aucun produit trouvé.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <div class="mt-3">

                {{ $products->links() }}

            </div>

        </div>

    </div>

</div>

@endsection