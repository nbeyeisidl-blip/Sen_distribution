@extends('admin.layouts.app')


@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-0 text-gray-800">Catégories & Sous-Catégories</h2>
            <p class="text-muted mb-0 small">Organisation hiérarchique du catalogue</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="fas fa-plus me-1"></i> Ajouter une Catégorie / Sous-Catégorie
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Type</th>
                            <th>Catégorie Parente</th>
                            <th>Produits</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    @if($category->parent_id)
                                        <span class="text-muted ms-3">— </span><strong>{{ $category->name }}</strong>
                                    @else
                                        <strong><i class="fas fa-folder me-1 text-warning"></i> {{ $category->name }}</strong>
                                    @endif
                                </td>
                                <td>
                                    @if($category->parent_id)
                                        <span class="badge bg-info text-white">Sous-catégorie</span>
                                    @else
                                        <span class="badge bg-primary">Catégorie Principale</span>
                                    @endif
                                </td>
                                <td>
                                    @if($category->parent)
                                        <span class="badge bg-light text-dark border">{{ $category->parent->name }}</span>
                                    @else
                                        <span class="text-muted small">Aucune (Principale)</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $category->products_count }} produit(s)
                                    </span>
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-primary me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModal{{ $category->id }}">
                                        Modifier
                                    </button>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Voulez-vous supprimer cette catégorie ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal de Modification -->
                            <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Modifier : {{ $category->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Nom</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Catégorie Parente (Laissez vide si c'est une catégorie principale)</label>
                                                    <select name="parent_id" class="form-select">
                                                        <option value="">Aucune (Catégorie principale)</option>
                                                        @foreach($parentCategories as $parent)
                                                            @if($parent->id != $category->id)
                                                                <option value="{{ $parent->id }}" {{ $category->parent_id == $parent->id ? 'selected' : '' }}>
                                                                    {{ $parent->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Description</label>
                                                    <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
                                                </div>
                                                <div class="mb-3">
    <label for="parent_id" class="form-label">Catégorie Parente</label>
    <select name="parent_id" id="parent_id" class="form-select">
        <option value="">Aucune (Créer comme Catégorie Principale)</option>
        @foreach($parentCategories as $parent)
            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
        @endforeach
    </select>
</div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    Aucune catégorie trouvée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'Ajout -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une Catégorie / Sous-Catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nom de la catégorie</label>
                        <input type="text" name="name" class="form-control" placeholder="ex: Vêtements, Chaussures, Chemises..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Catégorie Parente</label>
                        <select name="parent_id" class="form-select">
                            <option value="" selected>Aucune (Créer comme Catégorie Principale)</option>
                            @foreach($parentCategories as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                            @endforeach
                        </select>
                        <div class="form-text">Si vous choisissez un parent, cette catégorie deviendra une sous-catégorie.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Description optionnelle..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection