@php
use App\Models\Annonce;
@endphp

@extends('Layouts.app')

@section('content')
<div class="container">
    <!-- Category Search Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('annonces.index') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="category_id" class="col-form-label">Filtrer par catégorie:</label>
                </div>
                <div class="col-auto">
                    <select name="category_id" id="category_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->libelle }} ({{ $category->annonces_count }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Annonces</h3>
                    <a href="{{ route('annonces.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Nouvelle Annonce
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row g-4">
                        @foreach($annonces as $annonce)
                            <div class="col-md-4">
                                <div class="card h-100 shadow-sm">
                                    @if($annonce->photo)
                                        <img src="{{ asset('storage/' . $annonce->photo) }}" 
                                             class="card-img-top" 
                                             alt="{{ $annonce->titre }}"
                                             style="height: 200px; object-fit: cover;">
                                    @else
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                             style="height: 200px;">
                                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $annonce->titre }}</h5>
                                        <p class="card-text text-muted">{{ Str::limit($annonce->description, 100) }}</p>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="badge bg-primary">{{ $annonce->categorie_libelle }}</span>
                                            <span class="text-primary fw-bold">{{ number_format($annonce->prix, 2) }} DH</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                <i class="bi bi-person"></i> {{ $annonce->utilisateur ? $annonce->utilisateur->nom : 'Utilisateur inconnu' }}
                                            </small>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar"></i> {{ $annonce->datepublication }}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <div class="btn-group w-100" role="group">
                                            <a href="{{ route('annonces.show', $annonce) }}" 
                                               class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-eye"></i> Voir
                                            </a>
                                            @if(Auth::user() instanceof App\Models\Administrateur || Auth::id() == $annonce->expediteur)
                                                <a href="{{ route('annonces.edit', $annonce) }}" 
                                                   class="btn btn-outline-warning btn-sm">
                                                    <i class="bi bi-pencil"></i> Modifier
                                                </a>
                                                <form action="{{ route('annonces.destroy', $annonce) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-outline-danger btn-sm" 
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')">
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

@push('scripts')
<script>
    // Optional: Add any JavaScript enhancements here
    document.getElementById('category_id').addEventListener('change', function() {
        this.form.submit();
    });
</script>
@endpush
@endsection 