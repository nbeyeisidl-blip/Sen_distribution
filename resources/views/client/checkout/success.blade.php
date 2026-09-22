@extends('layouts.app')

@section('content')

<div class="container py-5 text-center">

    <div class="card shadow-sm p-5">

        <i class="bi bi-check-circle text-success"
           style="font-size: 70px;"></i>

        <h2 class="mt-3">
            Commande enregistrée !
        </h2>

        <p class="text-muted">
            Votre commande a bien été enregistrée.
        </p>

        <a href="{{ route('home') }}"
           class="btn btn-primary">

            Continuer mes achats

        </a>

    </div>

</div>

@endsection