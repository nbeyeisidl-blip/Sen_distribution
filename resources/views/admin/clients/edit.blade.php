@extends('admin.layouts.app')

@section('title', 'Modifier un client')

@section('page-title', 'Modifier un client')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-body">

        <h4 class="mb-4">
            <i class="bi bi-pencil-square text-warning"></i>
            Modifier le client
        </h4>

        <form method="POST"
              action="{{ route('admin.clients.update', $client) }}">

            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-6">

                    <label class="form-label">
                        Nom *
                    </label>

                    <input type="text"
                           name="nom"
                           value="{{ old('nom', $client->nom) }}"
                           class="form-control"
                           required>

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Prénom
                    </label>

                    <input type="text"
                           name="prenom"
                           value="{{ old('prenom', $client->prenom) }}"
                           class="form-control">

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Téléphone
                    </label>

                    <input type="text"
                           name="telephone"
                           value="{{ old('telephone', $client->telephone) }}"
                           class="form-control">

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Email
                    </label>

                    <input type="email"
                           name="email"
                           value="{{ old('email', $client->email) }}"
                           class="form-control">

                </div>

                <div class="col-12">

                    <label class="form-label">
                        Adresse
                    </label>

                    <textarea name="adresse"
                              rows="3"
                              class="form-control">{{ old('adresse', $client->adresse) }}</textarea>

                </div>

                <div class="col-12">

                    <div class="form-check">

                        <input type="checkbox"
                               name="is_active"
                               value="1"
                               class="form-check-input"
                               id="is_active"
                               {{ old('is_active', $client->is_active) ? 'checked' : '' }}>

                        <label class="form-check-label"
                               for="is_active">

                            Client actif

                        </label>

                    </div>

                </div>

            </div>

            <div class="mt-4">

                <button type="submit"
                        class="btn btn-warning">

                    <i class="bi bi-check-lg"></i>
                    Enregistrer les modifications

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