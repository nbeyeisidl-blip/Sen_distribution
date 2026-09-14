@extends('admin.layouts.app')

@section('title', 'Modifier une catégorie')

@section('page-title', 'Modifier une catégorie')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-body">

        <h4 class="mb-4">
            <i class="bi bi-pencil-square text-warning"></i>
            Modifier la catégorie
        </h4>

        <form method="POST"
              action="{{ route('admin.categories.update', $category) }}">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">
                    Nom de la catégorie
                </label>

                <input type="text"
                       name="name"
                       value="{{ old('name', $category->name) }}"
                       class="form-control @error('name') is-invalid @enderror"
                       required>

                @error('name')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Description
                </label>

                <textarea name="description"
                          rows="4"
                          class="form-control">{{ old('description', $category->description) }}</textarea>

            </div>


            <div class="form-check mb-4">

                <input type="checkbox"
                       name="is_active"
                       value="1"
                       class="form-check-input"
                       id="is_active"
                       {{ old('is_active', $category->is_active) ? 'checked' : '' }}>

                <label class="form-check-label"
                       for="is_active">

                    Catégorie active

                </label>

            </div>


            <button type="submit"
                    class="btn btn-warning">

                <i class="bi bi-check-lg"></i>
                Enregistrer les modifications

            </button>

            <a href="{{ route('admin.categories.index') }}"
               class="btn btn-secondary">

                Annuler

            </a>

        </form>

    </div>

</div>

@endsection