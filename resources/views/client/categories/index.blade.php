@extends('client.layouts.app')

@section('content')
<div class="container py-4">

    {{-- En-tête de la page --}}
    <div class="p-4 mb-4 bg-primary text-white rounded shadow-sm" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('client.home') }}" class="text-white-50 text-decoration-none">Accueil</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Catégories</li>
                    </ol>
                </nav>
                <h1 class="h2 fw-bold mb-1">Nos Rayons & Catégories</h1>
                <p class="mb-0 text-white-50">Explorez l'ensemble de nos catégories de produits de qualité chez SEN DISTRIBUTION.</p>
            </div>
            <div class="d-none d-md-block text-end">
                <span class="badge bg-white text-primary fs-6 px-3 py-2 rounded-pill shadow-sm">
                    {{ $categories->count() }} Rayons disponibles
                </span>
            </div>
        </div>
    </div>

    {{-- GRILLE DES CATÉGORIES --}}
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse($categories as $category)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm text-center p-3 category-card hover-shadow transition">
                    
                    {{-- Icône/Visuel de la catégorie --}}
                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        @switch(strtolower($category->name))
                            @case('alimentaire')
                                <i class="bi bi-basket fs-1"></i>
                                @break
                            @case('boissons')
                                <i class="bi bi-cup-straw fs-1"></i>
                                @break
                            @case('hygiène')
                            @case('hygiene')
                                <i class="bi bi-sparkles fs-1"></i>
                                @break
                            @case('entretien')
                                <i class="bi bi-house-door fs-1"></i>
                                @break
                            @default
                                <i class="bi bi-box-seam fs-1"></i>
                        @endswitch
                    </div>

                    <div class="card-body p-0 d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="fw-bold h6 text-dark mb-2">{{ $category->name }}</h5>
                            <p class="text-muted small mb-3">
                                {{ Str::limit($category->description ?? 'Découvrez notre sélection pour ce rayon.', 60) }}
                            </p>
                        </div>

                        <div>
                            <span class="badge bg-light text-dark border rounded-pill mb-3 px-3 py-2">
                                <i class="bi bi-tag me-1"></i>{{ $category->products_count }} produit(s)
                            </span>

                            <a href="{{ route('client.categories.show', $category->id) }}" class="btn btn-outline-primary btn-sm w-100 fw-bold">
                                Découvrir le rayon <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="p-5 bg-light rounded shadow-sm">
                    <i class="bi bi-folder-x display-1 text-muted mb-3 d-block"></i>
                    <h4 class="fw-bold">Aucune catégorie disponible</h4>
                    <p class="text-muted">Les rayons seront configurés très prochainement.</p>
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection