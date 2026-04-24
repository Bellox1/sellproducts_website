<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Eat&Drink')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&display=swap');

        :root {
            --primary-color: #f47668;
            --secondary-color: #f39c12;
            --dark-color: #2c3e50;
            --light-color: #ecf0f1;
        }

        body {
            font-family: 'Syne', sans-serif;
            background-color: #f8f9fa;
            color: var(--dark-color);
        }



        .hero-section {
            position: relative;
            height: 100vh;
            min-height: 600px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-hero-section {
            padding-top: 15rem;
            padding-bottom: 8rem;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-glass-auth {
            display: inline-block;
            padding: 12px 30px;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 50px;
            color: #64748b !important;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-glass-auth:hover {
            background: rgba(255, 255, 255, 0.8);
            color: #1e293b !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .hero-video {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            transform: translate3d(-50%, -50%, 0);
            object-fit: cover;
            z-index: 1;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }

        .hero-overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Darkened for better contrast */
            z-index: 2;
        }

        /* Buttons Style */
        .btn-glass,
        .btn-primary,
        .btn-danger,
        .btn-outline-danger,
        .btn-outline-dark,
        .navbar .btn {
            font-family: 'Syne', sans-serif;
            background: transparent !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
            border: none !important;
            /* No border as requested */
            color: #64748b !important;
            border-radius: 30px !important;
            padding: 5px 15px !important;
            font-size: 0.85rem !important;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: none;
            box-shadow: none !important;
        }

        .btn-glass:hover,
        .btn-primary:hover,
        .btn-danger:hover,
        .btn-outline-danger:hover,
        .btn-outline-dark:hover,
        .navbar .btn:hover {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.5) !important;
            transform: translateY(-1px);
            color: white !important;
        }

        /* Dark buttons for light backgrounds */
        .btn-glass-dark {
            background: transparent !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
            border: 1px solid rgba(0, 0, 0, 0.15) !important;
            color: #333 !important;
            padding: 5px 15px !important;
            font-size: 0.8rem !important;
            border-radius: 30px !important;
        }

        .btn-glass-dark:hover {
            background: rgba(0, 0, 0, 0.05) !important;
            color: #000 !important;
        }

        /* Initial transparent navbar */
        .navbar {
            background: transparent !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
            box-shadow: none !important;
            border-bottom: none !important;
            padding: 0.5rem 0;
            /* Minimal height */
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 9999;
            transition: all 0.3s ease-in-out;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.4) !important;
            backdrop-filter: blur(20px) !important;
            -webkit-backdrop-filter: blur(20px) !important;
            padding: 5px 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3) !important;
        }

        .navbar.scrolled .navbar-brand,
        .navbar.scrolled .nav-link,
        .navbar.scrolled .btn:not(.btn-primary):not(.btn-danger) {
            color: #000 !important;
            /* Dark text for readable header */
        }

        .navbar.scrolled .btn-outline-dark {
            border-color: rgba(0, 0, 0, 0.2) !important;
        }

        .navbar-brand {
            font-family: 'Syne', sans-serif;
            color: white !important;
            font-size: 1.9rem;
            font-weight: 800;
            letter-spacing: -2px;
            /* Very tight as per Syne aesthetic */
            margin-right: auto;
            transition: all 0.3s ease;
            text-transform: uppercase;
        }

        .navbar.scrolled .navbar-brand {
            color: #333 !important;
        }

        .navbar.scrolled .btn,
        .navbar.scrolled .nav-link {
            color: #777 !important;
            /* Gray text as requested */
        }

        .navbar-nav {
            margin-left: auto !important;
            /* Push nav list to right */
        }

        .navbar .nav-link {
            font-family: 'Syne', sans-serif;
            color: white !important;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 0.5rem 1rem !important;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Sound Toggle Style */
        .sound-toggle {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 600px;
            /* Placeholder to match structure? No, let's make it a circle */
        }

        .sound-toggle {
            position: fixed !important;
            bottom: 30px;
            right: 30px;
            width: 55px !important;
            height: 55px !important;
            background: rgba(255, 255, 255, 0.2) !important;
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            /* Black icon */
            cursor: pointer;
            z-index: 9999;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .sound-toggle:hover {
            transform: scale(1.1);
            background: rgba(255, 255, 255, 0.4) !important;
        }

        .sound-toggle i {
            font-size: 1.6rem;
            color: #000;
        }

        /* Preloader Styles */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000;
            z-index: 9999;
            overflow: hidden;
            padding: 20px;
            /* Slight padding to reduce size */
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.8s ease-in-out, visibility 0.8s;
        }

        .preloader-gallery {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            width: 100%;
            height: calc(100% - 40px);
        }

        .preloader-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 4px;
            opacity: 0;
            /* Initial state: at center, scaled down */
            transform: scale(0);
            transition: all 1s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .preloader-img.show {
            opacity: 1;
            transform: scale(1) translateZ(0);
        }

        body.loaded #preloader {
            opacity: 0;
            visibility: hidden;
        }

        body.loaded .hero-section,
        body.loaded .navbar {
            opacity: 1;
            visibility: visible;
        }

        .hero-section,
        .navbar {
            opacity: 0;
            visibility: hidden;
            transition: opacity 1s ease-in-out;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%) !important;
            background-attachment: fixed !important;
            font-family: 'Syne', sans-serif;
            padding-top: 0;
            overflow-x: hidden;
            /* Fix horizontal scroll */
        }

        body:not(.intro-active) {
            padding-top: 100px;
        }

        body.loaded {
            overflow: auto;
        }

        .vitrine-bg-blobs {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
        }

        .vitrine-bg-blobs::before,
        .vitrine-bg-blobs::after {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.3;
        }

        .vitrine-bg-blobs::before {
            background: #fbc2eb;
            top: 10%;
            right: -10%;
        }

        .vitrine-bg-blobs::after {
            background: #a6c1ee;
            bottom: 10%;
            left: -10%;
        }

        /* Global Glassmorphism Cards */
        .card {
            background: rgba(255, 255, 255, 0.15) !important;
            backdrop-filter: blur(15px) !important;
            -webkit-backdrop-filter: blur(15px) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
        }

        .card:hover {
            transform: translateY(-12px);
            background: rgba(255, 255, 255, 0.25) !important;
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.1) !important;
        }

        .product-preview {
            background: rgba(255, 255, 255, 0.1) !important;
            border-radius: 12px;
            padding: 15px;
            /* More padding */
            margin-top: 15px;
            font-size: 1.1rem;
            /* Larger text */
        }

        .card-title {
            font-size: 1.4rem;
            /* Larger stand title */
            font-weight: 700;
        }

        /* Minimalist Search */
        .search-form-minimal {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        .search-input-group {
            position: relative;
            display: flex;
            align-items: center;
            border-bottom: 2px solid rgba(0, 0, 0, 0.1);
            padding-bottom: 10px;
            transition: all 0.6s cubic-bezier(0.19, 1, 0.22, 1);
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        .search-input-group:focus-within {
            max-width: 100%;
            border-bottom-color: #000;
            transform: translateY(-2px);
        }

        .search-input {
            width: 100%;
            border: none !important;
            background: transparent !important;
            font-size: 1.5rem;
            padding: 10px 60px 10px 0;
            outline: none !important;
            font-family: 'Syne', sans-serif;
            color: #000;
        }

        .search-btn-glass {
            position: absolute;
            right: 0;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2) !important;
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .container {
            max-width: 1200px;
        }


        footer {
            background: rgba(0, 0, 0, 0.9) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            color: white;
            padding: 120px 0 60px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 80px 80px 0 0;
            /* Massive top radius */
            font-family: 'Syne', sans-serif;
            margin-top: -40px;
            /* Overlap with video slightly if wanted */
            position: relative;
            z-index: 5;
        }

        .footer-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 2rem;
            letter-spacing: -1px;
            text-transform: uppercase;
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
            margin-bottom: 10px;
        }

        .footer-link:hover {
            color: white;
            transform: translateX(5px);
        }

        .footer-bottom {
            padding-top: 50px;
            margin-top: 50px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            opacity: 0.5;
            font-size: 0.9rem;
        }

        /* ===================== RESPONSIVE MOBILE ===================== */
        @media (max-width: 768px) {

            /* Navbar */
            .navbar-toggler {
                border: 1px solid rgba(0,0,0,0.2) !important;
                padding: 6px 10px;
            }
            .navbar-toggler-icon {
                filter: none;
                transition: all 0.5s cubic-bezier(0.25, 1, 0.5, 1);
            }
            /* Modification : Croix personnalisée et asymétrique ultra-épurée */
            .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon {
                background-image: none !important;
                position: relative;
            }
            .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon::before,
            .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon::after {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                background-color: #000; /* Noir épuré */
                border-radius: 20px;
                transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
            }
            
            /* La longue barre (impression d'élan/zoom) */
            .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon::before {
                width: 32px;
                height: 2px;
                transform: translate(-50%, -50%) rotate(35deg); /* Angle incliné */
            }
            
            /* La barre courte (les pieds courts) */
            .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon::after {
                width: 18px;
                height: 2px;
                margin-left: 5px; /* Décalage pour l'effet de perspective */
                transform: translate(-50%, -50%) rotate(-50deg);
            }
            body.intro-active .navbar:not(.scrolled) .navbar-toggler-icon {
                filter: invert(1);
            }
            body.intro-active .navbar:not(.scrolled) .navbar-toggler {
                border-color: rgba(255,255,255,0.4) !important;
            }

            .navbar-collapse {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border-radius: 16px;
                margin-top: 10px;
                padding: 16px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            }

            .navbar-collapse .nav-link,
            .navbar-collapse .btn {
                color: #333 !important;
                padding: 10px 16px !important;
            }

            .navbar-brand {
                font-size: 1.4rem !important;
            }

            /* Hero section */
            .hero-section {
                min-height: 100svh;
            }

            .auth-hero-section {
                padding-top: 8rem;
                padding-bottom: 4rem;
            }

            .auth-hero-section h1 {
                font-size: 2rem;
            }

            /* Footer */
            footer {
                border-radius: 40px 40px 0 0;
                padding: 60px 0 40px;
            }

            .footer-title {
                font-size: 1.8rem;
            }

            /* Sound toggle */
            .sound-toggle {
                bottom: 15px;
                right: 15px;
                width: 44px !important;
                height: 44px !important;
            }

            .sound-toggle i {
                font-size: 1.2rem;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body class="{{ Route::currentRouteName() == 'vitrine.index' ? 'intro-active' : 'loaded' }}">
    <div id="preloader">
        <div class="preloader-gallery" id="pgallery">
            @php
                $dir = public_path('storage/img');
                $files = glob($dir . '/*.{jpeg,jpg,png,webp}', GLOB_BRACE);
                $all_images = array_map(function ($path) {
                    return basename($path);
                }, $files);
                shuffle($all_images);
                // Limit to 10 images for 2 rows of 5 (Portrait aspect)
                $images = array_slice($all_images, 0, 10);
            @endphp
            @foreach ($images as $index => $img)
                <img src="{{ asset('storage/img/' . $img) }}" class="preloader-img"
                    style="transition-delay: {{ $index * 0.1 }}s">
            @endforeach
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light {{ !request()->routeIs('vitrine.index') ? 'scrolled' : '' }}">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" viewBox="0 0 24 24" class="d-inline-block">
                    <path d="M12 2L1 8v8l11 6 11-6V8L12 2zm0 2.8L20 9v6l-8 4.4-8-4.4V9l8-4.2z"/>
                    <path d="M12 12l-5-2.5V15l5 2.5 5-2.5V9.5L12 12z"/>
                </svg>
                <span>Eat&Drink</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    <li class="nav-item">
                        <a class="btn {{ request()->is('/') ? 'btn-primary' : 'btn-outline-dark' }}"
                            href="/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn {{ request()->routeIs('commandes.panier') ? 'btn-primary' : 'btn-outline-dark' }} position-relative"
                            href="{{ route('commandes.panier') }}">
                            <i class="bi bi-basket-fill"></i> Panier
                            @if (session('panier') && count(session('panier')) > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light">
                                    {{ array_sum(session('panier')) }}
                                    <span class="visually-hidden">produits dans le panier</span>
                                </span>
                            @endif
                        </a>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="btn {{ request()->routeIs('register') ? 'btn-primary' : 'btn-outline-dark' }}"
                                href="{{ route('register') }}">
                                <i class="bi bi-shop"></i> Demande de stand
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn {{ request()->routeIs('login') ? 'btn-primary' : 'btn-outline-dark' }}"
                                href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> Accès stand
                            </a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-dark">
                                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    @if (in_array(Route::currentRouteName(), ['vitrine.index', 'stands.index']))
        {{-- Hero section for Guests --}}
        @guest
            <section class="hero-section">
                <video autoplay muted loop playsinline class="hero-video">
                    <source src="{{ asset('storage/video/banniere.mp4') }}" type="video/mp4">
                </video>
                <div class="hero-overlay"></div>
                <div class="sound-toggle" id="soundToggle">
                    <i class="bi bi-volume-up-fill" id="soundIcon"></i>
                </div>
            </section>
        @endguest

        @auth
            <section class="auth-hero-section">
                <div class="container">
                    @if (auth()->user()->role == 'admin')
                        <h1 class="display-4 fw-bold">Bienvenue, Administrateur !</h1>
                        <p class="lead text-secondary">Gérez les stands, les utilisateurs et l'ensemble de la plateforme
                            Eat&Drink.</p>
                        <a href="{{ route('admin.index') }}" class="btn btn-glass-auth mt-3">Accéder au tableau de bord</a>
                    @elseif(auth()->user()->role == 'entrepreneur_en_attente')
                        <h1 class="display-4 fw-bold">Bienvenue, Entrepreneur !</h1>
                        <p class="lead text-secondary">Votre demande de stand est en cours de traitement.</p>
                    @else
                        <h1 class="display-4 fw-bold">Bienvenue, {{ auth()->user()->name }} !</h1>
                        <p class="lead text-secondary">Gérez votre stand, vos produits et suivez vos commandes.</p>
                        <a href="{{ route('stands.index') }}" class="btn btn-glass-auth mt-3">Accéder à mon espace</a>
                    @endif
                </div>
            </section>
        @endauth
    @endif

    <main class="container-fluid px-0 {{ in_array(Route::currentRouteName(), ['login', 'register', 'password.request', 'password.reset', 'attente']) ? 'mt-0 mb-5' : 'my-5' }}" id="products">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row section-padding">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <h2 class="footer-title d-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" viewBox="0 0 24 24" class="d-inline-block">
                            <path d="M12 2L1 8v8l11 6 11-6V8L12 2zm0 2.8L20 9v6l-8 4.4-8-4.4V9l8-4.2z"/>
                            <path d="M12 12l-5-2.5V15l5 2.5 5-2.5V9.5L12 12z"/>
                        </svg>
                        <span>Eat&Drink</span>
                    </h2>
                    <p class="lead opacity-75 mb-4" style="max-width: 400px;">Découvrez l'élite de l'artisanat
                        culinaire. Une vitrine immersive dédiée aux passionnés du goût et du savoir-faire authentique.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-outline-light rounded-circle p-2"
                            style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"><i
                                class="bi bi-instagram"></i></a>
                        <a href="#" class="btn btn-outline-light rounded-circle p-2"
                            style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"><i
                                class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-outline-light rounded-circle p-2"
                            style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"><i
                                class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 mb-5 mb-lg-0">
                    <h4 class="fw-bold mb-4">Naviguer</h4>
                    <a href="{{ route('vitrine.index') }}#stands" class="footer-link">La Vitrine</a>
                    <a href="{{ route('login') }}" class="footer-link">Accès Stand</a>
                    <a href="{{ route('register') }}" class="footer-link">Nous Rejoindre</a>
                </div>
                <div class="col-lg-2 mb-5 mb-lg-0">
                    <h4 class="fw-bold mb-4">Infos</h4>
                    <p class="opacity-50">Lieu d'exception<br>Cotonou, Bénin</p>
                    <p class="opacity-50">Weekend: 9h - 22h</p>
                </div>
                <div class="col-lg-3">
                    <h4 class="fw-bold mb-4">Contact</h4>
                    <p class="mb-1">Des questions ?</p>
                    <a href="mailto:contact@eatdrink.com"
                        class="footer-link fs-5 fw-bold text-white">contact@eatdrink.com</a>
                    <p class="mt-3 opacity-50">+229 01 46 86 25 36</p>
                </div>
            </div>

            <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <p class="mb-0">&copy; 2024 Eat&Drink platform. Crafted for excellence.</p>
                <div class="d-flex gap-4">
                    <a href="#" class="footer-link mb-0" style="font-size: 0.8rem;">Mentions Légales</a>
                    <a href="#" class="footer-link mb-0" style="font-size: 0.8rem;">Confidentialité</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preloader Logic
        window.addEventListener('DOMContentLoaded', () => {
            const body = document.body;
            const imgs = document.querySelectorAll('.preloader-img');
            const preloader = document.querySelector('#preloader');

            if (body.classList.contains('intro-active')) {
                const centerX = window.innerWidth / 2;
                const centerY = window.innerHeight / 2;

                // Step 1: Initial positioning (center them)
                imgs.forEach(img => {
                    const rect = img.getBoundingClientRect();
                    const imgCenterX = rect.left + rect.width / 2;
                    const imgCenterY = rect.top + rect.height / 2;
                    const startX = centerX - imgCenterX;
                    const startY = centerY - imgCenterY;
                    img.style.transform = `translate(${startX}px, ${startY}px) scale(0)`;
                    img.style.opacity = "0";
                });

                // Step 2: Explode outward from center
                setTimeout(() => {
                    imgs.forEach((img, i) => {
                        setTimeout(() => {
                            img.style.opacity = "1";
                            img.style.transform = `translate(0, 0) scale(1)`;
                        }, i * 100);
                    });
                }, 500);

                // Step 3: Implode back to center
                setTimeout(() => {
                    imgs.forEach((img, i) => {
                        setTimeout(() => {
                            const rect = img.getBoundingClientRect();
                            const imgCenterX = rect.left + rect.width / 2;
                            const imgCenterY = rect.top + rect.height / 2;
                            const endX = centerX - imgCenterX;
                            const endY = centerY - imgCenterY;
                            img.style.transition = "all 0.8s cubic-bezier(0.7, 0, 0.3, 1)";
                            img.style.transform =
                                `translate(${endX}px, ${endY}px) scale(0)`;
                            img.style.opacity = "0";
                        }, i * 80);
                    });
                }, 4000);

                // Transition to site
                setTimeout(() => {
                    body.classList.add('loaded');
                }, 5500);
            }
        });

        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            // On non-home pages, keep it scrolled/sticky by default
            const isHome = {{ request()->routeIs('vitrine.index') ? 'true' : 'false' }};

            if (window.scrollY > 50 || !isHome) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Initialize state
        document.addEventListener('DOMContentLoaded', () => {
            const navbar = document.querySelector('.navbar');
            const isHome = {{ request()->routeIs('vitrine.index') ? 'true' : 'false' }};
            if (!isHome) navbar.classList.add('scrolled');
        });

        // Fix for video freezing on scroll and hover sound
        const video = document.querySelector('.hero-video');
        const heroSection = document.querySelector('.hero-section');

        if (video && heroSection) {
            // Sound Toggle Logic
            const soundToggle = document.getElementById('soundToggle');
            const soundIcon = document.getElementById('soundIcon');

            if (soundToggle && video) {
                // Load state from sessionStorage
                const isMuted = sessionStorage.getItem('videoMuted');

                if (isMuted === 'true') {
                    video.muted = true;
                    soundIcon.classList.replace('bi-volume-up-fill', 'bi-volume-mute-fill');
                } else if (isMuted === 'false') {
                    video.muted = false;
                    soundIcon.classList.replace('bi-volume-mute-fill', 'bi-volume-up-fill');
                } else {
                    // Default behavior (Muted for autoplay)
                    video.muted = true;
                    soundIcon.classList.replace('bi-volume-up-fill', 'bi-volume-mute-fill');
                }

                soundToggle.addEventListener('click', function() {
                    video.muted = !video.muted;
                    sessionStorage.setItem('videoMuted', video.muted);
                    if (video.muted) {
                        soundIcon.classList.replace('bi-volume-up-fill', 'bi-volume-mute-fill');
                    } else {
                        soundIcon.classList.replace('bi-volume-mute-fill', 'bi-volume-up-fill');
                    }
                });
            }

            window.addEventListener('scroll', function() {
                if (window.scrollY < window.innerHeight) {
                    if (video.paused) video.play();
                } else {
                    if (!video.paused) video.pause();
                }
            });
            // Ensure loops correctly and stays active
            video.addEventListener('ended', function() {
                this.play();
            });
        }
    </script>
</body>

</html>
