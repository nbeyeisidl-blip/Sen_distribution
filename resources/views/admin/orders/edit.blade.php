@extends('admin.layouts.app')

@section('content')
<div class="container-fluid px-4 mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Modifier la Commande #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Retour à la liste
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Formulaire de statut -->
        <div class="col-md-7">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Mettre à jour le statut</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="status" class="form-label font-weight-bold">Statut de la commande</label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>En cours de traitement</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>En cours de livraison</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Livrée / Terminée</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-1"></i> Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Détails du client et du paiement -->
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Informations de la Commande</h5>
                </div>
                <div class="card-body">
                    <!-- Récupération du Nom du Client -->
                    <p class="mb-2">
                        <strong>Client :</strong> 
                        <span class="text-primary fw-bold">
                            {{ $order->client->name ?? $order->user->name ?? $order->client_name ?? 'Client non renseigné' }}
                        </span>
                    </p>

                    <!-- Récupération de l'Email du Client -->
                    <p class="mb-2">
                        <strong>Email :</strong> 
                        {{ $order->client->email ?? $order->user->email ?? $order->client_email ?? 'N/A' }}
                    </p>

                    <hr>

                    <!-- Mode de paiement (Cash à la livraison) -->
                    <p class="mb-2">
                        <strong>Mode de paiement :</strong> 
                        <span class="badge bg-success">
                            <i class="bi bi-cash-stack me-1"></i>
                            {{ strtoupper($order->payment_method ?? 'Cash à la livraison') }}
                        </span>
                    </p>

                    <!-- Montant Total -->
                    <p class="mb-0">
                        <strong>Total :</strong> 
                        <span class="fs-5 text-dark fw-bold">
                            {{ number_format($order->total ?? $order->total_amount ?? 0, 0, ',', ' ') }} FCFA
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection