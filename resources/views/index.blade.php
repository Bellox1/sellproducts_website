@extends('layouts.app')
@section('title', 'Vitrine - Stands et Produits')
@section('content')

    <div class="vitrine-bg-blobs"></div>
    <div class="vitrine-wrapper">
        <!-- intro-placeholder for stable layout height -->
        <div class="intro-placeholder" style="min-height: 250px;">
            <div class="vitrine-intro-container" id="vitrineHeader">
                <div class="text-center mb-5 intro-content">
                    <h1 class="vitrine-title">Vitrine des Stands</h1>
                    <p class="lead text-muted vitrine-desc">Découvrez nos stands artisanaux et leurs délices</p>
                </div>
            </div>
        </div>

        <div class="vitrine-content-area">
            <!-- Barre de recherche améliorée -->
            <!-- Placeholder for search bar stable height -->
            <div class="search-placeholder" id="stands" style="min-height: 150px;">
                <div class="search-sticky-container">
                    <div class="row justify-content-center mb-5 search-row">
                        <div class="col-md-10">
                            <form action="{{ route('vitrine.recherche') }}" method="GET" class="search-form-minimal">
                                <div class="search-input-group">
                                    <input type="text" name="q" class="search-input"
                                        placeholder="Rechercher des stands ou produits..." value="{{ request('q') }}">
                                    <button type="submit" class="search-btn-glass">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- End search-sticky-container -->
            </div>

            @if ($stands->count() > 0)
                <div class="stands-masonry-grid">
                    @foreach ($stands as $stand)
                        <div class="masonry-item">
                            <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                                @if ($stand->produits->first() && $stand->produits->first()->image_url)
                                    <div class="card-img-container">
                                        <img src="{{ Str::startsWith($stand->produits->first()->image_url, ['http://', 'https://'])
                                            ? $stand->produits->first()->image_url
                                            : asset($stand->produits->first()->image_url) }}"
                                            class="card-img-top"
                                            alt="Image du produit {{ $stand->produits->first()->nom }}">
                                    </div>
                                @endif
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title mb-0">{{ $stand->nom_stand }}</h5>
                                        <span class="badge btn-glass-dark fw-normal">{{ $stand->produits->count() }}
                                            produits</span>
                                    </div>
                                    <p class="card-text text-muted mb-3">{{ Str::limit($stand->description, 100) }}</p>
                                    <p class="text-muted small mb-3">
                                        <i class="bi bi-person"></i> {{ $stand->user->name }}
                                    </p>

                                    @if ($stand->produits->count() > 0)
                                        <div class="product-preview mb-4">
                                            @foreach ($stand->produits->take(rand(2, 3)) as $produit)
                                                <div
                                                    class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                                    <span>{{ $produit->nom }}</span>
                                                    <span class="fw-bold">{{ number_format($produit->prix, 2) }}
                                                        €</span>
                                                </div>
                                            @endforeach
                                            @if ($stand->produits->count() > 3)
                                                <div class="text-center mt-2">
                                                    <small class="text-muted">
                                                        + {{ $stand->produits->count() - 3 }} autres produits
                                                    </small>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="alert alert-light mb-4">
                                            <small class="text-muted">Aucun produit disponible pour le moment</small>
                                        </div>
                                    @endif
                                    <a href="{{ route('vitrine.stand', $stand) }}" class="btn btn-glass-dark w-100">
                                        <i class="bi bi-shop"></i> Visiter le stand
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state text-center py-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#ddd" viewBox="0 0 24 24"
                        class="mb-4">
                        <path d="M12 2L1 8v8l11 6 11-6V8L12 2zm0 2.8L20 9v6l-8 4.4-8-4.4V9l8-4.2z" />
                        <path d="M12 12l-5-2.5V15l5 2.5 5-2.5V9.5L12 12z" />
                    </svg>
                    <h4 class="fw-light mb-3">Aucun stand disponible</h4>
                    <p class="text-muted">Les stands approuvés apparaîtront ici prochainement</p>
                </div>
            @endif

            <!-- Cinematic Footer Video Section -->
            <div id="video-section" class="video-footer-container mt-2 py-4 text-center">
                <div class="video-wrapper-inner">
                    <video autoplay muted loop playsinline class="cinematic-video">
                        <source src="{{ asset('storage/video/stand.mp4') }}" type="video/mp4">
                        Votre navigateur ne supporte pas la vidéo.
                    </video>
                </div>
            </div>
        </div> <!-- End vitrine-content-area -->
    </div>
    </div>

    <style>
        .search-sticky-container {
            transition: all 0.7s cubic-bezier(0.19, 1, 0.22, 1);
            z-index: 1000;
            width: 100%;
            height: 150px;
            margin-top: 50px;
            /* Added space for visibility */
            margin-bottom: 50px;
        }

        /* Transitioning to side view */
        .side-active .search-input-group {
            position: fixed;
            right: 40px;
            top: 100px;
            /* Stay near the top right, horizontal */
            width: 300px;
            transform: none !important;
            /* NO ROTATION */
            z-index: 2005;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            padding: 5px 20px;
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
        }

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

        .search-btn-glass:hover {
            transform: scale(1.1) rotate(15deg);
            background: rgba(255, 255, 255, 0.4) !important;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .vitrine-wrapper {
            width: 100%;
            position: relative;
            padding: 0 80px;
            transition: all 0.7s ease;
        }

        @media (max-width: 768px) {
            .vitrine-wrapper {
                padding: 0 16px !important;
            }
            .vitrine-wrapper.side-active .vitrine-intro-container {
                position: static !important;
                width: 100% !important;
                transform: none !important;
            }
            .vitrine-wrapper.side-active .intro-content {
                transform: none !important;
            }
            .vitrine-wrapper.side-active .search-sticky-container {
                position: static !important;
                width: 100% !important;
            }
            .side-active .search-input-group {
                position: static !important;
                max-width: 100% !important;
            }
        }

        /* Staggered Grid (Middle Higher) */
        .stands-masonry-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            /* Even tighter margins */
            width: 100%;
            padding-top: 50px;
        }

        @media (max-width: 1100px) {
            .stands-masonry-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .stands-masonry-grid {
                grid-template-columns: 1fr;
            }
        }

        .masonry-item {
            width: 100%;
            transition: transform 0.6s ease-out;
        }

        /* Target the middle column in a 3-column desktop layout */
        @media (min-width: 1101px) {
            .masonry-item:nth-child(3n+2) {
                transform: translateY(-40px);
                /* Lift middle column */
            }
        }

        .card-img-container {
            height: auto;
            max-height: 350px;
            /* Prevent "double height" images */
            min-height: 180px;
            overflow: hidden;
            background: rgba(0, 0, 0, 0.03);
        }

        /* Cinematic Video Footer - FULL WIDTH REFINED */
        .video-footer-container {
            width: 100%;
            max-width: 1600px;
            margin: 50px auto;
            /* Centered with top/bottom margin */
            padding: 0 20px;
        }

        .video-wrapper-inner {
            position: relative;
            width: 100%;
            border-radius: 60px;
            /* Big radius for the video back */
            overflow: hidden;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.15);
        }

        .cinematic-video {
            width: 100%;
            height: 700px;
            /* Increased height again */
            object-fit: cover;
        }

        .video-overlay-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            width: 100%;
        }

        .vitrine-intro-container {
            width: 100%;
            min-height: 250px;
            /* RESERVED SPACE to prevent stands from jumping up */
            padding: 60px 0;
            text-align: center;
            transition: all 0.7s cubic-bezier(0.19, 1, 0.22, 1);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .intro-content {
            transition: all 0.7s cubic-bezier(0.19, 1, 0.22, 1);
        }

        /* Vertical Sidebar (when scrolling) */
        .vitrine-wrapper.side-active .vitrine-intro-container {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 100px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
        }

        .vitrine-wrapper.side-active .intro-content {
            transform: rotate(-90deg);
            white-space: nowrap;
            text-align: center;
        }

        .vitrine-wrapper.side-active .search-sticky-container {
            position: fixed;
            right: 40px;
            top: 100px;
            width: auto;
            transform: none !important;
            z-index: 2001;
        }

        .side-active .search-input-group {
            max-width: 250px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            padding: 5px 20px;
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
        }

        .side-active .search-input-group:focus-within {
            max-width: 700px;
            /* Even longer as requested */
        }

        .vitrine-title {
            font-size: 6.5rem;
            font-weight: 800;
            color: #000 !important;
            letter-spacing: -3px;
            margin-bottom: 20px;
            transition: all 0.7s cubic-bezier(0.19, 1, 0.22, 1);
            text-transform: uppercase;
        }

        @media (max-width: 768px) {
            .vitrine-title {
                font-size: 2.8rem !important;
                letter-spacing: -1px;
            }
            .search-input {
                font-size: 1rem !important;
            }
            .cinematic-video {
                height: 300px !important;
            }
            .video-wrapper-inner {
                border-radius: 24px !important;
            }
        }

        .vitrine-desc {
            font-size: 1.2rem;
            font-weight: 500;
            color: #333;
            opacity: 0.6;
            transition: all 0.7s cubic-bezier(0.19, 1, 0.22, 1);
        }

        .vitrine-wrapper.side-active .vitrine-title {
            font-size: 2.2rem !important;
            font-weight: 800;
            margin: 0 !important;
            opacity: 0.8;
            letter-spacing: 2px;
            text-align: center;
        }

        /* Zero-Bug Fade Out Strategy */
        .side-hide .vitrine-intro-container,
        .side-hide .search-sticky-container {
            opacity: 0 !important;
            visibility: hidden;
            pointer-events: none;
            transition: all 0.5s ease !important;
        }

        .vitrine-intro-container, .search-sticky-container {
            transition: all 0.7s cubic-bezier(0.19, 1, 0.22, 1), opacity 0.5s ease;
        }

        .vitrine-wrapper.side-active .vitrine-desc {
            font-size: 1rem;
            font-weight: 500;
            opacity: 0.6;
            margin-top: 5px;
        }

        .vitrine-wrapper.side-active .vitrine-desc {
            display: block;
            font-size: 0.9rem !important;
            /* Reverted */
            opacity: 0.5;
            margin-top: 15px !important;
            text-align: center;
        }

        .intro-content {
            transition: all 0.7s cubic-bezier(0.19, 1, 0.22, 1);
        }

        .vitrine-content-area {
            /* overflow: hidden; Removed to allow sticky search bar */
        }

        .card {
            background: rgba(255, 255, 255, 0.15) !important;
            backdrop-filter: blur(15px) !important;
            -webkit-backdrop-filter: blur(15px) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
        }

        .card-body,
        .card-footer,
        .product-preview {
            background: transparent !important;
            background-color: transparent !important;
            border: none !important;
        }

        .card-img-container {
            height: 220px;
            overflow: hidden;
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .card:hover {
            transform: translateY(-12px);
            background: rgba(255, 255, 255, 0.35) !important;
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.1) !important;
        }

        .card:hover .card-img-top {
            transform: scale(1.1);
        }

        .product-preview {
            background: rgba(255, 255, 255, 0.1) !important;
            border-radius: 12px;
            padding: 10px;
            margin-top: 15px;
        }

        /* Important: Reveal glass effect by changing the page background */
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%) !important;
            background-attachment: fixed !important;
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
            /* Pink blob */
            top: 10%;
            right: -10%;
        }

        .vitrine-bg-blobs::after {
            background: #a6c1ee;
            /* Blue blob */
            bottom: 10%;
            left: -10%;
        }

        .empty-state {
            background: #f8f9fa;
            border-radius: 12px;
        }
    </style>

    <script>
        // Calculate threshold once to avoid infinite loops when elements become fixed
        let vitrineThreshold = 0;
        let videoThreshold = 0;
        let isActive = false;

        const updateThreshold = () => {
            const header = document.getElementById('vitrineHeader');
            const video = document.getElementById('video-section');
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (header) {
                const headerRect = header.parentElement.getBoundingClientRect();
                vitrineThreshold = (headerRect.top + scrollTop) + 150;
            }
            if (video) {
                const videoRect = video.getBoundingClientRect();
                // Store the absolute top position of the video
                videoThreshold = (videoRect.top + scrollTop) - 450;
            }
        };

        window.addEventListener('load', updateThreshold);
        window.addEventListener('resize', updateThreshold);

        document.addEventListener('scroll', function() {
            const wrapper = document.querySelector('.vitrine-wrapper');
            const video = document.getElementById('video-section');
            if (!wrapper) return;

            // Désactiver l'animation de sidebar sur mobile pour éviter les bugs de scroll/focus
            if (window.innerWidth <= 768) {
                wrapper.classList.remove('side-active');
                wrapper.classList.remove('side-hide');
                return;
            }

            const scrollPos = window.scrollY;

            // 1. Fixed positioning trigger (remains active once reached)
            if (scrollPos > vitrineThreshold) {
                wrapper.classList.add('side-active');
            } else {
                wrapper.classList.remove('side-active');
            }

            // 2. Visual Fade-Out trigger (when nearing video)
            if (video) {
                const rect = video.getBoundingClientRect();
                if (rect.top < 600) { // Use viewport relative position (bug-free)
                    wrapper.classList.add('side-hide');
                } else {
                    wrapper.classList.remove('side-hide');
                }
            }
        });

        // Intersection observer for fade-in effect
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = "1";
                    entry.target.style.transform = "translateY(0)";
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.card').forEach(card => {
            card.style.opacity = "0";
            card.style.transform = "translateY(50px)";
            card.style.transition = "all 0.6s ease-out";
            observer.observe(card);
        });
    </script>
@endsection
