<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture #{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }} - SEN DISTRIBUTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .receipt-card {
            max-width: 800px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white;
            }
            .receipt-card {
                box-shadow: none;
                margin: 0;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    {{-- Barre de commandes (Non imprimable) --}}
    <div class="d-flex justify-content-between align-items-center my-4 no-print" style="max-width: 800px; margin: auto;">
        <a href="{{ route('cashier.sales.index') }}" class="btn btn-outline-secondary fw-semibold">
            <i class="bi bi-arrow-left me-2"></i>Retour aux ventes
        </a>
        <button onclick="window.print()" class="btn btn-primary fw-bold shadow-sm">
            <i class="bi bi-printer me-2"></i>Imprimer la facture
        </button>
    </div>

    {{-- Carte Facture --}}
    <div class="card border-0 p-4 p-md-5 receipt-card">
        <!-- Entête -->
        <div class="row align-items-center mb-4">
            <div class="col-sm-6">
                <h2 class="fw-bold text-primary mb-1">SEN DISTRIBUTION</h2>
                <p class="text-muted small mb-0">Commerce & Distribution de Produits</p>
                <p class="text-muted small mb-0">Dakar, Sénégal</p>
                <p class="text-muted small mb-0">Tél: +221 33 000 00 00</p>
            </div>
            <div class="col-sm-6 text-sm-end mt-3 mt-sm-0">
                <h4 class="fw-bold text-uppercase text-secondary mb-1">FACTURE</h4>
                <p class="mb-0 fw-bold">N° : <span class="text-danger">#{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}</span></p>
                <p class="text-muted small mb-0">Date : {{ $sale->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <hr class="my-3">

        <!-- Informations Client & Caissier -->
        <div class="row mb-4">
            <div class="col-6">
                <h6 class="text-muted text-uppercase small fw-bold">Facturé à :</h6>
                <p class="fw-semibold mb-0 text-dark">
                    {{ $sale->client->name ?? $sale->client_name ?? 'Client comptant' }}
                </p>
                @if(isset($sale->client->email))
                    <p class="text-muted small mb-0">{{ $sale->client->email }}</p>
                @endif
            </div>
            <div class="col-6 text-end">
                <h6 class="text-muted text-uppercase small fw-bold">Caissier / Opérateur :</h6>
                <p class="fw-semibold mb-0 text-dark">
                    {{ $sale->user->name ?? Auth::user()->name ?? 'Caisse Principale' }}
                </p>
            </div>
        </div>

        <!-- Tableau des produits -->
        <div class="table-responsive mb-4">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-uppercase small">
                    <tr>
                        <th scope="col">Désignation</th>
                        <th scope="col" class="text-center" style="width: 120px;">Prix Unit.</th>
                        <th scope="col" class="text-center" style="width: 90px;">Qté</th>
                        <th scope="col" class="text-end" style="width: 140px;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sale->items ?? $sale->saleDetails ?? [] as $item)
                        <tr>
                            <td>
                                <span class="fw-semibold">{{ $item->product->name ?? $item->product_name ?? 'Produit' }}</span>
                            </td>
                            <td class="text-center">
                                {{ number_format($item->price ?? $item->unit_price ?? 0, 0, ',', ' ') }} FCFA
                            </td>
                            <td class="text-center fw-bold">{{ $item->quantity ?? $item->qte }}</td>
                            <td class="text-end fw-bold">
                                {{ number_format(($item->quantity ?? $item->qte) * ($item->price ?? $item->unit_price ?? 0), 0, ',', ' ') }} FCFA
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-3 text-muted">
                                Aucun détail disponible pour cette vente.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Total -->
        <div class="row justify-content-end mb-4">
            <div class="col-md-5">
                <div class="p-3 bg-light rounded-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Mode de paiement :</span>
                        <span class="fw-semibold text-capitalize">{{ $sale->payment_method ?? 'Espèces' }}</span>
                    </div>
                    <hr class="my-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold fs-5 text-dark">Total Net :</span>
                        <span class="fw-bold fs-4 text-primary">
                            {{ number_format($sale->total_amount ?? $sale->montant_total ?? 0, 0, ',', ' ') }} FCFA
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pied de page -->
        <div class="text-center mt-4 pt-3 border-top text-muted small">
            <p class="mb-1 fw-semibold">Merci de votre confiance et à bientôt !</p>
            <p class="mb-0">SEN DISTRIBUTION - La qualité au service de vos besoins.</p>
        </div>
    </div>
</div>

</body>
</html>