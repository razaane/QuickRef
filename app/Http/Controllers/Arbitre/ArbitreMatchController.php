<?php

namespace App\Http\Controllers\Arbitre;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Game;

class ArbitreMatchController extends Controller
{
    public function dashboard()
    {
        $arbitre   = auth()->user()->arbitre;
        $arbitreId = $arbitre->id;

        // Prochains matchs (futurs)
        $upcomingMatches = Game::with(['equipeDomicile', 'equipeVisiteur', 'categorie'])
            ->where(function($q) use ($arbitreId) {
                $q->where('arbitre_central_id', $arbitreId)
                  ->orWhere('arbitre_assistant1_id', $arbitreId)
                  ->orWhere('arbitre_assistant2_id', $arbitreId)
                  ->orWhere('quatrieme_arbitre_id', $arbitreId);
            })
            ->where('date_heure', '>=', now())
            ->whereIn('statut', ['en_attente', 'confirmer'])
            ->orderBy('date_heure', 'asc')
            ->take(5)
            ->get();

        // Matchs déjà joués
        $playedMatches = Game::with(['equipeDomicile', 'equipeVisiteur', 'categorie'])
            ->where(function($q) use ($arbitreId) {
                $q->where('arbitre_central_id', $arbitreId)
                  ->orWhere('arbitre_assistant1_id', $arbitreId)
                  ->orWhere('arbitre_assistant2_id', $arbitreId)
                  ->orWhere('quatrieme_arbitre_id', $arbitreId);
            })
            ->where('statut', 'jouer')
            ->orderBy('date_heure', 'desc')
            ->get();

        // Total indemnités (tous les paiements de cet arbitre)
        $totalIndemnites = DB::table('paiements')
            ->where('arbitre_id', $arbitreId)
            ->sum('montant');

        // Total payé
        $totalPaye = DB::table('paiements')
            ->where('arbitre_id', $arbitreId)
            ->where('statut', 'paye')
            ->sum('montant');

        // Total en attente
        $totalAttente = DB::table('paiements')
            ->where('arbitre_id', $arbitreId)
            ->where('statut', 'en_attente')
            ->sum('montant');

        return view('arbitre.dashboard', compact(
            'upcomingMatches',
            'playedMatches',
            'arbitre',
            'totalIndemnites',
            'totalPaye',
            'totalAttente'
        ));
    }

    public function index()
    {
        $arbitreId = auth()->user()->arbitre->id;

        $matchs = Game::with(['equipeDomicile', 'equipeVisiteur', 'categorie'])
            ->where(function($q) use ($arbitreId) {
                $q->where('arbitre_central_id', $arbitreId)
                  ->orWhere('arbitre_assistant1_id', $arbitreId)
                  ->orWhere('arbitre_assistant2_id', $arbitreId)
                  ->orWhere('quatrieme_arbitre_id', $arbitreId);
            })
            ->orderBy('date_heure', 'desc')
            ->paginate(10);

        return view('arbitre.matchs.index', compact('matchs'));
    }

    public function show($id)
    {
        $arbitreId = auth()->user()->arbitre->id;

        $match = Game::with([
            'equipeDomicile', 'equipeVisiteur', 'categorie',
            'arbitreCentral.user', 'assistant1.user', 'assistant2.user', 'quatrieme.user'
        ])->findOrFail($id);

        return view('arbitre.matchs.show', compact('match', 'arbitreId'));
    }
}