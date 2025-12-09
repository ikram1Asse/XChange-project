@extends('layouts.app')
@section('title', 'Créer une Catégorie')

@section('content')
    <h1 class="mb-4">Créer une Nouvelle Catégorie</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="libelle" class="form-label">Libellé</label>
            <input type="text" name="libelle" id="libelle" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection