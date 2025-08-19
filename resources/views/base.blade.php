<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Agence Immo - Trouvez votre bien idéal')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            color: #333;
        }
        
        .navbar {
            background-color: var(--primary-color) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://plus.unsplash.com/premium_photo-1661902468735-eabf780f8ff6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8bWFpc29uJTIwZGUlMjBsdXhlfGVufDB8fDB8fHww');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 120px 0;
            margin-bottom: 60px;
        }
        
        .property-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            margin-bottom: 30px;
        }
        
        .property-card:hover {
            transform: translateY(-10px);
        }
        
        .property-img {
            height: 220px;
            object-fit: cover;
            width: 100%;
        }
        
        
        .property-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Badge pour les biens vendus */
        .badge-sold {
            background-color: #e74c3c; /* Rouge vif */
            box-shadow: 0 2px 5px rgba(231, 76, 60, 0.3);
        }
        
        /* Badge pour les biens en vente */
        .badge-available {
            background-color: #2ecc71; /* Vert frais */
            box-shadow: 0 2px 5px rgba(46, 204, 113, 0.3);
        }
        
        /* Badge pour les nouvelles offres */
        .badge-new {
            background-color: #3498db; /* Bleu */
            box-shadow: 0 2px 5px rgba(52, 152, 219, 0.3);
        }

        
        .property-price {
            color: var(--secondary-color);
            font-weight: 700;
            font-size: 1.4rem;
        }
        
        .property-features i {
            color: var(--secondary-color);
            margin-right: 5px;
        }
        
        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
        
        .section-title {
            position: relative;
            margin-bottom: 40px;
            padding-bottom: 15px;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--secondary-color);
        }
        
        footer {
            background-color: var(--primary-color);
            color: white;
            padding: 40px 0;
            margin-top: 60px;
        }
    </style>

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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animation au scroll
        document.addEventListener('DOMContentLoaded', function() {
            const propertyCards = document.querySelectorAll('.property-card');
            
            const animateOnScroll = () => {
                propertyCards.forEach(card => {
                    const cardPosition = card.getBoundingClientRect().top;
                    const screenPosition = window.innerHeight / 1.2;
                    
                    if(cardPosition < screenPosition) {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }
                });
            };
            
            // Initial state
            propertyCards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.5s ease';
            });
            
            window.addEventListener('load', animateOnScroll);
            window.addEventListener('scroll', animateOnScroll);
        });
    </script>
</body>
</html>