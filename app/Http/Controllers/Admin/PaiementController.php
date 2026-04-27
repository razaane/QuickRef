<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaiementController extends Controller
{
    public function index()
    {
        // Uniquement les matchs joués
        $matchs = Game::with([
                'arbitreCentral.user',
                'assistant1.user',
                'assistant2.user',
                'quatrieme.user',
                'categorie'
            ])
            ->where('statut', 'jouer')
            ->orderBy('date_heure', 'desc')
            ->get();

        
        $totalAttente = 0;
        foreach ($matchs as $match) {
            $montant = $match->categorie->montant ?? 0;
            $arbitresMatch = array_filter([
                $match->arbitreCentral,
                $match->assistant1,
                $match->assistant2,
                $match->quatrieme,
            ]);
            foreach ($arbitresMatch as $arbitre) {
                $dejaPaye = DB::table('paiements')
                    ->where('arbitre_id', $arbitre->id)
                    ->where('mois', $match->id)
                    ->where('statut', 'paye')
                    ->exists();
                if (!$dejaPaye) {
                    $totalAttente += $montant;
                }
            }
        }

        return view('admin.paiements.index', compact('matchs', 'totalAttente'));
    }

    
    public function payerArbitre(Request $request)
{
    $request->validate([
        'arbitre_id' => 'required|exists:arbitres,id',
        'match_id'   => 'required|exists:matchs,id',
        'statut'     => 'required|in:paye,non_paye',  
    ]);

    $match = Game::with('categorie')->findOrFail($request->match_id);
    $montant = $match->categorie->montant ?? 0;

    DB::table('paiements')->updateOrInsert(
        [
            'arbitre_id' => $request->arbitre_id,
            'mois'       => $request->match_id,
        ],
        [
            'montant'       => $montant,
            'statut'        => $request->statut,  
            'date_paiement' => $request->statut === 'paye' ? now()->toDateString() : null,
            'updated_at'    => now(),
            'created_at'    => now(),
        ]
    );

    return redirect()->back()->with('success', 'Statut mis à jour !');
}
}