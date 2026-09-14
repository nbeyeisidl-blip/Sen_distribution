@extends('cashier.layouts.app')

@section('content')
<div class="container-fluid py-4">

    {{-- EN-TÊTE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Gestion des Clients</h1>
            <p class="text-muted small mb-0">Répertoire et création de clients - SEN DISTRIBUTION</p>
        </div>
        <button class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#addClientModal">
            <i class="bi bi-person-plus me-1"></i> Nouveau client
        </button>
    </div>

    {{-- ALERTE SUCCÈS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- BARRE DE RECHERCHE --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('cashier.clients.index') }}" method="GET" class="row g-3">
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 bg-light" 
                               placeholder="Rechercher par nom, téléphone ou email..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100 fw-bold">Rechercher</button>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLEAU DES CLIENTS --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0">
                    <thead class="table-light small text-muted">
                        <tr>
                            <th>#ID</th>
                            <th>Nom complet</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Date d'inscription</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clients as $client)
                            <tr>
                                <td class="fw-bold text-secondary">#{{ $client->id }}</td>
                                <td class="fw-bold text-dark">{{ $client->name ?? $client->nom }}</td>
                                <td>{{ $client->phone ?? '-' }}</td>
                                <td>{{ $client->email ?? '-' }}</td>
                                <td class="small text-muted">{{ $client->created_at ? $client->created_at->format('d/m/Y') : '-' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('cashier.sales.create') }}?client_id={{ $client->id }}" class="btn btn-sm btn-outline-primary fw-bold">
                                        <i class="bi bi-cart-plus me-1"></i> Nouvelle vente
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    Aucun client trouvé.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($clients->hasPages())
            <div class="card-footer bg-white py-3">
                {{ $clients->links() }}
            </div>
        @endif
    </div>

</div>

{{-- MODAL AJOUT CLIENT --}}
<div class="modal fade" id="addClientModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold">Ajouter un nouveau client</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('cashier.clients.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nom complet <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required placeholder="Ex: Moussa Diop">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Téléphone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Ex: +221 77 000 00 00">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Adresse email</label>
                        <input type="email" name="email" class="form-control" placeholder="Ex: client@mail.com">
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary fw-bold" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary fw-bold">Enregistrer le client</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection