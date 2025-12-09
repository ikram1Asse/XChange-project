<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'expediteur',
        'destinataire',
        'contenu'
    ];

    // Get the sender
    public function sender()
    {
        return $this->belongsTo(Utilisateur::class, 'expediteur');
    }

    // Get the receiver
    public function receiver()
    {
        return $this->belongsTo(Utilisateur::class, 'destinataire');
    }

    // Get the announcement
    public function annonce()
    {
        return $this->belongsTo(Annonce::class, 'annonce_id');
    }
}
