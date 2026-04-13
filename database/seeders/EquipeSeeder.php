<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipe;

class EquipeSeeder extends Seeder
{
    public function run(): void
    {
        $equipes = [
            ['nom' => 'Wydad Athletic Club',         'ville' => 'Casablanca'],
            ['nom' => 'Raja Club Athletic',           'ville' => 'Casablanca'],
            ['nom' => 'FUS Rabat',                    'ville' => 'Rabat'],
            ['nom' => 'FAR Rabat',                    'ville' => 'Rabat'],
            ['nom' => 'Hassania Agadir',              'ville' => 'Agadir'],
            ['nom' => 'Ittihad Tanger',               'ville' => 'Tanger'],
            ['nom' => 'Moghreb Tétouan',              'ville' => 'Tétouan'],
            ['nom' => 'Renaissance Berkane',          'ville' => 'Berkane'],
            ['nom' => 'Difaa El Jadida',              'ville' => 'El Jadida'],
            ['nom' => 'Olympique Khouribga',          'ville' => 'Khouribga'],
        ];

        foreach ($equipes as $equipe) {
            Equipe::create($equipe);
        }
    }
}