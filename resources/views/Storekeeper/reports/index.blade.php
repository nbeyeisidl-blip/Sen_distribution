@extends('storekeeper.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1"><i class="bi bi-file-earmark-bar-graph me-2"></i>Rapports d'Inventaire</h1>
            <p class="text-muted small mb-0">Analyse globale et vue synthétique des stocks - SEN DISTRIBUTION</p>
        </div>
        <button onclick="window.print()" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-printer me-1"></i> Imprimer le rapport
        </button>
    </div>

    {{-- CARTES KPIS --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm border-start border-primary border-4">
                <div class="card-body">
                    <span class="text-muted small text-uppercase fw-bold">Total Produits</span>
                    <h3 class="fw-bold my-1">{{ number_format($totalProducts) }}</h3>
                    <span class="text-muted small">Références enregistrées</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm border-start border-success border-4">
                <div class="card-body">
                    <span class="text-muted small text-uppercase fw-bold">Stock Total</span>
                    <h3 class="fw-bold my-1 text-success">{{ number_format($totalStockUnits) }}</h3>
                    <span class="text-muted small">Unités en magasin</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm border-start border-warning border-4">
                <div class="card-body">
                    <span class="text-muted small text-uppercase fw-bold">Alertes Stock</span>
                    <h3 class="fw-bold my-1 text-warning">{{ $lowStockProducts }}</h3>
                    <span class="text-muted small">Seuil critique (&le; 5)</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm border-start border-danger border-4">
                <div class="card-body">
                    <span class="text-muted small text-uppercase fw-bold">Ruptures</span>
                    <h3 class="fw-bold my-1 text-danger">{{ $outOfStock }}</h3>
                    <span class="text-muted small">Produits épuisés</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- TABLEAU REPARTITION PAR CATEGORIE --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title fw-bold mb-0"><i class="bi bi-folder me-2"></i>Répartition du Stock par Catégorie</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light small">
                                <tr>
                                    <th>Catégorie</th>
                                    <th class="text-center">Nombre de Produits</th>
                                    <th class="text-end">Total Unités</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categoriesStats as $cat)
                                    <tr>
                                        <td class="fw-bold">{{ $cat->name }}</td>
                                        <td class="text-center"><span class="badge bg-light text-dark border">{{ $cat->products_count }}</span></td>
                                        <td class="text-end fw-bold">{{ number_format($cat->total_stock ?? 0) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-3 text-muted">Aucune donnée disponible.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- TOP STOCK --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title fw-bold mb-0"><i class="bi bi-trophy me-2"></i>Top 5 - plus gros volumes</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($topStockProducts as $prod)
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <div>
                                    <span class="fw-bold text-dark d-block">{{ $prod->name }}</span>
                                    <small class="text-muted">ID: #PRD-{{ str_pad($prod->id, 4, '0', STR_PAD_LEFT) }}</small>
                                </div>
                                <span class="badge bg-primary rounded-pill px-3 py-2 fs-6">{{ $prod->stock }} unités</span>
                            </li>
                        @empty
                            <li class="list-group-item text-center py-3 text-muted">Aucun produit.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection