@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>{{ isset($annonce) ? 'Modifier l\'annonce' : 'Nouvelle annonce' }}</h3>
                    <a href="{{ route('annonces.index') }}" class="btn btn-secondary">Retour</a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ isset($annonce) ? route('annonces.update', $annonce) : route('annonces.store') }}" 
                        method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @if(isset($annonce))
                            @method('PUT')
                        @endif

                        <div class="form-group mb-3">
                            <label for="titre">Titre</label>
                            <input type="text" 
                                   class="form-control @error('titre') is-invalid @enderror" 
                                   id="titre" 
                                   name="titre" 
                                   value="{{ old('titre', isset($annonce) ? $annonce->titre : '') }}" 
                                   required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="photo">Photo</label>
                            <input type="file" 
                                   class="form-control @error('photo') is-invalid @enderror" 
                                   id="photo" 
                                   name="photo" 
                                   @unless(isset($annonce)) required @endunless>
                            @if(isset($annonce) && $annonce->photo)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $annonce->photo) }}" 
                                         alt="Current photo" 
                                         class="img-thumbnail" 
                                         style="max-width: 200px;">
                                </div>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="prix">Prix</label>
                            <input type="number" 
                                   class="form-control @error('prix') is-invalid @enderror" 
                                   id="prix" 
                                   name="prix" 
                                   step="0.01" 
                                   value="{{ old('prix', isset($annonce) ? $annonce->prix : '') }}" 
                                   required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4" 
                                      required>{{ old('description', isset($annonce) ? $annonce->description : '') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="categorie_id">Catégorie</label>
                            <select class="form-control @error('categorie_id') is-invalid @enderror" 
                                    id="categorie_id" 
                                    name="categorie_id" 
                                    required>
                                <option value="">Sélectionnez une catégorie</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}" 
                                            {{ old('categorie_id', isset($annonce) ? $annonce->categorie_id : '') == $categorie->id ? 'selected' : '' }}>
                                        {{ $categorie->libelle }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="datepublication">Date de publication</label>
                            <input type="date" 
                                   class="form-control @error('datepublication') is-invalid @enderror" 
                                   id="datepublication" 
                                   name="datepublication" 
                                   value="{{ old('datepublication', isset($annonce) ? $annonce->datepublication : date('Y-m-d')) }}" 
                                   required>
                        </div>

                        @if(Auth::user() instanceof App\Models\Administrateur)
                            <div class="form-group mb-3">
                                <label for="utilisateur_id">Expéditeur</label>
                                <select class="form-control @error('expediteur') is-invalid @enderror" 
                                        id="utilisateur_id" 
                                        name="expediteur" 
                                        required>
                                    <option value="">Sélectionnez un expéditeur</option>
                                    @foreach($utilisateurs as $utilisateur)
                                        <option value="{{ $utilisateur->id }}" 
                                                {{ old('expediteur', isset($annonce) ? $annonce->expediteur : '') == $utilisateur->id ? 'selected' : '' }}>
                                            {{ $utilisateur->nom }} {{ $utilisateur->prenom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($annonce) ? 'Mettre à jour' : 'Créer' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 