@extends('admin.layouts.app')

@section('title', 'Ajouter un client')

@section('page-title', 'Ajouter un client')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-body">

        <h4 class="mb-4">
            <i class="bi bi-person-plus text-primary"></i>
            Nouveau client
        </h4>

        <form method="POST"
              action="{{ route('admin.clients.store') }}">

            @csrf

            <div class="row g-3">

                <div class="col-md-6">

                    <label class="form-label">
                        Nom *
                    </label>

                    <input type="text"
                           name="nom"
                           value="{{ old('nom') }}"
                           class="form-control"
                           required>

                    @error('nom')
                        <div class="text-danger small">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Prénom
                    </label>

                    <input type="text"
                           name="prenom"
                           value="{{ old('prenom') }}"
                           class="form-control">

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Téléphone
                    </label>

                    <input type="text"
                           name="telephone"
                           value="{{ old('telephone') }}"
                           class="form-control"
                           placeholder="77 000 00 00">

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Email
                    </label>

                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="form-control">

                </div>

                <div class="col-12">

                    <label class="form-label">
                        Adresse
                    </label>

                    <textarea name="adresse"
                              rows="3"
                              class="form-control">{{ old('adresse') }}</textarea>

                </div>

                <div class="col-12">

                    <div class="form-check">

                        <input type="checkbox"
                               name="is_active"
                               value="1"
                               class="form-check-input"
                               id="is_active"
                               checked>

                        <label class="form-check-label"
                               for="is_active">

                            Client actif

                        </label>

                    </div>

                </div>

            </div>

            <div class="mt-4">

                <button type="submit"
                        class="btn btn-primary">

                    <i class="bi bi-check-lg"></i>
                    Enregistrer

                </button>

                <a href="{{ route('admin.clients.index') }}"
                   class="btn btn-secondary">

                    Annuler

                </a>

            </div>

        </form>

    </div>

</div>

@endsection