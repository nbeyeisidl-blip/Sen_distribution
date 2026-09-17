@extends('admin.layouts.app')

@section('title', 'Gestion des ventes')
@section('page-title', 'Gestion des ventes')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Gestion des ventes</h3>
        <p class="text-muted mb-0">Consultez l'historique complet des ventes.</p>
    </div>

    <a href="{{ route('admin.sales.create') }}" class="btn btn-primary">
        <i class="bi bi-cart-plus me-1"></i> Nouvelle vente
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="border-0 fw-semibold ps-4">N° Vente</th>
                        <th class="border-0 fw-semibold">Client</th>
                        <th class="border-0 fw-semibold">Date</th>
                        <th class="border-0 fw-semibold">Montant</th>
                        <th class="border-0 fw-semibold">Paiement</th>
                        <th class="border-0 fw-semibold text-center pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                        <tr>
                            {{-- Code Vente --}}
                            <td class="ps-4 fw-semibold text-dark">
                                {{ $sale->code ?? 'VTS-' . str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}
                            </td>
                            
                            {{-- Colonne Client corrigée --}}
<td>
    @if($sale->client)
        <strong>{{ $sale->client->nom }} {{ $sale->client->prenom ?? '' }}</strong>
    @elseif(!empty($sale->client_name))
        <strong>{{ $sale->client_name }}</strong>
    @else
        <span class="text-muted">Client de passage</span>
    @endif
</td>

                            {{-- Date --}}
                            <td class="text-muted">
                                {{ $sale->created_at ? $sale->created_at->format('d/m/Y H:i') : '-' }}
                            </td>
                            
                            {{-- Montant --}}
                            <td class="fw-bold text-dark">
                                {{ number_format($sale->total, 0, ',', ' ') }} FCFA
                            </td>
                            
                            {{-- Mode de paiement --}}
                            <td>
                                <span class="badge bg-info-subtle text-info px-2 py-1 rounded-2">
                                    {{ $sale->payment_method }}
                                </span>
                            </td>
                            
                            {{-- Actions --}}
                            <td class="text-center pe-4">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.sales.show', $sale->id) }}" 
                                       class="btn btn-outline-secondary" 
                                       title="Voir les détails">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.sales.edit', $sale->id) }}" 
                                       class="btn btn-outline-warning" 
                                       title="Éditer">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('admin.sales.destroy', $sale->id) }}" 
                                          method="POST" 
                                          class="d-inline" 
                                          onsubmit="return confirm('Voulez-vous vraiment supprimer cette vente ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger" 
                                                title="Supprimer">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Aucune vente enregistrée.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($sales->hasPages())
            <div class="p-3 border-top">
                {{ $sales->links() }}
            </div>
        @endif
    </div>
</div>

@endsection