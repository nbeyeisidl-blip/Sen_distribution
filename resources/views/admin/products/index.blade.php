@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Gestion des Produits</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Ajouter un produit
        </a>
    </div>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tableau des produits -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Prix</th>
                            <th>Stock</th>
                            <th>Attributs (Taille/Couleur/Sexe)</th>
                            
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <!-- Image -->
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <span class="badge bg-light text-secondary border">Pas d'image</span>
                                    @endif
                                </td>

                                <!-- Nom -->
                                <td>
                                    <strong>{{ $product->name }}</strong>
                                </td>

                                <!-- Catégorie -->
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $product->category->name ?? 'Sans catégorie' }}
                                    </span>
                                </td>

                                <!-- Prix -->
                                <td>
                                    <strong>{{ number_format($product->price, 0, ',', ' ') }} FCFA</strong>
                                </td>

                                <!-- Stock -->
                                <td>
                                    @if($product->stock > 5)
                                        <span class="badge bg-success">{{ $product->stock }} en stock</span>
                                    @elseif($product->stock > 0)
                                        <span class="badge bg-warning text-dark">Reste {{ $product->stock }}</span>
                                    @else
                                        <span class="badge bg-danger">Rupture</span>
                                    @endif
                                </td>

                                <!-- Attributs -->
                                <td>
                                    <small class="d-block text-muted">
                                        <strong>Sexe :</strong> {{ ucfirst($product->gender) }}
                                    </small>
                                    @if($product->size)
                                        <small class="d-block text-muted"><strong>Taille :</strong> {{ $product->size }}</small>
                                    @endif
                                    @if($product->color)
                                        <small class="d-block text-muted"><strong>Couleur :</strong> {{ $product->color }}</small>
                                    @endif
                                </td>

                  
                                <!-- Actions -->
                                <td class="text-end">
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-primary">
            Modifier
        </a>

        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Supprimer ce produit ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">
                Supprimer
            </button>
        </form>
    </div>
</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    Aucun produit trouvé. <a href="{{ route('admin.products.create') }}">Ajouter un premier produit</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        @if($products->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection