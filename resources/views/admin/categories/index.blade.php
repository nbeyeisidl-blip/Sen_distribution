@extends('admin.layouts.app')

@section('title', 'Gestion des catégories')

@section('page-title', 'Gestion des catégories')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold mb-1">Catégories</h3>
        <p class="text-muted mb-0">
            Gérez les catégories de vos produits.
        </p>
    </div>

    <a href="{{ route('admin.categories.create') }}"
       class="btn btn-primary">

        <i class="bi bi-plus-lg"></i>
        Ajouter une catégorie

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


@if(session('error'))

    <div class="alert alert-danger alert-dismissible fade show">

        <i class="bi bi-exclamation-triangle"></i>
        {{ session('error') }}

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
              action="{{ route('admin.categories.index') }}"
              class="row g-2 mb-4">

            <div class="col-md-8">

                <input type="text"
                       name="search"
                       class="form-control"
                       value="{{ $search }}"
                       placeholder="Rechercher une catégorie...">

            </div>

            <div class="col-md-2">

                <button class="btn btn-dark w-100">

                    <i class="bi bi-search"></i>
                    Rechercher

                </button>

            </div>

            <div class="col-md-2">

                <a href="{{ route('admin.categories.index') }}"
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
                        <th>Nom</th>
                        <th>Slug</th>
                        <th>Produits</th>
                        <th>Statut</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($categories as $category)

                        <tr>

                            <td>
                                {{ $category->id }}
                            </td>

                            <td>
                                <strong>
                                    {{ $category->name }}
                                </strong>
                            </td>

                            <td>
                                <span class="text-muted">
                                    {{ $category->slug }}
                                </span>
                            </td>

                            <td>

                                <span class="badge bg-primary">
                                    {{ $category->products_count }}
                                </span>

                            </td>

                            <td>

                                @if($category->is_active)

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        Inactive
                                    </span>

                                @endif

                            </td>

                            <td>

                                <a href="{{ route('admin.categories.edit', $category) }}"
                                   class="btn btn-sm btn-warning">

                                    <i class="bi bi-pencil"></i>

                                </a>


                                <form action="{{ route('admin.categories.destroy', $category) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Voulez-vous supprimer cette catégorie ?')">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="text-center py-5">

                                <i class="bi bi-tags fs-1 text-muted"></i>

                                <p class="text-muted mt-2">
                                    Aucune catégorie trouvée.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div class="mt-3">

            {{ $categories->links() }}

        </div>

    </div>

</div>

@endsection