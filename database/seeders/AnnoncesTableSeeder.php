<?php

namespace Database\Seeders;

use App\Models\Annonce;
use App\Models\Utilisateur;
use App\Models\Categorie;
use Illuminate\Database\Seeder;

class AnnoncesTableSeeder extends Seeder
{
    public function run(): void
    {
        $annonces = [
            [
                'titre' => 'iPhone 12 Pro à vendre',
                'prix' => 699.99,
                'photo' => 'iphone12pro.jpeg',
                'description' => 'iPhone 12 Pro en excellent état',
                'categorie_id' => 3, // Électronique
                'datepublication' => now(),
                'expediteur' => 1, // User ID
            ],
            [
                'titre' => 'Appartement à louer',
                'prix' => 1200.00,
                'photo' => 'appartement.jpeg',
                'description' => 'Bel appartement 2 pièces',
                'categorie_id' => 1, // Immobilier
                'datepublication' => now(),
                'expediteur' => 2, // User ID
            ],
        ];

        foreach ($annonces as $annonce) {
            try {
                if (Utilisateur::find($annonce['expediteur']) && Categorie::find($annonce['categorie_id'])) {
                    Annonce::create($annonce);
                }
            } catch (\Exception $e) {
                logger()->error("Failed to create annonce: " . $e->getMessage());
            }
        }
    }
} 