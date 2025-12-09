<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UtilisateursTableSeeder::class,    // First, create users
            CategoriesTableSeeder::class,      // Then categories
            AnnoncesTableSeeder::class,        // Then announcements
            MessagesTableSeeder::class,        // Finally, messages
        ]);
    }
}
