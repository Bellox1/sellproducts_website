@extends('layouts.app')

@section('title', 'Centre de Contrôle - Admin')

@section('content')
    <div class="admin-dashboard-wrapper min-vh-100 py-5" style="background: transparent; color: #1e293b;">
        <div class="d-block d-md-none" style="height: 80px; width: 100%;"></div>
        <div class="d-none d-md-block" style="height: 200px; width: 100%;"></div>
        
        <div class="container-fluid px-3 px-md-5 py-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 mb-md-5 gap-4 animate-in">
                <div class="glass-container p-3 p-md-4 rounded-5 border border-white border-opacity-50">
                    <p class="text-secondary small ls-2 text-uppercase mb-2 fw-bold" style="letter-spacing: 4px;">Centre de
                        Contrôle</p>
                    <h1 class="display-5 display-md-3 fw-bold mb-0 text-dark">Espace Admin.</h1>
                    <p class="fs-5 text-muted mt-3 fw-medium">Gérez les stands, les utilisateurs et l'ensemble de la
                        plateforme <span class="text-primary">Eat&Drink</span>.</p>
                </div>
                <div class="text-start text-md-end pb-3">
                    <div class="d-inline-block px-4 py-2 rounded-pill shadow-sm glass-pill border border-white">
                        <span class="text-secondary small me-2 text-uppercase ls-1">STATUT:</span>
                        <span class="text-success small fw-bold"><i class="bi bi-shield-check me-1"></i> OPTIMAL</span>
                    </div>
                </div>
            </div>

            <!-- Real Stats Grid -->
            <div class="row g-4 mb-5 animate-in" style="animation-delay: 0.1s;">
                <div class="col-md-6">
                    <div class="glass-container p-4 p-md-5 rounded-5 shadow-sm border border-white">
                        <div class="d-flex justify-content-between mb-4">
                            <div class="icon-box bg-soft-primary">
                                <i class="bi bi-people fs-2"></i>
                            </div>
                        </div>
                        <div class="stat-value display-5 fw-bold text-dark">{{ $approvedEntrepreneurs->count() }}</div>
                        <div class="stat-label text-secondary small text-uppercase ls-2 mt-2 fw-bold">Artisans Actifs</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="glass-container p-5 rounded-5 shadow-sm border border-white">
                        <div class="d-flex justify-content-between mb-4">
                            <div class="icon-box bg-soft-warning">
                                <i class="bi bi-hourglass-split fs-2"></i>
                            </div>
                        </div>
                        <div class="stat-value display-5 fw-bold text-dark">{{ $pendingRequests->count() }}</div>
                        <div class="stat-label text-secondary small text-uppercase ls-2 mt-2 fw-bold">Demandes en Attente
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-5">
                <!-- Pending Requests Column -->
                <div class="col-lg-9 animate-in" style="animation-delay: 0.2s;">
                    <h4 class="fw-bold d-flex align-items-center text-dark mb-4 px-2">
                        <i class="bi bi-mailbox me-3 text-primary"></i>
                        Nouvelles Candidatures
                    </h4>

                    <div class="glass-container p-3 p-md-5 rounded-5 shadow-sm border border-white">
                        @if ($pendingRequests->count())
                            <div class="table-responsive">
                                <table class="table admin-fancy-table align-middle m-0">
                                    <thead>
                                        <tr class="small text-uppercase">
                                            <th class="border-0 pb-4 text-dark fw-bold text-nowrap" style="letter-spacing: 1px; min-width: 250px;">
                                                Entreprise / Artisan</th>
                                            <th class="border-0 pb-4 text-dark fw-bold text-nowrap" style="letter-spacing: 1px; min-width: 180px;">Date
                                                Soumission</th>
                                            <th class="border-0 pb-4 text-end text-dark fw-bold text-nowrap"
                                                style="letter-spacing: 1px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pendingRequests as $request)
                                            <tr class="admin-row transition-all border-top">
                                                <td class="py-4">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <div class="fw-bold fs-5 text-dark mb-1">
                                                            {{ $request->nom_entreprise }}</div>
                                                        <div class="text-secondary small">{{ $request->email }}</div>
                                                    </div>
                                                </div>
                                                </td>
                                                <td>
                                                    <div class="text-dark fw-medium mb-1">
                                                        {{ $request->created_at ? $request->created_at->format('d M Y') : '—' }}
                                                    </div>
                                                    <div class="text-secondary small">
                                                        {{ $request->created_at ? $request->created_at->format('H:i') : '' }}
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="d-flex flex-column flex-md-row justify-content-end gap-2">
                                                        <button
                                                            class="btn btn-glass-approve rounded-pill px-3 px-md-4 py-2 py-md-1 btn-sm fw-bold shadow-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#approveModal{{ $request->id }}">
                                                            APPROUVER
                                                        </button>
                                                        <button
                                                            class="btn btn-glass-reject rounded-pill px-3 px-md-4 py-2 py-md-1 btn-sm fw-bold shadow-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#rejectModal{{ $request->id }}">
                                                            REJETER
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-check2-circle display-1 text-secondary opacity-25 mb-4"></i>
                                <h4 class="text-secondary fw-medium">Aucune demande en attente</h4>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Approved Entrepreneurs Column -->
                <div class="col-lg-3 animate-in" style="animation-delay: 0.3s;">
                    <h4 class="fw-bold d-flex align-items-center text-dark mb-4 px-2">
                        <i class="bi bi-award me-3 text-warning"></i>
                        Artisans Certifiés
                    </h4>

                    <div class="glass-container p-3 p-md-4 rounded-5 shadow-sm border border-white">
                        <div class="approved-list overflow-auto px-2" style="max-height: 600px;">
                            @forelse($approvedEntrepreneurs as $entrepreneur)
                                <div
                                    class="approved-item p-4 rounded-4 mb-3 transition-all bg-white bg-opacity-40 border border-white border-opacity-50">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="fw-bold text-dark small text-uppercase ls-1">
                                                    {{ $entrepreneur->nom_entreprise }}</div>
                                                <div class="text-secondary mt-1" style="font-size: 0.8rem;">
                                                    {{ $entrepreneur->name }}</div>
                                            </div>
                                        </div>
                                        <i class="bi bi-patch-check-fill text-primary"></i>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5 opacity-50">
                                    <p class="small text-uppercase ls-1">Aucun artisan certifié</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals Section -->
    @foreach ($pendingRequests as $request)
        <!-- Approve Modal -->
        <div class="modal fade" id="approveModal{{ $request->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-5 border-0 rounded-5 shadow-lg glass-modal">
                    <div class="modal-body text-center py-4">
                        <div class="mb-4 d-inline-block p-4 rounded-circle bg-success bg-opacity-10 text-success">
                            <i class="bi bi-shield-check display-4"></i>
                        </div>
                        <h3 class="fw-bold text-dark mb-3">Valider l'Artisan ?</h3>
                        <p class="text-secondary mb-5 fs-5">Autoriser **{{ $request->nom_entreprise }}** à rejoindre la
                            plateforme ?</p>
                        <div class="d-flex gap-3 justify-content-center">
                            <button type="button" class="btn btn-light rounded-pill px-5 fw-bold text-secondary"
                                data-bs-dismiss="modal">ANNULER</button>
                            <form method="POST" action="{{ route('admin.users.approve', $request->id) }}">
                                @csrf
                                <button type="submit"
                                    class="btn btn-dark rounded-pill px-5 fw-bold shadow-lg">CONFIRMER</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reject Modal -->
        <div class="modal fade" id="rejectModal{{ $request->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-5 border-0 rounded-5 shadow-lg glass-modal">
                    <div class="modal-body py-2">
                        <h3 class="fw-bold text-dark mb-4">Motif du Rejet</h3>
                        <form method="POST" action="{{ route('admin.users.reject', $request->id) }}">
                            @csrf
                            <div class="mb-4">
                                <textarea name="motif_rejet" class="form-control border-0 bg-white bg-opacity-50 p-4 rounded-4 shadow-inner"
                                    rows="4" required placeholder="Expliquez votre décision..."></textarea>
                            </div>
                            <div class="d-flex gap-3 justify-content-end">
                                <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary"
                                    data-bs-dismiss="modal">FERMER</button>
                                <button type="submit"
                                    class="btn btn-danger rounded-pill px-4 fw-bold shadow-lg">REJETER</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <style>
        .ls-1 {
            letter-spacing: 1px;
        }

        .ls-2 {
            letter-spacing: 2px;
        }

        /* ICON SYSTEM FIX - MANDATORY FONT OVERRIDE */
        .bi::before {
            font-family: "bootstrap-icons" !important;
            font-style: normal !important;
            font-weight: normal !important;
            font-variant: normal !important;
            text-transform: none !important;
            line-height: 1 !important;
            vertical-align: -.125em !important;
            -webkit-font-smoothing: antialiased !important;
            -moz-osx-font-smoothing: grayscale !important;
        }

        .bi {
            opacity: 1 !important;
            display: inline-block;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
            font-family: "bootstrap-icons" !important;
        }

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
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.4);
        }

        .bg-soft-primary {
            background: #f4766820;
            color: #f47668 !important;
        }

        .bg-soft-warning {
            background: #f39c1220;
            color: #f39c12 !important;
        }

        .bg-soft-success {
            background: #19875420;
            color: #198754 !important;
        }

        .glass-pill {
            background: rgba(255, 255, 255, 0.7) !important;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.4) !important;
        }

        .btn-glass-approve {
            background: rgba(25, 135, 84, 0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(25, 135, 84, 0.3) !important;
            color: #198754 !important;
        }

        .btn-glass-reject {
            background: rgba(220, 53, 69, 0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(220, 53, 69, 0.3) !important;
            color: #dc3545 !important;
        }

        .glass-modal {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(40px);
            border: 1px solid rgba(255, 255, 255, 0.8) !important;
        }

        .animate-in {
            animation: dashboardIn 1.2s cubic-bezier(0.19, 1, 0.22, 1) forwards;
            opacity: 0;
        }

        @keyframes dashboardIn {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        html {
            overflow-y: scroll !important;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        @media (max-width: 768px) {
            .admin-fancy-table thead {
                display: none;
            }
            .admin-fancy-table, .admin-fancy-table tbody, .admin-fancy-table tr, .admin-fancy-table td {
                display: block;
                width: 100%;
            }
            .admin-fancy-table tr {
                margin-bottom: 1rem;
                background: rgba(255,255,255,0.3);
                border-radius: 1rem;
                padding: 1rem;
            }
            .admin-fancy-table td {
                text-align: left !important;
                padding: 0.5rem 0 !important;
                border: none !important;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
            }
            .admin-fancy-table td.text-end {
                align-items: stretch;
            }
            .admin-fancy-table td.text-end .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(20, 20, 20, 0.1);
            border-radius: 10px;
        }
    </style>
@endsection
