@extends('storekeeper.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1"><i class="bi bi-arrow-repeat me-2"></i>Réapprovisionnement</h1>
            <p class="text-muted small mb-0">Suivi des produits en rupture ou à faible stock - SEN DISTRIBUTION</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="card-title fw-bold text-danger mb-0">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>Articles en Alerte Stock (Seuil &le; 5)
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small text-muted">
                        <tr>
                            <th>Code ID</th>
                            <th>Désignation</th>
                            <th>Stock Actuel</th>
                            <th>Statut</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lowStockProducts as $product)
                            <tr>
                                <td class="fw-bold text-secondary">#PRD-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td class="fw-bold text-dark">{{ $product->name }}</td>
                                <td class="fw-bold fs-6">{{ $product->stock }}</td>
                                <td>
                                    @if($product->stock <= 0)
                                        <span class="badge bg-danger">Rupture Totale</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Stock Critical</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#restockModal{{ $product->id }}">
                                        <i class="bi bi-plus-circle me-1"></i> Réapprovisionner
                                    </button>
                                </td>
                            </tr>

                            {{-- MODALE DE RÉAPPROVISIONNEMENT --}}
                            <div class="modal fade" id="restockModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('storekeeper.restock.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <div class="modal-header bg-light">
                                                <h5 class="modal-title fw-bold">Réapprovisionner : {{ $product->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Stock Actuel</label>
                                                    <input type="text" class="form-control" value="{{ $product->stock }}" readonly disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Quantité à Ajouter <span class="text-danger">*</span></label>
                                                    <input type="number" name="quantity" class="form-control" placeholder="ex: 50" min="1" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Fournisseur (Optionnel)</label>
                                                    <select name="fournisseur_id" class="form-select">
                                                        <option value="">-- Choisir un fournisseur --</option>
                                                        @foreach($fournisseurs as $f)
                                                            <option value="{{ $f->id }}">{{ $f->nom }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-success fw-bold">Valider l'Ajout</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-success fw-bold">
                                    <i class="bi bi-check-circle me-1"></i> Aucun produit ne nécessite de réapprovisionnement urgent.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($lowStockProducts->hasPages())
            <div class="card-footer bg-white">
                {{ $lowStockProducts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection