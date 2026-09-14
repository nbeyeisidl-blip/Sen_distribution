@extends('admin.layouts.app')

@section('title', 'Gestion des clients')

@section('page-title', 'Gestion des clients')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold mb-1">Clients</h3>
        <p class="text-muted mb-0">
            Gérez vos clients.
        </p>
    </div>

    <a href="{{ route('admin.clients.create') }}"
       class="btn btn-primary">

        <i class="bi bi-person-plus"></i>
        Ajouter un client

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

        <form method="GET"
              action="{{ route('admin.clients.index') }}"
              class="row g-2 mb-4">

            <div class="col-md-8">

                <input type="text"
                       name="search"
                       value="{{ $search }}"
                       class="form-control"
                       placeholder="Rechercher un client...">

            </div>

            <div class="col-md-2">

                <button class="btn btn-dark w-100">

                    <i class="bi bi-search"></i>
                    Rechercher

                </button>

            </div>

            <div class="col-md-2">

                <a href="{{ route('admin.clients.index') }}"
                   class="btn btn-outline-secondary w-100">

                    Réinitialiser

                </a>

            </div>

        </form>


        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>#</th>
                        <th>Client</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Adresse</th>
                        <th>Statut</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($clients as $client)

                        <tr>

                            <td>
                                {{ $client->id }}
                            </td>

                            <td>

                                <strong>
                                    {{ $client->nom }}
                                    {{ $client->prenom }}
                                </strong>

                            </td>

                            <td>
                                {{ $client->telephone ?? '-' }}
                            </td>

                            <td>
                                {{ $client->email ?? '-' }}
                            </td>

                            <td>
                                {{ $client->adresse ?? '-' }}
                            </td>

                            <td>

                                @if($client->is_active)

                                    <span class="badge bg-success">
                                        Actif
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        Inactif
                                    </span>

                                @endif

                            </td>

                            <td>

                                <a href="{{ route('admin.clients.edit', $client) }}"
                                   class="btn btn-sm btn-warning">

                                    <i class="bi bi-pencil"></i>

                                </a>

                                <form action="{{ route('admin.clients.destroy', $client) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Voulez-vous supprimer ce client ?')">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center py-5">

                                <i class="bi bi-people fs-1 text-muted"></i>

                                <p class="text-muted mt-2">
                                    Aucun client trouvé.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $clients->links() }}

        </div>

    </div>

</div>

@endsection