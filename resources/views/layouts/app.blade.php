<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Icon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('img/logo_hotelNservices.jpg') }}">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
        }
        .navbar {
            display: block;
        }
        .navbar-nar{
            margin-right: 1000px;
        }
        .logo-text {
            font-family: 'Pacifico', serif;
            color: #000;
            text-decoration: none;
            pointer-events: none;
            margin-left: 8px;
        }
        .navbar-nav{
            margin-left: 140px;
        }
        .navbar-brand img {
            height: 50px;
            width: auto;
            vertical-align: middle;
        }
        .nav-link {
            padding: 10px 15px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .nav-link:hover {
            background-color: #f8cb45;
            color: #000 !important;
            border-radius: 4px;
        }
        .nav-link.active {
            background-color: #f8cb45;
            color: #000 !important;
            border-radius: 4px;
        }
        .btn-primary {
            background-color: #f8cb45;
            border-color: #f8cb45;
            color: #000;
        }
        .btn-primary:hover {
            background-color: #e0b33d;
            border-color: #e0b33d;
        }
        .memberImage{
            max-width: 100%;
            height: 300px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <!-- Header Navigation -->
    <header class="bg-light shadow-sm">
        <nav class="navbar navbar-expand-md navbar-light bg-light container">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('img/logo_hotelNservices.jpg') }}" alt="KagayakuKin Yume Logo">
                    </a>
                    <span class="logo-text fs-3">KagayakuKin Yume Hotel</span>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('explore') ? 'active' : '' }}" href="{{ route('explore') }}">Explore</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('rooms') ? 'active' : '' }}" href="{{ route('rooms') }}">Rooms</a>
                        </li>   
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>
                    <div class="d-flex gap-2 ms-auto">
                        <a href="" class="btn btn-primary">Book now</a>
                        <a href="" class="btn btn-outline-secondary">Sign Up/Login</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3 class="fs-5 mb-3">About Us</h3>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">Our Story</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Awards & Recognition</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Careers</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Press Room</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3 class="fs-5 mb-3">Contact</h3>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-geo-alt me-2"></i> 123 Luxury Avenue, Cityscape, Country</li>
                        <li><i class="bi bi-telephone me-2"></i> +1 (555) 123-4567</li>
                        <li><i class="bi bi-envelope me-2"></i> info@luxuryhotel.com</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3 class="fs-5 mb-3">Follow Us</h3>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-gray-600 mt-4">
            <p class="text-center text-gray-400">© 2025 Luxury Hotel. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>