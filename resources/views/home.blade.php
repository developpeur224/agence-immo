@extends('base')

@section('content')
     <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Trouvez votre bien idéal</h1>
            <p class="lead mb-5">Découvrez notre sélection exclusive de propriétés</p>
            
            <!-- Search Form -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-body">
                            <form class="row g-3">
                                <div class="col-md-4">
                                    <select class="form-select">
                                        <option selected>Type de bien</option>
                                        <option>Maison</option>
                                        <option>Appartement</option>
                                        <option>Terrain</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select">
                                        <option selected>Localisation</option>
                                        <option>Paris</option>
                                        <option>Lyon</option>
                                        <option>Marseille</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-search me-2"></i>Rechercher
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Properties Section -->
    <section class="container mb-5">
        <h2 class="text-center section-title">Nos dernières offres</h2>
        
        <div class="row">
            @foreach($properties as $property)
            <div class="col-lg-4 col-md-6 mt-4">
                @include('properties.card')
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('property.index') }}" class="btn btn-primary px-4 py-2">
                Voir tous nos biens <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center mb-4 mb-md-0">
                    <div class="p-4">
                        <i class="fas fa-shield-alt fa-3x mb-3 text-primary"></i>
                        <h4>Sécurité</h4>
                        <p class="text-muted">Transactions sécurisées avec nos notaires partenaires</p>
                    </div>
                </div>
                <div class="col-md-4 text-center mb-4 mb-md-0">
                    <div class="p-4">
                        <i class="fas fa-search-dollar fa-3x mb-3 text-primary"></i>
                        <h4>Expertise</h4>
                        <p class="text-muted">Notre équipe d'experts à votre service</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="p-4">
                        <i class="fas fa-handshake fa-3x mb-3 text-primary"></i>
                        <h4>Confiance</h4>
                        <p class="text-muted">Plus de 15 ans d'expérience dans l'immobilier</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
   