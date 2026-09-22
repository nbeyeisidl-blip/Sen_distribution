@extends('client.layouts.app')


@section('content')
<div class="container my-5">
    <div class="mb-4">
        <h2 class="fw-bold"><i class="bi bi-cart3 me-2 text-primary"></i>Mon Panier</h2>
        <p class="text-muted">Consultez les articles de votre panier avant de commander.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(empty($cart) || count($cart) == 0)
        <div class="card border-0 shadow-sm text-center py-5 rounded-3">
            <div class="card-body">
                <i class="bi bi-cart-x display-1 text-muted mb-3 d-block"></i>
                <h4 class="fw-bold text-secondary">Votre panier est vide</h4>
                <a href="{{ route('client.home') }}" class="btn btn-primary rounded-pill px-4 mt-3">
                    <i class="bi bi-bag-plus me-2"></i>Découvrir nos produits
                </a>
            </div>
        </div>
    @else
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Produit</th>
                                    <th>Prix</th>
                                    <th style="width: 140px;">Quantité</th>
                                    <th>Total</th>
                                    <th class="text-end pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($cart as $id => $item)
                                    @php 
                                        $subtotal = $item['price'] * $item['quantity']; 
                                        $total += $subtotal; 
                                    @endphp
                                    <tr>
                                        <td class="ps-4">
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

                                                <span class="fw-semibold text-dark">{{ $item['name'] }}</span>
                                            </div>
                                        </td>
                                        <td>{{ number_format($item['price'], 0, ',', ' ') }} FCFA</td>
                                        <td>
                                            <!-- Formulaire de mise à jour de la quantité -->
                                            <form action="{{ route('client.cart.update', $id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm text-center" style="width: 65px;" onchange="this.form.submit()">
                                            </form>
                                        </td>
                                        <td class="fw-bold text-dark">{{ number_format($subtotal, 0, ',', ' ') }} FCFA</td>
                                        <td class="text-end pe-4">
                                            <!-- Formulaire de suppression -->
                                            <form action="{{ route('client.cart.remove', $id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Supprimer cet article ?')">
                                                    <i class="bi bi-trash fs-5"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Total et validation -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3 border-bottom pb-2">Récapitulatif</h5>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Sous-total</span>
                            <span class="fw-semibold">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="fw-bold fs-5">Total</span>
                            <strong class="text-primary fs-4">{{ number_format($total, 0, ',', ' ') }} FCFA</strong>
                        </div>
                        <a href="{{ route('client.checkout.index') }}" class="btn btn-primary w-100 py-3 fw-bold rounded-pill shadow-sm">
                            <i class="bi bi-credit-card me-2"></i> Valider la commande
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection