@extends('admin.layouts.app')

@section('title', 'Gestion des commandes')

@section('page-title', 'Gestion des commandes')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold">
                <i class="bi bi-cart-check"></i>
                Gestion des commandes
            </h3>

            <p class="text-muted">
                Consultez et gérez les commandes des clients.
            </p>
        </div>

    </div>


    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>
                            <th>N°</th>
                            <th>Client</th>
                            <th>Total</th>
                            <th>Paiement</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                    @forelse($orders as $order)

                        <tr>

                            <td>
                                <strong>
                                    #{{ $order->id }}
                                </strong>
                            </td>

                            <td>

                                @if($order->client)

                                    {{ $order->client->prenom }}
                                    {{ $order->client->nom }}

                                @else

                                    Client inconnu

                                @endif

                            </td>

                            <td>
                                <strong>
                                    {{ number_format($order->total, 0, ',', ' ') }}
                                    FCFA
                                </strong>
                            </td>

                            <td>
                                {{ $order->payment_method ?? '-' }}
                            </td>

                            <td>

                                @switch($order->status)

                                    @case('pending')
                                        <span class="badge bg-warning text-dark">
                                            En attente
                                        </span>
                                        @break

                                    @case('confirmed')
                                        <span class="badge bg-primary">
                                            Confirmée
                                        </span>
                                        @break

                                    @case('processing')
                                        <span class="badge bg-info">
                                            En préparation
                                        </span>
                                        @break

                                    @case('shipped')
                                        <span class="badge bg-secondary">
                                            Expédiée
                                        </span>
                                        @break

                                    @case('delivered')
                                        <span class="badge bg-success">
                                            Livrée
                                        </span>
                                        @break

                                    @case('cancelled')
                                        <span class="badge bg-danger">
                                            Annulée
                                        </span>
                                        @break

                                @endswitch

                            </td>

                            <td>
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td>

                                <a href="{{ route('admin.orders.show', $order) }}"
                                   class="btn btn-sm btn-info">

                                    <i class="bi bi-eye"></i>

                                </a>

                                <a href="{{ route('admin.orders.edit', $order) }}"
                                   class="btn btn-sm btn-warning">

                                    <i class="bi bi-pencil"></i>

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center py-5">

                                <i class="bi bi-cart-x fs-1 text-muted"></i>

                                <p class="text-muted mt-2">
                                    Aucune commande trouvée.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $orders->links() }}

            </div>

        </div>

    </div>

</div>

@endsection