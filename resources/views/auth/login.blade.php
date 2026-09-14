@extends('client.layouts.app')

@section('title', 'Connexion - SEN DISTRIBUTION')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-3 p-4">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary">SEN DISTRIBUTION</h3>
                    <p class="text-muted small">Connectez-vous à votre espace</p>
                </div>

                {{-- Message d'erreur global --}}
                @if($errors->has('email'))
                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ $errors->first('email') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Message de succès après inscription ou déconnexion --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf

                    <!-- Adresse Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Adresse Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   placeholder="exemple@sendistribution.sn" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus>
                        </div>
                    </div>

                    <!-- Mot de Passe -->
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
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Se souvenir de moi -->
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label text-muted small" for="remember">
                                Se souvenir de moi
                            </label>
                        </div>
                    </div>

                    <!-- Bouton Soumettre -->
                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm mb-3">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                    </button>
                </form>

                <hr class="text-muted">

                <!-- Lien vers l'inscription Client -->
                <div class="text-center mt-2">
                    <p class="text-muted mb-0 small">Vous n'avez pas encore de compte ?</p>
                    <a href="{{ route('register') }}" class="fw-bold text-decoration-none">Créer un compte client</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection