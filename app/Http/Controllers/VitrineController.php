<?php

namespace App\Http\Controllers;

use App\Models\Stand;
use App\Models\Produit;
use Illuminate\Http\Request;

class VitrineController extends Controller
{
    /**
     * Afficher la vitrine publique avec tous les stands approuvés
     */
    public function index()
    {
        $stands = Stand::whereHas('user', function($query) {
            $query->where('role', 'entrepreneur_approuve');
        })->with(['produits', 'user'])->get();

        return view('index', compact('stands'));
    }

    /**
     * Afficher les détails d'un stand avec ses produits
     */
    public function showStand(Stand $stand)
    {
        // Vérifier que le stand appartient à un entrepreneur approuvé
        if ($stand->user->role !== 'entrepreneur_approuve') {
            abort(404);
        }

        $stand->load(['produits', 'user']);

        return view('vitrine.stand', compact('stand'));
    }

    /**
     * Rechercher des stands ou produits
     */
    public function rechercher(Request $request)
    {
        $query = $request->get('q', '');

        $standsQuery = Stand::whereHas('user', function($q) {
            $q->where('role', 'entrepreneur_approuve');
        });

        if (!empty($query)) {
            $standsQuery->where(function($q) use ($query) {
                $q->where('nom_stand', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhereHas('produits', function($pq) use ($query) {
                      $pq->where('nom', 'like', "%{$query}%")
                         ->orWhere('description', 'like', "%{$query}%");
                  });
            });
        }

        $stands = $standsQuery->with(['produits', 'user'])->get();

        return view('vitrine.recherche', compact('stands', 'query'));
    }
}
