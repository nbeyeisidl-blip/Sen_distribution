@extends('admin.layouts.app')

 {{-- Ajustez le nom de votre layout admin si nécessaire --}}

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Center de Notifications</h1>
            <p class="text-muted small mb-0">Gestion et suivi des alertes du système SEN DISTRIBUTION</p>
        </div>
        @if(auth()->user()->unreadNotifications->count() > 0)
            <form action="{{ route('admin.notifications.markAllRead') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-primary btn-sm fw-bold">
                    <i class="bi bi-check2-all me-1"></i> Tout marquer comme lu
                </button>
            </form>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0 text-primary">
                <i class="bi bi-bell-fill me-2"></i>Toutes les notifications
            </h6>
            <span class="badge bg-primary rounded-pill">
                {{ auth()->user()->unreadNotifications->count() }} non lue(s)
            </span>
        </div>

        <div class="list-group list-group-flush">
            @forelse(auth()->user()->notifications as $notification)
                <div class="list-group-item list-group-item-action p-3 {{ $notification->unread() ? 'bg-light border-start border-primary border-4' : '' }}">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center me-3">
                            {{-- Icône selon le type de notification (avec sécurisation 'type' ??) --}}
                            <div class="me-3 fs-3">
                                @if(($notification->data['type'] ?? '') === 'new_order')
                                    <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-circle">
                                        <i class="bi bi-cart-check"></i>
                                    </span>
                                @elseif(($notification->data['type'] ?? '') === 'low_stock')
                                    <span class="badge bg-warning bg-opacity-10 text-warning p-2 rounded-circle">
                                        <i class="bi bi-exclamation-triangle"></i>
                                    </span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary p-2 rounded-circle">
                                        <i class="bi bi-bell"></i>
                                    </span>
                                @endif
                            </div>

                            <div>
                                <h6 class="fw-bold mb-1 text-dark">
                                    {{ $notification->data['message'] ?? 'Nouvelle notification système' }}
                                </h6>
                                <p class="mb-1 text-muted small">
                                    Client : <strong>{{ $notification->data['client_nom'] ?? 'N/A' }}</strong> 
                                    @if(isset($notification->data['total']))
                                        | Montant : <strong class="text-primary">{{ number_format($notification->data['total'], 0, ',', ' ') }} FCFA</strong>
                                    @endif
                                </p>
                                <span class="text-muted" style="font-size: 0.75rem;">
                                    <i class="bi bi-clock me-1"></i>{{ $notification->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            @if(isset($notification->data['order_id']))
                                <a href="{{ route('admin.orders.show', $notification->data['order_id']) }}" class="btn btn-sm btn-primary fw-bold">
                                    Voir la commande
                                </a>
                            @endif

                            @if($notification->unread())
                                <form action="{{ route('admin.notifications.markRead', $notification->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-light border text-muted" title="Marquer comme lu">
                                        <i class="bi bi-check2"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="bi bi-bell-slash display-1 text-muted mb-3 d-block"></i>
                    <h5 class="fw-bold text-muted">Aucune notification</h5>
                    <p class="text-muted small">Vous n'avez reçu aucune alerte pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection