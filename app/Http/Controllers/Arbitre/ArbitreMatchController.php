<?php

namespace App\Http\Controllers\Arbitre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArbitreMatchController extends Controller
{
    public function dashboard()
{
    $arbitreId = auth()->user()->arbitre->id;

    $upcomingMatches = \App\Models\Game::with(['equipeDomicile', 'equipeVisiteur'])
        ->where(function($q) use ($arbitreId) {
            $q->where('arbitre_central_id', $arbitreId)
              ->orWhere('arbitre_assistant1_id', $arbitreId)
              ->orWhere('arbitre_assistant2_id', $arbitreId)
              ->orWhere('quatrieme_arbitre_id', $arbitreId);
        })
        ->where('date_heure', '>=', now())
        ->orderBy('date_heure', 'asc')
        ->get();

    return view('arbitre.dashboard', compact('upcomingMatches', 'arbitreId'));
}
}

