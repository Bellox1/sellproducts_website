@extends('layouts.app')

@section('title', 'Statut en attente')

@section('content')
<div class="min-vh-100 d-flex align-items-start py-0">
    <div class="vitrine-bg-blobs"></div>
    <div class="container pt-0 mt-0">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="glass-registration-card p-4 p-md-5 text-center animate-in">
                    <!-- Loading Status Icon -->
                    <div class="mb-5 position-relative d-inline-block">
                        <div class="status-pulse-ring"></div>
                        <div class="status-icon-main">
                            <i class="bi bi-hourglass-split text-dark display-1"></i>
                        </div>
                    </div>
                    
                    <h1 class="display-4 fw-bold text-dark mb-2 ls-tight">Patience.</h1>
                    <p class="text-muted fs-5 ls-wide text-uppercase mb-5">Votre accès est en cours de validation</p>
                    
                    <div class="glass-inner-card p-4 mb-5 mx-auto" style="max-width: 550px;">
                        <p class="mb-0 text-dark opacity-75 fs-5">
                            Votre demande a été transmise à notre équipe. 
                            Nous vérifions vos informations pour garantir la <strong>meilleure expérience</strong> au sein de notre vitrine.
                        </p>
                    </div>

                    <div class="d-flex align-items-center justify-content-center flex-wrap gap-4 mt-2">
                        <a href="/" class="btn btn-premium-glass px-5">
                            RETOUR À L'ACCUEIL <i class="bi bi-house-door ms-2"></i>
                        </a>
                        
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link text-muted text-decoration-none small ls-1 fw-bold hover-dark">
                                SE DÉCONNECTER <i class="bi bi-box-arrow-right ms-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .ls-tight { letter-spacing: -2px; }
    .ls-wide { letter-spacing: 4px; }
    .ls-1 { letter-spacing: 1px; }
    
    .glass-registration-card {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(30px);
        -webkit-backdrop-filter: blur(30px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 50px;
        box-shadow: 0 40px 100px rgba(0, 0, 0, 0.05);
    }

    .glass-inner-card {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 25px;
    }

    .status-pulse-ring {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 120px;
        height: 120px;
        border: 2px solid rgba(0,0,0,0.05);
        border-radius: 50%;
        animation: pulseRing 3s ease-out infinite;
    }

    @keyframes pulseRing {
        0% { width: 80px; height: 80px; opacity: 1; }
        100% { width: 200px; height: 200px; opacity: 0; }
    }

    .status-icon-main {
        position: relative;
        z-index: 2;
        animation: rotateHourglass 4s infinite ease-in-out;
    }

    @keyframes rotateHourglass {
        0% { transform: rotate(0); }
        45% { transform: rotate(0); }
        55% { transform: rotate(180deg); }
        100% { transform: rotate(180deg); }
    }

    .btn-premium-glass {
        background: rgba(255, 255, 255, 0.5) !important;
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.6) !important;
        border-radius: 50px !important;
        padding: 15px 40px !important;
        color: #000 !important;
        font-weight: 800;
        transition: all 0.4s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-premium-glass:hover {
        background: rgba(255, 255, 255, 0.8) !important;
        transform: translateY(-3px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .hover-dark:hover {
        color: #000 !important;
    }

    .animate-in {
        animation: scaleUp 1.2s cubic-bezier(0.19, 1, 0.22, 1) forwards;
    }
    @keyframes scaleUp {
        from { opacity: 0; transform: scale(0.9) translateY(30px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    body { overflow-x: hidden; min-height: 100vh; }
</style>
@endsection
