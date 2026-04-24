@extends('layouts.app')

@section('title', 'Réinitialiser le mot de passe')

@section('content')
<div class="min-vh-100 d-flex align-items-start py-0 py-md-5">
    <div class="vitrine-bg-blobs"></div>
    <div class="container pt-0 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="glass-registration-card p-5 animate-in">
                    <!-- Branding/Icon -->
                    <div class="mb-4 text-center">
                        <h1 class="display-3 fw-bold text-dark mb-0 ls-tight">Nouveau départ.</h1>
                        <p class="text-muted fs-5 ls-wide text-uppercase">Définissez votre nouveau mot de passe.</p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger mb-4 border-0 shadow-sm" style="background: rgba(255,0,0,0.05); border-radius: 15px;">
                            @foreach($errors->all() as $error)
                                <div class="small mb-1 fw-bold">— {{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}" class="mt-4">
                        @csrf
                        
                        <div class="mb-5 text-center">
                            <i class="bi bi-shield-lock text-dark display-3 mb-3 d-block"></i>
                            <p class="text-muted">Votre identité a été vérifiée. <br>Choisissez votre nouveau mot de passe ci-dessous.</p>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-4">
                                <label for="password" class="text-dark small ls-wide text-uppercase d-block mb-2 opacity-75">Nouveau Mot de Passe</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control-premium" id="password" name="password" placeholder="••••••••" required>
                                    <button type="button" class="btn-toggle-password" onclick="togglePassword('password')">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="password_confirmation" class="text-dark small ls-wide text-uppercase d-block mb-2 opacity-75">Confirmation</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control-premium" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                                    <button type="button" class="btn-toggle-password" onclick="togglePassword('password_confirmation')">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-4 mt-5">
                            <button type="submit" class="btn btn-premium-glass px-5">
                                RÉINITIALISER <i class="bi bi-check-lg ms-2"></i>
                            </button>
                            <a href="{{ route('login') }}" class="text-muted text-decoration-none small ls-1 hover-dark fw-bold">
                                ANNULER
                            </a>
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

    .btn-toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: rgba(0, 0, 0, 0.3);
        font-size: 1.2rem;
        cursor: pointer;
        transition: color 0.3s ease;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
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
        from { opacity: 0; transform: scale(0.95) translateY(20px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    body { overflow-x: hidden; min-height: 100vh; }
</style>

<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = input.nextElementSibling.querySelector('i');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>
@endsection
