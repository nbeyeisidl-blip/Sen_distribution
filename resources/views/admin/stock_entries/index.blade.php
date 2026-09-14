@extends('admin.layouts.app')

@section('title', 'Gestion des Entrées de Stock')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Gestion des Entrées de Stock</h1>
        <a href="{{ route('admin.stock_entries.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Nouvelle Entrée
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 fw-bold">Historique des approvisionnements</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>N° Entrée</th>
                            <th>Fournisseur</th>
                            <th>Date</th>
                            <th>Montant Total</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($entries as $entry)
                            <tr>
                                <td><strong>ENT-{{ str_pad($entry->id, 5, '0', STR_PAD_LEFT) }}</strong></td>
                                <td>{{ $entry->fournisseur ? $entry->fournisseur->nom : 'N/A' }}</td>
                                <td>{{ $entry->created_at ? $entry->created_at->format('d/m/Y H:i') : '' }}</td>
                                <td>{{ number_format($entry->total_amount ?? 0, 0, ',', ' ') }} FCFA</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.stock_entries.show', $entry->id) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-eye"></i> Voir
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Aucune entrée de stock enregistrée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $entries->links() }}
            </div>
        </div>
    </div>
</div>
@endsection