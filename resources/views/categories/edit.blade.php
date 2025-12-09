@extends('layouts.app')
@section('title', 'Modifier la Catégorie')

@section('content')
    <h1 class="mb-4">Modifier la Catégorie</h1>

    <form action="{{ route('categories.update', $categorie) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="libelle" class="form-label">Libellé</label>
            <input type="text" name="libelle" id="libelle" class="form-control" value="{{ $categorie->libelle }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection