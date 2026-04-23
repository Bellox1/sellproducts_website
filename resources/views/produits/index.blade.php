@extends('layouts.app')

@section('title', 'Mes Produits')

@section('content')
<div class="admin-dashboard-wrapper min-vh-100 py-5" style="background: transparent; color: #1e293b;">
    <div class="d-block d-md-none" style="height: 80px; width: 100%;"></div>
    <div class="d-none d-md-block" style="height: 200px; width: 100%;"></div>
    
    <div class="container-fluid px-3 px-md-5 py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 mb-md-5 gap-4 animate-in">
            <div class="glass-container p-4 rounded-5 border border-white border-opacity-50 w-100">
                <p class="text-secondary small ls-2 text-uppercase mb-2 fw-bold" style="letter-spacing: 4px;">Mon Inventaire</p>
                <h1 class="display-5 display-md-3 fw-bold mb-0 text-dark">Mes Produits.</h1>
                <p class="fs-5 text-muted mt-3 fw-medium">Gérez votre catalogue de saveurs disponibles sur <span class="text-primary">Eat&Drink</span>.</p>
            </div>
            <div class="pb-3 w-100 d-md-flex justify-content-end">
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('produits.create') }}" class="btn btn-glass-auth shadow-sm fw-bold flex-grow-1 flex-md-grow-0 text-center">
                        <i class="bi bi-plus-circle me-2"></i>NOUVEAU PRODUIT
                    </a>
                    <a href="{{ route('stands.index') }}" class="btn btn-glass-auth shadow-sm fw-bold flex-grow-1 flex-md-grow-0 text-center">
                        <i class="bi bi-shop me-2"></i>RETOUR AUX STANDS
                    </a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert glass-container border-success border-opacity-25 text-success p-4 rounded-5 mb-5 animate-in">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if($products->count() > 0)
            <div class="row g-4 animate-in" style="animation-delay: 0.1s;">
                @foreach($products as $product)
                    <div class="col-md-6 col-lg-4">
                        <div class="glass-container p-0 rounded-5 shadow-sm border border-white h-100 transition-all hover-up overflow-hidden">
                            @if($product->image_url)
                                <div class="card-img-container" style="height: 250px; position: relative;">
                                    <img src="{{ $product->image_url }}" class="w-100 h-100 object-fit-cover transition-all" alt="{{ $product->nom }}">
                                    <div class="position-absolute top-0 end-0 p-3">
                                        <span class="badge glass-pill text-dark px-3 py-2 rounded-pill shadow-sm">{{ number_format($product->prix, 2) }} €</span>
                                    </div>
                                </div>
                            @else
                                <div class="card-img-container bg-white bg-opacity-50 d-flex flex-column align-items-center justify-content-center" style="height: 250px;">
                                    <i class="bi bi-image text-secondary opacity-25 mb-2" style="font-size: 3rem;"></i>
                                    <span class="text-secondary small fw-bold">AUCUNE IMAGE</span>
                                    <div class="position-absolute top-0 end-0 p-3">
                                        <span class="badge glass-pill text-dark px-3 py-2 rounded-pill shadow-sm">{{ number_format($product->prix, 2) }} €</span>
                                    </div>
                                </div>
                            @endif

                            <div class="p-3 p-md-5">
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start mb-3 gap-2">
                                    <h3 class="fw-bold text-dark mb-0 pe-2">{{ $product->nom }}</h3>
                                    <div class="text-secondary small mt-1 mt-md-0">
                                        <i class="bi bi-shop me-1 text-primary"></i>{{ $product->stand->nom_stand }}
                                    </div>
                                </div>
                                <p class="text-secondary mb-4">{{ Str::limit($product->description, 100) }}</p>

                                <div class="d-flex flex-column flex-md-row gap-2 gap-md-3 pt-3 border-top border-white border-opacity-50">
                                    <a href="{{ route('produits.edit', $product) }}" class="btn btn-glass-auth flex-grow-1 text-center py-2">
                                        <i class="bi bi-pencil me-1"></i> MODIFIER
                                    </a>
                                    <form action="{{ route('produits.destroy', $product) }}" method="POST" class="flex-grow-1">
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
                <i class="bi bi-box-seam display-1 text-secondary opacity-25 mb-4"></i>
                <h3 class="text-secondary fw-bold">Inventaire vide</h3>
                <p class="text-muted mb-5">Ajoutez vos premiers délices pour les proposer à vos clients.</p>
                <a href="{{ route('produits.create') }}" class="btn btn-glass-auth px-5 py-3 fw-bold">
                    AJOUTER MON PREMIER PRODUIT
                </a>
            </div>
        @endif
    </div>
</div>

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
    }

    .btn-glass-auth:hover {
        background: #fff;
        color: #000 !important;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    .hover-up:hover {
        transform: translateY(-10px);
        background: rgba(255,255,255,0.8);
    }

    .hover-up:hover img {
        transform: scale(1.05);
    }

    .animate-in {
        animation: slideIn 1.2s cubic-bezier(0.19, 1, 0.22, 1) forwards;
        opacity: 0;
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 767px) {
        .glass-container.p-5 {
            padding: 1.25rem !important;
        }
    }
</style>
@endsection
