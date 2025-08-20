@extends('base')

@section('title', 'Tous nos biens immobiliers')

@section('content')
    <!-- Hero Section réduite pour la page liste -->
    <section class="hero-section-sm text-white py-5" style="background-color: var(--primary-color)">
        <div class="container text-center">
            <h1 class="fw-bold mb-3">Tous nos biens immobiliers</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center bg-transparent">
                    <li class="breadcrumb-item"><a href="/" class="text-white">Accueil</a></li>
                    <li class="breadcrumb-item active text-white-50" aria-current="page">Biens immobiliers</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Barre de filtres -->
    <section class="bg-light py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <p class="mb-0 fw-bold">
                        {{ $properties->total() }} biens disponibles
                    </p>
                </div>
                <div class="col-md-6">
                    <form class="row g-2">
                        <div class="col-md-8">
                            <select class="form-select" name="sort">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Plus récents</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                                <option value="surface_asc" {{ request('sort') == 'surface_asc' ? 'selected' : '' }}>Surface croissante</option>
                                <option value="surface_desc" {{ request('sort') == 'surface_desc' ? 'selected' : '' }}>Surface décroissante</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-sort me-1"></i> Trier
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Liste des biens avec pagination -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                @forelse($properties as $property)
                <div class="col-lg-4 col-md-6 mb-4">
                    @include('properties.card', ['property' => $property])
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle me-2"></i> Aucun bien ne correspond à votre recherche
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($properties->hasPages())
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    {{ $properties->links('pagination::bootstrap-5') }}
                </div>
            </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-primary text-white py-5">
        <div class="container text-center">
            <h2 class="mb-4">Vous ne trouvez pas votre bonheur ?</h2>
            <p class="lead mb-4">Notre équipe se tient à votre disposition pour vous aider dans votre recherche</p>
            <a href="#" class="btn btn-light btn-lg px-4">
                <i class="fas fa-envelope me-2"></i> Contactez-nous
            </a>
        </div>
    </section>
@endsection

@section('styles')
    @vite('resources/css/index.property.css')
@endsection