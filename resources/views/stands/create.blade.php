@extends('layouts.app')

@section('title', 'Créer un nouveau stand')

@section('content')
<div class="admin-dashboard-wrapper min-vh-100 py-5" style="background: transparent; color: #1e293b;">
    <div class="d-block d-md-none" style="height: 80px; width: 100%;"></div>
    <div class="d-none d-md-block" style="height: 200px; width: 100%;"></div>
    
    <div class="container-fluid px-3 px-md-5 py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 mb-md-5 animate-in">
            <div class="glass-container p-3 p-md-4 rounded-5 border border-white border-opacity-50 mb-3 mb-md-0">
                <p class="text-secondary small ls-2 text-uppercase mb-2 fw-bold" style="letter-spacing: 4px;">Points de Vente</p>
                <h1 class="display-5 display-md-3 fw-bold mb-0 text-dark">Nouveau Stand.</h1>
                <p class="fs-6 fs-md-5 text-muted mt-3 fw-medium">Configurez votre nouvel espace de vente sur <span class="text-primary">Eat&Drink</span>.</p>
            </div>
            <div class="text-start text-md-end pb-3">
                <a href="{{ route('stands.index') }}" class="btn btn-glass-auth shadow-sm fw-bold w-100 w-md-auto d-inline-block py-2">
                    <i class="bi bi-arrow-left me-2"></i>ANNULER
                </a>
            </div>
        </div>

        @if($errors->any())
            <div class="alert glass-container border-danger border-opacity-25 text-danger p-4 rounded-5 mb-5 animate-in">
                <ul class="mb-0 small fw-bold">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('stands.store') }}" method="POST" class="animate-in" style="animation-delay: 0.1s;">
            @csrf

            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="glass-container p-4 rounded-5 border border-white h-100">
                        <label for="nom_stand" class="form-label small fw-bold text-uppercase ls-1 text-secondary">Nom du stand</label>
                        <input type="text" class="form-control premium-input @error('nom_stand') is-invalid @enderror" id="nom_stand" name="nom_stand" value="{{ old('nom_stand') }}" required placeholder="Ex: Ma Petite Boulangerie">
                        @error('nom_stand') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="glass-container p-4 rounded-5 border border-white h-100">
                        <label for="description" class="form-label small fw-bold text-uppercase ls-1 text-secondary">Description du stand</label>
                        <textarea class="form-control premium-input @error('description') is-invalid @enderror" id="description" name="description" rows="1" placeholder="Quelques mots sur votre stand...">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-3 mt-4 mt-md-5">
                <button type="submit" class="btn btn-glass-auth w-100 w-md-auto px-4 px-md-5 py-2 py-md-3 fw-bold">
                    <i class="bi bi-check2-circle me-2"></i>OUVRIR LE STAND
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('styles')
<style>
    .ls-1 { letter-spacing: 1px; }
    .ls-2 { letter-spacing: 2px; }
    
    .glass-container {
        background: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(30px);
        -webkit-backdrop-filter: blur(30px);
        border: 1px solid rgba(255, 255, 255, 0.5) !important;
        transition: all 0.3s ease;
    }

    .premium-input {
        background: rgba(255, 255, 255, 0.5) !important;
        border: 1px solid rgba(0, 0, 0, 0.05) !important;
        border-radius: 15px !important;
        padding: 12px 15px !important;
        color: #1e293b !important;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .premium-input:focus {
        background: #fff !important;
        border-color: #f47668 !important;
        box-shadow: 0 0 15px rgba(244, 118, 104, 0.1) !important;
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
        background: #fff;
        color: #000 !important;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    .animate-in {
        animation: slideIn 1.2s cubic-bezier(0.19, 1, 0.22, 1) forwards;
        opacity: 0;
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
