<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    private function canManageMessage(Message $message): bool
    {
        return Auth::user() instanceof \App\Models\Administrateur
            || Auth::id() == ($message->expediteur_id ?? $message->expediteur);
    }

    public function index()
    {
        $messages = Message::with(['sender', 'receiver'])->latest()->get();
        return view('messages.index', compact('messages'));
    }

    public function create()
    {
        $utilisateurs = Utilisateur::all();
        return view('messages.create', compact('utilisateurs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'expediteur' => 'required|exists:utilisateurs,id',
            'destinataire' => 'required|exists:utilisateurs,id',
            'contenu' => 'required|string|max:255',
        ]);

        Message::create($validated);

        return redirect()->route('messages.index')
            ->with('success', 'Message créé avec succès.');
    }

    public function show(Message $message)
    {
        if (!$this->canManageMessage($message)) {
            return redirect()->route('messages.index')
                ->with('error', 'Vous n\'avez pas la permission de voir ce message.');
        }

        $message->load(['sender', 'receiver']);
        return view('messages.show', compact('message'));
    }

    public function edit(Message $message)
    {
        if (!$this->canManageMessage($message)) {
            return redirect()->route('messages.index')
                ->with('error', 'Vous n\'avez pas la permission de modifier ce message.');
        }

        $message->load(['sender', 'receiver']);
        $utilisateurs = Utilisateur::all();
        return view('messages.edit', compact('message', 'utilisateurs'));
    }

    public function update(Request $request, Message $message)
    {
        if (!$this->canManageMessage($message)) {
            return redirect()->route('messages.index')
                ->with('error', 'Vous n\'avez pas la permission de modifier ce message.');
        }

        $validated = $request->validate([
            'expediteur' => 'required|exists:utilisateurs,id',
            'destinataire' => 'required|exists:utilisateurs,id',
            'contenu' => 'required|string|max:255',
        ]);

        $message->update($validated);

        return redirect()->route('messages.index')
            ->with('success', 'Message mis à jour avec succès.');
    }

    public function destroy(Message $message)
    {
        if (!$this->canManageMessage($message)) {
            return redirect()->route('messages.index')
                ->with('error', 'Vous n\'avez pas la permission de supprimer ce message.');
        }

        $message->delete();
        return redirect()->route('messages.index')
            ->with('success', 'Message supprimé avec succès.');
    }
}
