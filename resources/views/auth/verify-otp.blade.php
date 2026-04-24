@extends('layouts.app')

@section('title', 'Vérification du code')

@section('content')
<div class="min-vh-100 d-flex align-items-start py-0 py-md-5">
    <div class="vitrine-bg-blobs"></div>
    <div class="container pt-0 pt-md-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="glass-registration-card p-5 text-center animate-in">
                    <!-- Header -->
                    <div class="mb-4">
                        <h1 class="display-4 fw-bold text-dark mb-0 ls-tight">Vérification</h1>
                        <p class="text-muted fs-5 ls-wide text-uppercase">Entrez le code reçu par email</p>
                    </div>

                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm" style="background: rgba(40,167,69,0.15); border-radius: 20px; backdrop-filter: blur(10px);">
                            <div class="d-flex align-items-center text-success">
                                <i class="bi bi-check-circle-fill me-3 fs-4"></i>
                                <div class="small fw-bold">{{ session('status') }}</div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4 border-0 shadow-sm" style="background: rgba(220,53,69,0.15); border-radius: 20px; backdrop-filter: blur(10px);">
                            <div class="d-flex align-items-center text-start">
                                <i class="bi bi-exclamation-circle-fill me-3 fs-4"></i>
                                <div>
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

                    <form method="POST" action="{{ route('password.verify.otp') }}" class="mt-5">
                        @csrf
                        
                        <!-- 6 OTP Boxes -->
                        <div class="d-flex justify-content-center gap-1 gap-md-3 mb-5">
                            @for ($i = 0; $i < 6; $i++)
                                <input type="text" name="otp[]" 
                                       class="form-control-otp" 
                                       maxlength="1" 
                                       pattern="[0-9]" 
                                       inputmode="numeric" 
                                       autocomplete="one-time-code"
                                       required
                                       oninput="handleOtpInput(this, {{ $i }})"
                                       onkeydown="handleOtpKeyDown(event, this, {{ $i }})">
                            @endfor
                        </div>

                        <button type="submit" class="btn btn-premium-glass px-5 w-100">
                            VÉRIFIER LE CODE <i class="bi bi-shield-check ms-2"></i>
                        </button>
                    </form>

                    <div class="mt-5">
                        <p class="small text-muted mb-0">Vous n'avez pas reçu de code ?</p>
                        <form method="POST" action="{{ route('password.resend') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link text-dark fw-bold text-decoration-none small ls-1 hover-opacity-75 p-0">
                                RENVOYER UN CODE <i class="bi bi-arrow-clockwise ms-1"></i>
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

    .form-control-otp {
        width: 55px;
        height: 75px;
        text-align: center;
        font-size: 2.2rem;
        font-weight: 800;
        background: rgba(255, 255, 255, 0.3) !important;
        border: 2px solid rgba(255, 255, 255, 0.4) !important;
        border-radius: 18px !important;
        color: #000 !important;
        outline: none !important;
        transition: all 0.3s cubic-bezier(0.19, 1, 0.22, 1);
        box-shadow: none !important;
    }

    @media (max-width: 480px) {
        .form-control-otp {
            flex: 1;
            max-width: 55px;
            height: 60px;
            font-size: 1.6rem;
            padding: 0 !important;
            background: rgba(255, 255, 255, 0.9) !important;
        }
    }

    .form-control-otp:focus {
        background: rgba(255, 255, 255, 0.6) !important;
        border-color: #000 !important;
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
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
    function handleOtpInput(input, index) {
        // Only numbers
        input.value = input.value.replace(/[^0-9]/g, '');
        
        if (input.value.length === 1 && index < 5) {
            const nextInput = input.parentElement.children[index + 1];
            if (nextInput) nextInput.focus();
        }
    }

    function handleOtpKeyDown(event, input, index) {
        if (event.key === 'Backspace' && input.value.length === 0 && index > 0) {
            const prevInput = input.parentElement.children[index - 1];
            if (prevInput) prevInput.focus();
        }
    }

    // Paste handling
    document.addEventListener('paste', function (e) {
        if (e.target.classList.contains('form-control-otp')) {
            const data = e.clipboardData.getData('text').split('').filter(c => /[0-9]/.test(c));
            const inputs = document.querySelectorAll('.form-control-otp');
            data.forEach((char, i) => {
                if (inputs[i]) inputs[i].value = char;
            });
            if (data.length > 0) {
                const nextIndex = Math.min(data.length, 5);
                inputs[nextIndex].focus();
            }
        }
    });
</script>
@endsection
