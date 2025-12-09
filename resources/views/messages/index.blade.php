@extends('Layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Messages</h3>
                    <a href="{{ route('messages.create') }}" class="btn btn-primary">Nouveau Message</a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        @foreach($messages as $message)
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 {{ $message->lu ? 'border-secondary' : 'border-primary' }}">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>De:</strong> {{ $message->sender->nom }} {{ $message->sender->prenom }}
                                            <br>
                                            <strong>À:</strong> {{ $message->receiver->nom }} {{ $message->receiver->prenom }}
                                        </div>
                                        <span class="badge {{ $message->lu ? 'bg-secondary' : 'bg-primary' }}">
                                            {{ $message->lu ? 'Lu' : 'Non lu' }}
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $message->sujet }}</h5>
                                        <p class="card-text">{{ Str::limit($message->contenu, 150) }}</p>
                                        <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('messages.show', $message) }}" class="btn btn-info btn-sm">
                                                <i class="bi bi-eye"></i> Voir
                                            </a>
                                            @if(Auth::user() instanceof App\Models\Administrateur || Auth::id() == $message->expediteur_id)
                                                <a href="{{ route('messages.edit', $message) }}" class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil"></i> Modifier
                                                </a>
                                                <form action="{{ route('messages.destroy', $message) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?')">
                                                        <i class="bi bi-trash"></i> Supprimer
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 