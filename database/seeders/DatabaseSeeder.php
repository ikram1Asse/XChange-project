<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate all tables
        DB::table('messages')->truncate();
        DB::table('annonces')->truncate();
        DB::table('categories')->truncate();
        DB::table('utilisateurs')->truncate();
        DB::table('administrateurs')->truncate();

        $this->call([
            AdministrateursTableSeeder::class,
            UtilisateursTableSeeder::class,
            CategoriesTableSeeder::class,
            AnnoncesTableSeeder::class,
            MessagesTableSeeder::class,
        ]);

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
} 