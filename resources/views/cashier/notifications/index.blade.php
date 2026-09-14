@extends('cashier.layouts.app')


@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Notifications</h1>
            <p class="text-muted small mb-0">Centre d'alertes et messages système - SEN DISTRIBUTION</p>
        </div>
        @if($notifications->whereNull('read_at')->count() > 0)
            <form action="{{ route('cashier.notifications.markAll') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-primary fw-bold">
                    <i class="bi bi-check2-all me-1"></i> Tout marquer comme lu
                </button>
            </form>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                @forelse($notifications as $notification)
                    @php
                        $isUnread = is_null($notification->read_at);
                        $data = is_array($notification->data) ? $notification->data : json_decode($notification->data, true);
                    @endphp
                    <div class="list-group-item p-3 {{ $isUnread ? 'bg-light' : 'bg-white' }}">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="d-flex align-items-start">
                                <div class="me-3 mt-1">
                                    <span class="badge bg-primary-subtle text-primary p-2 rounded-circle fs-6">
                                        <i class="bi bi-bell"></i>
                                    </span>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="mb-0 fw-bold text-dark me-2">
                                            {{ $notification->title ?? $data['title'] ?? 'Notification' }}
                                        </h6>
                                        @if($isUnread)
                                            <span class="badge bg-primary rounded-pill px-2 small">Nouveau</span>
                                        @endif
                                    </div>
                                    <p class="text-muted small mb-1">
                                        {{ $notification->message ?? $data['message'] ?? '' }}
                                    </p>
                                    <span class="text-muted extra-small" style="font-size: 0.75rem;">
                                        <i class="bi bi-clock me-1"></i>{{ $notification->created_at ? $notification->created_at->diffForHumans() : '' }}
                                    </span>
                                </div>
                            </div>

                            @if($isUnread)
                                <form action="{{ route('cashier.notifications.markRead', $notification->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-light border text-secondary" title="Marquer comme lu">
                                        <i class="bi bi-check"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="bi bi-bell-slash fs-1 text-muted d-block mb-3"></i>
                        <p class="text-muted mb-0">Aucune notification pour le moment.</p>
                    </div>
                @endforelse
            </div>
        </div>

        @if($notifications->hasPages())
            <div class="card-footer bg-white py-3">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>

</div>
@endsection