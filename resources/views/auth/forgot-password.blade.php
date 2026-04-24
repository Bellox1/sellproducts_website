@extends('layouts.app')

@section('title', 'Mot de passe oublié')

@section('content')
<div class="min-vh-100 d-flex align-items-start py-0 py-md-5">
    <div class="vitrine-bg-blobs"></div>
    <div class="container pt-0 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="glass-registration-card p-5 animate-in">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm" style="background: rgba(40,167,69,0.15); border-radius: 20px; backdrop-filter: blur(10px);">
                            <div class="d-flex align-items-center text-success">
                                <i class="bi bi-check-circle-fill me-3 fs-4"></i>
                                <div>{{ session('status') }}</div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4 border-0 shadow-sm" style="background: rgba(220,53,69,0.15); border-radius: 20px; backdrop-filter: blur(10px);">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-circle-fill me-3 fs-4"></i>
                                <div>
                                    <strong class="d-block mb-1">Attention !</strong>
                                    <ul class="mb-0 list-unstyled small">
                                        @foreach($errors->all() as $error)
                                            <li><i class="bi bi-dot"></i> {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Branding/Icon -->
                    <div class="mb-4 text-center">
                        <h1 class="display-3 fw-bold text-dark mb-0 ls-tight">Récupération</h1>
                        <p class="text-muted fs-5 ls-wide text-uppercase">Récupérez votre accès en un instant.</p>
                    </div>

                    <form method="POST" action="{{ route('password.email') }}" class="mt-4">
                        @csrf

                        <div class="mb-5">
                            <label for="email" class="text-dark small ls-wide text-uppercase d-block mb-2 opacity-75">Votre Adresse Email</label>
                            <input type="email" class="form-control-premium" id="email" name="email" value="{{ old('email') }}" placeholder="votre@email.com" required autofocus>
                            <div class="d-flex justify-content-between align-items-start mt-2">
                                <small class="text-muted" style="max-width: 70%;">Nous vous enverrons un code OTP à 6 chiffres.</small>
                                <a href="{{ route('login') }}" class="text-muted text-decoration-none extra-small ls-1 hover-dark fw-bold text-end">
                                    RETOUR À LA CONNEXION
                                </a>
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <button type="submit" class="btn btn-premium-glass px-5 w-100">
                                ENVOYER LE CODE <i class="bi bi-send ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .ls-tight { letter-spacing: -3px; }
    .ls-wide { letter-spacing: 3px; }
    .ls-1 { letter-spacing: 1px; }
    
    .glass-registration-card {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 40px;
        box-shadow: 0 40px 100px rgba(0, 0, 0, 0.08);
    }

    @media (max-width: 768px) {
        .glass-registration-card {
            background: transparent !important;
            backdrop-filter: none !important;
            border: none !important;
            box-shadow: none !important;
            padding: 20px 10px !important;
        }
    }

    .form-control-premium {
        background: rgba(255, 255, 255, 0.3) !important;
        border: 1px solid rgba(255, 255, 255, 0.4) !important;
        border-radius: 20px !important;
        color: #000 !important;
        font-size: 1.1rem !important;
        padding: 15px 25px !important;
        width: 100%;
        outline: none !important;
        transition: all 0.4s ease;
        box-shadow: none !important;
    }
    
    .form-control-premium::placeholder {
        color: rgba(0, 0, 0, 0.2) !important;
    }

    .form-control-premium:focus {
        background: rgba(255, 255, 255, 0.5) !important;
        border-color: rgba(255, 255, 255, 0.8) !important;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05) !important;
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

    .extra-small { font-size: 0.65rem; }

    .animate-in {
        animation: scaleUp 1.2s cubic-bezier(0.19, 1, 0.22, 1) forwards;
    }
    @keyframes scaleUp {
        from { opacity: 0; transform: scale(0.95) translateY(20px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    body { overflow-x: hidden; min-height: 100vh; }
</style>
@endsection
