@extends('admin.layouts.app')


@section('title', 'Modifier la vente #' . $sale->id)

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Modifier la Vente #{{ $sale->id }}</h1>
        <a href="{{ route('admin.sales.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Retour à la liste
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.sales.update', $sale->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            {{-- Colonne de gauche : Informations Client et Paiement --}}
            <div class="col-lg-4 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white py-3">
                        <h6 class="m-0 fw-bold">Informations de la Vente</h6>
                    </div>
                    <div class="card-body">
                        {{-- Client --}}
                        <div class="mb-3">
                            <label for="client_id" class="form-label">Client</label>
                            <select name="client_id" id="client_id" class="form-select @error('client_id') is-invalid @enderror">
                                <option value="">Client de passage</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id', $sale->client_id) == $client->id ? 'selected' : '' }}>
                                        {{ $client->nom }} {{ $client->prenom }} {{ $client->telephone ? '('.$client->telephone.')' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Mode de paiement --}}
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Mode de Paiement <span class="text-danger">*</span></label>
                            <select name="payment_method" id="payment_method" class="form-select @error('payment_method') is-invalid @enderror" required>
                                <option value="Espèces" {{ old('payment_method', $sale->payment_method) == 'Espèces' ? 'selected' : '' }}>Espèces</option>
                                <option value="Carte Bancaire" {{ old('payment_method', $sale->payment_method) == 'Carte Bancaire' ? 'selected' : '' }}>Carte Bancaire</option>
                                <option value="Orange Money" {{ old('payment_method', $sale->payment_method) == 'Orange Money' ? 'selected' : '' }}>Orange Money</option>
                                <option value="Wave" {{ old('payment_method', $sale->payment_method) == 'Wave' ? 'selected' : '' }}>Wave</option>
                                <option value="Virement" {{ old('payment_method', $sale->payment_method) == 'Virement' ? 'selected' : '' }}>Virement</option>
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save me-1"></i> Mettre à jour la vente
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Colonne de droite : Sélection des Produits --}}
            <div class="col-lg-8 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white py-3">
                        <h6 class="m-0 fw-bold">Produits de la Vente</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Produit</th>
                                        <th style="width: 150px;">Prix Unitaire</th>
                                        <th style="width: 150px;">Stock En Stock</th>
                                        <th style="width: 160px;">Quantité Vendue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // Transformer les items existants sous forme d'un tableau [product_id => quantity]
                                        $saleItems = $sale->items->pluck('quantity', 'product_id')->toArray();
                                    @endphp

                                    @foreach($products as $index => $product)
                                        @php
                                            $qtyInSale = $saleItems[$product->id] ?? 0;
                                        @endphp
                                        <tr>
                                            <td>
                                                <strong>{{ $product->name }}</strong>
                                                <input type="hidden" name="products[{{ $index }}][id]" value="{{ $product->id }}">
                                            </td>
                                            <td>{{ number_format($product->price, 0, ',', ' ') }} FCFA</td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $product->stock }}</span>
                                            </td>
                                            <td>
                                                <input type="number" 
                                                       name="products[{{ $index }}][quantity]" 
                                                       class="form-control" 
                                                       min="0" 
                                                       value="{{ old("products.{$index}.quantity", $qtyInSale) }}" 
                                                       placeholder="0">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection