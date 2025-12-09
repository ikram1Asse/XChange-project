<?php

namespace Database\Seeders;

use App\Models\Administrateur;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministrateursTableSeeder extends Seeder
{
    public function run(): void
    {
        Administrateur::create([
            'nom' => 'Admin',
            'prenom' => 'System',
            'email' => 'admin@xchange.com',
            'password' => Hash::make('password'),
            'adresse' => 'Adresse Admin',
            'datenaissance' => now()->subYears(25),
        ]);
    }
} 