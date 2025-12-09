@extends('Layouts.app')
@section('title', 'Tableau de Bord Administrateur')

@section('content')
<div class="container">
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-megaphone"></i> Annonces</h5>
                    <p class="card-text display-4">{{ $stats['annonces_count'] }}</p>
                    <a href="{{ route('annonces.index') }}" class="text-white">Voir toutes les annonces →</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-tags"></i> Catégories</h5>
                    <p class="card-text display-4">{{ $stats['categories_count'] }}</p>
                    <a href="{{ route('categories.index') }}" class="text-white">Gérer les catégories →</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-people"></i> Utilisateurs</h5>
                    <p class="card-text display-4">{{ $stats['utilisateurs_count'] }}</p>
                    <span class="text-white">Total des utilisateurs</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-chat-dots"></i> Messages</h5>
                    <p class="card-text display-4">{{ $stats['messages_count'] }}</p>
                    <a href="{{ route('messages.index') }}" class="text-white">Voir les messages →</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Latest Annonces -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-megaphone"></i> Dernières Annonces</h5>
                    <a href="{{ route('annonces.index') }}" class="btn btn-sm btn-primary">Voir tout</a>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach($latest_annonces as $annonce)
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $annonce->titre }}</h6>
                                    <small>{{ $annonce->created_at->format('d/m/Y') }}</small>
                                </div>
                                <p class="mb-1">{{ number_format($annonce->prix, 2) }} DH</p>
                                <small>Par: {{ $annonce->utilisateur ? $annonce->utilisateur->nom : 'Utilisateur inconnu' }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Messages -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-chat-dots"></i> Derniers Messages</h5>
                    <a href="{{ route('messages.index') }}" class="btn btn-sm btn-primary">Voir tout</a>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach($latest_messages as $message)
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">De: {{ $message->sender->nom }} {{ $message->sender->prenom }}</h6>
                                    <small>{{ $message->created_at->format('d/m/Y H:i') }}</small>
                                </div>
                                <p class="mb-1">{{ Str::limit($message->contenu, 100) }}</p>
                                <small>À: {{ $message->receiver->nom }} {{ $message->receiver->prenom }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Overview -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-tags"></i> Catégories</h5>
                    <a href="{{ route('categories.index') }}" class="btn btn-sm btn-primary">Gérer les catégories</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Catégorie</th>
                                    <th>Nombre d'annonces</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->libelle }}</td>
                                        <td>{{ $category->annonces_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-5px);
}

.list-group-item {
    transition: background-color 0.2s;
}

.list-group-item:hover {
    background-color: #f8f9fa;
}

.bi {
    margin-right: 0.5rem;
}
</style>
@endsection 