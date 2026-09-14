@extends('admin.layouts.app')

@section('title', 'Modifier un produit')

@section('page-title', 'Modifier un produit')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-body">

        <h4 class="mb-4">
            <i class="bi bi-pencil-square text-warning"></i>
            Modifier le produit
        </h4>

        <form action="{{ route('admin.products.update', $product) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row g-3">

                {{-- NOM --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Nom du produit
                    </label>

                    <input type="text"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $product->name) }}"
                           required>

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- CATEGORIE --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Catégorie
                    </label>

                    <select name="category_id"
                            class="form-select @error('category_id') is-invalid @enderror">

                        <option value="">
                            -- Choisir une catégorie --
                        </option>

                        @foreach($categories as $category)

                            <option value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- PRIX --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Prix (FCFA)
                    </label>

                    <input type="number"
                           name="price"
                           class="form-control @error('price') is-invalid @enderror"
                           min="0"
                           step="1"
                           value="{{ old('price', $product->price) }}"
                           required>

                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- STOCK --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Stock
                    </label>

                    <input type="number"
                           name="stock"
                           class="form-control @error('stock') is-invalid @enderror"
                           min="0"
                           value="{{ old('stock', $product->stock) }}"
                           required>

                    @error('stock')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- DESCRIPTION --}}
                <div class="col-12">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea name="description"
                              class="form-control"
                              rows="4">{{ old('description', $product->description) }}</textarea>

                </div>


                {{-- IMAGE ACTUELLE --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Image actuelle
                    </label>

                    @if($product->image && file_exists(public_path('images/products/' . $product->image)))

                        <div>
                            <img src="{{ asset('images/products/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 width="150"
                                 height="150"
                                 class="rounded img-thumbnail"
                                 style="object-fit: cover;">
                        </div>

                    @else

                        <p class="text-muted">
                            Aucune image.
                        </p>

                    @endif

                </div>


                {{-- NOUVELLE IMAGE --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Remplacer l'image
                    </label>

                    <input type="file"
                           name="image"
                           class="form-control"
                           accept="image/*">

                    <small class="text-muted">
                        JPG, JPEG, PNG ou WEBP — maximum 2 Mo.
                    </small>

                </div>

            </div>


            {{-- BOUTONS --}}
            <div class="mt-4">

                <button type="submit"
                        class="btn btn-warning">

                    <i class="bi bi-check-lg"></i>
                    Enregistrer les modifications

                </button>

                <a href="{{ route('admin.products.index') }}"
                   class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>
                    Retour

                </a>

            </div>

        </form>

    </div>

</div>

@endsection