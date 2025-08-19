@php
    $isOptionExists = $option->exists;
    $name = $isOptionExists ? 'Editer une option' : 'Ajouter une option';
    $buttonText = $isOptionExists ? 'Modifier l\'option' : 'Créer une option';
@endphp
@extends('admin.admin')
@section('title', $name)
@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0"> {{ $name }}</h1>
        <a href="{{ route('admin.option.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @include('admin.options._partials._form')
        </div>
    </div>

@endsection