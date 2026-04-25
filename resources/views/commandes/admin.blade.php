@extends('layouts.app')

@section('title', 'Administration - Toutes les commandes')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1>Administration - Toutes les commandes</h1>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-3">
                    <a href="{{ route('vitrine.index') }}" class="btn btn-secondary">Retour à la vitrine</a>
                </div>

                @if ($commandes->count() > 0)
                    <div class="card">
                        <div class="card-header">
                            <h5>Total: {{ $commandes->count() }} commande(s)</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Stand</th>
                                            <th>Entrepreneur</th>
                                            <th>Client</th>
                                            <th>Total</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($commandes as $commande)
                                            <tr>
                                                <td>#{{ $commande->id }}</td>
                                                <td>{{ $commande->stand->nom_stand }}</td>
                                                <td>{{ $commande->stand->user->name }}</td>
                                                <td>{{ $commande->client_email ?? 'N/A' }}</td>
                                                <td><strong>{{ number_format($commande->total, 2) }} FCFA</strong></td>
                                                <td>{{ $commande->date_commande->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    <a href="{{ route('commandes.show', $commande) }}"
                                                        class="btn btn-info btn-sm">Voir détails</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Statistiques -->
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Total des ventes</h5>
                                    <p class="card-text fs-4 text-primary">
                                        {{ number_format($commandes->sum('total'), 2) }} FCFA
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Nombre de commandes</h5>
                                    <p class="card-text fs-4 text-success">{{ $commandes->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Stands actifs</h5>
                                    <p class="card-text fs-4 text-info">{{ $commandes->unique('stand_id')->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        <h4>Aucune commande</h4>
                        <p>Aucune commande n'a été passée pour le moment.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
