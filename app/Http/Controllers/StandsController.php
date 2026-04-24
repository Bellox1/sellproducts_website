<?php

namespace App\Http\Controllers;

use App\Models\Stand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StandsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Stand::class);
        $stands = Stand::where('user_id', auth()->id())->get();
        return view('stands.index', compact('stands'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Stand $stand)
    {
        $this->authorize('view', $stand);
        $commandes = $stand->commandes()->latest()->take(10)->get();
        return view('stands.show', compact('stand', 'commandes'));
    }

    public function commandes(Stand $stand)
    {
        $this->authorize('view', $stand);
        $commandes = $stand->commandes()->latest()->paginate(15);
        return view('stands.commandes', compact('stand', 'commandes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stand $stand)
    {
        $this->authorize('update', $stand);
        return view('stands.edit', compact('stand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stand $stand)
    {
        $this->authorize('update', $stand);
        $data = $request->validate([
            'nom_stand' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $stand->update($data);
        return redirect()->route('stands.index')->with('success', 'Stand mis à jour avec succès.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Stand::class);
        return view('stands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Stand::class);
        $data = $request->validate([
            'nom_stand' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $data['user_id'] = auth()->id();
        Stand::create($data);
        return redirect()->route('stands.index')->with('success', 'Stand créé avec succès.');
    }
}
