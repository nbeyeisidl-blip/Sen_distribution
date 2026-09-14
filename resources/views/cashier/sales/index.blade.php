@extends('client.layouts.app')

@section('title', 'Historique des Ventes - Caissier')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">Espace Caissier</h2>
            <p class="text-muted small mb-0">Historique et gestion des enregistrements de ventes</p>
        </div>
        <a href="{{ route('cashier.sales.create') }}" class="btn btn-success fw-bold shadow-sm">
            <i class="bi bi-plus-circle me-2"></i>Nouvelle Vente
        </a>
    </div>

    {{-- Notification de succès --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-4"># N° Vente</th>
                            <th scope="col">Client</th>
                            <th scope="col">Date & Heure</th>
                            <th scope="col">Montant Total</th>
                            <th scope="col">Statut</th>
                            <th scope="col" class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                            <tr>
                                <td class="ps-4 fw-bold">#{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $sale->client->name ?? $sale->client_name ?? 'Client comptant' }}</td>
                                <td>{{ $sale->created_at->format('d/m/Y H:i') }}</td>
<td class="fw-bold text-dark">{{ number_format($sale->total_amount ?? $sale->total ?? $sale->montant_total ?? 0, 0, ',', ' ') }} FCFA</td>                                <td>
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                        Payée
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('cashier.sales.show', $sale->id) }}" class="btn btn-sm btn-outline-primary me-1" title="Voir détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('cashier.sales.receipt', $sale->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary" title="Imprimer reçu">
                                        <i class="bi bi-printer"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-receipt fs-1 d-block mb-2"></i>
                                    Aucune vente enregistrée pour le moment.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($sales->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $sales->links() }}
            </div>
        @endif
    </div>
</div>
@endsection