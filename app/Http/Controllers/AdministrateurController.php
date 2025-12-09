<?php

namespace App\Http\Controllers;
use App\Models\Administrateur;
use Illuminate\Http\Request;

class AdministrateurController extends Controller
{
    public function index()
    {
        $utilisateurs = Administrateur::all();
        return view('administrateurs.index', compact('administrateurs'));
    }

    public function create()
    {
        return view('administrateurs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email',
            'password' => 'required|string|min:8',
        ]);

        Administrateur::create($validated);

        return redirect()->route('administrateurs.index')
            ->with('success', 'administrateur créé avec succès.');
    }

    public function show(Administrateur $administrateur)
    {
        return view('administrateurs.show', compact('administrateur'));
    }

    public function edit(Administrateur $administrateur)
    {
        return view('administrateurs.edit', compact('administrateur'));
    }

    public function update(Request $request, Administrateur $administrateur)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:administrateurs,email,'. $administrateur->id . ',id',
            'password' => 'required|string|min:8',
        ]);

        $administrateur->update($validated);

        return redirect()->route('administrateurs.index')
            ->with('success', 'administrateur mis à jour avec succès.');
    }

    public function destroy(Administrateur $administrateur)
    {
        $administrateur->delete();
        return redirect()->route('administrateur.index')
            ->with('success', 'administrateur supprimé avec succès.');
    }
}
