@extends('layouts.app')

@section('title', 'Modifier le produit')

@section('content')
<div class="admin-dashboard-wrapper min-vh-100 py-3 py-md-5" style="background: transparent; color: #1e293b;">
    
    <div class="container-fluid px-3 px-md-5 pt-0 pb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 mb-md-5 animate-in">
            <div class="glass-container p-3 p-md-4 rounded-5 border border-white border-opacity-50 mb-3 mb-md-0">
                <p class="text-secondary small ls-2 text-uppercase mb-0 fw-bold" style="letter-spacing: 4px;">Inventaire</p>
                <h1 class="display-5 display-md-3 fw-bold mb-0 text-dark">Modifier Produit.</h1>
                <p class="fs-6 fs-md-5 text-muted mt-3 fw-medium">Adaptez les informations de l'article <span class="text-primary">{{ $produit->nom }}</span>.</p>
            </div>
            <div class="text-start text-md-end pb-3">
                <a href="{{ route('produits.index') }}" class="btn btn-glass-auth shadow-sm fw-bold w-100 w-md-auto d-inline-block py-2">
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

        <form action="{{ route('produits.update', $produit) }}" method="POST" enctype="multipart/form-data" class="animate-in" style="animation-delay: 0.1s;">
            @csrf
            @method('PUT')

            <div class="row g-4 mb-4">
                {{-- Row 1: Nom, Prix, Stand --}}
                <div class="col-md-4">
                    <div class="glass-container p-4 rounded-5 border border-white h-100">
                        <label for="nom" class="form-label small fw-bold text-uppercase ls-1 text-secondary">Nom du produit</label>
                        <input type="text" class="form-control premium-input @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $produit->nom) }}" required>
                        @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="glass-container p-4 rounded-5 border border-white h-100">
                        <label for="prix" class="form-label small fw-bold text-uppercase ls-1 text-secondary">Prix (€)</label>
                        <input type="number" class="form-control premium-input @error('prix') is-invalid @enderror" id="prix" name="prix" step="0.01" min="0" value="{{ old('prix', $produit->prix) }}" required>
                        @error('prix') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="glass-container p-4 rounded-5 border border-white h-100">
                        <label for="stand_id" class="form-label small fw-bold text-uppercase ls-1 text-secondary">Stand de vente</label>
                        <select class="form-select premium-input @error('stand_id') is-invalid @enderror" id="stand_id" name="stand_id" required>
                            <option value="">Choisir un stand...</option>
                            @foreach($stands as $stand)
                                <option value="{{ $stand->id }}" {{ old('stand_id', $produit->stand_id) == $stand->id ? 'selected' : '' }}>{{ $stand->nom_stand }}</option>
                            @endforeach
                        </select>
                        @error('stand_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Row 2: Image URL, Image File, Description --}}
                <div class="col-md-4">
                    <div class="glass-container p-4 rounded-5 border border-white h-100">
                        <label for="image_url" class="form-label small fw-bold text-uppercase ls-1 text-secondary">URL de l'image</label>
                        <input type="url" class="form-control premium-input @error('image_url') is-invalid @enderror" id="image_url" name="image_url" value="{{ old('image_url', $produit->image_url) }}">
                        @error('image_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @if($produit->image_url)
                            <div class="mt-2 text-primary small fw-bold">
                                <i class="bi bi-link-45deg"></i> <a href="{{ Str::startsWith($produit->image_url, ['http://', 'https://']) ? $produit->image_url : asset($produit->image_url) }}" target="_blank" class="text-decoration-none">Voir l'URL actuelle</a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="glass-container p-4 rounded-5 border border-white h-100">
                        <label for="image_file" class="form-label small fw-bold text-uppercase ls-1 text-secondary">Nouveau fichier image</label>
                        <input type="file" class="form-control premium-input @error('image_file') is-invalid @enderror" id="image_file" name="image_file" accept="image/*">
                        @error('image_file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="glass-container p-4 rounded-5 border border-white h-100">
                        <label for="description" class="form-label small fw-bold text-uppercase ls-1 text-secondary">Description</label>
                        <textarea class="form-control premium-input @error('description') is-invalid @enderror" id="description" name="description" rows="1">{{ old('description', $produit->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-3 mt-4 mt-md-5">
                <button type="submit" class="btn btn-glass-auth w-100 w-md-auto px-4 px-md-5 py-2 py-md-3 fw-bold">
                    <i class="bi bi-arrow-repeat me-2"></i>METTRE À JOUR LE PRODUIT
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlInput = document.getElementById('image_url');
        const fileInput = document.getElementById('image_file');

        urlInput.addEventListener('input', function() {
            if (this.value) fileInput.value = '';
        });

        fileInput.addEventListener('change', function() {
            if (this.value) urlInput.value = '';
        });
    });
</script>
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
