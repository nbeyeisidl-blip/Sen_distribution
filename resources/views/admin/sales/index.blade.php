@extends('admin.layouts.app')

@section('title', 'Gestion des ventes')

@section('page-title', 'Gestion des ventes')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold mb-1">Gestion des ventes</h3>
        <p class="text-muted mb-0">
            Consultez l'historique des ventes.
        </p>
    </div>

    <a href="{{ route('admin.sales.create') }}"
       class="btn btn-primary">

        <i class="bi bi-cart-plus"></i>
        Nouvelle vente

    </a>

</div>

@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show">

        <i class="bi bi-check-circle"></i>
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>

    </div>

@endif

<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">
<tr>
                <th class="border-0 fw-semibold">N° Vente</th>
                <th class="border-0 fw-semibold">Client</th>
                <th class="border-0 fw-semibold">Date</th>
                <th class="border-0 fw-semibold">Montant</th>
                <th class="border-0 fw-semibold">Paiement</th>
                <th class="border-0 fw-semibold text-center">Action</th>
            </tr>

                </thead>

                <tbody>
    @forelse($sales as $sale)
        <tr>
            {{-- Code Vente --}}
            <td class="fw-semibold text-dark">
                {{ $sale->code ?? 'VTS-' . str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}
            </td>
            
            {{-- Client : Extraction explicite du nom --}}
            <td>
                @if(is_object($sale->client))
                    {{ $sale->client->name ?? $sale->client->nom ?? 'Client de passage' }}
                @elseif(is_array($sale->client))
                    {{ $sale->client['name'] ?? $sale->client['nom'] ?? 'Client de passage' }}
                @else
                    {{ $sale->client_name ?? 'Client de passage' }}
                @endif
            </td>

            {{-- Date --}}
            <td class="text-muted">
                {{ $sale->created_at ? $sale->created_at->format('d/m/Y') : '-' }}
            </td>
            
            {{-- Montant : Vérification de plusieurs noms de colonnes possibles --}}
            <td class="fw-bold text-dark">
                {{ number_format($sale->total_amount ?? $sale->total ?? $sale->montant ?? 0, 0, ',', ' ') }} FCFA
            </td>
            
            {{-- Mode de paiement --}}
            <td>
                <span class="badge bg-info-subtle text-info px-2 py-1 rounded-2">
                    {{ $sale->payment_method ?? $sale->mode_paiement ?? 'Espèces' }}
                </span>
            </td>
            
            {{-- Actions --}}
            <td class="text-center">
               <a href="{{ route('admin.sales.edit', $sale->id) }}" class="btn btn-sm btn-warning">Éditer</a>

<form action="{{ route('admin.sales.destroy', $sale->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous vraiment supprimer cette vente ?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
</form> 
            
            <a href="{{ route('admin.sales.show', $sale->id) }}" class="btn btn-sm btn-light border rounded-circle p-1">
                    <i class="bi bi-eye text-secondary"></i>
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center text-muted py-4">Aucune vente enregistrée.</td>
        </tr>
    @endforelse
</tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $sales->links() }}

        </div>

    </div>

</div>

@endsection