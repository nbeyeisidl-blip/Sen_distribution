@extends('client.layouts.app')

@section('content')
<div class="container my-5">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <h6 class="fw-bold mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Veuillez corriger les champs suivants :</h6>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="mb-4">
        <h2 class="fw-bold"><i class="bi bi-credit-card me-2"></i>Caisse & Finalisation</h2>
        <p class="text-muted">Veuillez vérifier vos informations de livraison et valider votre commande.</p>
    </div>
    <form action="{{ route('client.checkout.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            
            <!-- Informations de Livraison & Paiement -->
            <div class="col-lg-7">
                <!-- Adresse de Livraison -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3"><i class="bi bi-geo-alt me-2 text-primary"></i>Adresse de livraison</h5>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label fw-semibold">Prénom</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', Auth::user()->first_name ?? '') }}" required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="last_name" class="form-label fw-semibold">Nom</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', Auth::user()->name ?? '') }}" required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-semibold">Téléphone</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}" placeholder="77 000 00 00" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="city" class="form-label fw-semibold">Ville / Région</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', 'Dakar') }}" required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label fw-semibold">Adresse exacte</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2" placeholder="Quartier, rue, numéro de maison..." required>{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mode de Paiement -->
<div class="card border-0 shadow-sm rounded-3 mb-4">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-3"><i class="bi bi-wallet2 me-2 text-primary"></i>Mode de paiement <span class="text-danger">*</span></h5>

        @error('payment_method')
            <div class="alert alert-danger py-2 small mb-3">
                <i class="bi bi-exclamation-triangle me-1"></i> Veuillez choisir un mode de paiement.
            </div>
        @enderror

        <div class="d-flex flex-column gap-3">
            
            <!-- Wave -->
            <label class="form-check p-3 border rounded-3 d-flex align-items-center justify-content-between cursor-pointer payment-option">
                <div class="d-flex align-items-center">
                    <input class="form-check-input me-3" type="radio" name="payment_method" id="payment_wave" value="wave" {{ old('payment_method') == 'wave' ? 'checked' : '' }} required>
                    <div>
                        <div class="fw-bold text-dark">Wave</div>
                        <div class="text-muted small">Paiement instantané via votre compte Wave</div>
                    </div>
                </div>
                <span class="badge bg-info text-dark fw-bold px-3 py-2">Wave</span>
            </label>

            <!-- Orange Money -->
            <label class="form-check p-3 border rounded-3 d-flex align-items-center justify-content-between cursor-pointer payment-option">
                <div class="d-flex align-items-center">
                    <input class="form-check-input me-3" type="radio" name="payment_method" id="payment_om" value="orange_money" {{ old('payment_method') == 'orange_money' ? 'checked' : '' }}>
                    <div>
                        <div class="fw-bold text-dark">Orange Money</div>
                        <div class="text-muted small">Paiement mobile sécurisé par code #144#</div>
                    </div>
                </div>
                <span class="badge bg-warning text-dark fw-bold px-3 py-2">OM</span>
            </label>

            <!-- Paiement à la livraison -->
            <label class="form-check p-3 border rounded-3 d-flex align-items-center justify-content-between cursor-pointer payment-option">
                <div class="d-flex align-items-center">
                    <input class="form-check-input me-3" type="radio" name="payment_method" id="payment_cash" value="cash" {{ old('payment_method', 'cash') == 'cash' ? 'checked' : '' }}>
                    <div>
                        <div class="fw-bold text-dark">Paiement à la livraison</div>
                        <div class="text-muted small">Payez en espèces dès réception de votre colis</div>
                    </div>
                </div>
                <i class="bi bi-cash-stack fs-3 text-success"></i>
            </label>

        </div>
    </div>
</div>
            </div>

            <!-- Récapitulatif du Panier -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-3 sticky-top" style="top: 20px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3 border-bottom pb-2"><i class="bi bi-bag-check me-2 text-primary"></i>Récapitulatif de la commande</h5>

                        <ul class="list-group list-group-flush mb-3">
                            @foreach($cart as $id => $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        @if(!empty($item['image']))
    <img src="{{ Str::startsWith($item['image'], 'http') ? $item['image'] : asset('images/products/' . ltrim(basename($item['image']), '/')) }}" 
         alt="{{ $item['name'] }}" 
         class="rounded me-3 border" 
         style="width: 50px; height: 50px; object-fit: cover;">
@else
    <div class="bg-light rounded border me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
        <i class="bi bi-image text-muted"></i>
    </div>
                                        @endif
                                        <div>
                                            <h6 class="my-0 fw-semibold">{{ $item['name'] }}</h6>
                                            <small class="text-muted">Quantité : {{ $item['quantity'] }} × {{ number_format($item['price'], 0, ',', ' ') }} FCFA</small>
                                        </div>
                                    </div>
                                    <span class="fw-semibold text-dark">{{ number_format($item['price'] * $item['quantity'], 0, ',', ' ') }} FCFA</span>
                                </li>
                            @endforeach
                        </ul>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Sous-total</span>
                            <span class="fw-semibold">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Frais de livraison</span>
                            <span class="text-success fw-semibold">À définir à la livraison</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="fw-bold fs-5">Total</span>
                            <strong class="text-primary fs-4">{{ number_format($total, 0, ',', ' ') }} FCFA</strong>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-pill shadow-sm">
                            <i class="bi bi-check-circle me-2"></i> Confirmer la commande
                        </button>

                        <a href="{{ route('client.cart.index') }}" class="btn btn-link w-100 mt-2 text-decoration-none text-muted small">
                            <i class="bi bi-arrow-left me-1"></i> Modifier le panier
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection