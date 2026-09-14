@extends('admin.layouts.app')

@section('title', 'Détail de la vente')

@section('page-title', 'Détail de la vente')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="fw-bold">
            Vente #{{ $sale->id }}
        </h3>

        <p class="text-muted">
            {{ $sale->created_at->format('d/m/Y à H:i') }}
        </p>

    </div>

    <button onclick="window.print()"
            class="btn btn-dark">

        <i class="bi bi-printer"></i>
        Imprimer

    </button>

</div>


<div class="card shadow-sm border-0">

    <div class="card-body p-4">

        {{-- EN-TÊTE --}}

        <div class="row mb-4">

            <div class="col-md-6">

                <h3 class="fw-bold">
                    SEN DISTRIBUTION
                </h3>

                <p class="text-muted mb-0">
                    Gestion des ventes et des stocks
                </p>

            </div>

            <div class="col-md-6 text-md-end">

                <h4>
                    FACTURE
                </h4>

                <p class="mb-0">
                    N° #{{ $sale->id }}
                </p>

                <p class="mb-0">
                    {{ $sale->created_at->format('d/m/Y H:i') }}
                </p>

            </div>

        </div>

        <hr>


        {{-- CLIENT --}}

        <div class="row mb-4">

            <div class="col-md-6">

                <strong>Client :</strong>

                @if($sale->client)

                    <p class="mb-0">

                        {{ $sale->client->nom }}
                        {{ $sale->client->prenom }}

                    </p>

                    @if($sale->client->telephone)

                        <p class="mb-0">
                            {{ $sale->client->telephone }}
                        </p>

                    @endif

                    @if($sale->client->email)

                        <p class="mb-0">
                            {{ $sale->client->email }}
                        </p>

                    @endif

                @else

                    <p class="text-muted">
                        Client comptoir
                    </p>

                @endif

            </div>

            <div class="col-md-6 text-md-end">

                <strong>
                    Mode de paiement :
                </strong>

                <p>
                    {{ $sale->payment_method }}
                </p>

            </div>

        </div>


        {{-- PRODUITS --}}

        <div class="table-responsive">

            <table class="table table-bordered">

                <thead class="table-light">

                    <tr>

                        <th>Produit</th>
                        <th class="text-center">Quantité</th>
                        <th class="text-end">Prix</th>
                        <th class="text-end">Sous-total</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($sale->items as $item)

                        <tr>

                            <td>
                                {{ $item->product->name }}
                            </td>

                            <td class="text-center">
                                {{ $item->quantity }}
                            </td>

                            <td class="text-end">

                                {{ number_format($item->price, 0, ',', ' ') }}
                                FCFA

                            </td>

                            <td class="text-end">

                                {{ number_format($item->subtotal, 0, ',', ' ') }}
                                FCFA

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        {{-- TOTAL --}}

        <div class="row justify-content-end">

            <div class="col-md-5">

                <div class="d-flex justify-content-between">

                    <span>
                        Total :
                    </span>

                    <strong class="fs-4">

                        {{ number_format($sale->total, 0, ',', ' ') }}
                        FCFA

                    </strong>

                </div>

            </div>

        </div>


        <hr>

        <div class="text-center text-muted">

            <p class="mb-0">
                Merci pour votre confiance.
            </p>

            <small>
                SEN DISTRIBUTION
            </small>

        </div>

    </div>

</div>


<style>

@media print {

    body * {
        visibility: hidden;
    }

    .card,
    .card * {
        visibility: visible;
    }

    .card {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        box-shadow: none !important;
    }

    .btn {
        display: none !important;
    }

}

</style>

@endsection