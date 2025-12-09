<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['libelle' => 'Immobilier'],
            ['libelle' => 'Véhicules'],
            ['libelle' => 'Électronique'],
            ['libelle' => 'Meubles'],
            ['libelle' => 'Mode'],
        ];

        foreach ($categories as $category) {
            try {
                Categorie::create($category);
            } catch (\Exception $e) {
                logger()->error("Failed to create category: " . $e->getMessage());
            }
        }
    }
} 