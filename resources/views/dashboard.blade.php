@extends('layouts.app')

@section('title', 'Tableau de bord - Entrepreneur')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="mb-4 text-center">
                    <h1 class="fw-bold">Bienvenue, {{ Auth::user()->name }} !</h1>
                    <p class="lead">Voici votre espace personnel pour gérer vos produits.</p>
                </div>
                <div class="mb-4 text-end">
                    <a href="{{ route('produits.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Ajouter un produit
                    </a>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="mb-4">Mes produits</h3>
                        @if ($products->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nom</th>
                                            <th>Description</th>
                                            <th>Prix (FCFA)</th>
                                            <th>Stand</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $produit)
                                            <tr>
                                                <td>{{ $produit->nom }}</td>
                                                <td>{{ $produit->description }}</td>
                                                <td>{{ number_format($produit->prix, 2) }}</td>
                                                <td>{{ $produit->stand->nom_stand ?? '-' }}</td>
                                                <td>
                                                    <a href="{{ route('produits.edit', $produit) }}"
                                                        class="btn btn-sm btn-primary">Modifier</a>
                                                    <form action="{{ route('produits.destroy', $produit) }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Supprimer ce produit ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info text-center mb-0">
                                Vous n'avez pas encore ajouté de produit.<br>
                                Cliquez sur "Ajouter un produit" pour commencer !
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
