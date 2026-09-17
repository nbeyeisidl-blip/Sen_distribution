@extends('client.layouts.app')

@section('title', 'Inscription - SEN DISTRIBUTION')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-3 p-4">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary">SEN DISTRIBUTION</h3>
                    <p class="text-muted small">Créer un nouveau compte utilisateur</p>
                </div>

                {{-- Affichage des erreurs globales --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('register.submit') }}" method="POST">
                    @csrf

                    <!-- Nom complet -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nom complet</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   placeholder="Modou Ndiaye" 
                                   value="{{ old('name') }}" 
                                   required 
                                   autofocus>
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Adresse Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Adresse Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   placeholder="exemple@domain.sn" 
                                   value="{{ old('email') }}" 
                                   required>
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Sélection du Rôle -->
                    <div class="mb-3">
                        <label for="role" class="form-label fw-semibold">Type de compte (Rôle)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-shield-person"></i></span>
                            <select name="role" id="role" class="form-select">
    <option value="client">Client</option>
    <option value="caissier">Caissier</option>
    <option value="magasinier">Magasinier</option>
    <option value="admin">Administrateur</option>
</select>
                        </div>
                        @error('role')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Mot de passe</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                            <input type="password" 
                                   name="password" 
                                   id="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   placeholder="••••••••" 
                                   required>
                        </div>
                        <div class="form-text small text-muted">Au moins 8 caractères.</div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirmation du mot de passe -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold">Confirmer le mot de passe</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password_confirmation" 
                                   class="form-control" 
                                   placeholder="••••••••" 
                                   required>
                        </div>
                    </div>

                    <!-- Bouton Inscription -->
                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm mb-3">
                        <i class="bi bi-person-plus me-2"></i>Créer le compte
                    </button>
                </form>

                <hr class="text-muted">

                <!-- Lien vers la connexion -->
                <div class="text-center mt-2">
                    <p class="text-muted mb-0 small">Vous avez déjà un compte ?</p>
                    <a href="{{ route('login') }}" class="fw-bold text-decoration-none">Se connecter</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection