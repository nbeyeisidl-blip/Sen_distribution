@extends('admin.layouts.app')

@section('title', 'Modifier fournisseur')

@section('page-title', 'Modifier fournisseur')

@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-body">

        <h4 class="fw-bold mb-4">
            <i class="bi bi-pencil-square"></i>
            Modifier le fournisseur
        </h4>

        <form method="POST"
              action="{{ route('admin.fournisseurs.update', $fournisseur) }}">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Nom *
                    </label>

                    <input type="text"
                           name="nom"
                           class="form-control"
                           value="{{ old('nom', $fournisseur->nom) }}"
                           required>

                    @error('nom')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Entreprise
                    </label>

                    <input type="text"
                           name="entreprise"
                           class="form-control"
                           value="{{ old('entreprise', $fournisseur->entreprise) }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Téléphone
                    </label>

                    <input type="text"
                           name="telephone"
                           class="form-control"
                           value="{{ old('telephone', $fournisseur->telephone) }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Email
                    </label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email', $fournisseur->email) }}">

                    @error('email')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col-12 mb-3">

                    <label class="form-label">
                        Adresse
                    </label>

                    <textarea name="adresse"
                              class="form-control"
                              rows="3">{{ old('adresse', $fournisseur->adresse) }}</textarea>

                </div>

            </div>

            <button type="submit"
                    class="btn btn-success">

                <i class="bi bi-check-circle"></i>
                Enregistrer les modifications

            </button>

            <a href="{{ route('admin.fournisseurs.index') }}"
               class="btn btn-secondary">

                Annuler

            </a>

        </form>

    </div>

</div>

@endsection