@extends('cashier.layouts.app')

@section('content')
<div class="container-fluid py-4">

    {{-- BARRE D'ACTIONS (Impression / Navigation) --}}
    <div class="d-flex justify-content-between align-items-center mb-4 d-print-none">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Facture / Reçu de Caisse</h1>
            <p class="text-muted small mb-0">Vente N° VTE-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('cashier.sales.create') }}" class="btn btn-outline-primary fw-bold">
                <i class="bi bi-cart-plus me-1"></i> Nouvelle Vente
            </a>
            <button onclick="window.print()" class="btn btn-success fw-bold">
                <i class="bi bi-printer me-1"></i> Imprimer
            </button>
        </div>
    </div>

    {{-- ALERTE SUCCÈS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-print-none mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- FICHE FACTURE / REÇU (ZONE IMPRIMABLE) --}}
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm printable-area">
                <div class="card-body p-4 p-md-5">

                    {{-- EN-TÊTE FACTURE & LOGO SEN DISTRIBUTION --}}
                    <div class="row align-items-center border-bottom pb-4 mb-4">
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-primary text-white rounded p-2 d-inline-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                    <i class="bi bi-shop fs-3"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold text-primary mb-0">SEN DISTRIBUTION</h4>
                                    <small class="text-muted">Commerce & Distribution Générale</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-end">
                            <h5 class="fw-bold text-dark mb-1">FACTURE</h5>
                            <span class="badge bg-light text-dark border">
    N° {{ $order->invoice_number ?? 'VTE-' . str_pad($order->id ?? 0, 5, '0', STR_PAD_LEFT) }}
</span>
                            <div class="small text-muted mt-1">
                                Date : {{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : now()->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>

                    {{-- INFORMATIONS CLIENT & REÇU --}}
                    <div class="row mb-4">
                        <div class="col-6">
                            <span class="text-muted small fw-semibold d-block mb-1">Informations Client :</span>
                            <h6 class="fw-bold text-dark mb-1">{{ $order->client->name ?? $order->client->nom ?? 'Client Comptoir' }}</h6>
                            <p class="text-muted small mb-0">Tél : {{ $order->client->phone ?? $order->phone ?? '-' }}</p>
                        </div>
                        <div class="col-6 text-end">
                            <span class="text-muted small fw-semibold d-block mb-1">Mode de Règlement :</span>
                            <h6 class="fw-bold text-dark mb-1">{{ ucfirst($order->payment_method ?? 'Espèces') }}</h6>
                            <p class="text-muted small mb-0">
                                Statut : <span class="text-success fw-bold"><i class="bi bi-check-circle me-1"></i>Payé</span>
                            </p>
                        </div>
                    </div>

                    {{-- TABLEAU DES ARTICLES ACHETÉS --}}
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light small text-muted">
                                <tr>
                                    <th>Désignation Produit</th>
                                    <th class="text-end" style="width: 120px;">Prix Unitaire</th>
                                    <th class="text-center" style="width: 90px;">Qté</th>
                                    <th class="text-end" style="width: 140px;">Montant Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($order->items as $item)
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-dark small">{{ $item->product->name ?? $item->product->nom ?? 'Produit' }}</div>
                                        </td>
                                        <td class="text-end small">
                                            {{ number_format($item->price, 0, ',', ' ') }} FCFA
                                        </td>
                                        <td class="text-center fw-semibold small">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="text-end fw-bold text-dark small">
                                            {{ number_format($item->price * $item->quantity, 0, ',', ' ') }} FCFA
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-3 text-muted">
                                            Aucun article associé à cette commande.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- RÉCAPITULATIF FINANCIER --}}
                    <div class="row justify-content-end mb-4">
                        <div class="col-md-6 col-lg-5">
                            <div class="border rounded p-3 bg-light">
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted">Sous-total :</span>
                                    <span>{{ number_format(($order->total + ($order->discount ?? 0)), 0, ',', ' ') }} FCFA</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted">Remise accordée :</span>
                                    <span class="text-danger">- {{ number_format($order->discount ?? 0, 0, ',', ' ') }} FCFA</span>
                                </div>
                                <hr class="my-2">
                                <div class="d-flex justify-content-between fs-5 fw-bold text-primary">
                                    <span>Net à payer :</span>
                                    <span>{{ number_format($order->total, 0, ',', ' ') }} FCFA</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PIED DE PAGE & MESSAGE DE REMERCIEMENT --}}
                    <div class="text-center border-top pt-4 mt-4">
                        <p class="fw-bold text-dark mb-1">Merci pour votre confiance !</p>
                        <small class="text-muted d-block">SEN DISTRIBUTION - Dakar, Sénégal | Service Client : +221 33 000 00 00</small>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

{{-- CSS SPÉCIFIQUE POUR L'IMPRESSION DIRECTE --}}
<style>
    @media print {
        body {
            background-color: #fff !important;
        }
        .d-print-none {
            display: none !important;
        }
        .printable-area {
            box-shadow: none !important;
            border: none !important;
            width: 100% !important;
        }
        .card-body {
            padding: 0 !important;
        }
    }
</style>
@endsection