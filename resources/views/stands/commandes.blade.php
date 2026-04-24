@extends('layouts.app')

@section('title', 'Historique des Commandes')

@section('content')
<div class="admin-dashboard-wrapper min-vh-100 py-3 py-md-5" style="background: transparent; color: #1e293b;">
    <div class="container-fluid px-3 px-md-5 pt-0 pb-4">
        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 mb-md-5 gap-4 animate-in">
            <div class="glass-container p-4 rounded-5 border border-white border-opacity-50 w-100">
                <p class="text-secondary small ls-2 text-uppercase mb-0 fw-bold" style="letter-spacing: 4px;">{{ $stand->nom_stand }}</p>
                <h1 class="display-5 display-md-3 fw-bold mb-0 text-dark">Historique Commandes.</h1>
                <p class="fs-5 text-muted mt-3 fw-medium">Consultez l'intégralité des ventes réalisées sur ce stand.</p>
            </div>
            <div class="pb-3 w-100 d-md-flex justify-content-end">
                <a href="{{ route('stands.show', $stand) }}" class="btn btn-glass-auth shadow-sm fw-bold w-100 w-md-auto d-inline-block py-2">
                    <i class="bi bi-arrow-left me-2"></i>RETOUR AU STAND
                </a>
            </div>
        </div>

        <!-- Orders Table Card -->
        <div class="glass-container p-4 p-md-5 rounded-5 shadow-sm border border-white animate-in" style="animation-delay: 0.1s;">
            @if($commandes->count() > 0)
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr class="text-secondary text-uppercase small ls-1">
                                <th class="border-0 pb-4">ID</th>
                                <th class="border-0 pb-4">Client</th>
                                <th class="border-0 pb-4">Total</th>
                                <th class="border-0 pb-4">Date</th>
                                <th class="border-0 pb-4 text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commandes as $commande)
                                <tr class="border-top">
                                    <td class="py-4 fw-bold text-dark">#{{ $commande->id }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $commande->client_email ?? 'Client Anonyme' }}</div>
                                        <div class="small text-muted">ID: {{ $commande->client_id ?? 'N/A' }}</div>
                                    </td>
                                    <td class="fw-bold text-dark fs-5">{{ number_format($commande->total, 2) }} €</td>
                                    <td class="text-secondary">
                                        <div>{{ $commande->created_at->format('d M Y') }}</div>
                                        <div class="small">{{ $commande->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('commandes.show', $commande) }}" class="btn btn-premium-action px-3 py-1 rounded-pill">
                                            DÉTAILS <i class="bi bi-chevron-right ms-1"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-5 d-flex justify-content-center">
                    {{ $commandes->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-receipt-cutoff display-1 text-secondary opacity-25 mb-4"></i>
                    <h3 class="text-secondary fw-bold">Aucune commande</h3>
                    <p class="text-muted">L'historique de ce stand est encore vierge.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .ls-1 { letter-spacing: 1px; }
    .ls-2 { letter-spacing: 2px; }
    
    .glass-container {
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(30px);
        -webkit-backdrop-filter: blur(30px);
        border: 1px solid rgba(255, 255, 255, 0.6) !important;
        transition: all 0.4s ease;
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
        background: #fff; color: #000 !important;
        transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    .btn-premium-action {
        background: rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.1);
        color: #1e293b;
        font-weight: 700;
        font-size: 0.8rem;
        transition: all 0.3s ease;
    }

    .btn-premium-action:hover {
        background: #000;
        color: #fff;
    }

    .animate-in {
        animation: slideIn 1.2s cubic-bezier(0.19, 1, 0.22, 1) forwards;
        opacity: 0;
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .pagination .page-link {
        border-radius: 10px !important;
        margin: 0 4px;
        background: rgba(255,255,255,0.5);
        border: 1px solid rgba(255,255,255,0.8);
        color: #1e293b;
    }
    .pagination .page-item.active .page-link {
        background: #000;
        border-color: #000;
    }
</style>
@endsection
