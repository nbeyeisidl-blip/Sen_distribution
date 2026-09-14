@extends('client.layouts.app')

@section('title', 'Détail de la commande #' . $order->id)

@section('content')
<div class="container my-5">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Commande #{{ $order->id }}</h2>
        <a href="{{ route('client.products.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left me-1"></i> Continuer vos achats
        </a>
    </div>

    <div class="row g-4">
        <!-- Détails des articles -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 mb-4">
                <h5 class="fw-bold mb-3">Articles commandés</h5>
                <div class="table-responsive">
                    <table class="table align-middle">
    <thead>
        <tr>
            <th>Produit</th>
            <th>Prix unitaire</th>
            <th>Quantité</th>
            <th class="text-end">Sous-total</th>
        </tr>
    </thead>
    <tbody>
        @forelse($order->items as $item)
            <tr>
                <td>
                    {{ $item->product->name ?? $item->product_name ?? 'Produit inconnu' }}
                </td>
                <td>
                    {{ number_format($item->price ?? $item->unit_price ?? 0, 0, ',', ' ') }} FCFA
                </td>
                <td>{{ $item->quantity }}</td>
                <td class="text-end fw-bold">
                    {{ number_format(($item->price ?? $item->unit_price ?? 0) * $item->quantity, 0, ',', ' ') }} FCFA
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center text-muted py-3">
                    Aucun article trouvé pour cette commande.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
                </div>
            </div>
        </div>

        <!-- Résumé de la commande -->
        <div class="col-lg-4">
            <div class="card p-3 shadow-sm">
    <h5 class="fw-bold mb-3">Récapitulatif</h5>
    
    <p class="mb-2">
        <span class="text-muted">Statut :</span> 
        <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span>
    </p>

    <p class="mb-2">
        <span class="text-muted">Adresse de livraison :</span><br>
        <strong>{{ $order->shipping_address ?? $order->client->address ?? 'Non renseignée' }}</strong>
    </p>

    <p class="mb-3">
        <span class="text-muted">Téléphone :</span><br>
        <strong>{{ $order->phone ?? $order->client->phone ?? 'Non renseigné' }}</strong>
    </p>

    <hr>

    <div class="d-flex justify-content-between align-items-center">
        <span class="fw-bold">Total payé</span>
        <span class="fs-5 text-primary fw-bold">
            {{ number_format($order->total ?? $order->total_amount ?? 0, 0, ',', ' ') }} FCFA
        </span>
    </div>
</div>
        </div>
    </div>
</div>
@endsection