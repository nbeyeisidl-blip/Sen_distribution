@extends('admin.layouts.app')

@section('title', 'Ajouter un produit')

@section('page-title', 'Ajouter un produit')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-body">

        <h4 class="mb-4">
            <i class="bi bi-plus-circle text-primary"></i>
            Nouveau produit
        </h4>

        <form action="{{ route('admin.products.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="row g-3">

                <div class="col-md-6">

                    <label class="form-label">
                        Nom du produit
                    </label>

                    <input type="text"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                           required>

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Catégorie
                    </label>

                    <select name="category_id"
                            class="form-select">

                        <option value="">
                            -- Choisir une catégorie --
                        </option>

                        @foreach($categories as $category)

                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Prix (FCFA)
                    </label>

                    <input type="number"
                           name="price"
                           class="form-control"
                           min="0"
                           step="1"
                           value="{{ old('price') }}"
                           required>

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Stock
                    </label>

                    <input type="number"
                           name="stock"
                           class="form-control"
                           min="0"
                           value="{{ old('stock', 0) }}"
                           required>

                </div>


                <div class="col-12">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea name="description"
                              class="form-control"
                              rows="4">{{ old('description') }}</textarea>

                </div>


                <div class="mb-3">
        <label for="image" class="form-label">Image du produit</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*">
            
        
        
        <!-- Bloc Attributs Produit : Taille, Couleur, Genre -->
<div class="row">
    <!-- Genre / Sexe -->
    <div class="col-md-4 mb-3">
        <label for="gender" class="form-label">Sexe / Public cible</label>
        <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
            <option value="mixte" {{ old('gender') == 'mixte' ? 'selected' : '' }}>Mixte / Unisexe</option>
            <option value="homme" {{ old('gender') == 'homme' ? 'selected' : '' }}>Homme</option>
            <option value="femme" {{ old('gender') == 'femme' ? 'selected' : '' }}>Femme</option>
            <option value="enfant" {{ old('gender') == 'enfant' ? 'selected' : '' }}>Enfant</option>
        </select>
        @error('gender')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Taille -->
    <div class="col-md-4 mb-3">
        <label for="size" class="form-label">Taille / Pointure</label>
        <input type="text" name="size" id="size" class="form-control @error('size') is-invalid @enderror" placeholder="Ex: M, L, XL, 42..." value="{{ old('size') }}">
        @error('size')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Couleur -->
    <div class="col-md-4 mb-3">
        <label for="color" class="form-label">Couleur</label>
        <input type="text" name="color" id="color" class="form-control @error('color') is-invalid @enderror" placeholder="Ex: Noir, Blanc, Rouge..." value="{{ old('color') }}">
        @error('color')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
    </div>

            </div>


            <div class="mt-4">

                <button type="submit"
                        class="btn btn-primary">

                    <i class="bi bi-check-lg"></i>
                    Enregistrer

                </button>

                <a href="{{ route('admin.products.index') }}"
                   class="btn btn-secondary">

                    Annuler

                </a>

            </div>

        </form>

    </div>

</div>

@endsection