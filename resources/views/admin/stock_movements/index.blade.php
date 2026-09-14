@extends('admin.layouts.app')

@section('title', 'Historique du stock')

@section('page-title', 'Historique du stock')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                <i class="bi bi-clock-history"></i>
                Historique du stock
            </h3>

            <p class="text-muted mb-0">
                Consultez tous les mouvements de stock.
            </p>
        </div>

        <a href="{{ route('admin.stock.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-box-seam"></i>
            Gestion du stock

        </a>

    </div>


    {{-- FILTRES --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form method="GET"
                  action="{{ route('admin.stock_movements.index') }}">

                <div class="row g-2">

                    <div class="col-md-6">

                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Rechercher un produit..."
                               value="{{ request('search') }}">

                    </div>

                    <div class="col-md-4">

                        <select name="type"
                                class="form-select">

                            <option value="">
                                Tous les mouvements
                            </option>

                            <option value="entrée"
                                {{ request('type') === 'entrée' ? 'selected' : '' }}>

                                🟢 Entrées

                            </option>

                            <option value="sortie"
                                {{ request('type') === 'sortie' ? 'selected' : '' }}>

                                🔴 Sorties

                            </option>

                        </select>

                    </div>

                    <div class="col-md-2">

                        <button type="submit"
                                class="btn btn-primary w-100">

                            <i class="bi bi-search"></i>
                            Filtrer

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- TABLEAU --}}

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>Date</th>
                            <th>Produit</th>
                            <th>Type</th>
                            <th>Quantité</th>
                            <th>Référence</th>
                            <th>Description</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($movements as $movement)

                            <tr>

                                <td>

                                    {{ $movement->created_at
                                        ->format('d/m/Y H:i') }}

                                </td>

                                <td>

                                    <strong>
                                        {{ $movement->product->name }}
                                    </strong>

                                </td>

                                <td>

                                    @if($movement->type === 'entrée')

                                        <span class="badge bg-success">

                                            <i class="bi bi-arrow-down-circle"></i>
                                            Entrée

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            <i class="bi bi-arrow-up-circle"></i>
                                            Sortie

                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($movement->type === 'entrée')

                                        <strong class="text-success">
                                            +{{ $movement->quantity }}
                                        </strong>

                                    @else

                                        <strong class="text-danger">
                                            -{{ $movement->quantity }}
                                        </strong>

                                    @endif

                                </td>

                                <td>

                                    {{ $movement->reference ?? '-' }}

                                </td>

                                <td>

                                    {{ $movement->description ?? '-' }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="text-center py-4">

                                    <i class="bi bi-clock-history fs-1 text-muted"></i>

                                    <p class="text-muted mt-2">
                                        Aucun mouvement enregistré.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $movements->links() }}

            </div>

        </div>

    </div>

</div>

@endsection