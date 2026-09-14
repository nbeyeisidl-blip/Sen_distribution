```blade
@extends('client.layouts.app')

@section('title', 'Mes commandes')

@section('content')

<div class="container">

    <h2 class="fw-bold mb-4">
        <i class="bi bi-bag-check"></i>
        Mes commandes
    </h2>

    @forelse($orders as $order)

        <div class="card border-0 shadow-sm mb-3">

            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-md-3">
                        <strong>
                            Commande #{{ $order->id }}
                        </strong>
                    </div>

                    <div class="col-md-3">
                        {{ $order->created_at->format('d/m/Y') }}
                    </div>

                    <div class="col-md-3">
                        <strong>
                            {{ number_format($order->total, 0, ',', ' ') }}
                            FCFA
                        </strong>
                    </div>

                    <div class="col-md-3 text-end">

                       <a href="{{ route('client.orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                Voir la commande #{{ $order->id }}
            </a>

                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="alert alert-info">
            Vous n'avez encore aucune commande.
        </div>

    @endforelse

    {{ $orders->links() }}

</div>

@endsection
```
