@extends('Layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Details du message</h3>
                    <a href="{{ route('messages.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <strong>De:</strong>
                        {{ $message->sender->nom }} {{ $message->sender->prenom }}
                    </div>

                    <div class="mb-3">
                        <strong>A:</strong>
                        {{ $message->receiver->nom }} {{ $message->receiver->prenom }}
                    </div>

                    <div class="mb-3">
                        <strong>Contenu:</strong>
                        <div class="border rounded p-3 mt-2 bg-light">
                            {{ $message->contenu }}
                        </div>
                    </div>

                    <div class="text-muted">
                        Envoye {{ $message->created_at->diffForHumans() }}
                    </div>
                </div>

                @auth
                    @if(Auth::user() instanceof App\Models\Administrateur || Auth::id() == ($message->expediteur_id ?? $message->expediteur))
                        <div class="card-footer bg-transparent">
                            <div class="d-flex gap-2">
                                <a href="{{ route('messages.edit', $message) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Modifier
                                </a>
                                <form action="{{ route('messages.destroy', $message) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Etes-vous sur de vouloir supprimer ce message ?')"
                                    >
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
