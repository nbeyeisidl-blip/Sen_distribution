@extends('admin.layouts.app')

@section('content')

<div class="container-fluid py-4">

    {{-- EN-TÊTE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">
                <i class="bi bi-box-arrow-in-down"></i>
                Entrée de stock #{{ $stockEntry->id }}
            </h2>

            <p class="text-muted mb-0">
                Détails de l'entrée de stock
            </p>
        </div>

        <a href="{{ route('admin.stock_entries.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>
            Retour
        </a>

    </div>


    {{-- INFORMATIONS --}}
    <div class="row g-4 mb-4">

        {{-- FOURNISSEUR --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Fournisseur
                    </h6>

                    @if($stockEntry->fournisseur)

                        <h5 class="fw-bold">
                            {{ $stockEntry->fournisseur->nom }}
                        </h5>

                    @else

                        <span class="text-muted">
                            Aucun fournisseur
                        </span>

                    @endif

                </div>

            </div>

        </div>


        {{-- DATE --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Date
                    </h6>

                    <h5 class="fw-bold">

                        {{ $stockEntry->created_at
                            ? $stockEntry->created_at->format('d/m/Y H:i')
                            : '-' }}

                    </h5>

                </div>

            </div>

        </div>


        {{-- TOTAL --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Total
                    </h6>

                    <h4 class="fw-bold text-primary">

                        {{ number_format(
                            $stockEntry->total,
                            0,
                            ',',
                            ' '
                        ) }}

                        FCFA

                    </h4>

                </div>

            </div>

        </div>

    </div>


    {{-- OBSERVATION --}}
    @if($stockEntry->observation)

        <div class="alert alert-info">

            <strong>
                <i class="bi bi-info-circle"></i>
                Observation :
            </strong>

            {{ $stockEntry->observation }}

        </div>

    @endif


    {{-- PRODUITS --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <h5 class="mb-0 fw-bold">

                <i class="bi bi-box-seam"></i>
                Produits reçus

            </h5>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>#</th>

                            <th>Produit</th>

                            <th>Quantité</th>

                            <th>Prix d'achat</th>

                            <th>Sous-total</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($stockEntry->items as $item)

                            <tr>

                                <td>
                                    {{ $item->id }}
                                </td>

                                <td>

                                    @if($item->product)

                                        <strong>
                                            {{ $item->product->name }}
                                        </strong>

                                    @else

                                        <span class="text-danger">
                                            Produit supprimé
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <span class="badge bg-primary">

                                        {{ $item->quantity }}

                                    </span>

                                </td>

                                <td>

                                    {{ number_format(
                                        $item->purchase_price,
                                        0,
                                        ',',
                                        ' '
                                    ) }}

                                    FCFA

                                </td>

                                <td class="fw-bold">

                                    {{ number_format(
                                        $item->subtotal,
                                        0,
                                        ',',
                                        ' '
                                    ) }}

                                    FCFA

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center py-4">

                                    <i class="bi bi-inbox fs-1 text-muted"></i>

                                    <p class="text-muted mb-0">
                                        Aucun produit dans cette entrée.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>


                    <tfoot>

                        <tr>

                            <th colspan="4"
                                class="text-end">

                                TOTAL

                            </th>

                            <th class="text-primary">

                                {{ number_format(
                                    $stockEntry->total,
                                    0,
                                    ',',
                                    ' '
                                ) }}

                                FCFA

                            </th>

                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection