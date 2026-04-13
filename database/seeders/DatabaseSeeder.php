<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ArbitreSeeder::class,
            CategorieSeeder::class,
            EquipeSeeder::class,
            MatchSeeder::class,
            PaiementSeeder::class,
        ]);
    }
}