@extends('storekeeper.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-truck me-2"></i>Liste des Fournisseurs</h2>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <form action="{{ route('storekeeper.suppliers.index') }}" method="GET" class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher nom, téléphone, email..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Rechercher
                    </button>
                </div>
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nom / Raison Sociale</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Adresse</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($fournisseurs as $fournisseur)
                            <tr>
                                <td>{{ $fournisseur->id }}</td>
                                <td class="fw-bold">{{ $fournisseur->nom }}</td>
                                <td>{{ $fournisseur->telephone ?? 'N/A' }}</td>
                                <td>{{ $fournisseur->email ?? 'N/A' }}</td>
                                <td>{{ $fournisseur->adresse ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">Aucun fournisseur trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $fournisseurs->links() }}
        </div>
    </div>
</div>
@endsection