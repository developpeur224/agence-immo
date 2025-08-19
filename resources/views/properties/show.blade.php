@extends('base')

@section('content')
<div class="container py-5">

    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">{{ $property->title }}</h1>
        <span class="badge bg-{{ $property->sold ? 'danger' : 'success' }} fs-6">
            {{ $property->sold ? 'Vendu' : 'À vendre' }}
        </span>
    </div>
    @php
    $pathImgDefault = 'https://plus.unsplash.com/premium_photo-1661902468735-eabf780f8ff6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8bWFpc29uJTIwZGUlMjBsdXhlfGVufDB8fDB8fHww';
    @endphp
    <!-- Galerie d'images -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="property-gallery">
                    <!-- Image principale -->
                    <img id="mainImage" src="{{ $property->image ? asset('storage/' . $property->image) : $pathImgDefault }}"
                        class="card-img-top"
                        alt="{{ $property->title }}">
                </div>
            </div>
            <!-- Description et détails -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="h4 card-title mb-4">Description</h2>
                    <div class="property-description">
                        {!! nl2br(e($property->description)) !!}
                    </div>
                </div>
            </div>

            <!-- Caractéristiques -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="h4 card-title mb-4">Caractéristiques</h2>
                    <div class="row">
                        @foreach($property->options as $option)
                        <div class="col-md-6 mb-2">
                            <i class="fas fa-check text-success me-2"></i> {{ $option->name }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Localisation -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h4 card-title mb-4">Localisation</h2>
                    <div class="ratio ratio-16x9">
                        <iframe
                            src="https://maps.google.com/maps?q={{ $property->address }},{{ $property->city }}&output=embed"
                            allowfullscreen
                            loading="lazy">
                        </iframe>
                    </div>
                    <div class="mt-3">
                        <p class="mb-1"><strong>Adresse complète :</strong></p>
                        <p class="mb-0">{{ $property->address }}, {{ $property->postal_code }} {{ $property->city }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar avec infos clés -->
        <div class="col-md-4">
            <div class="card shadow-sm sticky-top" style="top: 20px;">
                <div class="card-body">
                    <h3 class="h4 text-primary mb-4">{{ number_format($property->price, 0, ',', ' ') }} GNF</h3>

                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-ruler-combined text-muted me-2"></i> Surface</span>
                            <strong>{{ $property->surface }} m²</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-door-open text-muted me-2"></i> Pièces</span>
                            <strong>{{ $property->rooms }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-bed text-muted me-2"></i> Chambres</span>
                            <strong>{{ $property->bedrooms }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-layer-group text-muted me-2"></i> Étage</span>
                            <strong>{{ $property->floor ?? 'Rez-de-chaussée' }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-map-marker-alt text-muted me-2"></i> Localisation</span>
                            <strong>{{ $property->city }} ({{ $property->postal_code }})</strong>
                        </li>
                    </ul>

                    <button class="btn btn-primary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#contactModal">
                        <i class="fas fa-envelope me-2"></i> Contacter l'agence
                    </button>

                    <div class="d-flex justify-content-center gap-2">
                        <!-- Boutons d'action ... -->
                    </div>

                    <!-- Section des images du bien -->
                    <div class="mt-4">
                        <h4 class="h5 mb-3 border-bottom pb-2">Images du bien</h4>

                        <!-- Images secondaires -->
                        @if($property->images && count($property->images) > 0)
                        @foreach($property->images as $image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $image->path) }}"
                                alt="Image du bien"
                                class="img-fluid rounded shadow-sm w-100"
                                style="max-height: 150px; object-fit: cover;">
                        </div>
                        @endforeach
                        @else
                        <div class="alert alert-info small py-2">
                            Aucune image supplémentaire disponible
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de contact -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Intéressé par ce bien ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('property.contact', $property) }}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="row">
                         @include('components.input', [
                            'name' => 'firstname',
                            'type' => 'text',
                            'label' => 'Prénom',
                            'value' => 'Thierno Mika',
                            'required' => true,
                            'wrapperClass' => 'col-md-6',
                            'placeholder' => 'Entrez votre prénom'
                        ])

                        @include('components.input', [
                            'name' => 'lastname',
                            'type' => 'text',
                            'label' => 'Nom',
                            'value' => 'Diallo',
                            'required' => true,
                            'wrapperClass' => 'col-md-6',
                            'placeholder' => 'Entrez votre nom'
                        ])
                    </div>
                    
                    <div class="row">
                        @include('components.input', [
                            'name' => 'email',
                            'type' => 'email',
                            'label' => 'E-mail',
                            'value' => 'mika.diallo@global-itec.com',
                            'required' => true,
                            'wrapperClass' => 'col-md-6',
                            'placeholder' => 'Entrez votre email'
                        ])

                        @include('components.input', [
                            'name' => 'phone',
                            'type' => 'tel',
                            'label' => 'Téléphone',
                            'value' => '+224625235760',
                            'required' => true,
                            'wrapperClass' => 'col-md-6',
                            'placeholder' => 'Entrez votre téléphone'
                        ])
                    </div>
                    
                    @include('components.textarea', [
                        'name' => 'message',
                        'label' => 'Message',
                        'required' => true,
                        'rows' => 4,
                        'value' => "Je suis intéressé par le bien \"{$property->title}\" (Réf: {$property->id}).
                        "
                    ])

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Biens similaires -->

@if($similarProperties->count() > 0)
<section class="bg-light py-5">
    <div class="container">
        <h2 class="h3 text-center mb-5">Biens similaires</h2>
        <div class="row">
            @foreach($similarProperties as $property)
            <div class="col-lg-3 col-md-6 mb-4">
                @include('properties.card', ['property' => $property])
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@section('styles')

<style>
    .image-container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        min-height: 120px;
        /* Ajustez selon vos besoins */
        padding: 5px;
        overflow: hidden;
    }

    .property-gallery {
        position: relative;
    }

    .thumbnail {
        transition: all 0.3s ease;
    }

    .thumbnail:hover {
        transform: scale(1.05);
        opacity: 0.9;
    }

    .property-description {
        line-height: 1.8;
        white-space: pre-line;
    }

    .list-group-item {
        padding: 0.75rem 0;
        border-color: rgba(0, 0, 0, 0.05);
    }
</style>
@endsection