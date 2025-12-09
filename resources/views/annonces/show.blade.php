@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>{{ $annonce->titre }}</h3>
                    <a href="{{ route('annonces.index') }}" class="btn btn-secondary">Retour</a>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            @if($annonce->photo)
                                <img src="{{ asset('storage/' . $annonce->photo) }}" 
                                     alt="{{ $annonce->titre }}" 
                                     class="img-fluid rounded">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                     style="height: 300px;">
                                    <i class="bi bi-image text-muted" style="font-size: 4rem;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h4 class="text-primary">Prix: {{ number_format($annonce->prix, 2) }} €</h4>
                            <p><strong>Catégorie:</strong> {{ $annonce->categorie->libelle }}</p>
                            <p><strong>Date de publication:</strong> {{ $annonce->datepublication }}</p>
                            <p><strong>Expéditeur:</strong> {{ $annonce->utilisateur ? $annonce->utilisateur->nom : 'Utilisateur inconnu' }}</p>
                        </div>
                    </div>
                    
                    <div class="description-section">
                        <h5>Description</h5>
                        <p class="text-justify">{{ $annonce->description }}</p>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('annonces.edit', $annonce) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('annonces.destroy', $annonce) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 