@extends('cashier.layouts.app')
 {{-- Ajustez selon votre layout principal --}}

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Gestion des Commandes</h3>
            <p class="text-muted small mb-0">Suivi et historique complet des commandes — SEN DISTRIBUTION</p>
        </div>
        <a href="{{ route('cashier.sales.create') }}" class="btn btn-primary px-3 rounded-3">
            <i class="bi bi-plus-lg me-1"></i> Nouvelle vente
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light small text-muted">
                        <tr>
                            <th class="ps-4">N° Commande</th>
                            <th>Client</th>
                            <th>Articles</th>
                            <th>Date & Heure</th>
                            <th>Mode de règlement</th>
                            <th>Montant Total</th>
                            <th>Statut</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        @forelse($orders as $order)
                            @php
                                // Calcul automatique du nombre total d'articles dans la commande
                                $itemCount = 0;
                                if ($order->items && $order->items->count() > 0) {
                                    $itemCount = $order->items->sum('quantity') ?: $order->items->count();
                                } elseif ($order->saleItems && $order->saleItems->count() > 0) {
                                    $itemCount = $order->saleItems->sum('quantity') ?: $order->saleItems->count();
                                }
                            @endphp
                            <tr>
                                <td class="ps-4 fw-bold text-primary">
                                    VTE-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                </td>
                                <td>
                                    {{ $order->client->name ?? $order->client->nom ?? 'Client Comptoir' }}
                                </td>
                                <td>
    @php
        // 1. Essaye de faire la somme des quantités si la relation est chargée
        if ($order->relationLoaded('items') && $order->items->count() > 0) {
            $count = $order->items->sum('quantity') ?: $order->items->count();
        } 
        // 2. Sinon, utilise l'attribut items_count généré par withCount()
        elseif (isset($order->items_count)) {
            $count = $order->items_count;
        } 
        // 3. Fallback direct sur la relation
        else {
            $count = $order->items ? $order->items->count() : 0;
        }
    @endphp

    <span class="badge bg-light text-dark border px-2 py-1">
        {{ $count }} article(s)
    </span>
</td>
                                <td class="text-muted">
                                    {{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : '-' }}
                                </td>
                                <td>
                                    {{ ucfirst($order->payment_method ?? 'Espèces') }}
                                </td>
                                <td class="fw-bold">
                                    {{ number_format($order->total ?? $order->total_amount ?? 0, 0, ',', ' ') }} FCFA
                                </td>
                                <td>
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-20 px-2 py-1 rounded-2">
                                        {{ ucfirst($order->status ?? 'Payée') }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('cashier.sales.invoice', $order->id) }}" class="btn btn-sm btn-outline-secondary rounded-2">
                                        <i class="bi bi-file-earmark-text me-1"></i> Facture
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">
                                    <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                                    Aucune commande enregistrée pour le moment.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($orders->hasPages())
            <div class="card-footer bg-transparent border-0 py-3">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection