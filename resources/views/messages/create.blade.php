@extends('Layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Nouveau message</h3>
                    <a href="{{ route('messages.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
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

                    <form action="{{ route('messages.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="expediteur" class="form-label">Expediteur</label>
                            <select name="expediteur" id="expediteur" class="form-select" required>
                                <option value="">Choisir un expediteur</option>
                                @foreach($utilisateurs as $utilisateur)
                                    <option value="{{ $utilisateur->id }}" @selected(old('expediteur') == $utilisateur->id)>
                                        {{ $utilisateur->nom }} {{ $utilisateur->prenom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="destinataire" class="form-label">Destinataire</label>
                            <select name="destinataire" id="destinataire" class="form-select" required>
                                <option value="">Choisir un destinataire</option>
                                @foreach($utilisateurs as $utilisateur)
                                    <option value="{{ $utilisateur->id }}" @selected(old('destinataire') == $utilisateur->id)>
                                        {{ $utilisateur->nom }} {{ $utilisateur->prenom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="contenu" class="form-label">Contenu</label>
                            <textarea
                                name="contenu"
                                id="contenu"
                                rows="4"
                                class="form-control"
                                required
                            >{{ old('contenu') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
