@extends('layouts.app')

@section('content')

<div class="container py-5">

    <h2 class="mb-4">
        <i class="bi bi-credit-card"></i>
        Finaliser ma commande
    </h2>

    <div class="row">

        {{-- PRODUITS --}}
        <div class="col-md-7">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Résumé de la commande</strong>
                </div>

                <div class="card-body">

                    @foreach($products as $product)

                        @php
                            $quantity = $cart[$product->id]['quantity'];
                            $subtotal = $product->price * $quantity;
                        @endphp

                        <div class="d-flex justify-content-between
                                    align-items-center border-bottom py-3">

                            <div>

                                <strong>
                                    {{ $product->name }}
                                </strong>

                                <br>

                                <small class="text-muted">
                                    {{ number_format($product->price, 0, ',', ' ') }}
                                    FCFA × {{ $quantity }}
                                </small>

                            </div>

                            <strong>
                                {{ number_format($subtotal, 0, ',', ' ') }}
                                FCFA
                            </strong>

                        </div>

                    @endforeach

                    <div class="d-flex justify-content-between mt-4">

                        <h5>Total</h5>

                        <h5 class="text-primary">
                            {{ number_format($total, 0, ',', ' ') }}
                            FCFA
                        </h5>

                    </div>

                </div>

            </div>

        </div>


        {{-- FORMULAIRE --}}
        <div class="col-md-5">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Informations de livraison</strong>
                </div>

                <div class="card-body">

                    <form action="{{ route('checkout.store') }}"
                          method="POST">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">
                                Adresse de livraison
                            </label>

                            <textarea
                                name="adresse"
                                class="form-control"
                                rows="3"
                                required></textarea>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Moyen de paiement
                            </label>

                            <select
                                name="payment_method"
                                class="form-select"
                                required>

                                <option value="">
                                    Choisir un moyen de paiement
                                </option>

                                <option value="Wave">
                                    Wave
                                </option>

                                <option value="Orange Money">
                                    Orange Money
                                </option>

                                <option value="Carte bancaire">
                                    Carte bancaire
                                </option>

                            </select>

                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary w-100">

                            <i class="bi bi-check-circle"></i>

                            Confirmer la commande

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection