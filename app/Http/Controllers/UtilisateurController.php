<?php

namespace App\Http\Controllers;
use App\Models\Utilisateur;

use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
     public function index()
    {
        $utilisateurs = Utilisateur::all();
        return view('utilisateurs.index', compact('utilisateurs'));
    }

    public function create()
    {
        return view('utilisateurs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email',
            'password' => 'required|string|min:8',
            'adresse' => 'required|string|max:255',
            'datenaissance' => 'required|date',
        ]);

        Utilisateur::create($validated);

        return redirect()->route('utilisateurs.index')
            ->with('success', 'utilisateur créé avec succès.');
    }

    public function show(Utilisateur $utilisateur)
    {
        return view('utilisateurs.show', compact('utilisateur'));
    }

    public function edit(Utilisateur $utilisateur)
    {
        return view('utilisateurs.edit', compact('utilisateur'));
    }

    public function update(Request $request, Utilisateur $utilisateur)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email,'. $utilisateur->id . ',id',
            'password' => 'required|string|min:8',
            'adresse' => 'required|string|max:255',
            'datenaissance' => 'required|date',
        ]);

        $utilisateur->update($validated);

        return redirect()->route('utilisateurs.index')
            ->with('success', 'utilisateur mis à jour avec succès.');
    }

    public function destroy(Utilisateur $utilisateur)
    {
        $utilisateur->delete();
        return redirect()->route('utilisateur.index')
            ->with('success', 'utilisateur supprimé avec succès.');
    }
}
