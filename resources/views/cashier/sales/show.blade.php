@extends('cashier.layouts.app') {{-- Remplacez par votre layout principal si besoin --}}

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Détails de la vente #{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}</h1>
        <div>
            <a href="{{ route('cashier.sales.receipt', $sale->id) }}" class="btn btn-secondary me-2">
                <i class="bi bi-printer"></i> Imprimer Reçu
            </a>
            <a href="{{ route('cashier.sales.index') }}" class="btn btn-outline-secondary">
                Retour à la liste
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Informations Générales
                </div>
                <div class="card-body">
                    <p><strong>Date :</strong> {{ $sale->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Caissier :</strong> {{ $sale->user->name ?? 'N/A' }}</p>
                    <p><strong>Client :</strong> {{ $sale->client->name ?? 'Client de passage' }}</p>
                    <p><strong>Moyen de paiement :</strong> {{ ucfirst($sale->payment_method ?? 'Espèces') }}</p>
                    <hr>
                    <h5 class="text-success"><strong>Total :</strong> {{ number_format($sale->total_amount, 0, ',', ' ') }} FCFA</h5>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Produits Achetés
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Prix unitaire</th>
                                <th>Quantité</th>
                                <th>Sous-total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sale->items as $item)
                                <tr>
                                    <td>{{ $item->product->name ?? 'Produit supprimé' }}</td>
                                    <td>{{ number_format($item->price, 0, ',', ' ') }} FCFA</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->subtotal, 0, ',', ' ') }} FCFA</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection