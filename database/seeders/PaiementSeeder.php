<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ← utilise DB directement

class PaiementSeeder extends Seeder
{
    public function run(): void
    {
        $paiements = [
            ['arbitre_id' => 1, 'montant' => 4500.00, 'mois' => 'Janvier 2025', 'statut' => 'paye',       'date_paiement' => '2025-02-05'],
            ['arbitre_id' => 1, 'montant' => 3000.00, 'mois' => 'Février 2025', 'statut' => 'paye',       'date_paiement' => '2025-03-05'],
            ['arbitre_id' => 1, 'montant' => 1500.00, 'mois' => 'Mars 2025',    'statut' => 'en_attente', 'date_paiement' => null],

            ['arbitre_id' => 2, 'montant' => 1800.00, 'mois' => 'Janvier 2025', 'statut' => 'paye',       'date_paiement' => '2025-02-06'],
            ['arbitre_id' => 2, 'montant' => 900.00,  'mois' => 'Février 2025', 'statut' => 'paye',       'date_paiement' => '2025-03-06'],
            ['arbitre_id' => 2, 'montant' => 900.00,  'mois' => 'Mars 2025',    'statut' => 'en_attente', 'date_paiement' => null],

            ['arbitre_id' => 3, 'montant' => 1800.00, 'mois' => 'Janvier 2025', 'statut' => 'paye',       'date_paiement' => '2025-02-07'],
            ['arbitre_id' => 3, 'montant' => 900.00,  'mois' => 'Mars 2025',    'statut' => 'en_attente', 'date_paiement' => null],

            ['arbitre_id' => 4, 'montant' => 600.00,  'mois' => 'Janvier 2025', 'statut' => 'paye',       'date_paiement' => '2025-02-08'],
            ['arbitre_id' => 4, 'montant' => 600.00,  'mois' => 'Mars 2025',    'statut' => 'en_attente', 'date_paiement' => null],

            ['arbitre_id' => 5, 'montant' => 1200.00, 'mois' => 'Janvier 2025', 'statut' => 'paye',       'date_paiement' => '2025-02-09'],
            ['arbitre_id' => 5, 'montant' => 600.00,  'mois' => 'Mars 2025',    'statut' => 'en_attente', 'date_paiement' => null],

            ['arbitre_id' => 6, 'montant' => 3000.00, 'mois' => 'Février 2025', 'statut' => 'paye',       'date_paiement' => '2025-03-10'],
            ['arbitre_id' => 6, 'montant' => 1500.00, 'mois' => 'Mars 2025',    'statut' => 'en_attente', 'date_paiement' => null],

            ['arbitre_id' => 7, 'montant' => 900.00,  'mois' => 'Février 2025', 'statut' => 'paye',       'date_paiement' => '2025-03-11'],
            ['arbitre_id' => 7, 'montant' => 900.00,  'mois' => 'Mars 2025',    'statut' => 'en_attente', 'date_paiement' => null],

            ['arbitre_id' => 8, 'montant' => 600.00,  'mois' => 'Février 2025', 'statut' => 'paye',       'date_paiement' => '2025-03-12'],

            ['arbitre_id' => 9, 'montant' => 1800.00, 'mois' => 'Janvier 2025', 'statut' => 'paye',       'date_paiement' => '2025-02-13'],

            ['arbitre_id' => 10, 'montant' => 600.00, 'mois' => 'Janvier 2025', 'statut' => 'paye',       'date_paiement' => '2025-02-14'],
        ];

        foreach ($paiements as $paiement) {
            DB::table('paiements')->insert(array_merge($paiement, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}