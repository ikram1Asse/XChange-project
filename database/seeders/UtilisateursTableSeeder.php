<?php

namespace Database\Seeders;

use App\Models\Utilisateur;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UtilisateursTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'nom' => 'John',
                'prenom' => 'Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'adresse' => '123 Main St',
                'datenaissance' => '1990-01-01'
            ],
            [
                'nom' => 'Jane',
                'prenom' => 'Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
                'adresse' => '456 Oak Ave',
                'datenaissance' => '1992-05-15'
            ],
        ];

        foreach ($users as $user) {
            try {
                Utilisateur::create($user);
            } catch (\Exception $e) {
                logger()->error("Failed to create user: " . $e->getMessage());
            }
        }
    }
} 