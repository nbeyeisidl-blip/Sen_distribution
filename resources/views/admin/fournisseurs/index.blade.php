@extends('admin.layouts.app')

@section('title', 'Gestion des fournisseurs')

@section('page-title', 'Gestion des fournisseurs')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold mb-1">
            Gestion des fournisseurs
        </h3>

        <p class="text-muted mb-0">
            Gérez vos fournisseurs.
        </p>
    </div>

    <a href="{{ route('admin.fournisseurs.create') }}"
       class="btn btn-primary">

        <i class="bi bi-person-plus"></i>
        Ajouter un fournisseur

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


<div class="card border-0 shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Entreprise</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($fournisseurs as $fournisseur)

                    <tr>

                        <td>
                            {{ $fournisseur->id }}
                        </td>

                        <td>
                            <strong>
                                {{ $fournisseur->nom }}
                            </strong>
                        </td>

                        <td>
                            {{ $fournisseur->entreprise ?? '-' }}
                        </td>

                        <td>
                            {{ $fournisseur->telephone ?? '-' }}
                        </td>

                        <td>
                            {{ $fournisseur->email ?? '-' }}
                        </td>

                        <td>

                            <a href="{{ route('admin.fournisseurs.show', $fournisseur) }}"
                               class="btn btn-sm btn-info">

                                <i class="bi bi-eye"></i>

                            </a>

                            <a href="{{ route('admin.fournisseurs.edit', $fournisseur) }}"
                               class="btn btn-sm btn-warning">

                                <i class="bi bi-pencil"></i>

                            </a>

                            <form action="{{ route('admin.fournisseurs.destroy', $fournisseur) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Voulez-vous supprimer ce fournisseur ?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-danger">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6"
                            class="text-center py-4">

                            Aucun fournisseur enregistré.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{ $fournisseurs->links() }}

    </div>

</div>

@endsection