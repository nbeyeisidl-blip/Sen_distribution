@extends('cashier.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">

    <!-- En-tête -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h4 class="fw-bold mb-1 text-dark">Tableau de bord</h4>
            <p class="text-muted mb-0 small">Interface Caissier — SEN DISTRIBUTION</p>
        </div>
        <a href="{{ route('cashier.sales.create') }}" class="btn btn-primary px-3 py-2 rounded-3 fw-semibold shadow-sm">
            <i class="bi bi-cart-plus me-2"></i>Nouvelle vente
        </a>
    </div>

    <!-- Stat cartes / Métriques -->
    <div class="row g-3 mb-4">
 <!-- Carte Ventes -->
<div class="card border-0 shadow-sm p-3 rounded-3">
    <div class="d-flex align-items-center">
        <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-3 me-3">
            <i class="bi bi-bag fs-3"></i>
        </div>
        <div>
            <span class="text-muted small">Ventes</span>
            {{-- Utiliser $totalSalesCount ici --}}
            <h4 class="fw-bold mb-0">{{ $totalSalesCount ?? count($recentSales ?? []) }}</h4>
        </div>
    </div>
</div>

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-3 p-3 bg-white h-100">
                <div class="d-flex align-items-center">
                    <div class="p-3 bg-success bg-opacity-10 rounded-3 text-success me-3">
                        <i class="bi bi-currency-exchange fs-4"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-semibold">Ventes du mois — Montant</span>
                        <h4 class="fw-bold mb-0 mt-1">{{ number_format($monthlyTotal ?? 0, 0, ',', ' ') }} FCFA</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-3 p-3 bg-white h-100">
                <div class="d-flex align-items-center">
                    <div class="p-3 bg-warning bg-opacity-10 rounded-3 text-warning me-3">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-semibold">Commandes en attente</span>
                        <h4 class="fw-bold mb-0 mt-1">{{ $pendingOrdersCount ?? 1 }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableaux et sections -->
    <div class="row g-4">
        <!-- Dernières ventes -->
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm rounded-3 bg-white p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-dark">Dernières ventes</h6>
                    <a href="#" class="text-primary text-decoration-none small fw-semibold">Voir tout</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light rounded-2 text-muted small">
                            <tr>
                                <th>N° Vente</th>
                                <th>Client</th>
                                <th>Produit</th>
                                <th>Montant</th>
                                <th>Paiement</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody class="small">
    @forelse($recentSales ?? [] as $sale)
        <tr>
            <!-- Numéro de vente -->
            <td class="fw-bold text-dark">
                VTE-{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}
            </td>

            <!-- Nom du Client -->
            <td>
                {{ $sale->client->name ?? $sale->client->nom ?? 'Client comptant' }}
            </td>

            <!-- Produit(s) -->
            <td class="text-muted">
                @if(isset($sale->items) && $sale->items->count() > 0)
                    @if($sale->items->count() === 1)
                        {{ $sale->items->first()->product->name ?? $sale->items->first()->product->nom ?? 'Produit' }}
                    @else
                        Articles multiples ({{ $sale->items->count() }})
                    @endif
                @else
                    Articles multiples
                @endif
            </td>

            <!-- Montant Total -->
            <td class="fw-bold">
                {{ number_format($sale->total ?? $sale->total_amount ?? 0, 0, ',', ' ') }} FCFA
            </td>

            <!-- Mode de Paiement -->
            <td>
                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-20 px-2 py-1 rounded-2">
                    {{ ucfirst($sale->payment_method ?? 'Espèces') }}
                </span>
            </td>

            <!-- Statut de la vente -->
            <td>
                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-20 px-2 py-1 rounded-2">
                    {{ ucfirst($sale->status ?? 'Payée') }}
                </span>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center text-muted py-4">
                <i class="bi bi-inbox fs-3 d-block mb-2 text-secondary"></i>
                Aucune vente récente enregistrée
            </td>
        </tr>
    @endforelse
</tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Carte Top Produits Vendus -->
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-transparent border-0 pt-3 px-3">
        <h6 class="fw-bold mb-0">Top produits vendus</h6>
    </div>
    <div class="card-body p-3">
        @forelse($topProducts ?? [] as $item)
            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                <div>
                    <h6 class="mb-0 fw-semibold text-dark">
                        {{ $item->product->name ?? $item->product->nom ?? 'Produit #' . $item->product_id }}
                    </h6>
                    <small class="text-muted">
                        {{ $item->total_qty }} vendu(s)
                    </small>
                </div>
                <div class="fw-bold text-primary">
                    {{ number_format($item->total_amount ?? 0, 0, ',', ' ') }} FCFA
                </div>
            </div>
        @empty
            <div class="text-center text-muted py-4">
                <i class="bi bi-box-seam fs-3 d-block mb-2 text-secondary"></i>
                <p class="mb-0 small">Aucun produit vendu pour le moment</p>
            </div>
        @endforelse
    </div>
</div>
    </div>

</div>
@endsection