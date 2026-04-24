@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('title', $stand->nom_stand . ' - Vitrine')

@section('content')
    <div class="vitrine-wrapper py-2">
        <div class="d-block d-md-none" style="height: 80px; width: 100%;"></div>
        <div class="d-none d-md-block" style="height: 30px; width: 100%;"></div>
        
        <div class="px-3 px-md-5">
            <!-- Return & Stand Header Row -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 mb-md-5 gap-3 animate-in">
                <a href="{{ route('vitrine.index') }}#stands" class="btn btn-glass-dark px-4 rounded-pill text-nowrap mb-2 mb-md-0">
                    <i class="bi bi-arrow-left me-2"></i> Retour
                </a>

                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#e74c3c"
                        viewBox="0 0 24 24" class="me-3 flex-shrink-0">
                        <path d="M12 2L1 8v8l11 6 11-6V8L12 2zm0 2.8L20 9v6l-8 4.4-8-4.4V9l8-4.2z" />
                        <path d="M12 12l-5-2.5V15l5 2.5 5-2.5V9.5L12 12z" />
                    </svg>
                    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center">
                        <h1 class="h5 h4-md mb-0 fw-bold me-md-2" style="font-size: 1.25rem;">{{ $stand->nom_stand }}</h1>
                        <span class="text-muted small mt-1 mt-md-0"><span class="d-none d-md-inline">|</span> Par <strong>{{ $stand->user->name }}</strong></span>
                    </div>
                </div>
            </div>

            <div class="glass-desc-box p-3 rounded-4 mb-5 animate-in"
                style="background: rgba(0,0,0,0.03); border-left: 4px solid #000;">
                <p class="lead mb-0 fs-6">{{ $stand->description }}</p>
            </div>

            <div class="product-gallery">
                <div class="mb-5 animate-in">
                    <h2 class="display-5 fw-bold mb-0">Carte des Délices</h2>
                    <p class="text-muted fs-5">Les créations de la maison</p>
                </div>

                @if ($stand->produits->count() > 0)
                    <div class="stands-masonry-grid">
                        @foreach ($stand->produits as $produit)
                            <div class="masonry-item animate-card">
                                <div class="card h-100 border-0 shadow-sm hover-shadow transition-all premium-product-card">
                                    @if ($produit->image_url)
                                        <div class="card-img-container">
                                            <img src="{{ Str::startsWith($produit->image_url, ['http://', 'https://'])
                                                ? $produit->image_url
                                                : asset($produit->image_url) }}"
                                                class="card-img-top" alt="{{ $produit->nom }}">
                                        </div>
                                    @else
                                        <div
                                            class="card-img-container bg-light d-flex align-items-center justify-content-center">
                                            <i class="bi bi-image text-muted opacity-25" style="font-size: 4rem;"></i>
                                        </div>
                                    @endif

                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h4 class="fw-bold mb-0">{{ $produit->nom }}</h4>
                                            <div class="product-price-tag">
                                                {{ number_format($produit->prix, 0, ',', ' ') }} <small>€</small>
                                            </div>
                                        </div>
                                        <p class="text-muted mb-4 fs-6">{{ Str::limit($produit->description, 120) }}</p>

                                        <form action="{{ route('commandes.ajouter-au-panier', $produit) }}" method="POST"
                                            class="add-to-cart-form">
                                            @csrf
                                            <div
                                                class="quantity-control-wrapper d-flex align-items-center justify-content-between bg-light rounded-pill p-1 mb-3">
                                                <button type="button" class="btn btn-qty border-0 rounded-circle"
                                                    onclick="this.nextElementSibling.stepDown()">-</button>
                                                <input type="number" name="quantite"
                                                    class="form-control bg-transparent border-0 text-center fw-bold fs-5"
                                                    value="1" min="1" max="99" readonly>
                                                <button type="button" class="btn btn-qty border-0 rounded-circle"
                                                    onclick="this.previousElementSibling.stepUp()">+</button>
                                            </div>
                                            <button type="submit"
                                                class="btn btn-dark w-100 py-3 rounded-pill fw-bold transition-all add-btn-premium">
                                                <i class="bi bi-bag-plus me-2"></i> AJOUTER AU PANIER
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state-lux text-center py-5 rounded-5 mt-5">
                        <i class="bi bi-stars display-1 mb-4 opacity-25"></i>
                        <h3 class="fw-bold">Bientôt disponible</h3>
                        <p class="text-muted">L'artisan prépare ses nouvelles créations.</p>
                    </div>
                @endif
            </div>
        </div> <!-- End px-3 px-md-5 -->

        <div class="py-5 my-md-5"></div> <!-- Section Spacer -->

        <!-- Immersive Side-Scroll Video Section (Edge-to-Edge) -->
        <div class="video-scroll-container mb-0" style="height: 400vh; scroll-snap-type: y mandatory;">
            <!-- Snap Points for determined positions -->
            <div style="position: absolute; top:0; height: 100vh; width: 1px; scroll-snap-align: start;"></div>
            <div style="position: absolute; top:100vh; height: 100vh; width: 1px; scroll-snap-align: start;"></div>
            <div style="position: absolute; top:200vh; height: 100vh; width: 1px; scroll-snap-align: start;"></div>
            <div style="position: absolute; top:300vh; height: 100vh; width: 1px; scroll-snap-align: start;"></div>

            <div class="sticky-video-wrapper">
                <div class="video-horizontal-track d-flex" id="videoTrack" style="transform: translateX(0);">
                    @php
                        $videos = ['foule.mp4', 'bugger-boisson.mp4', 'pizza.mp4', 'chef-food.mp4'];
                    @endphp
                    @foreach($videos as $index => $video)
                        <div class="video-full-slide {{ $index === 0 ? 'active' : '' }}">
                            <div class="video-container-premium">
                                <video autoplay muted loop playsinline class="cinematic-video">
                                    <source src="{{ asset('storage/video/' . $video) }}" type="video/mp4">
                                </video>
                                <div class="video-caption-overlay p-5 d-flex align-items-end">
                                    <div class="animate-on-scroll p-4">
                                        <h3 class="display-3 fw-bold text-white mb-0">L'Art Culinaire</h3>
                                        <p class="text-white-50 fs-4 ls-2 text-uppercase">Une immersion totale</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div> <!-- End vitrine-wrapper -->
    <div class="mb-5 pb-5"></div> <!-- Footer spacer -->

