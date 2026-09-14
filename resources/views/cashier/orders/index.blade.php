@extends('cashier.layouts.app')

@section('content')
<div class="container-fluid py-4">

    {{-- EN-TÊTE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Gestion des Commandes</h1>
            <p class="text-muted small mb-0">Suivi et historique complet des commandes - SEN DISTRIBUTION</p>
        </div>
        <a href="{{ route('cashier.sales.create') }}" class="btn btn-primary fw-bold">
            <i class="bi bi-cart-plus me-1"></i> Nouvelle vente
        </a>
    </div>

    {{-- BARRE DE RECHERCHE ET FILTRES --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('cashier.orders.index') }}" method="GET" class="row g-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 bg-light" 
                               placeholder="Rechercher par N° commande ou nom du client..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select bg-light" onchange="this.form.submit()">
                        <option value="">Tous les statuts</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Payée / Confirmée</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100 fw-bold">Filtrer</button>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLEAU DES COMMANDES --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0">
                    <thead class="table-light small text-muted">
                        <tr>
                            <th>N° Commande</th>
                            <th>Client</th>
                            <th>Articles</th>
                            <th>Date & Heure</th>
                            <th>Mode de règlement</th>
                            <th>Montant Total</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td class="fw-bold text-primary">
                                    VTE-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                </td>
                                <td>{{ $order->client->name ?? $order->client->nom ?? 'Client Comptoir' }}</td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $order->items->sum('quantity') }} article(s)
                                    </span>
                                </td>
                                <td class="small text-muted">
                                    {{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : '-' }}
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ ucfirst($order->payment_method ?? 'Espèces') }}
                                    </span>
                                </td>
                                <td class="fw-bold text-dark">
                                    {{ number_format($order->total, 0, ',', ' ') }} FCFA
                                </td>
                                <td>
                                    @if($order->status === 'completed' || $order->status === 'confirmed')
                                        <span class="badge bg-success-subtle text-success border border-success fw-semibold">
                                            <i class="bi bi-check-circle me-1"></i>Payée
                                        </span>
                                    @elseif($order->status === 'pending')
                                        <span class="badge bg-warning-subtle text-warning border border-warning fw-semibold">
                                            <i class="bi bi-clock me-1"></i>En attente
                                        </span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger fw-semibold">
                                            Annulée
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('cashier.invoice', $order->id) }}" class="btn btn-sm btn-outline-primary fw-bold" title="Voir la facture">
                                        <i class="bi bi-printer me-1"></i> Facture
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                    Aucune commande trouvée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- PAGINATION --}}
        @if($orders->hasPages())
            <div class="card-footer bg-white py-3">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

</div>
@endsection