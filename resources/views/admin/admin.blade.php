<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Administration</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/base.admin.css'])

    @yield('styles')
</head>
<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-house-gear me-2"></i>Administration
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('admin.property.*')) active @endif" 
                           href="{{ route('admin.property.index') }}">
                            <i class="bi bi-house-door me-1"></i> Mes biens
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('admin.option.*')) active @endif" 
                           href="{{ route('admin.option.index') }}">
                            <i class="bi bi-tags me-1"></i> Options
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i> Déconnexion
                        </a>
                        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Toast Container -->
    <div class="toast-container">
        @foreach (['success', 'error', 'warning', 'info'] as $index => $msg)

            @if(session()->has($msg))
                <div class="toast align-items-center text-white bg-{{ $msg == 'error' ? 'danger' : $msg  }} border-0" 
                     role="alert" aria-live="assertive" aria-atomic="true" 
                     data-bs-autohide="true" data-bs-delay="{{ $index * 2000 }}">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="bi 
                                @if($msg == 'success') bi-check-circle-fill
                                @elseif($msg == 'error') bi-x-circle-fill
                                @elseif($msg == 'warning') bi-exclamation-triangle-fill
                                @else bi-info-circle-fill
                                @endif
                            "></i>
                            {{ session($msg) }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" 
                                data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Bootstrap JS (avec Popper inclus) -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>
    <script>
       
    </script>
    @yield('scripts')
</body>
</html>