<style>
    .video-scroll-container {
        position: relative;
        width: 100%;
        overflow: visible;
    }
    
    .sticky-video-wrapper {
        position: sticky;
        top: 0;
        height: 100vh;
        overflow: hidden;
        background: #000;
    }
    
    .video-horizontal-track {
        height: 100%;
        width: 100%; /* No longer 400% */
        position: relative;
    }
    
    .video-full-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        opacity: 0;
        transition: opacity 1s ease-in-out;
        pointer-events: none;
    }
    
    .video-full-slide.active {
        opacity: 1;
        pointer-events: auto;
    }
    
    .video-container-premium {
        width: 100%;
        height: 100%;
        border-radius: 0 !important;
        overflow: hidden;
        position: relative;
        background: #000;
    }
    
    .cinematic-video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .video-caption-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 60%;
        background: linear-gradient(transparent, rgba(0,0,0,0.9));
    }
    .ls-2 { letter-spacing: 5px; }
</style>

<script>
    window.addEventListener('scroll', () => {
        const container = document.querySelector('.video-scroll-container');
        const track = document.getElementById('videoTrack');
        
        if (container && track) {
            const containerTop = container.offsetTop;
            const containerHeight = container.offsetHeight;
            const scrollY = window.scrollY;
            
            if (scrollY >= containerTop && scrollY <= containerTop + containerHeight - window.innerHeight) {
                const scrolled = scrollY - containerTop;
                const percentage = (scrolled / (containerHeight - window.innerHeight)) * 100;
                const videoIndex = Math.round(percentage / 33.33);
                
                const slides = document.querySelectorAll('.video-full-slide');
                slides.forEach((slide, index) => {
                    if (index === videoIndex) {
                        slide.classList.add('active');
                    } else {
                        slide.classList.remove('active');
                    }
                });
            } else if (scrollY < containerTop) {
                const slides = document.querySelectorAll('.video-full-slide');
                slides.forEach((slide, index) => {
                    if (index === 0) slide.classList.add('active');
                    else slide.classList.remove('active');
                });
            }
        }
    });
</script>

    <style>
        /* Premium Stand View Styles */
        .stands-masonry-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            width: 100%;
        }

        @media (max-width: 1100px) {
            .stands-masonry-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .premium-product-card {
            border-radius: 40px !important;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.4) !important;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
        }

        @media (max-width: 768px) {
            .stands-masonry-grid {
                grid-template-columns: 1fr;
            }
            .vitrine-wrapper {
                padding: 0 !important;
            }
            .video-scroll-container {
                display: none;
            }
        }

        .card-img-container {
            height: 280px;
            overflow: hidden;
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.19, 1, 0.22, 1);
        }

        .premium-product-card:hover .card-img-top {
            transform: scale(1.1);
        }

        .product-price-tag {
            background: #000;
            color: #fff;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .add-btn-premium:hover {
            background: #333;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .animate-in {
            animation: fadeInRight 0.8s cubic-bezier(0.19, 1, 0.22, 1) forwards;
        }

        .animate-card {
            animation: fadeInRight 2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(80px) translateY(10px) rotate(2deg);
            }
            to {
                opacity: 1;
                transform: translateX(0) translateY(0) rotate(0deg);
            }
        }
    </style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.animate-card').forEach((card, index) => {
            card.style.animationDelay = `${index * 0.2}s`;
        });
        
        const navbar = document.querySelector('.navbar');
        const videoSection = document.querySelector('.video-scroll-container');
        
        window.addEventListener('scroll', () => {
            if (navbar && videoSection) {
                if (window.getComputedStyle(videoSection).display === 'none') {
                    navbar.style.transform = 'translateY(0)';
                    return;
                }

                const videoTop = videoSection.offsetTop;
                if (window.scrollY > videoTop - 100) {
                    navbar.style.transform = 'translateY(-100%)';
                    navbar.style.transition = 'transform 0.5s ease';
                } else {
                    navbar.style.transform = 'translateY(0)';
                }
            }
        });
    });
</script>
@endsection
