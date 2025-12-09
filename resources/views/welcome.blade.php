@extends('Layouts.app')

@section('title', 'Accueil')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Bienvenue sur <b>XCHANGE</b></h1>
                <p class="hero-subtitle"><i>La plateforme qui facilite vos échanges</i></p>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-custom">
                        Commencer maintenant
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="featured-section">
        <div class="container">
            <h2 class="section-title">Nos Services</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <i class="bi bi-arrow-left-right feature-icon"></i>
                    <h3>Échanges Faciles</h3>
                    <p>Échangez vos objets en toute simplicité</p>
                </div>
                <div class="feature-item">
                    <i class="bi bi-shield-check feature-icon"></i>
                    <h3>Sécurisé</h3>
                    <p>Transactions sécurisées et vérifiées</p>
                </div>
                <div class="feature-item">
                    <i class="bi bi-people feature-icon"></i>
                    <h3>Communauté</h3>
                    <p>Rejoignez une communauté active</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Announcements Section -->
    <section class="featured-section" style="background-color: var(--light-beige);">
        <div class="container">
            <h2 class="section-title">Dernières Annonces</h2>
            <div class="row">
                @foreach($featured_annonces as $annonce)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if($annonce->photo)
                                <img src="{{ asset('public/images/' . $annonce->photo) }}" 
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
                                    <span class="badge bg-primary">{{ $annonce->categorie->libelle }}</span>
                                    <span class="text-primary fw-bold">{{ number_format($annonce->prix, 2) }} DH</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="bi bi-person"></i> {{ $annonce->utilisateur ? $annonce->utilisateur->nom : 'Utilisateur inconnu' }}
                                    </small>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar"></i> {{ $annonce->created_at->format('d/m/Y') }}
                                    </small>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent">
                                @auth
                                    <a href="{{ route('annonces.show', $annonce) }}" class="btn btn-primary btn-sm w-100">
                                        <i class="bi bi-eye"></i> Voir les détails
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm w-100">
                                        <i class="bi bi-box-arrow-in-right"></i> Connectez-vous pour voir
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="featured-section">
        <div class="container">
            <h2 class="section-title">Catégories Populaires</h2>
            <div class="row">
                @foreach($categories as $category)
                <div class="col-md-4 mb-4">
                    <div class="category-card">
                        <i class="bi bi-tag category-icon"></i>
                        <h3 class="category-title">{{ $category->libelle }}</h3>
                        <p class="category-count">{{ $category->annonces_count }} annonces</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>À propos de XCHANGE</h5>
                    <p>Votre plateforme de confiance pour les échanges entre particuliers.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Liens Rapides</h5>
                    <ul class="list-unstyled">
                        @guest
                            <li><a href="{{ route('login') }}">Connexion</a></li>
                            <li><a href="{{ route('register') }}">Inscription</a></li>
                        @else
                            <li><a href="{{ route('dashboard') }}">Tableau de Bord</a></li>
                            <li><a href="{{ route('annonces.index') }}">Annonces</a></li>
                            <li><a href="{{ route('messages.index') }}">Messages</a></li>
                        @endguest
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Contact</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-envelope"></i> xchange@gmail.com</li>
                        <li><i class="bi bi-telephone"></i> +212 661 123 456</li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-4">
                <p>&copy; {{ date('Y') }} XCHANGE. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
@endsection

@section('styles')
<style>
    :root {
        --primary-color: #E5D3B3;
        --secondary-color: #F5F5F2;
        --accent-color: rgb(112, 91, 68);
        --dark-brown: rgb(78, 47, 12);
        --light-beige: rgb(241, 240, 236);
        --text-color: #333333;
    }

    .hero-section {
        background-image: url('{{ asset('images/herobg.png') }}');
        background-size: cover;
        background-position: center;
        height: 100vh;
        padding: 200px 0 100px;
        position: relative;
        overflow: hidden;
        margin-top: -1.5rem;
    }

    .hero-content {
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
        background-color: rgba(255, 255, 255, 0.9);
        padding: 3rem;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .hero-title {
        font-size: 3.5rem;
        color: var(--dark-brown);
        margin-bottom: 1.5rem;
        font-weight: 300;
        letter-spacing: 1px;
    }

    .hero-subtitle {
        font-size: 1.5rem;
        color: var(--accent-color);
        margin-bottom: 2.5rem;
        font-weight: 300;
    }

    .featured-section {
        padding: 80px 0;
        background-color: white;
    }

    .section-title {
        font-size: 2.5rem;
        color: var(--dark-brown);
        text-align: center;
        margin-bottom: 3rem;
        font-weight: 300;
    }

    .category-card {
        background-color: var(--secondary-color);
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        margin-bottom: 2rem;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .category-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .btn-custom {
        background-color: var(--accent-color);
        color: white;
        padding: 1rem 2.5rem;
        border-radius: 30px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        border: none;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-custom:hover {
        background-color: var(--dark-brown);
        color: white;
        transform: translateY(-2px);
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        padding: 2rem 0;
    }

    .feature-item {
        text-align: center;
        padding: 2rem;
    }

    .feature-icon {
        font-size: 2.5rem;
        color: var(--accent-color);
        margin-bottom: 1rem;
    }

    .card {
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    /* Footer Styles */
    .footer {
        background-color: var(--dark-brown);
        color: var(--light-beige);
        padding: 60px 0 40px;
        margin-top: 0;
    }

    .footer h5 {
        color: var(--primary-color);
        margin-bottom: 1.5rem;
        font-weight: 300;
        font-size: 1.2rem;
    }

    .footer p {
        color: var(--light-beige);
        opacity: 0.8;
    }

    .footer ul li {
        margin-bottom: 0.8rem;
    }

    .footer a {
        color: var(--light-beige);
        text-decoration: none;
        transition: color 0.3s ease;
        opacity: 0.8;
    }

    .footer a:hover {
        color: var(--primary-color);
        opacity: 1;
    }

    .footer .bi {
        margin-right: 0.5rem;
        color: var(--primary-color);
    }

    .footer .text-center {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 2rem;
        margin-top: 2rem;
    }

    .footer .text-center p {
        margin-bottom: 0;
        font-size: 0.9rem;
        opacity: 0.7;
    }
</style>
@endsection
