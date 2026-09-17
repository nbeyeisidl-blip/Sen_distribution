@extends('admin.layouts.app')

@section('title', 'Nouvelle vente')
@section('page-title', 'Nouvelle vente')

@section('content')

{{-- 1. LA BALISE FORM ENGLOBE TOUT LE CONTENU --}}
<form method="POST" action="{{ route('admin.sales.store') }}">
    @csrf

    <div class="row">
        {{-- COLONNE GAUCHE : PRODUITS --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-4"><i class="bi bi-cart-plus"></i> Produits</h5>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Produit</th>
                                    <th>Prix</th>
                                    <th>Stock</th>
                                    <th width="150">Quantité</th>
                                    <th>Sous-total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr class="product-row" data-price="{{ $product->price }}">
                                        <td>
                                            <strong>{{ $product->name }}</strong>
                                            <input type="hidden" name="products[{{ $loop->index }}][id]" value="{{ $product->id }}">
                                        </td>
                                        <td>{{ number_format($product->price, 0, ',', ' ') }} FCFA</td>
                                        <td><span class="badge bg-primary">{{ $product->stock }}</span></td>
                                        <td>
                                            <input type="number" 
                                                   name="products[{{ $loop->index }}][quantity]" 
                                                   class="form-control quantity" 
                                                   min="0" 
                                                   max="{{ $product->stock }}" 
                                                   value="{{ old('products.'.$loop->index.'.quantity', 0) }}">
                                        </td>
                                        <td><strong class="subtotal">0 FCFA</strong></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- COLONNE DROITE : CLIENT, PAIEMENT & BOUTON --}}
        <div class="col-lg-4">
            {{-- CLIENT --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3"><i class="bi bi-person"></i> Client</h5>
                    <select name="client_id" id="client_id" class="form-select">
                        <option value="">Client comptoir / Client de passage</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">
                                {{ $client->nom }} {{ $client->prenom ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- PAIEMENT --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3"><i class="bi bi-credit-card"></i> Paiement</h5>
                    <select name="payment_method" class="form-select" required>
                        <option value="Espèces">Espèces</option>
                        <option value="Wave">Wave</option>
                        <option value="Orange Money">Orange Money</option>
                        <option value="Carte bancaire">Carte bancaire</option>
                    </select>
                </div>
            </div>

            {{-- TOTAL & ACTION --}}
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <span>Nombre d'articles</span>
                        <strong id="total-items">0</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fs-5">TOTAL</span>
                        <strong class="fs-4 text-primary" id="total">0 FCFA</strong>
                    </div>

                    {{-- BOUTON SUBMIT INDISPENSABLE --}}
                    <button type="submit" class="btn btn-success w-100 py-2">
                        <i class="bi bi-check-circle me-1"></i> Enregistrer la vente
                    </button>
                    <a href="{{ route('admin.sales.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                        Annuler
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('.product-row');
    const totalElement = document.getElementById('total');
    const itemsElement = document.getElementById('total-items');

    function calculateTotal() {
        let total = 0;
        let items = 0;

        rows.forEach(function(row) {
            const price = parseFloat(row.dataset.price);
            const quantityInput = row.querySelector('.quantity');
            const subtotalElement = row.querySelector('.subtotal');
            const quantity = parseInt(quantityInput.value) || 0;

            const subtotal = price * quantity;
            total += subtotal;
            items += quantity;

            subtotalElement.textContent = subtotal.toLocaleString('fr-FR') + ' FCFA';
        });

        totalElement.textContent = total.toLocaleString('fr-FR') + ' FCFA';
        itemsElement.textContent = items;
    }

    rows.forEach(function(row) {
        const quantityInput = row.querySelector('.quantity');
        quantityInput.addEventListener('input', calculateTotal);
        quantityInput.addEventListener('change', calculateTotal);
    });

    calculateTotal();
});
</script>
@endsection