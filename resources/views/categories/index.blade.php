@extends('layouts.app')
@section('title', 'Gestion des Catégories')

@section('content')
    <h1 class="mb-4">Liste des Catégories</h1>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Nouvelle Catégorie</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Libellé</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $categorie)
                <tr>
                    <td>{{ $categorie->id }}</td>
                    <td>{{ $categorie->libelle }}</td>
                    <td>
                        <a href="{{ route('categories.show', $categorie) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('categories.edit', $categorie) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('categories.destroy', $categorie) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection