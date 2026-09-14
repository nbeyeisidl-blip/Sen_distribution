@extends('admin.layouts.app')

@section('title', 'Gestion des produits')

@section('page-title', 'Gestion des produits')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold mb-1">Produits</h3>
        <p class="text-muted mb-0">
            Gérez les produits et les stocks.
        </p>
    </div>

    <a href="{{ route('admin.products.create') }}"
       class="btn btn-primary">
        <i class="bi bi-plus-lg"></i>
        Ajouter un produit
    </a>

</div>


@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle"></i>
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>
    </div>
@endif


<div class="card shadow-sm border-0">

    <div class="card-body">

        <!-- RECHERCHE -->

        <form method="GET"
              action="{{ route('admin.products.index') }}"
              class="row g-2 mb-4">

            <div class="col-md-8">

                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Rechercher un produit..."
                       value="{{ $search }}">

            </div>

            <div class="col-md-2">

                <button class="btn btn-dark w-100">
                    <i class="bi bi-search"></i>
                    Rechercher
                </button>

            </div>

            <div class="col-md-2">

                <a href="{{ route('admin.products.index') }}"
                   class="btn btn-outline-secondary w-100">
                    Réinitialiser
                </a>

            </div>

        </form>


        <!-- TABLE -->

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Produit</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($products as $product)

                        <tr>

                            <td>
                                {{ $product->id }}
                            </td>

                            <td>
    @if($product->image && file_exists(public_path('images/products/' . $product->image)))
        <img src="{{ asset('images/products/' . $product->image) }}" 
             alt="{{ $product->name }}" 
             width="50" height="50" 
             style="object-fit: cover; border-radius: 5px;">
    @else
        <span class="badge bg-secondary">Pas d'image</span>
    @endif
</td>

                            <td>
                                <strong>
                                    {{ $product->name }}
                                </strong>
                            </td>

                            <td>
                                {{ $product->category?->name ?? 'Sans catégorie' }}
                            </td>

                            <td>
                                {{ number_format($product->price, 0, ',', ' ') }}
                                FCFA
                            </td>

                            <td>

                                @if($product->stock <= 5)

                                    <span class="badge bg-danger">
                                        {{ $product->stock }}
                                    </span>

                                @else

                                    <span class="badge bg-success">
                                        {{ $product->stock }}
                                    </span>

                                @endif

                            </td>

                            <td>

                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>


                                <form action="{{ route('admin.products.destroy', $product) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Voulez-vous supprimer ce produit ?')">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center py-5">

                                <i class="bi bi-box-seam fs-1 text-muted"></i>

                                <p class="text-muted mt-2">
                                    Aucun produit trouvé.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- PAGINATION -->

        <div class="mt-3">

            {{ $products->links() }}

        </div>

    </div>

</div>

@endsection