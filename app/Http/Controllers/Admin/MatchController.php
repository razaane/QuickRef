<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Equipe;
use App\Models\Arbitre;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MatchController extends Controller
{
    /**
     * Display a listing of the matchs.
     */
    public function index()
    {
        $matchs = Game::with(['equipeDomicile', 'equipeVisiteur', 'categorie', 'arbitreCentral.user'])
            ->orderBy('date_heure', 'desc')
            ->paginate(10);

        return view('admin.matchs.index', compact('matchs'));
    }

    /**
     * Show the form for creating a new match.
     */
    public function create()
    {
        $equipes = Equipe::all();
        $categories = Categorie::all();
        $arbitres = Arbitre::with('user')->get();
        
        return view('admin.matchs.create', compact('equipes', 'categories', 'arbitres'));
    }

    /**
     * Store a newly created match in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateMatch($request);

        // Logic: Check si l'un des arbitres est déjà pris le même jour
        if ($this->isArbitreBusy($request)) {
            return back()->withInput()->withErrors(['error' => 'Un ou plusieurs arbitres sont déjà assignés à un match ce jour-là.']);
        }

        Game::create($data);

        return redirect()->route('admin.matchs.index')->with('success', 'Match programmé avec succès.');
    }

    /**
     * Display the specified match.
     */
    public function show(Game $match)
    {
        $match->load(['equipeDomicile', 'equipeVisiteur', 'categorie', 'arbitreCentral.user', 'assistant1.user', 'assistant2.user', 'quatrieme.user']);
        return view('admin.matchs.show', compact('match'));
    }

    /**
     * Show the form for editing the specified match.
     */
    public function edit(Game $match)
    {
        $equipes = Equipe::all();
        $categories = Categorie::all();
        $arbitres = Arbitre::with('user')->get();
        
        return view('admin.matchs.edit', compact('match', 'equipes', 'categories', 'arbitres'));
    }

    /**
     * Update the specified match in storage.
     */
    public function update(Request $request, Game $match)
    {
        $data = $this->validateMatch($request, $match->id);

        // Check availability (excluding current match)
        if ($this->isArbitreBusy($request, $match->id)) {
            return back()->withInput()->withErrors(['error' => 'Un ou plusieurs arbitres sont déjà pris ce jour-là.']);
        }

        $match->update($data);

        return redirect()->route('admin.matchs.index')->with('success', 'Match mis à jour avec succès.');
    }

    /**
     * Remove the specified match from storage.
     */
    public function destroy(Game $match)
    {
        $match->delete();
        return redirect()->route('admin.matchs.index')->with('success', 'Match supprimé avec succès.');
    }

    /**
     * Helper: Validation Logic (Shared between Store and Update)
     */
    private function validateMatch(Request $request, $id = null)
    {
        return $request->validate([
            'equipe_domicile_id' => 'required|exists:equipes,id',
            'equipe_visiteur_id' => 'required|exists:equipes,id|different:equipe_domicile_id',
            'categorie_id'       => 'required|exists:categories,id',
            'arbitre_central_id' => 'required|exists:arbitres,id',
            'arbitre_assistant1_id' => 'required|exists:arbitres,id|different:arbitre_central_id',
            'arbitre_assistant2_id' => 'required|exists:arbitres,id|different:arbitre_central_id|different:arbitre_assistant1_id',
            'quatrieme_arbitre_id'  => 'nullable|exists:arbitres,id',
            'date_heure' => 'required|date',
            'terrain'    => 'required|string|max:255',
            'ville'      => 'required|string|max:255',
            'statut'     => 'required|in:en_attente,confirmer,jouer,annuler,reporter',
        ]);
    }

    /**
     * Helper: Check if any selected referee is already assigned on that date
     */
    private function isArbitreBusy(Request $request, $excludeMatchId = null)
    {
        $dateMatch = Carbon::parse($request->date_heure)->format('Y-m-d');
        $arbitres_ids = array_filter([
            $request->arbitre_central_id, 
            $request->arbitre_assistant1_id, 
            $request->arbitre_assistant2_id,
            $request->quatrieme_arbitre_id
        ]);

        $query = Game::whereDate('date_heure', $dateMatch);

        if ($excludeMatchId) {
            $query->where('id', '!=', $excludeMatchId);
        }

        return $query->where(function($q) use ($arbitres_ids) {
            $q->whereIn('arbitre_central_id', $arbitres_ids)
              ->orWhereIn('arbitre_assistant1_id', $arbitres_ids)
              ->orWhereIn('arbitre_assistant2_id', $arbitres_ids)
              ->orWhereIn('quatrieme_arbitre_id', $arbitres_ids);
        })->exists();
    }
}