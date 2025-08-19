@php
    $isPropertyExists = $property->exists;
    $title = $isPropertyExists ? 'Editer un bien' : 'Ajouter un bien';
    $buttonText = $isPropertyExists ? 'Modifier la propriété' : 'Créer';
@endphp
@extends('admin.admin')
@section('title', $title)
@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0"> {{ $title }}</h1>
        <a href="{{ route('admin.property.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @include('admin.properties._partials._form')
        </div>
    </div>

@endsection