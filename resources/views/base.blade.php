<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Agence Immo - Trouvez votre bien idéal')</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    

    @yield(section: 'styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <i class="fas fa-home me-2"></i>Agence Immo
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">Accueil</a>
                </li>
            </ul>
            
            
            @auth
            <!-- Bouton de déconnexion ajouté ici -->
            <div class="d-flex">
                <a href="{{ route('auth.login') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  class="btn btn-outline-light">
                    <i class="fas fa-sign-in-alt me-2"></i>Déconnexion
                </a>
                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            @else
            <!-- Bouton de connexion ajouté ici -->
            <div class="d-flex">
                <a href="{{ route('auth.login') }}" class="btn btn-outline-light">
                    <i class="fas fa-sign-in-alt me-2"></i>Connexion
                </a>
            </div>
            @endauth
        </div>
    </div>
</nav>

    @yield('content')


    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="mb-3">Agence Immo</h5>
                    <p>Votre partenaire immobilier de confiance depuis 2008.</p>
                    <div class="social-icons">
                        <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">
                    <h5 class="mb-3">Liens</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white">Accueil</a></li>
                        <li class="mb-2"><a href="#" class="text-white">Acheter</a></li>
                        <li class="mb-2"><a href="#" class="text-white">Louer</a></li>
                        <li><a href="#" class="text-white">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h5 class="mb-3">Contact</h5>
                    <ul class="list-unstyled text-white">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> 123 Rue de Paris, 75000</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i> +33 1 23 45 67 89</li>
                        <li><i class="fas fa-envelope me-2"></i> contact@agence-immo.com</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="mb-3">Newsletter</h5>
                    <p>Abonnez-vous pour recevoir nos dernières offres</p>
                    <form>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Votre email">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="mt-4 bg-light">
            <div class="text-center pt-3">
                <p class="mb-0">&copy; 2023 Agence Immo. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    
</body>
</html>