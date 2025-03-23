<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="../storage/images/travel.png"/>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Moon+Dance&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<!-- Custom CSS -->
<link href="{{ asset('storage/css/style.css') }}" rel="stylesheet">


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>

<!-- Custom JS -->
<script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/home#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('posts.index') }}">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/trips-tips">Trips & Tips</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('posts.index') }}">Shop</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('favorites.index') }}">Favorites</a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="home#contact">Contact</a>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                    
                        @endguest
                        
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-3">
            @yield('content')
        </main>
    </div>
    
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-1">&copy; 2025 FreeLIfe. All rights reserved.</p>
            <p class="mb-0">
                <a href="#about" class="text-white text-decoration-none">About</a> | 
                <a href="/blog" class="text-white text-decoration-none">Blog</a> | 
                <a href="#contact" class="text-white text-decoration-none">Contact</a>
            </p>
            <!-- Footer -->
            
<footer class="bg-dark text-white text-center py-2">
    <div class="container">
        <p>Subscribe to our Newsletter</p>
        <form action="{{ route('newsletter.subscribe') }}" method="POST">
            <div class="input-group d-flex  justify-content-center">
                <form action="{{ route('newsletter.subscribe') }}" method="POST">
                    @csrf
                    <input type="email" class="form-control newsletterInput" name="email" placeholder="Enter your email" aria-label="Email" required>
                    <button class="btn btn-primary" type="submit">Subscribe</button>
                </form>
            </div>
        </form>
    </div>
</footer>

<!-- Footer Styling -->
<style>
    footer {
        position: relative;
        bottom: 0;
        width: 100%;
    }
    
</style>

        </div>
    </footer>
    
</body>
</html>
