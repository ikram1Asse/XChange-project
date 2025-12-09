<?php

namespace App\Http\Controllers;
use App\Models\Annonce;
use App\Models\Categorie;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AnnonceController extends Controller
{
    public function index(Request $request)
    {
        $query = Annonce::with(['utilisateur', 'categorie']);
        
        // Filter by category if category_id is provided
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('categorie_id', $request->category_id);
        }

        $annonces = $query->latest()->get();
        $categories = Categorie::withCount('annonces')->get();
        
        return view('annonces.index', compact('annonces', 'categories'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('annonces.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'prix' => 'required|numeric|min:0',
            'description' => 'required|string',
            'categorie_id' => 'required|exists:categories,id',
            'datepublication' => 'required|date',
        ]);

        $data = $request->except('photo');
        
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('public','annonces' );
        }

        $data['expediteur'] = Auth::id();
        
        $annonce = Annonce::create($data);

        return redirect()->route('annonces.index')
            ->with('success', 'Annonce créée avec succès.');
    }

    public function show(Annonce $annonce)
    {
        $annonce->load(['utilisateur', 'categorie']);
        return view('annonces.show', compact('annonce'));
    }

    public function edit(Annonce $annonce)
    {
        $annonce->load(['utilisateur', 'categorie']);
        $categories = Categorie::all();
        return view('annonces.edit', compact('annonce', 'categories'));
    }

    public function update(Request $request, Annonce $annonce)
    {
        $validated = $request->validate([
            'titre' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'prix' => 'required|numeric|min:0',
            'description' => 'required|string',
            'categorie_id' => 'required|exists:categories,id',
            'datepublication' => 'required|date',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            // Delete old image if it exists
            if ($annonce->photo && Storage::disk('public')->exists($annonce->photo)) {
                Storage::disk('public')->delete($annonce->photo);
            }
            // Store new image
            $data['photo'] = $request->file('photo')->store('annonces', 'public');
        }

        // Only allow updating expediteur if user is admin
        if (Auth::user() instanceof \App\Models\Administrateur) {
            $data['expediteur'] = $request->expediteur;
        }

        $annonce->update($data);

        return redirect()->route('annonces.index')
            ->with('success', 'Annonce mise à jour avec succès.');
    }

    public function destroy(Annonce $annonce)
    {
        // Check if user is admin or the owner of the announcement
        if (Auth::user() instanceof \App\Models\Administrateur || Auth::id() == $annonce->expediteur) {
            if ($annonce->photo) {
                Storage::disk('public')->delete($annonce->photo);
            }
            $annonce->delete();
            return redirect()->route('annonces.index')
                ->with('success', 'Annonce supprimée avec succès.');
        }

        return redirect()->route('annonces.index')
            ->with('error', 'Vous n\'avez pas la permission de supprimer cette annonce.');
    }
}
