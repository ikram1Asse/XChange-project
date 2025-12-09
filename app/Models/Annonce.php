<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $fillable = [
        'titre',
        'photo', 
        'prix', 
        'description', 
        'categorie_id', 
        'datepublication',
        'expediteur'
    ];

    // Get the category of this announcement
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    // Get the user who posted this announcement
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'expediteur');
    }

    // Get messages for this announcement
    public function messages()
    {
        return $this->hasMany(Message::class, 'annonce_id');
    }
}
