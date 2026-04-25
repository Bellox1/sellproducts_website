<div class="admin-dashboard-wrapper min-vh-100 py-5" style="background: transparent; color: #1e293b; padding-top: 15rem;">
    <div class="container-fluid px-5 py-4">
        <div class="d-flex justify-content-between align-items-end mb-5 animate-in">
            <div class="glass-container p-4 rounded-5 border border-white border-opacity-50">
                <p class="text-secondary small ls-2 text-uppercase mb-2 fw-bold" style="letter-spacing: 4px;">Suivi des
                    Ventes</p>
                <h1 class="display-3 fw-bold mb-0 text-dark">Historique Commandes.</h1>
                <p class="fs-5 text-muted mt-3 fw-medium">Consultez l'ensemble des transactions effectuées sur vos stands
                    <span class="text-primary">Eat&Drink</span>.</p>
            </div>
            <div class="text-end pb-3">
                <a href="{{ route('produits.index') }}" class="btn btn-glass-auth shadow-sm fw-bold">
                    <i class="bi bi-arrow-left me-2"></i>RETOUR AUX PRODUITS
                </a>
            </div>
        </div>

        @if (session('success'))
            <div
                class="alert glass-container border-success border-opacity-25 text-success p-4 rounded-5 mb-5 animate-in">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if ($commandes->count() > 0)
            <div class="row animate-in" style="animation-delay: 0.1s;">
                @foreach ($commandes as $commande)
                    <div class="col-12 mb-5">
                        <div
                            class="glass-container p-0 rounded-5 shadow-sm border border-white overflow-hidden transition-all hover-up">
                            <div
                                class="p-4 border-bottom border-white border-opacity-50 d-flex justify-content-between align-items-center bg-white bg-opacity-30">
                                <div class="d-flex align-items-center">
                                    <div class="icon-box bg-soft-primary me-3" style="width: 50px; height: 50px;">
                                        <i class="bi bi-receipt fs-4"></i>
                                    </div>
                                    <div>
                                        <h4 class="fw-bold mb-0 text-dark">Commande #{{ $commande->id }}</h4>
                                        <div class="text-secondary small text-uppercase ls-1">
                                            {{ $commande->stand->nom_stand }}</div>
                                    </div>
                                </div>
                                <span class="badge glass-pill text-dark px-4 py-2 rounded-pill border border-white">
                                    <i
                                        class="bi bi-calendar3 me-2 text-primary"></i>{{ $commande->date_commande->format('d M Y, H:i') }}
                                </span>
                            </div>

                            <div class="p-5">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <p class="text-secondary small text-uppercase ls-1 mb-1">Total Transaction</p>
                                        <h2 class="fw-bold text-dark">{{ number_format($commande->total, 2) }} FCFA</h2>
                                    </div>
                                    @if ($commande->client_email)
                                        <div class="col-md-6 text-md-end">
                                            <p class="text-secondary small text-uppercase ls-1 mb-1">Identifiant Client
                                            </p>
                                            <h5 class="text-dark fw-medium">{{ $commande->client_email }}</h5>
                                        </div>
                                    @endif
                                </div>

                                <div class="glass-container rounded-4 p-4 border-0">
                                    <h6 class="fw-bold text-uppercase ls-1 text-secondary mb-4">Détails des Articles
                                    </h6>
                                    <div class="table-responsive">
                                        <table class="table admin-fancy-table align-middle m-0">
                                            <thead>
                                                <tr class="small text-uppercase">
                                                    <th class="border-0 pb-3 text-secondary fw-bold">Désignation</th>
                                                    <th class="border-0 pb-3 text-secondary fw-bold">Prix Unit.</th>
                                                    <th class="border-0 pb-3 text-secondary fw-bold text-center">Qté
                                                    </th>
                                                    <th class="border-0 pb-3 text-end text-secondary fw-bold">Sous-total
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($commande->produits as $produit)
                                                    <tr>
                                                        <td class="py-3 fw-bold text-dark">
                                                            {{ $produit['nom'] ?? 'Produit inconnu' }}</td>
                                                        <td class="py-3 text-secondary">
                                                            {{ number_format($produit['prix'] ?? 0, 2) }} FCFA</td>
                                                        <td class="py-3 text-center">
                                                            <span
                                                                class="badge bg-soft-primary px-3 py-1 rounded-pill">{{ $produit['quantite'] ?? 0 }}</span>
                                                        </td>
                                                        <td class="py-3 text-end fw-bold text-dark">
                                                            {{ number_format($produit['sous_total'] ?? 0, 2) }} FCFA
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <a href="{{ route('commandes.show', $commande) }}" class="btn btn-glass-auth px-4">
                                        <i class="bi bi-eye me-2"></i>DÉTAILS COMPLETS
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="glass-container p-5 rounded-5 text-center animate-in">
                <i class="bi bi-clock-history display-1 text-secondary opacity-25 mb-4"></i>
                <h3 class="text-secondary fw-bold">Aucune transaction</h3>
                <p class="text-muted mb-5">Votre historique est vide pour le moment. Recevez vos premières commandes
                    pour voir les détails ici.</p>
                <a href="{{ route('produits.index') }}" class="btn btn-glass-auth px-5 py-3 fw-bold">
                    RETOUR À MON INVENTAIRE
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    .ls-1 {
        letter-spacing: 1px;
    }

    .ls-2 {
        letter-spacing: 2px;
    }

    .glass-container {
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(30px);
        -webkit-backdrop-filter: blur(30px);
        border: 1px solid rgba(255, 255, 255, 0.6) !important;
        transition: all 0.4s ease;
    }

    .icon-box {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        background: rgba(244, 118, 104, 0.1);
        color: #f47668;
    }

    .bg-soft-primary {
        background: rgba(244, 118, 104, 0.1);
        color: #f47668;
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
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
    }

    .btn-glass-auth:hover {
        background: #fff;
        color: #000 !important;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    }

    .hover-up:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.7);
    }

    .animate-in {
        animation: slideIn 1.2s cubic-bezier(0.19, 1, 0.22, 1) forwards;
        opacity: 0;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(40px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .admin-fancy-table th {
        font-family: 'Syne', sans-serif;
    }
</style>
