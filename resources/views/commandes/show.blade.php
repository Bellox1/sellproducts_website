@extends('layouts.app')

@section('title', 'Détails de la Commande')

@section('content')
    <div class="admin-dashboard-wrapper min-vh-100 py-3 py-md-5" style="background: transparent; color: #1e293b;">
        <div class="container-fluid px-3 px-md-5 pt-0 pb-4">
            <!-- Header -->
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 mb-md-5 gap-4 animate-in">
                <div class="glass-container p-4 rounded-5 border border-white border-opacity-50 w-100">
                    <p class="text-secondary small ls-2 text-uppercase mb-0 fw-bold" style="letter-spacing: 4px;">Détails
                        Transaction</p>
                    <h1 class="display-5 display-md-3 fw-bold mb-0 text-dark">Bon de Commande #{{ $commande->id }}.</h1>
                    <p class="fs-5 text-muted mt-3 fw-medium">Résumé complet des articles et informations de cette commande.
                    </p>
                </div>
                <div class="pb-3 w-100 d-md-flex justify-content-end">
                    <a href="{{ url()->previous() }}"
                        class="btn btn-glass-auth shadow-sm fw-bold w-100 w-md-auto d-inline-block py-2">
                        <i class="bi bi-arrow-left me-2"></i>RETOUR
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div
                    class="alert glass-container border-success border-opacity-25 text-success p-4 rounded-5 mb-4 animate-in">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="row g-4 animate-in" style="animation-delay: 0.1s;">
                <!-- Left Column: Articles -->
                <div class="col-lg-8">
                    <div class="glass-container p-4 p-md-5 rounded-5 shadow-sm border border-white mb-4">
                        <h4 class="fw-bold text-dark mb-4 text-uppercase ls-1 small">Articles Commandés</h4>
                        <div class="table-responsive">
                            <table class="table align-middle m-0">
                                <thead>
                                    <tr class="text-secondary text-uppercase small ls-1">
                                        <th class="border-0 pb-3">Désignation</th>
                                        <th class="border-0 pb-3 text-center">Prix Unit.</th>
                                        <th class="border-0 pb-3 text-center">Qté</th>
                                        <th class="border-0 pb-3 text-end">Sous-total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($commande->produits as $produit)
                                        <tr class="border-top">
                                            <td class="py-4">
                                                <div class="fw-bold text-dark">{{ $produit['nom'] }}</div>
                                                @if (isset($produit['description']))
                                                    <div class="text-secondary small">
                                                        {{ Str::limit($produit['description'], 50) }}</div>
                                                @endif
                                            </td>
                                            <td class="py-4 text-center text-secondary">
                                                {{ number_format($produit['prix'] ?? 0, 2) }} FCFA</td>
                                            <td class="py-4 text-center">
                                                <span
                                                    class="badge glass-pill text-dark px-3 py-1 rounded-pill">{{ $produit['quantite'] ?? 0 }}</span>
                                            </td>
                                            <td class="py-4 text-end fw-bold text-dark">
                                                {{ number_format($produit['sous_total'] ?? 0, 2) }} FCFA</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Summary -->
                <div class="col-lg-4">
                    <div class="glass-container p-4 p-md-5 rounded-5 shadow-sm border border-white mb-4">
                        <h4 class="fw-bold text-dark mb-4 text-uppercase ls-1 small">Résumé & Client</h4>
                        <div class="mb-4">
                            <p class="text-secondary small text-uppercase ls-1 mb-1">Montant Total</p>
                            <h2 class="fw-bold text-primary">{{ number_format($commande->total, 2) }} FCFA</h2>
                        </div>

                        <div class="mb-4">
                            <p class="text-secondary small text-uppercase ls-1 mb-2">Statut de Traitement</p>
                            <div class="d-flex flex-column gap-2">
                                <div class="mb-2">{!! $commande->status_label !!}</div>

                                <div class="dropdown">
                                    <button class="btn btn-sm btn-glass-auth rounded-pill px-4 dropdown-toggle w-100"
                                        type="button" data-bs-toggle="dropdown">
                                        CHANGER LE STATUT
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2 mt-2 w-100">
                                        <li>
                                            <form action="{{ route('commandes.update-status', $commande) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="Géré">
                                                <button type="submit"
                                                    class="dropdown-item rounded-3 fw-bold text-success py-2">
                                                    <i class="bi bi-check-circle me-2"></i> Marquer comme GÉRÉ
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('commandes.update-status', $commande) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="En cours">
                                                <button type="submit"
                                                    class="dropdown-item rounded-3 fw-bold text-warning py-2">
                                                    <i class="bi bi-clock-history me-2"></i> Marquer EN COURS
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('commandes.update-status', $commande) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="Plus dispo">
                                                <button type="submit"
                                                    class="dropdown-item rounded-3 fw-bold text-danger py-2">
                                                    <i class="bi bi-x-circle me-2"></i> PLUS DISPO
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="border-top border-white border-opacity-50 pt-4 mb-4">
                            <p class="text-secondary small text-uppercase ls-1 mb-1">Date d'opération</p>
                            <h6 class="text-dark fw-bold">{{ $commande->created_at->format('d M Y, H:i') }}</h6>
                        </div>

                        @if ($commande->client_email)
                            <div class="border-top border-white border-opacity-50 pt-4">
                                <p class="text-secondary small text-uppercase ls-1 mb-1">Contact Client</p>
                                <h6 class="text-dark fw-bold"><i
                                        class="bi bi-envelope me-2"></i>{{ $commande->client_email }}</h6>
                            </div>
                        @endif
                    </div>

                    <div class="glass-container p-4 rounded-5 shadow-sm border border-white">
                        <h6 class="fw-bold text-dark mb-3 text-uppercase ls-1 small">Vendu par</h6>
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-soft-primary me-3" style="width: 45px; height: 45px;">
                                <i class="bi bi-shop fs-5"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">{{ $commande->stand->nom_stand }}</h6>
                                <p class="text-secondary small mb-0">{{ $commande->stand->user->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            border-radius: 12px;
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

        .animate-in {
            animation: slideIn 1.2s cubic-bezier(0.19, 1, 0.22, 1) forwards;
            opacity: 0;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
