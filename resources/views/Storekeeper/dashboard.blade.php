@extends('storekeeper.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Tableau de bord Magasinier</h1>
            <p class="text-muted small mb-0">Gestion des stocks et mouvements - SEN DISTRIBUTION</p>
        </div>
    </div>

    {{-- CARTES KPIS --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <span class="text-muted small fw-semibold">Total Produits</span>
                <h3 class="fw-bold text-primary mb-0 mt-2">{{ $totalProducts ?? 0 }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <span class="text-muted small fw-semibold">Stock Total</span>
                <h3 class="fw-bold text-success mb-0 mt-2">{{ $totalStock ?? 0 }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <span class="text-muted small fw-semibold">Ruptures / Alertes</span>
                <h3 class="fw-bold text-warning mb-0 mt-2">{{ $lowStockCount ?? 0 }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <span class="text-muted small fw-semibold">Entrées du mois</span>
                <h3 class="fw-bold text-info mb-0 mt-2">{{ $monthlyEntries ?? 0 }}</h3>
            </div>
        </div>
    </div>

</div>
@endsection