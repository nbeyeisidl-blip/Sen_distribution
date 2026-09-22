
@extends('client.layouts.app')

@section('content')
<div class="container my-5">
    <div class="mb-4">
        <h2 class="fw-bold"><i class="bi bi-bag-check me-2 text-primary"></i>Mes Commandes & Suivi</h2>
        <p class="text-muted">Consultez l'historique de vos commandes et suivez l'état de livraison.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="card border-0 shadow-sm text-center py-5 rounded-3">
            <div class="card-body">
                <i class="bi bi-box-seam display-1 text-muted mb-3 d-block"></i>
                <h4 class="fw-bold text-secondary">Aucune commande trouvée</h4>
                <p class="text-muted">Vous n'avez pas encore passé de commande sur notre boutique.</p>
                <a href="{{ route('client.home') }}" class="btn btn-primary rounded-pill px-4 mt-2">
                    Découvrir nos produits
                </a>
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">N° Commande</th>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Paiement</th>
                            <th>Statut</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="ps-4 fw-bold">#{{ $order->id }}</td>
                                <td class="text-muted">{{ $order->created_at->format('d/m/Y à H:i') }}</td>
                                <td class="fw-semibold text-dark">{{ number_format($order->total ?? $order->total_amount, 0, ',', ' ') }} FCFA</td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ strtoupper($order->payment_method) }}
                                    </span>
                                </td>
                                <td>
                                    @if($order->status == 'pending')
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                            <i class="bi bi-clock me-1"></i> En attente
                                        </span>
                                    @elseif($order->status == 'processing')
                                        <span class="badge bg-info text-dark px-3 py-2 rounded-pill">
                                            <i class="bi bi-gear-wide-connected me-1"></i> En préparation
                                        </span>
                                    @elseif($order->status == 'shipped')
                                        <span class="badge bg-primary px-3 py-2 rounded-pill">
                                            <i class="bi bi-truck me-1"></i> En cours de livraison
                                        </span>
                                    @elseif($order->status == 'completed' || $order->status == 'delivered')
                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                            <i class="bi bi-check-circle me-1"></i> Livrée
                                        </span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="badge bg-danger px-3 py-2 rounded-pill">
                                            <i class="bi bi-x-circle me-1"></i> Annulée
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('client.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        <i class="bi bi-eye me-1"></i> Détails
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection