@extends('storekeeper.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0"><i class="bi bi-box-arrow-in-down me-2"></i>Nouvelle Entrée de Stock</h5>
                    <a href="{{ route('storekeeper.stock.index') }}" class="btn btn-sm btn-light">
                        <i class="bi bi-arrow-left"></i> Retour au stock
                    </a>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('storekeeper.stock.storeEntry') }}" method="POST">
                        @csrf

                        <!-- Sélection du produit -->
                        <div class="mb-3">
                            <label for="product_id" class="form-label fw-bold">Produit <span class="text-danger">*</span></label>
                            <select name="product_id" id="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
                                <option value="" selected disabled>-- Sélectionnez un produit --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }} (Stock actuel: {{ $product->stock }})
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Quantité à ajouter -->
                        <div class="mb-4">
                            <label for="quantity" class="form-label fw-bold">Quantité Ajoutée <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" placeholder="Ex: 50" value="{{ old('quantity') }}" min="1" required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('storekeeper.stock.index') }}" class="btn btn-secondary">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle me-1"></i> Valider l'entrée
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection