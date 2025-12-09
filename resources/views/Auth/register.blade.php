@extends('Layouts.app')
@section('title', 'Inscription')

@section('content')
<div class="container bg-light-beig">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark-brown text-white">Inscription</div>
                <div class="card-body">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" name="prenom" id="prenom" class="form-control @error('prenom') is-invalid @enderror" value="{{ old('prenom') }}" required>
                            @error('prenom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" name="adresse" id="adresse" class="form-control @error('adresse') is-invalid @enderror" value="{{ old('adresse') }}" required>
                            @error('adresse')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="datenaissance" class="form-label">Date de naissance</label>
                            <input type="date" name="datenaissance" id="datenaissance" class="form-control @error('datenaissance') is-invalid @enderror" value="{{ old('datenaissance') }}" required>
                            @error('datenaissance')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary">S'inscrire</button>
                            <a href="{{ route('login') }}" class="btn btn-link">Déjà inscrit ? Se connecter</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection