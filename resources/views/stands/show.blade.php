@extends('layouts.app')

@section('title', 'Détails du Stand')

@section('content')
    <div class="admin-dashboard-wrapper min-vh-100 py-3 py-md-5" style="background: transparent; color: #1e293b;">
        <div class="container-fluid px-3 px-md-5 pt-0 pb-4">
            <!-- Header -->
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 mb-md-5 gap-4 animate-in">
                <div class="glass-container p-3 p-md-4 rounded-5 border border-white border-opacity-50 w-100">
                    <p class="text-secondary small ls-2 text-uppercase mb-0 fw-bold" style="letter-spacing: 4px;">Gestion
                        Stand</p>
                    <h1 class="h3 h1-md fw-bold mb-0 text-dark">{{ $stand->nom_stand }}.</h1>
                    <p class="small text-muted mt-2 fw-medium mb-0">Activité en direct et inventaire.</p>
                </div>
                <div class="pb-3 w-100 d-md-flex justify-content-end">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('stands.index') }}"
                            class="btn btn-glass-auth shadow-sm fw-bold flex-grow-1 flex-md-grow-0 text-center">
                            <i class="bi bi-arrow-left me-2"></i>RETOUR
                        </a>
                        <a href="{{ route('stands.commandes', $stand) }}"
                            class="btn btn-glass-auth shadow-sm fw-bold flex-grow-1 flex-md-grow-0 text-center">
                            <i class="bi bi-receipt me-2"></i>HISTORIQUE
                        </a>
                        <a href="{{ route('stands.edit', $stand) }}"
                            class="btn btn-glass-auth shadow-sm fw-bold flex-grow-1 flex-md-grow-0 text-center">
                            <i class="bi bi-pencil me-2"></i>ÉDITER
                        </a>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div
                    class="alert glass-container border-success border-opacity-25 text-success p-4 rounded-5 mb-5 animate-in">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Recent Orders Section (MOVED UP) -->
            <div id="orders-section" class="mb-0 pb-5 animate-in"
                style="animation-delay: 0.1s; position: relative; z-index: 10;">
                <div class="d-flex justify-content-between align-items-center mb-4 px-2">
                    <h2 class="fw-bold text-dark mb-0">Dernières Commandes</h2>
                    <a href="{{ route('stands.commandes', $stand) }}"
                        class="text-primary fw-bold text-decoration-none small ls-1">
                        TOUT VOIR <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="px-0 px-md-2">
                    @if ($commandes->count() > 0)
                        <!-- Desktop Table View -->
                        <div class="d-none d-md-block table-responsive overflow-visible">
                            <table class="table align-middle m-0 text-dark">
                                <thead>
                                    <tr class="text-secondary text-uppercase small ls-1">
                                        <th class="border-0 pb-4 text-nowrap">ID</th>
                                        <th class="border-0 pb-4 text-nowrap">Client</th>
                                        <th class="border-0 pb-4 text-nowrap">Total</th>
                                        <th class="border-0 pb-4 text-nowrap">Statut</th>
                                        <th class="border-0 pb-4 text-end text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($commandes as $commande)
                                        <tr class="border-top">
                                            <td class="py-4 fw-bold">#{{ $commande->id }}</td>
                                            <td class="text-nowrap">
                                                <div class="fw-bold">{{ $commande->client_email ?? 'Anonyme' }}</div>
                                                <div class="small text-muted">
                                                    {{ $commande->created_at->format('d/m/y H:i') }}</div>
                                            </td>
                                            <td class="fw-bold text-dark text-nowrap">
                                                {{ number_format($commande->total, 2) }} FCFA</td>
                                            <td class="text-nowrap">
                                                {!! $commande->status_label !!}
                                            </td>
                                            <td class="text-end text-nowrap">
                                                <div class="dropdown d-inline-block">
                                                    <button
                                                        class="btn btn-sm btn-glass-auth rounded-pill px-3 dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown"
                                                        data-bs-boundary="viewport">
                                                        GÉRER
                                                    </button>
                                                    <ul
                                                        class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2 mt-2">
                                                        <li>
                                                            <form
                                                                action="{{ route('commandes.update-status', $commande) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="status" value="Géré">
                                                                <button type="submit"
                                                                    class="dropdown-item rounded-3 fw-bold text-success py-2">
                                                                    <i class="bi bi-check-circle me-2"></i> Marquer comme
                                                                    GÉRÉ
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form
                                                                action="{{ route('commandes.update-status', $commande) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="status" value="En cours">
                                                                <button type="submit"
                                                                    class="dropdown-item rounded-3 fw-bold text-warning py-2">
                                                                    <i class="bi bi-clock-history me-2"></i> Marquer EN
                                                                    COURS
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form
                                                                action="{{ route('commandes.update-status', $commande) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="status" value="Plus dispo">
                                                                <button type="submit"
                                                                    class="dropdown-item rounded-3 fw-bold text-danger py-2">
                                                                    <i class="bi bi-x-circle me-2"></i> PLUS DISPO
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li class="border-top mt-2 pt-2">
                                                            <a href="{{ route('commandes.show', $commande) }}"
                                                                class="dropdown-item rounded-3 py-2 small text-muted">
                                                                <i class="bi bi-eye me-2"></i> Voir détails complets
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="d-block d-md-none">
                            <div class="row g-3">
                                @foreach ($commandes as $commande)
                                    <div class="col-12">
                                        <div class="glass-container p-4 rounded-5 border border-white position-relative">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <div>
                                                    <span class="text-secondary small fw-bold">#{{ $commande->id }}</span>
                                                    <div class="fw-bold text-dark mt-1">
                                                        {{ $commande->client_email ?? 'Anonyme' }}</div>
                                                    <div class="small text-muted">
                                                        {{ $commande->created_at->format('d/m/y H:i') }}</div>
                                                </div>
                                                <div class="text-end">
                                                    <div class="fw-bold text-primary mb-2">
                                                        {{ number_format($commande->total, 2) }} FCFA</div>
                                                    {!! $commande->status_label !!}
                                                </div>
                                            </div>

                                            <div class="dropdown mt-3">
                                                <button
                                                    class="btn btn-sm btn-glass-auth rounded-pill w-100 py-2 dropdown-toggle"
                                                    type="button" data-bs-toggle="dropdown">
                                                    ACTIONS DE GESTION
                                                </button>
                                                <ul class="dropdown-menu border-0 shadow-lg rounded-4 p-2 w-100">
                                                    <li>
                                                        <form action="{{ route('commandes.update-status', $commande) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="status" value="Géré">
                                                            <button type="submit"
                                                                class="dropdown-item rounded-3 fw-bold text-success py-2">
                                                                <i class="bi bi-check-circle me-2"></i> Marquer GÉRÉ
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
                                                    <li class="border-top mt-2 pt-2">
                                                        <a href="{{ route('commandes.show', $commande) }}"
                                                            class="dropdown-item rounded-3 py-2 text-center small text-muted">
                                                            <i class="bi bi-eye me-1"></i> VOIR DÉTAILS
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-receipt display-3 text-secondary opacity-25 mb-3"></i>
                            <p class="text-muted fs-5 mb-0">Aucune commande reçue pour le moment.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Catalogue Section -->
            <div id="catalog-section"
                class="d-flex justify-content-between align-items-center mb-5 mt-5 py-5 border-top border-white border-opacity-25 animate-in"
                style="animation-delay: 0.2s; position: relative; z-index: 5;">
                <h2 class="fw-bold text-dark mb-0">Catalogue Produits</h2>
                <a href="{{ route('produits.create') }}" class="btn btn-glass-auth fw-bold px-4">
                    <i class="bi bi-plus-circle me-2"></i>NOUVEAU
                </a>
            </div>

            @if ($stand->produits->count() > 0)
                <div class="row g-4 animate-in" style="animation-delay: 0.3s;">
                    @foreach ($stand->produits as $produit)
                        <div class="col-md-6 col-lg-4">
                            <div
                                class="glass-container p-0 rounded-5 shadow-sm border border-white h-100 transition-all hover-up overflow-hidden">
                                @if ($produit->image_url)
                                    <div class="card-img-container" style="height: 180px; position: relative;">
                                        <img src="{{ filter_var($produit->image_url, FILTER_VALIDATE_URL) ? $produit->image_url : asset($produit->image_url) }}"
                                            class="w-100 h-100 object-fit-cover transition-all"
                                            alt="{{ $produit->nom }}">
                                        <div class="position-absolute top-0 end-0 p-3">
                                            <span
                                                class="badge glass-pill text-dark px-3 py-2 rounded-pill shadow-sm fw-bold">{{ number_format($produit->prix, 2) }}
                                                FCFA</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="card-img-container bg-white bg-opacity-50 d-flex flex-column align-items-center justify-content-center"
                                        style="height: 180px;">
                                        <i class="bi bi-image text-secondary opacity-25 mb-2"
                                            style="font-size: 2.5rem;"></i>
                                        <div class="position-absolute top-0 end-0 p-3">
                                            <span
                                                class="badge glass-pill text-dark px-3 py-2 rounded-pill shadow-sm fw-bold">{{ number_format($produit->prix, 2) }}
                                                FCFA</span>
                                        </div>
                                    </div>
                                @endif

                                <div class="p-4">
                                    <h4 class="fw-bold text-dark mb-2">{{ $produit->nom }}</h4>
                                    <p class="text-secondary small mb-4">{{ Str::limit($produit->description, 80) }}</p>

                                    <div class="d-flex gap-2 pt-3 border-top border-white border-opacity-50">
                                        <a href="{{ route('produits.edit', $produit) }}"
                                            class="btn btn-glass-auth flex-grow-1 text-center py-2 btn-sm">
                                            <i class="bi bi-pencil me-1"></i> ÉDITER
                                        </a>
                                        <form action="{{ route('produits.destroy', $produit) }}" method="POST"
                                            class="flex-grow-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-glass-auth w-100 text-center py-2 btn-sm"
                                                onclick="return confirm('Souhaitez-vous supprimer ce produit ?')">
                                                <i class="bi bi-trash me-1"></i>
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
                    <i class="bi bi-box-seam display-2 text-secondary opacity-25 mb-4"></i>
                    <h3 class="text-secondary fw-bold">Catalogue vide</h3>
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
            border-radius: 20px;
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

        .dropdown-item:hover {
            background-color: rgba(0, 0, 0, 0.03) !important;
        }

        .hover-up:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.8);
        }

        .hover-up:hover img {
            transform: scale(1.05);
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



        .dropdown-menu {
            z-index: 1050 !important;
        }

        @media (max-width: 767px) {
            .glass-container.p-5 {
                padding: 1.25rem !important;
            }

            .table-responsive {
                border: none;
            }
        }
    </style>
@endsection
