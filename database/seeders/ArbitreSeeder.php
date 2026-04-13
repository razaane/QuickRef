<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Arbitre;

class ArbitreSeeder extends Seeder
{
    public function run(): void
    {
        // user_id 2 à 11 (les arbitres créés dans UserSeeder)
        $arbitres = [
            [
                'user_id'   => 2,
                'telephone' => '0661234501',
                'grade'     => 'international',
                'adresse'   => 'Casablanca, Maarif',
            ],
            [
                'user_id'   => 3,
                'telephone' => '0661234502',
                'grade'     => 'national',
                'adresse'   => 'Rabat, Agdal',
            ],
            [
                'user_id'   => 4,
                'telephone' => '0661234503',
                'grade'     => 'national',
                'adresse'   => 'Fès, Ville Nouvelle',
            ],
            [
                'user_id'   => 5,
                'telephone' => '0661234504',
                'grade'     => 'regional',
                'adresse'   => 'Marrakech, Guéliz',
            ],
            [
                'user_id'   => 6,
                'telephone' => '0661234505',
                'grade'     => 'regional',
                'adresse'   => 'Tanger, Centre',
            ],
            [
                'user_id'   => 7,
                'telephone' => '0661234506',
                'grade'     => 'international',
                'adresse'   => 'Casablanca, Ain Diab',
            ],
            [
                'user_id'   => 8,
                'telephone' => '0661234507',
                'grade'     => 'national',
                'adresse'   => 'Oujda, Centre',
            ],
            [
                'user_id'   => 9,
                'telephone' => '0661234508',
                'grade'     => 'regional',
                'adresse'   => 'Agadir, Talborjt',
            ],
            [
                'user_id'   => 10,
                'telephone' => '0661234509',
                'grade'     => 'national',
                'adresse'   => 'Meknès, Hamriya',
            ],
            [
                'user_id'   => 11,
                'telephone' => '0661234510',
                'grade'     => 'regional',
                'adresse'   => 'Kenitra, Centre',
            ],
        ];

        foreach ($arbitres as $arbitre) {
            Arbitre::create($arbitre);
        }
    }
}