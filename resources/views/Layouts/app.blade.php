<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - XCHANGE </title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color:rgb(223, 214, 198);
            --secondary-color:rgb(219, 217, 213);
            --accent-color:rgb(112, 91, 68) ;
            --dark-brown:rgb(78, 47, 12);
            --light-beig:rgb(241, 240, 236);
        }

        .navbar-custom {
            background-color: var(--light-beig) !important;
        }

        .navbar-custom .navbar-brand img {
            height: 70px;
            width: auto;
        }

        .navbar-custom .nav-link {
            color: var(--dark-brown) !important;
        }

        .navbar-custom .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .navbar-custom .nav-link.active {
            color: var(--accent-color) !important;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--dark-brown);
        }

        .btn-primary:hover {
            background-color: var(--dark-brown);
            border-color: var(--dark-brown);
        }

        .bg-primary {
            background-color: var(--primary-color) !important;
        }

        .text-primary {
            color: var(--primary-color) !important;
        }

        .badge.bg-primary {
            background-color: var(--primary-color) !important;
        }

        .dropdown-item:active {
            background-color: var(--primary-color);
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/LogoXChange2-Picsart.png') }}" alt="XCHANGE" style="height: 70px; width: auto;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth
                        @if(auth()->user() instanceof App\Models\Administrateur)
                            <li class="nav-item">
                                <a class="nav-link @if(Route::currentRouteName() == 'admin.dashboard') active @endif" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> Tableau de Bord Admin
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(Route::currentRouteName() == 'categories.index') active @endif" href="{{ route('categories.index') }}">
                                    <i class="bi bi-tags"></i> Catégories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(Route::currentRouteName() == 'administrateurs.index') active @endif" href="{{ route('administrateurs.index') }}">
                                    <i class="bi bi-people"></i> Administrateurs
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link @if(Route::currentRouteName() == 'dashboard') active @endif" href="{{ route('dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> Tableau de Bord
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link @if(Route::currentRouteName() == 'annonces.index') active @endif" href="{{ route('annonces.index') }}">
                                <i class="bi bi-megaphone"></i> Annonces
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Route::currentRouteName() == 'messages.index') active @endif" href="{{ route('messages.index') }}">
                                <i class="bi bi-chat-dots"></i> Messages
                            </a>
                        </li>
                    @endauth
                </ul>
                <ul class="navbar-nav">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->nom }} {{ Auth::user()->prenom }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Connexion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="bi bi-person-plus"></i> Inscription
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @yield('scripts')
</body>
</html>