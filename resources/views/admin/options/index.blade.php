@extends('admin.admin')

@section('title', 'Liste des options')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Les options</h1>
        <a href="{{ route('admin.option.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter une option
        </a>
    </div>

    <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-nowrap">ID</th>
                                <th>Nom</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($options as $option)
                                <tr>
                                    <td class="fw-bold">#{{ $loop->iteration }}</td>
                                    <td>{{ $option->name }}</td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.option.edit', $option) }}" class="btn btn-sm btn-outline-secondary me-1" title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.option.destroy', $option) }}" method="POST" class="d-inline">
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
            {{ $options->links('pagination::bootstrap-5') }}
        </div>
@endsection