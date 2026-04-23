@extends('layouts.app')

@section('title', 'Détails du Stand')

@section('content')
<div class="admin-dashboard-wrapper min-vh-100 py-5" style="background: transparent; color: #1e293b; padding-top: 15rem;">
    <div class="container-fluid px-3 px-md-5 py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 mb-md-5 gap-4 animate-in">
            <div class="glass-container p-4 rounded-5 border border-white border-opacity-50 w-100">
                <p class="text-secondary small ls-2 text-uppercase mb-2 fw-bold" style="letter-spacing: 4px;">Détails du Stand</p>
                <h1 class="display-5 display-md-3 fw-bold mb-0 text-dark">{{ $stand->nom_stand }}.</h1>
                <p class="fs-5 text-muted mt-3 fw-medium">Consultez et gérez l'inventaire spécifique de ce point de vente.</p>
            </div>
            <div class="pb-3 w-100 d-md-flex justify-content-end">
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('stands.index') }}" class="btn btn-glass-auth shadow-sm fw-bold flex-grow-1 flex-md-grow-0 text-center">
                        <i class="bi bi-arrow-left me-2"></i>RETOUR
                    </a>
                    <a href="{{ route('stands.edit', $stand) }}" class="btn btn-glass-auth shadow-sm fw-bold flex-grow-1 flex-md-grow-0 text-center">
                        <i class="bi bi-pencil me-2"></i>ÉDITER LE STAND
                    </a>
                </div>
            </div>
        </div>

        <div class="glass-container p-5 rounded-5 shadow-sm border border-white mb-5 animate-in" style="animation-delay: 0.1s;">
            <div class="row align-items-center">
                <div class="col-md-auto mb-4 mb-md-0">
                    <div class="icon-box bg-soft-primary" style="width: 80px; height: 80px;">
                        <i class="bi bi-shop display-5"></i>
                    </div>
                </div>
                <div class="col-md">
                    <div class="badge glass-pill text-dark px-3 py-2 rounded-pill border border-white mb-3 text-uppercase ls-1">INFO STAND</div>
                    <p class="fs-4 text-secondary mb-0 fw-medium">{{ $stand->description }}</p>
                </div>
                <div class="col-md-auto text-md-end">
                    <p class="text-secondary small text-uppercase ls-1 mb-1">Date d'ouverture</p>
                    <h5 class="text-dark fw-bold">{{ $stand->created_at ? $stand->created_at->format('d M Y') : 'Non définie' }}</h5>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-5 animate-in" style="animation-delay: 0.2s;">
            <h2 class="fw-bold text-dark">Catalogue Produits</h2>
            <a href="{{ route('produits.create') }}" class="btn btn-glass-auth fw-bold px-4">
                <i class="bi bi-plus-circle me-2"></i>AJOUTER UN PRODUIT
            </a>
        </div>

        @if($stand->produits->count() > 0)
            <div class="row g-4 animate-in" style="animation-delay: 0.3s;">
                @foreach($stand->produits as $produit)
                    <div class="col-md-6 col-lg-4">
                        <div class="glass-container p-0 rounded-5 shadow-sm border border-white h-100 transition-all hover-up overflow-hidden">
                            @if($produit->image_url)
                                <div class="card-img-container" style="height: 250px; position: relative;">
                                    <img src="{{ filter_var($produit->image_url, FILTER_VALIDATE_URL) ? $produit->image_url : asset($produit->image_url) }}" 
                                         class="w-100 h-100 object-fit-cover transition-all" alt="{{ $produit->nom }}">
                                    <div class="position-absolute top-0 end-0 p-3">
                                        <span class="badge glass-pill text-dark px-3 py-2 rounded-pill shadow-sm">{{ number_format($produit->prix, 2) }} €</span>
                                    </div>
                                </div>
                            @else
                                <div class="card-img-container bg-white bg-opacity-50 d-flex flex-column align-items-center justify-content-center" style="height: 250px;">
                                    <i class="bi bi-image text-secondary opacity-25 mb-2" style="font-size: 3rem;"></i>
                                    <span class="text-secondary small fw-bold">AUCUNE IMAGE</span>
                                    <div class="position-absolute top-0 end-0 p-3">
                                        <span class="badge glass-pill text-dark px-3 py-2 rounded-pill shadow-sm">{{ number_format($produit->prix, 2) }} €</span>
                                    </div>
                                </div>
                            @endif

                            <div class="p-5">
                                <h3 class="fw-bold text-dark mb-2">{{ $produit->nom }}</h3>
                                <p class="text-secondary mb-4">{{ Str::limit($produit->description, 100) }}</p>

                                <div class="d-flex gap-3 pt-3 border-top border-white border-opacity-50">
                                    <a href="{{ route('produits.edit', $produit) }}" class="btn btn-glass-auth flex-grow-1 text-center py-2">
                                        <i class="bi bi-pencil me-1"></i> ÉDITER
                                    </a>
                                    <form action="{{ route('produits.destroy', $produit) }}" method="POST" class="flex-grow-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-glass-auth w-100 text-center py-2" onclick="return confirm('Supprimer ce produit ?')">
                                            <i class="bi bi-trash me-1"></i> SUPPRIMER
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="glass-container p-5 rounded-5 text-center animate-in">
                <i class="bi bi-box-seam display-2 text-secondary opacity-25 mb-4"></i>
                <h3 class="text-secondary fw-bold">Catalogue vide</h3>
                <p class="text-muted">Ce stand ne contient aucun produit pour le moment.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
    .ls-1 { letter-spacing: 1px; }
    .ls-2 { letter-spacing: 2px; }
    
    .glass-container {
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(30px);
        -webkit-backdrop-filter: blur(30px);
        border: 1px solid rgba(255, 255, 255, 0.6) !important;
        transition: all 0.4s ease;
    }

    .icon-box {
        display: flex; align-items: center; justify-content: center;
        border-radius: 20px; background: rgba(244, 118, 104, 0.1); color: #f47668;
    }

    .bg-soft-primary { background: rgba(244, 118, 104, 0.1); color: #f47668; }

    .glass-pill {
        background: rgba(255, 255, 255, 0.8) !important;
        backdrop-filter: blur(10px);
    }

    .btn-glass-auth {
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(0, 0, 0, 0.05) !important;
        color: #64748b !important;
        border-radius: 50px !important;
        transition: all 0.3s ease;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
    }

    .btn-glass-auth:hover {
        background: #fff; color: #000 !important;
        transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    .hover-up:hover { transform: translateY(-10px); background: rgba(255,255,255,0.8); }
    .hover-up:hover img { transform: scale(1.05); }

    .animate-in {
        animation: slideIn 1.2s cubic-bezier(0.19, 1, 0.22, 1) forwards;
        opacity: 0;
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 767px) {
        .admin-dashboard-wrapper {
            padding-top: 8rem !important;
        }
        .row.align-items-center {
            text-align: center;
        }
        .col-md-auto.text-md-end {
            text-align: center;
            margin-top: 1rem;
        }
        .glass-container.p-5 {
            padding: 1.25rem !important;
        }
    }
</style>
@endsection
