<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nom' => 'Botola Pro D1',    'montant' => 1500.00],
            ['nom' => 'Botola Pro D2',    'montant' => 900.00],
            ['nom' => 'Coupe du Trône',   'montant' => 1200.00],
            ['nom' => 'Championnat U21',  'montant' => 600.00],
            ['nom' => 'Championnat U18',  'montant' => 400.00],
        ];

        foreach ($categories as $categorie) {
            Categorie::create($categorie);
        }
    }
}