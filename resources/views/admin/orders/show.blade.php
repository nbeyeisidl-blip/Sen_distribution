<div class="d-flex align-items-center gap-2">
    <!-- Statut actuel de la commande -->
    @if($order->status === 'completed')
        <span class="badge bg-success px-3 py-2 fs-6">
            <i class="bi bi-check-circle-fill me-1"></i> Commande Livrée
        </span>
    @elseif($order->status === 'cancelled')
        <span class="badge bg-danger px-3 py-2 fs-6">
            <i class="bi bi-x-circle-fill me-1"></i> Commande Annulée
        </span>
    @else
        <!-- Bouton pour passer directement à "Livrée" -->
        <form action="{{ route('admin.orders.confirm', $order->id) }}" method="POST" onsubmit="return confirm('Confirmer la livraison de cette commande ?');">
            @csrf
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-lg me-1"></i> Marquer comme Livrée
            </button>
        </form>

        <!-- Bouton d'édition classique -->
        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-outline-primary">
            <i class="bi bi-pencil me-1"></i> Modifier le statut
        </a>
    @endif
</div>