@extends('layouts.app')

@section('title', 'Mes Stands')

@section('content')
<div class="admin-dashboard-wrapper min-vh-100 py-3 py-md-5" style="background: transparent; color: #1e293b;">
    <div class="container-fluid px-3 px-md-5 pt-0 pb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 mb-md-5 gap-4 animate-in">
            <div class="glass-container p-4 rounded-5 border border-white border-opacity-50 w-100">
                <p class="text-secondary small ls-2 text-uppercase mb-0 fw-bold" style="letter-spacing: 4px;">Mon Commerce</p>
                <h1 class="display-5 display-md-3 fw-bold mb-0 text-dark">Mes Stands.</h1>
                <p class="fs-5 text-muted mt-3 fw-medium">Gérez vos points de vente et votre présence sur <span class="text-primary">Eat&Drink</span>.</p>
            </div>
            <div class="pb-3 w-100 d-md-flex justify-content-end">
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('stands.create') }}" class="btn btn-glass-auth shadow-sm fw-bold flex-grow-1 flex-md-grow-0 text-center">
                        <i class="bi bi-plus-circle me-2"></i>NOUVEAU STAND
                    </a>
                    <a href="{{ route('produits.index') }}" class="btn btn-glass-auth shadow-sm fw-bold flex-grow-1 flex-md-grow-0 text-center">
                        <i class="bi bi-box-seam me-2"></i>MES PRODUITS
                    </a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert glass-container border-success border-opacity-25 text-success p-4 rounded-5 mb-5 animate-in">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if($stands->count() > 0)
            <div class="row g-4 animate-in" style="animation-delay: 0.1s;">
                @foreach($stands as $stand)
                    <div class="col-md-6 col-lg-4">
                        <div class="glass-container p-5 rounded-5 shadow-sm border border-white h-100 transition-all hover-up">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div class="icon-box bg-soft-primary">
                                    <i class="bi bi-shop fs-2"></i>
                                </div>
                                <span class="badge glass-pill text-dark px-3 py-2 rounded-pill border border-white">{{ $stand->produits->count() }} PRODUITS</span>
                            </div>
                            
                            <h3 class="fw-bold text-dark mb-3">{{ $stand->nom_stand }}</h3>
                            <p class="text-secondary mb-4">{{ Str::limit($stand->description, 120) }}</p>

                            <div class="d-flex gap-3 pt-3 border-top border-white border-opacity-50">
                                <a href="{{ route('stands.show', $stand) }}" class="btn btn-glass-auth flex-grow-1 text-center py-2">
                                    <i class="bi bi-eye me-1"></i> VOIR
                                </a>
                                <a href="{{ route('stands.edit', $stand) }}" class="btn btn-glass-auth flex-grow-1 text-center py-2">
                                    <i class="bi bi-pencil me-1"></i> ÉDITER
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="glass-container p-5 rounded-5 text-center animate-in">
                <i class="bi bi-shop display-1 text-secondary opacity-25 mb-4"></i>
                <h3 class="text-secondary fw-bold">Aucun stand actif</h3>
                <p class="text-muted mb-5">Commencez l'aventure en créant votre premier point de vente.</p>
                <a href="{{ route('stands.create') }}" class="btn btn-glass-auth px-5 py-3 fw-bold">
                    CRÉER MON PREMIER STAND
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

    .icon-box {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
        background: rgba(244, 118, 104, 0.1);
        color: #f47668;
    }

    .glass-pill {
        background: rgba(255, 255, 255, 0.7) !important;
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

    .animate-in {
        animation: slideIn 1.2s cubic-bezier(0.19, 1, 0.22, 1) forwards;
        opacity: 0;
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 767px) {
        h1.display-4 {
            font-size: 2rem !important;
        }
        .glass-container.p-5 {
            padding: 1.25rem !important;
        }
    }
</style>
@endsection
