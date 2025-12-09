<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\Categorie;

class HomeController extends Controller
{
    public function index()
    {
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