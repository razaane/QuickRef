<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;

class MatchSeeder extends Seeder
{
    public function run(): void
    {
        $matchs = [
            [
                'equipe_domicile_id'  => 1, // WAC
                'equipe_visiteur_id'  => 2, // Raja
                'categorie_id'        => 1, // Botola Pro D1
                'arbitre_central_id'  => 1,
                'arbitre_assistant1_id' => 2,
                'arbitre_assistant2_id' => 3,
                'quatrieme_arbitre_id'  => 4,
                'date_heure'          => '2026-04-26 16:00:00', // Aujourd'hui
                'terrain'             => 'Stade Mohammed V',
                'ville'               => 'Casablanca',
                'statut'              => 'jouer',
            ],
            [
                'equipe_domicile_id'  => 3, // FUS
                'equipe_visiteur_id'  => 4, // FAR
                'categorie_id'        => 1,
                'arbitre_central_id'  => 5,
                'arbitre_assistant1_id' => 6,
                'arbitre_assistant2_id' => 7,
                'quatrieme_arbitre_id'  => 8,
                'date_heure'          => '2026-04-27 15:00:00', // Demain
                'terrain'             => 'Stade Moulay Abdellah',
                'ville'               => 'Rabat',
                'statut'              => 'jouer',
            ],
            [
                'equipe_domicile_id'  => 5, // Hassania
                'equipe_visiteur_id'  => 6, // Ittihad Tanger
                'categorie_id'        => 1,
                'arbitre_central_id'  => 2,
                'arbitre_assistant1_id' => 3,
                'arbitre_assistant2_id' => 4,
                'quatrieme_arbitre_id'  => null,
                'date_heure'          => '2026-04-28 17:00:00', // Après-demain
                'terrain'             => 'Stade Al Inbiaâth',
                'ville'               => 'Agadir',
                'statut'              => 'confirmer',
            ],
            [
                'equipe_domicile_id'  => 7, // Moghreb
                'equipe_visiteur_id'  => 8, // Renaissance
                'categorie_id'        => 2, // D2
                'arbitre_central_id'  => 9,
                'arbitre_assistant1_id' => 10,
                'arbitre_assistant2_id' => 1,
                'quatrieme_arbitre_id'  => null,
                'date_heure'          => '2026-04-29 15:00:00', // 3 jours
                'terrain'             => 'Stade Saniat Rmel',
                'ville'               => 'Tétouan',
                'statut'              => 'en_attente',
            ],
            [
                'equipe_domicile_id'  => 1, // WAC
                'equipe_visiteur_id'  => 5, // Hassania
                'categorie_id'        => 3, // Coupe du Trône
                'arbitre_central_id'  => 6,
                'arbitre_assistant1_id' => 7,
                'arbitre_assistant2_id' => 8,
                'quatrieme_arbitre_id'  => 9,
                'date_heure'          => '2026-05-02 18:00:00', // 6 jours
                'terrain'             => 'Stade Mohammed V',
                'ville'               => 'Casablanca',
                'statut'              => 'en_attente',
            ],
            [
                'equipe_domicile_id'  => 9, // Difaa
                'equipe_visiteur_id'  => 10, // Olympique
                'categorie_id'        => 2,
                'arbitre_central_id'  => 3,
                'arbitre_assistant1_id' => 4,
                'arbitre_assistant2_id' => 5,
                'quatrieme_arbitre_id'  => null,
                'date_heure'          => '2026-05-03 14:00:00', // 7 jours
                'terrain'             => 'Stade El Abdi',
                'ville'               => 'El Jadida',
                'statut'              => 'annuler',
            ],
            [
                'equipe_domicile_id'  => 2, // Raja
                'equipe_visiteur_id'  => 3, // FUS
                'categorie_id'        => 1,
                'arbitre_central_id'  => 1,
                'arbitre_assistant1_id' => 2,
                'arbitre_assistant2_id' => 3,
                'quatrieme_arbitre_id'  => 4,
                'date_heure'          => '2026-05-10 16:00:00', // 14 jours
                'terrain'             => 'Stade Mohammed V',
                'ville'               => 'Casablanca',
                'statut'              => 'reporter',
            ],
        ];

        foreach ($matchs as $match) {
            Game::create($match);
        }
    }
}