<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = ['libelle'];

    // Get announcements in this category
    public function annonces()
    {
        return $this->hasMany(Annonce::class, 'categorie_id');
    }
}