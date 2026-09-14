@extends('client.layouts.app')

@section('title', 'Mon panier - SEN DISTRIBUTION')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold">
            <i class="bi bi-cart3"></i>
            Mon panier
        </h2>

        <p class="text-muted">
            Vérifiez vos produits avant de commander.
        </p>
    </div>

    <a href="{{ route('client.products.index') }}" class="btn btn-outline-primary">
        <i class="bi bi-arrow-left"></i>
        Continuer mes achats
    </a>
</div>

@if(empty($cart))

    <div class="card border-0 shadow-sm">
        <div class="card-body text-center py-5">
            <i class="bi bi-cart-x text-muted" style="font-size: 80px;"></i>
            <h4 class="mt-3">Votre panier est vide</h4>
            <p class="text-muted">Ajoutez des produits à votre panier.</p>
            <a href="{{ route('client.products.index') }}" class="btn btn-primary">
                Voir les produits
            </a>
        </div>
    </div>

@else

<div class="row g-4">

    <!-- PRODUITS -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                @php
                    $subtotal = 0;
                @endphp

                @foreach($cart as $item)

                    @php
                        $totalItem = $item['price'] * $item['quantity'];
                        $subtotal += $totalItem;
                        $imageName = $item['image'] ?? null;
                    @endphp

                    <div class="row align-items-center border-bottom py-3">

                        {{-- Image du produit --}}
                        <div class="col-md-2 text-center mb-2 mb-md-0">
                            <div class="bg-light p-2 rounded" style="height: 90px;">
                                <img src="{{ $imageName && file_exists(public_path('images/products/' . $imageName)) ? asset('images/products/' . $imageName) : asset('images/default-product.png') }}" 
                                     alt="{{ $item['name'] }}" 
                                     class="img-fluid h-100" 
                                     style="object-fit: contain;">
                            </div>
                        </div>

                        {{-- Info Produit --}}
                        <div class="col-md-4">
                            <h6 class="fw-bold mb-1">
                                {{ $item['name'] }}
                            </h6>
                            <span class="text-primary fw-bold">
                                {{ number_format($item['price'], 0, ',', ' ') }} FCFA
                            </span>
                        </div>

                        {{-- Quantité --}}
                        <div class="col-md-3">
                            <form action="{{ route('client.cart.update', $item['id']) }}" method="POST" class="d-flex">
                                @csrf
                                @method('PUT')

                                <input type="number" 
                                       name="quantity" 
                                       value="{{ $item['quantity'] }}" 
                                       min="1" 
                                       class="form-control">

                                <button type="submit" class="btn btn-outline-primary ms-2">
                                    <i class="bi bi-check"></i>
                                </button>
                            </form>
                        </div>

                        {{-- Total du produit --}}
                        <div class="col-md-2 text-end">
                            <strong>
                                {{ number_format($totalItem, 0, ',', ' ') }} F
                            </strong>
                        </div>

                        {{-- Suppression --}}
                        <div class="col-md-1 text-end">
                            <form action="{{ route('client.cart.remove', $item['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>

                    </div>

                @endforeach

            </div>
        </div>

        <form action="{{ route('client.cart.clear') }}" method="POST" class="mt-3">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-outline-danger">
                <i class="bi bi-trash"></i>
                Vider le panier
            </button>
        </form>
    </div>

    <!-- RÉSUMÉ -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Résumé de la commande</h5>

                <div class="d-flex justify-content-between mb-3">
                    <span>Sous-total</span>
                    <strong>{{ number_format($subtotal, 0, ',', ' ') }} FCFA</strong>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span>Livraison</span>
                    <strong>2 000 FCFA</strong>
                </div>

                @php
                    $delivery = 2000;
                    $total = $subtotal + $delivery;
                @endphp

                <hr>

                <div class="d-flex justify-content-between mb-4">
                    <strong>Total</strong>
                    <strong class="text-primary fs-4">
                        {{ number_format($total, 0, ',', ' ') }} FCFA
                    </strong>
                </div>

                <a href="{{ route('client.checkout.index') }}" class="btn btn-primary w-100 btn-lg">
                    <i class="bi bi-credit-card"></i>
                    Passer la commande
                </a>
            </div>
        </div>
    </div>

</div>

@endif

@endsection