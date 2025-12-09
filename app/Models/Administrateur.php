<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrateur extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    
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

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
