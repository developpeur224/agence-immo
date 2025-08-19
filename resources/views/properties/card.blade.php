<div class="property-card h-100">
    @if($property->sold)
    <span class="property-badge badge-sold">
        <i class="fas fa-tag me-1"></i> Vendu
    </span>
    @else
    @if($property->created_at->diffInDays() < 7)
        <span class="property-badge badge-new">
        <i class="fas fa-star me-1"></i> Nouveau
        </span>
        @else
        <span class="property-badge badge-available">
            <i class="fas fa-home me-1"></i> Disponible
        </span>
        @endif
        @endif

<img src="{{ $property->image ? asset('storage/' . $property->image) : 'https://plus.unsplash.com/premium_photo-1661902468735-eabf780f8ff6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8bWFpc29uJTIwZGUlMjBsdXhlfGVufDB8fDB8fHww' }}" 
     class="property-img" 
     alt="{{ $property->title }}">
     
        <div class="card-body m-4">
            <h5 class="card-title">{{ $property->title }}</h5>
            <p class="text-muted mb-3">
                <i class="fas fa-map-marker-alt"></i> {{ $property->city }}, {{ $property->postal_code }}
            </p>

            <div class="property-features mb-3">
                <span class="me-3"><i class="fas fa-ruler-combined"></i> {{ $property->surface }} m²</span>
                <span class="me-3"><i class="fas fa-bed"></i> {{ $property->bedrooms }} ch.</span>
                <span><i class="fas fa-door-open"></i> {{ $property->rooms }} pièces</span>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div class="property-price">
                    {{ number_format($property->price, 0, ',', ' ') }} GNF
                </div>
                <a href="{{ route('property.show', $property) }}" class="btn btn-sm btn-outline-primary">
                    Voir plus <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
</div>