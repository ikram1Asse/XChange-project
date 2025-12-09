<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Message;
use App\Models\Categorie;
use App\Models\Utilisateur;
use App\Models\Administrateur;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Regular user dashboard
        $stats = [
            'annonces_count' => Annonce::where('expediteur', auth()->id())->count(),
            'messages_count' => Message::where('expediteur', auth()->id())
                ->orWhere('destinataire', auth()->id())
                ->count(),
            'categories_count' => Categorie::count(),
            'utilisateurs_count' => Utilisateur::count(),
        ];

        $latest_annonces = Annonce::with(['categorie', 'utilisateur'])
            ->where('expediteur', auth()->id())
            ->latest()
            ->take(5)
            ->get();

        $latest_messages = Message::with(['sender', 'receiver'])
            ->where('expediteur', auth()->id())
            ->orWhere('destinataire', auth()->id())
            ->latest()
            ->take(5)
            ->get();

        $categories = Categorie::withCount(['annonces' => function($query) {
            $query->where('expediteur', auth()->id());
        }])
        ->orderByDesc('annonces_count')
        ->take(6)
        ->get();

        return view('dashboard', compact('stats', 'latest_annonces', 'latest_messages', 'categories'));
    }

    public function adminDashboard()
    {
        // Admin dashboard
        $stats = [
            'annonces_count' => Annonce::count(),
            'categories_count' => Categorie::count(),
            'utilisateurs_count' => Utilisateur::count(),
            'messages_count' => Message::count(),
        ];

        $latest_annonces = Annonce::with(['categorie', 'utilisateur'])
            ->latest()
            ->take(5)
            ->get();

        $latest_messages = Message::with(['sender', 'receiver'])
            ->latest()
            ->take(5)
            ->get();

        $categories = Categorie::withCount('annonces')
            ->orderByDesc('annonces_count')
            ->take(6)
            ->get();

        return view('admin.dashboard', compact('stats', 'latest_annonces', 'latest_messages', 'categories'));
    }
} 