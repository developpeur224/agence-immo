@extends('admin.admin')
@section('title', 'Liste des biens')

@section('content')
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Les biens</h1>
            <a href="{{ route('admin.property.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Ajouter une propriété
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-nowrap">ID</th>
                                <th>Titre</th>
                                <th>Surface</th>
                                <th>Pièces</th>
                                <th>Chambres</th>
                                <th>Étage</th>
                                <th class="text-nowrap">Prix</th>
                                <th>Ville</th>
                                <th>Code postal</th>
                                <th>Adresse</th>
                                <th>Vendu</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($properties as $property)
                                <tr>
                                    <td class="fw-bold">#{{ $loop->iteration }}</td>
                                    <td>{{ Str::limit($property->title, 20) }}</td>
                                    <td>{{ $property->surface }} m²</td>
                                    <td>{{ $property->rooms }}</td>
                                    <td>{{ $property->bedrooms }}</td>
                                    <td>{{ $property->floor ?? '-' }}</td>
                                    <td class="text-success fw-bold">{{ number_format($property->price, thousands_separator: ' ') }} GNF</td>
                                    <td>{{ $property->city }}</td>
                                    <td>{{ $property->postal_code }}</td>
                                    <td>{{ Str::limit($property->address, 15) }}</td>
                                    <td>
                                        @if($property->sold)
                                            <span class="badge bg-danger">Vendu</span>
                                        @else
                                            <span class="badge bg-success">Disponible</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.property.edit', $property) }}" class="btn btn-sm btn-outline-secondary me-1" title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.property.destroy', $property) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr ?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div> 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $properties->links('pagination::bootstrap-5') }}
        </div>
@endsection