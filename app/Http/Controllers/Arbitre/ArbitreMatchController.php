<?php

namespace App\Http\Controllers\Arbitre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArbitreMatchController extends Controller
{
    public function dashboard()
{
    $user = auth()->user();
    $arbitreId = $user->arbitre->id;

    // Jib l-matchs li jayin (Upcoming)
    $upcomingMatches = \App\Models\Game::where(function($q) use ($arbitreId) {
            $q->where('arbitre_central_id', $arbitreId)
              ->orWhere('arbitre_assistant1_id', $arbitreId)
              ->orWhere('arbitre_assistant2_id', $arbitreId)
              ->orWhere('quatrieme_arbitre_id', $arbitreId);
        })
        ->where('date_heure', '>', now())
        ->orderBy('date_heure', 'asc')
        ->take(3)
        ->get();

    // 7issab l-flouss dyal l-ch-her (Indemnités)
    $monthlyPayment = \App\Models\Game::where('date_heure', '>=', now()->startOfMonth())
        ->where('statut', 'jouer')
        ->where(function($q) use ($arbitreId) {
            $q->where('arbitre_central_id', $arbitreId)
              ->orWhere('arbitre_assistant1_id', $arbitreId)
              ->orWhere('arbitre_assistant2_id', $arbitreId)
              ->orWhere('quatrieme_arbitre_id', $arbitreId);
        })
        ->with('categorie')
        ->get()
        ->sum(fn($m) => $m->categorie->montant);

    return view('arbitre.dashboard', compact('upcomingMatches', 'monthlyPayment'));
}
}
