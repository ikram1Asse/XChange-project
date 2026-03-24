<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        $featured_annonces = Annonce::with(['categorie', 'utilisateur'])
            ->latest()
            ->take(6)
            ->get();

        $categories = Categorie::withCount('annonces')
            ->orderByDesc('annonces_count')
            ->take(6)
            ->get();

        return view('welcome', compact('featured_annonces', 'categories'));
    }
} 