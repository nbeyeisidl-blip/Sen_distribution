@extends('cashier.layouts.app')


@section('content')
<div class="container-fluid py-4">

    {{-- EN-TÊTE DU TABLEAU DE BORD --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Tableau de bord</h1>
            <p class="text-muted small mb-0">Interface Caissier - SEN DISTRIBUTION</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="position-relative">
                <i class="bi bi-bell fs-4"></i>
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                @endif
            </div>
            <div class="d-flex align-items-center gap-2 border-start ps-3">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                    <i class="bi bi-person-fill fs-5"></i>
                </div>
                <span class="fw-semibold text-dark">{{ auth()->user()->name ?? 'Caissier' }}</span>
            </div>
        </div>
    </div>

    {{-- 1. CARTES D'INDICATEURS (KPIs) --}}
    <div class="row g-3 mb-4">
        
        {{-- Total Ventes --}}
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <span class="text-muted small fw-semibold">Ventes</span>
                    <h2 class="fw-bold text-dark my-2">{{ $salesCount ?? 0 }}</h2>
                </div>
            </div>
        </div>

        {{-- Montant Total --}}
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <span class="text-muted small fw-semibold">Ventes du mois - Montant</span>
                    <h2 class="fw-bold text-primary my-2">
                        {{ number_format($totalAmount ?? 0, 0, ',', ' ') }} <span class="fs-6 text-dark">FCFA</span>
                    </h2>
                </div>
            </div>
        </div>

        {{-- Commandes en attente --}}
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <span class="text-muted small fw-semibold">Commandes en attente</span>
                    <h2 class="fw-bold text-dark my-2">{{ $pendingOrders ?? 0 }}</h2>
                </div>
            </div>
        </div>

    </div>

    {{-- 2. SECTION PRINCIPALE (DERNIÈRES VENTES + TOP PRODUITS) --}}
    <div class="row g-4">

        {{-- TABLEAU DES DERNIÈRES VENTES --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold text-dark mb-0">Dernières ventes</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light small text-muted">
                            <tr>
                                <th>N° Vente</th>
                                <th>Client</th>
                                <th>Produit</th>
                                <th>Montant</th>
                                <th>Paiement</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentSales as $sale)
                                <tr>
                                    <td class="fw-bold text-secondary">VTE-{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $sale->client->name ?? $sale->client->nom ?? 'Client Comptoir' }}</td>
                                    <td>{{ $sale->items->first()->product->name ?? $sale->items->first()->product->nom ?? 'Articles multiples' }}</td>
                                    <td class="fw-bold">{{ number_format($sale->total, 0, ',', ' ') }} FCFA</td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            {{ ucfirst($sale->payment_method ?? 'Espèces') }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($sale->status === 'completed' || $sale->status === 'confirmed')
                                            <span class="text-success"><i class="bi bi-check-lg me-1"></i>Payé</span>
                                        @else
                                            <span class="text-warning"><i class="bi bi-clock me-1"></i>En attente</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        Aucune vente enregistrée récemment.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- PANNEAU DROIT : TOP PRODUITS & BOUTON NOUVELLE VENTE --}}
        <div class="col-lg-4">

            {{-- Top produits vendus --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold text-dark mb-0">Top produits vendus</h6>
                </div>
                <div class="list-group list-group-flush">
                    @forelse($topProducts as $index => $product)
                        <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="fw-bold text-muted me-2">{{ $index + 1 }}.</span>
                            <span class="fw-semibold text-dark flex-grow-1">{{ $product->name ?? $product->nom }}</span>
                            <span class="badge bg-light text-dark border fw-normal">
                                {{ number_format($product->price, 0, ',', ' ') }} FCFA
                            </span>
                        </div>
                    @empty
                        <div class="list-group-item text-center text-muted py-3">
                            Aucun produit vendu.
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Bouton d'action directe --}}
            <div class="text-center">
                <a href="{{ route('cashier.sales.create') }}" class="btn btn-primary btn-lg w-100 py-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-cart-plus fs-4"></i>
                    <span>Nouvelle vente</span>
                </a>
                <small class="text-muted d-block mt-2">Créer une nouvelle vente en caisse</small>
            </div>

        </div>

    </div>

</div>
@endsection