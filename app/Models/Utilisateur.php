<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Utilisateur extends Authenticatable
{
    protected $table = 'utilisateurs';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'adresse',
        'datenaissance'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Get user's announcements
    public function annonces()
    {
        return $this->hasMany(Annonce::class, 'expediteur');
    }

    // Get sent messages
    public function messagesSent()
    {
        return $this->hasMany(Message::class, 'expediteur');
    }

    // Get received messages
    public function messagesReceived()
    {
        return $this->hasMany(Message::class, 'destinataire');
    }
}
