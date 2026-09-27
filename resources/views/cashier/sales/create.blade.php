@extends('cashier.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="fw-bold mb-0">Nouvelle Vente</h4>
            <p class="text-muted small mb-0">Interface Point de Vente (POS) — SEN DISTRIBUTION</p>
        </div>
        <a href="{{ route('cashier.dashboard') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Tableau de bord
        </a>
    </div>

    <!-- Notifications Flash -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-3">
        <!-- CÔTÉ GAUCHE : PANIER & FORMULAIRE -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-3 bg-white p-3">
                
                <form action="{{ route('cashier.sales.store') }}" method="POST">
                    @csrf

                    <!-- Sélection du Client (SANS 'required') -->
                    <div class="mb-3">
                        <label for="client_id" class="form-label fw-bold text-secondary small mb-1">CLIENT</label>
                        <select name="client_id" id="client_id" class="form-select border-1">
                            <option value="">-- Client de passage (Anonyme) --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">
                                    {{ $client->name }} {{ $client->phone ? '('.$client->phone.')' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tableau du Panier -->
                    <div class="table-responsive mb-3" style="min-height: 200px; max-height: 350px; overflow-y: auto;">
                        <table class="table align-middle table-hover">
                            <thead class="table-light sticky-top">
                                <tr class="small text-muted">
                                    <th>Produit</th>
                                    <th class="text-center">Prix U.</th>
                                    <th class="text-center">Qté</th>
                                    <th class="text-end">Total</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cart as $id => $item)
                                    <tr>
                                        <td class="fw-semibold text-dark">{{ $item['name'] }}</td>
                                        <td class="text-center">{{ number_format($item['price'], 0, ',', ' ') }} FCFA</td>
                                        <td class="text-center">
                                            <span class="badge bg-light text-dark border px-2 py-1">{{ $item['quantity'] }}</span>
                                        </td>
                                        <td class="text-end fw-bold">{{ number_format($item['price'] * $item['quantity'], 0, ',', ' ') }} FCFA</td>
                                        <td class="text-end">
                                            <a href="{{ route('cashier.cart.remove', $id) }}" class="btn btn-sm btn-outline-danger border-0">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-5">
                                            <i class="bi bi-cart-x fs-2 d-block mb-2 opacity-50"></i>
                                            Panier vide. Cliquez sur un produit dans le catalogue à droite.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Totaux & Récapitulatif -->
                    <div class="bg-light p-3 rounded-3 mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Sous-total :</span>
                            <span class="fw-semibold">{{ number_format($subtotal, 0, ',', ' ') }} FCFA</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Remise (FCFA) :</span>
                            <input type="number" name="discount" class="form-control form-control-sm w-25 text-end" value="0" min="0">
                        </div>
                        <hr class="my-2">
                        <div class="d-flex justify-content-between fs-5 fw-bold text-primary">
                            <span>Total net :</span>
                            <span>{{ number_format($subtotal, 0, ',', ' ') }} FCFA</span>
                        </div>
                    </div>

                    <!-- Mode de paiement -->
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary small mb-2">MODE DE PAIEMENT</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="especes" value="Espèces" checked>
                                <label class="form-check-label fw-semibold" for="especes">Espèces</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="wave" value="Wave">
                                <label class="form-check-label fw-semibold" for="wave">Wave</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="om" value="Orange Money">
                                <label class="form-check-label fw-semibold" for="om">Orange Money</label>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'actions -->
                    <div class="row g-2">
                        <div class="col-4">
                            <a href="{{ route('cashier.cart.clear') }}" class="btn btn-outline-secondary w-100 fw-semibold">Annuler</a>
                        </div>
                        <div class="col-8">
                            <button type="submit" class="btn btn-primary w-100 fw-semibold {{ empty($cart) ? 'disabled' : '' }}">
                                <i class="bi bi-check-circle me-1"></i>Valider la vente
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

        <!-- CÔTÉ DROIT : CATALOGUE PRODUITS -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-3 bg-white p-3">
                <h6 class="fw-bold mb-3">Catalogue Produits</h6>
                
                <div class="input-group mb-3">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" id="searchProduct" class="form-control bg-light border-start-0" placeholder="Rechercher un produit...">
                </div>

                <div class="row g-2 overflow-auto" style="max-height: 520px;" id="productList">
                    @forelse($products as $product)
                        <div class="col-6 product-item">
                            <div class="card h-100 border p-2 text-center rounded-3 bg-light shadow-2-hover">
                                <h6 class="fw-bold text-dark mb-1 small text-truncate" title="{{ $product->name }}">{{ $product->name }}</h6>
                                <p class="text-muted extra-small mb-1">Stock : {{ $product->stock }}</p>
                                <p class="fw-bold text-primary mb-2 small">{{ number_format($product->price, 0, ',', ' ') }} FCFA</p>
                                <a href="{{ route('cashier.sales.create', ['product_id' => $product->id]) }}" 
                                   class="btn btn-sm btn-primary w-100 py-1 extra-small fw-semibold">
                                   + Vendre
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-4 text-muted">Aucun produit disponible</div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

</div>

<!-- Recherche dynamique JS côté client -->
<script>
    document.getElementById('searchProduct').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let items = document.querySelectorAll('.product-item');
        items.forEach(function(item) {
            let name = item.querySelector('h6').textContent.toLowerCase();
            if(name.includes(filter)) {
                item.style.display = "";
            } else {
                item.style.display = "none";
            }
        });
    });
</script>

<style>
    .extra-small { font-size: 0.75rem; }
</style>
@endsection