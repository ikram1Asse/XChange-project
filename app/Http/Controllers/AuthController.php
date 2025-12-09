<?php
namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')
                ->with('success', 'Connexion réussie.');
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification sont incorrectes.',
        ])->onlyInput('email');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email',
            'password' => 'required|string|min:8|confirmed',
            'adresse' => 'required|string',
            'datenaissance' => 'required|date'
        ]);

        $validated['password'] = Hash::make($validated['password']);
        
        $user = Utilisateur::create($validated);
        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'Inscription réussie.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')
            ->with('success', 'Déconnexion réussie.');
    }
}