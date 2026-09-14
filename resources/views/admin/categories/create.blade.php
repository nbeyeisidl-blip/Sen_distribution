@extends('admin.layouts.app')

@section('title', 'Ajouter une catégorie')

@section('page-title', 'Ajouter une catégorie')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-body">

        <h4 class="mb-4">
            <i class="bi bi-plus-circle text-primary"></i>
            Nouvelle catégorie
        </h4>

        <form method="POST"
              action="{{ route('admin.categories.store') }}">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Nom de la catégorie
                </label>

                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       class="form-control @error('name') is-invalid @enderror"
                       placeholder="Exemple : Alimentation"
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
                          class="form-control">{{ old('description') }}</textarea>

            </div>


            <div class="form-check mb-4">

                <input type="checkbox"
                       name="is_active"
                       value="1"
                       class="form-check-input"
                       id="is_active"
                       checked>

                <label class="form-check-label"
                       for="is_active">

                    Catégorie active

                </label>

            </div>


            <button type="submit"
                    class="btn btn-primary">

                <i class="bi bi-check-lg"></i>
                Enregistrer

            </button>

            <a href="{{ route('admin.categories.index') }}"
               class="btn btn-secondary">

                Annuler

            </a>

        </form>

    </div>

</div>

@endsection