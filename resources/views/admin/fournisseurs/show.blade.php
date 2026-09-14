@extends('admin.layouts.app')

@section('title', 'Détails fournisseur')

@section('page-title', 'Détails fournisseur')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <h4 class="fw-bold mb-0">
                        <i class="bi bi-truck"></i>
                        Détails du fournisseur
                    </h4>

                    <span class="badge bg-primary">
                        Fournisseur #{{ $fournisseur->id }}
                    </span>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <small class="text-muted">
                            Nom
                        </small>

                        <h5>
                            {{ $fournisseur->nom }}
                        </h5>

                    </div>

                    <div class="col-md-6 mb-4">

                        <small class="text-muted">
                            Entreprise
                        </small>

                        <h5>
                            {{ $fournisseur->entreprise ?? 'Non renseignée' }}
                        </h5>

                    </div>

                    <div class="col-md-6 mb-4">

                        <small class="text-muted">
                            Téléphone
                        </small>

                        <h5>
                            {{ $fournisseur->telephone ?? 'Non renseigné' }}
                        </h5>

                    </div>

                    <div class="col-md-6 mb-4">

                        <small class="text-muted">
                            Email
                        </small>

                        <h5>
                            {{ $fournisseur->email ?? 'Non renseigné' }}
                        </h5>

                    </div>

                    <div class="col-12 mb-4">

                        <small class="text-muted">
                            Adresse
                        </small>

                        <h5>
                            {{ $fournisseur->adresse ?? 'Non renseignée' }}
                        </h5>

                    </div>

                </div>

                <hr>

                <div class="d-flex gap-2">

                    <a href="{{ route('admin.fournisseurs.edit', $fournisseur) }}"
                       class="btn btn-warning">

                        <i class="bi bi-pencil"></i>
                        Modifier

                    </a>

                    <a href="{{ route('admin.fournisseurs.index') }}"
                       class="btn btn-secondary">

                        <i class="bi bi-arrow-left"></i>
                        Retour

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection