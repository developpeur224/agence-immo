@extends('base') <!-- Remplacez par le nom de votre fichier de base -->

@section('title', 'Connexion - Agence Immo')

@section('styles')
<style>
    .card {
        border-radius: 15px;
        border: none;
    }
    
    .form-control {
        height: 50px;
        border-radius: 8px;
    }
    
    .btn-outline-primary {
        color: var(--secondary-color);
        border-color: var(--secondary-color);
    }
    
    .btn-outline-primary:hover {
        background-color: var(--secondary-color);
        color: white;
    }
    
    .alert {
        border-radius: 8px;
    }
</style>
@endsection

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">Connexion</h2>
                    
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <form method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Se connecter</button>
                        </div>
                        
                        <div class="text-center mt-3">
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none" href="{{ route('password.request') }}">
                                    Mot de passe oublié ?
                                </a>
                            @endif
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection