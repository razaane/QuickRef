<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Arbitre;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total matchs joués
        $totalMatchsJoues = Game::where('statut', 'jouer')->count();

        // Total matchs en attente
        $totalMatchsAttente = Game::where('statut', 'en_attente')->count();

        // Total arbitres
        $totalArbitres = Arbitre::count();

        // Total paiements en attente (montant)
        $totalPaiementsAttente = DB::table('paiements')
            ->where('statut', 'en_attente')
            ->sum('montant');

        // Total paiements payés (montant)
        $totalPaiementsPaye = DB::table('paiements')
            ->where('statut', 'paye')
            ->sum('montant');

        // Derniers matchs
        $derniersMatchs = Game::with(['equipeDomicile', 'equipeVisiteur', 'categorie', 'arbitreCentral.user'])
            ->orderBy('date_heure', 'desc')
            ->take(6)
            ->get();

        return view('admin.dashboard', compact(
            'totalMatchsJoues',
            'totalMatchsAttente',
            'totalArbitres',
            'totalPaiementsAttente',
            'totalPaiementsPaye',
            'derniersMatchs'
        ));
    }
}