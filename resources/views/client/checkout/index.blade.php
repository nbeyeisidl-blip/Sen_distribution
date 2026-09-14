@extends('client.layouts.app')

@section('title', 'Validation de la commande')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4"><i class="bi bi-credit-card me-2"></i>Validation de votre commande</h2>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Formulaire de Livraison -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4">
                <h4 class="h5 fw-bold mb-3">Informations de livraison & Paiement</h4>
                <hr class="mb-4">

                <form action="{{ route('client.checkout.store') }}" method="POST">
                    @csrf

                    <!-- Adresse de livraison -->
                    <div class="mb-3">
                        <label for="shipping_address" class="form-label fw-semibold">Adresse de livraison <span class="text-danger">*</span></label>
                        <textarea name="shipping_address" id="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror" rows="3" placeholder="Saisissez votre adresse complète (Quartier, Rue, Ville...)" required>{{ old('shipping_address') }}</textarea>
                        @error('shipping_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Numéro de téléphone -->
                    <div class="mb-3">
                        <label for="phone" class="form-label fw-semibold">Numéro de téléphone <span class="text-danger">*</span></label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Ex: +221 77 000 00 00" value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Notes additionnelles -->
                    <div class="mb-4">
                        <label for="notes" class="form-label fw-semibold">Notes / Instructions spécifiques (Optionnel)</label>
                        <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" rows="2" placeholder="Indications complémentaires pour le livreur...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mode de paiement -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Mode de paiement</label>
                        <div class="form-check p-3 border rounded mb-2 bg-light">
                            <input class="form-check-input" type="radio" name="payment_method" id="pay_cash" value="cash" checked>
                            <label class="form-check-label fw-bold" for="pay_cash">
                                <i class="bi bi-cash-stack text-success me-2"></i>Paiement à la livraison
                            </label>
                            <p class="text-muted small mb-0 mt-1">Payez en espèces lorsque le livreur arrive chez vous.</p>
                        </div>
                    </div>

                    <!-- Bouton de confirmation -->
                    <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm fw-bold">
                        <i class="bi bi-check-circle me-2"></i>Confirmer la commande
                    </button>
                </form>
            </div>
        </div>

        <!-- Récapitulatif du Panier -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm p-4 bg-light">
                <h4 class="h5 fw-bold mb-3">Résumé du panier</h4>
                <hr>

                <ul class="list-group list-group-flush mb-3 bg-transparent">
                    @foreach($cart as $id => $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            <div>
                                <h6 class="my-0 fw-semibold">{{ $item['name'] }}</h6>
                                <small class="text-muted">Quantité : {{ $item['quantity'] }} x {{ number_format($item['price'], 0, ',', ' ') }} FCFA</small>
                            </div>
                            <span class="fw-bold text-dark">{{ number_format($item['price'] * $item['quantity'], 0, ',', ' ') }} FCFA</span>
                        </li>
                    @endforeach
                </ul>

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted">Sous-total</span>
                    <span class="fw-bold">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Frais de livraison</span>
                    <span class="text-success fw-bold">Calculés à la livraison</span>
                </div>

                <div class="d-flex justify-content-between align-items-center p-3 bg-white rounded border">
                    <span class="h5 mb-0 fw-bold">Total Général</span>
                    <span class="h4 mb-0 fw-bold text-primary">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection