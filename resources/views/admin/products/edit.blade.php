@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Modifier le produit : {{ $product->name }}</h2>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Retour</a>
    </div>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nom du produit</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Prix (FCFA)</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Catégorie</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Sexe / Public</label>
                <select name="gender" class="form-select">
                    <option value="mixte" {{ $product->gender == 'mixte' ? 'selected' : '' }}>Mixte / Unisexe</option>
                    <option value="homme" {{ $product->gender == 'homme' ? 'selected' : '' }}>Homme</option>
                    <option value="femme" {{ $product->gender == 'femme' ? 'selected' : '' }}>Femme</option>
                    <option value="enfant" {{ $product->gender == 'enfant' ? 'selected' : '' }}>Enfant</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Taille</label>
                <input type="text" name="size" class="form-control" value="{{ old('size', $product->size) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Couleur</label>
                <input type="text" name="color" class="form-control" value="{{ old('color', $product->color) }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Changer l'image (optionnel)</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            @if($product->image)
                <div class="mt-2">
                    <img src="{{ asset('images/products/' . $product->image) }}" alt="Image actuelle" width="80" class="rounded">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="3" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Mettre à jour le produit</button>
    </form>
</div>
@endsection