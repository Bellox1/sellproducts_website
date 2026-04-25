@extends('layouts.app')

@section('title', 'Résultats de recherche' . ($query ? ' - ' . $query : ''))

@section('content')

    <div class="vitrine-wrapper py-5">
        <div class="px-2 px-md-5">
            <div class="">
                <div class="text-center mb-5">

                    <h1 class="display-4 fw-bold mb-3">Résultats de recherche</h1>
                    @if ($query)
                        <p class="lead text-muted">Stands et produits pour : **"{{ $query }}"**</p>
                    @else
                        <p class="lead text-muted">Exploration de tous les stands</p>
                    @endif
                    <p class="text-muted">{{ $stands->count() }} résultat(s) trouvé(s)</p>
                </div>

                <div class="vitrine-bg-blobs"></div>
                <div class="mb-5">
                    <div class="w-100">
                        <form action="{{ route('vitrine.recherche') }}" method="GET" class="search-form-minimal">
                            <div class="search-input-group">
                                <input type="text" name="q" class="search-input"
                                    placeholder="Rechercher des stands ou produits..." value="{{ $query }}">
                                <button type="submit" class="search-btn-glass">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
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
                                                @foreach ($stand->produits->take(3) as $produit)
                                                    <div
                                                        class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                                        <span>{{ $produit->nom }}</span>
                                                        <span class="fw-bold">{{ number_format($produit->prix, 2) }}
                                                            FCFA</span>
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

                                        <a href="{{ route('vitrine.stand', $stand) }}" class="btn btn-premium-glass w-100">
                                            <i class="bi bi-shop"></i> Visiter le stand
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state text-center py-5"
                        style="background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 30px;">
                        <i class="bi bi-search-heart display-1 mb-4" style="color: rgba(0,0,0,0.1)"></i>
                        <h4 class="fw-light mb-3">Aucun résultat trouvé</h4>
                        <p class="text-muted">Aucun stand ou produit ne correspond à votre recherche "{{ $query }}".
                        </p>
                        <a href="{{ route('vitrine.index') }}#stands" class="btn btn-premium-glass px-5 mt-3">Retourner à
                            la vitrine</a>
                    </div>
                @endif
            </div>
        </div>
        <style>
            .btn-premium-glass {
                background: rgba(255, 255, 255, 0.4) !important;
                backdrop-filter: blur(15px);
                -webkit-backdrop-filter: blur(15px);
                border: 1px solid rgba(255, 255, 255, 0.5) !important;
                border-radius: 50px !important;
                padding: 12px 35px !important;
                color: #000 !important;
                font-weight: 700;
                transition: all 0.4s ease;
                text-transform: uppercase;
                letter-spacing: 1px;
                font-size: 0.9rem;
            }

            .btn-premium-glass:hover {
                background: rgba(255, 255, 255, 0.6) !important;
                transform: translateY(-3px);
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            }

            /* Staggered Grid (Middle Higher) */
            .stands-masonry-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
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

                .vitrine-wrapper {
                    padding: 0 10px !important;
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
                min-height: 180px;
                overflow: hidden;
                background: rgba(0, 0, 0, 0.03);
            }

            .card-img-top {
                width: 100%;
                height: 100%;
                max-height: 350px;
                object-fit: cover;
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // No sidebar animation on research page
            });
        </script>
    </div>
@endsection
