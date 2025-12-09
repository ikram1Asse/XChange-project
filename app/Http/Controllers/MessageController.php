<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class MessageController extends Controller
{
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
        $message->load(['sender', 'receiver']);
        return view('messages.show', compact('message'));
    }

    public function edit(Message $message)
    {
        $message->load(['sender', 'receiver']);
        $utilisateurs = Utilisateur::all();
        return view('messages.edit', compact('message', 'utilisateurs'));
    }

    public function update(Request $request, Message $message)
    {
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
        $message->delete();
        return redirect()->route('messages.index')
            ->with('success', 'Message supprimé avec succès.');
    }
}
