@extends('admin.layouts.app')

@section('title', 'Nouvelle entrée de stock')

@section('page-title', 'Nouvelle entrée de stock')

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h3 class="fw-bold">
                        <i class="bi bi-box-arrow-in-down"></i>
                        Nouvelle entrée de stock
                    </h3>

                    <p class="text-muted">
                        Ajouter des produits au stock
                    </p>
                </div>

                <a href="{{ route('admin.stock.index') }}"
                   class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>
                    Retour

                </a>

            </div>


            {{-- ERREURS --}}

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form method="POST"
                  action="{{ route('admin.stock_entries.store') }}">

                @csrf


                {{-- FOURNISSEUR --}}

                <div class="row mb-4">

                    <div class="col-md-6">

                        <label class="form-label fw-bold">
                            Fournisseur
                        </label>

                        <select name="fournisseur_id"
                                class="form-select">

                            <option value="">
                                -- Aucun fournisseur --
                            </option>

                            @foreach($fournisseurs as $fournisseur)

                                <option value="{{ $fournisseur->id }}">

                                    {{ $fournisseur->nom }}

                                    @if($fournisseur->entreprise)
                                        - {{ $fournisseur->entreprise }}
                                    @endif

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-bold">
                            Observation
                        </label>

                        <input type="text"
                               name="observation"
                               class="form-control"
                               placeholder="Ex : Réception marchandises">

                    </div>

                </div>


                {{-- PRODUITS --}}

                <h5 class="fw-bold mb-3">
                    Produits reçus
                </h5>

                <div class="table-responsive">

                    <table class="table table-bordered align-middle">

                        <thead class="table-light">

                            <tr>

                                <th>Produit</th>

                                <th>Stock actuel</th>

                                <th width="200">
                                    Quantité reçue
                                </th>

                                <th width="220">
                                    Prix d'achat
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($products as $product)

                                <tr>

                                    <td>

                                        <input type="hidden"
                                               name="products[{{ $product->id }}][id]"
                                               value="{{ $product->id }}">

                                        <strong>
                                            {{ $product->name }}
                                        </strong>

                                    </td>


                                    <td>

                                        @if($product->stock > 10)

                                            <span class="badge bg-success">
                                                {{ $product->stock }}
                                            </span>

                                        @elseif($product->stock > 0)

                                            <span class="badge bg-warning text-dark">
                                                {{ $product->stock }}
                                            </span>

                                        @else

                                            <span class="badge bg-danger">
                                                0
                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        <input type="number"
                                               name="products[{{ $product->id }}][quantity]"
                                               class="form-control"
                                               min="0"
                                               value="0">

                                    </td>


                                    <td>

                                        <div class="input-group">

                                            <input type="number"
                                                   name="products[{{ $product->id }}][purchase_price]"
                                                   class="form-control"
                                                   min="0"
                                                   step="0.01"
                                                   value="0">

                                            <span class="input-group-text">
                                                FCFA
                                            </span>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4"
                                        class="text-center py-4">

                                        <i class="bi bi-box-seam fs-1 text-muted"></i>

                                        <p class="text-muted mt-2">
                                            Aucun produit disponible.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- BOUTONS --}}

                <div class="mt-4">

                    <button type="submit"
                            class="btn btn-success">

                        <i class="bi bi-check-circle"></i>

                        Enregistrer l'entrée

                    </button>

                    <a href="{{ route('admin.stock.index') }}"
                       class="btn btn-secondary">

                        Annuler

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection