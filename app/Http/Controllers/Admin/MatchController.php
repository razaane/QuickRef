<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Equipe;
use App\Models\Arbitre;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  

class MatchController extends Controller
{
    public function index()
    {
        $matchs = Game::with([
            'equipeDomicile',
            'equipeVisiteur',
            'categorie',
            'arbitreCentral.user'
        ])->orderBy('date_heure', 'desc')->paginate(10);

        return view('admin.matchs.index', compact('matchs'));
    }

    public function create()
    {
        return view('admin.matchs.create', [
            'equipes' => Equipe::all(),
            'categories' => Categorie::all(),
            'arbitres' => Arbitre::with('user')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateMatch($request);
        
        if ($this->isArbitreBusy($request)) {
            return back()->withInput()
                ->withErrors(['error' => 'Un arbitre est déjà assigné à ce créneau.']);
        }
        
        DB::beginTransaction();
        try {
            Game::create($data);
            DB::commit();
            
            return redirect()->route('admin.matchs.index')
                ->with('success', 'Match créé avec succès.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()
                ->withErrors(['error' => 'Erreur lors de la création : ' . $e->getMessage()]);
        }
    }

    public function show(Game $match)
    {
        $match->load([
            'equipeDomicile',
            'equipeVisiteur',
            'categorie',
            'arbitreCentral.user',
            'assistant1.user',
            'assistant2.user',
            'quatrieme.user'
        ]);

        return view('admin.matchs.show', compact('match'));
    }

    public function edit(Game $match)
    {
        return view('admin.matchs.edit', [
            'match' => $match,
            'equipes' => Equipe::all(),
            'categories' => Categorie::all(),
            'arbitres' => Arbitre::with('user')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $match = Game::findOrFail($id);
        
        $data = $this->validateMatch($request);
        
        if ($this->isArbitreBusy($request, $id)) {
            return back()->withInput()
                ->withErrors(['error' => 'Conflit: arbitre déjà occupé.']);
        }
        
        DB::beginTransaction();
        try {
            $match->update($data);
            DB::commit();
            
            return redirect()->route('admin.matchs.index')
                ->with('success', 'Match mis à jour avec succès.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()
                ->withErrors(['error' => 'Erreur lors de la mise à jour : ' . $e->getMessage()]);
        }
    }

    public function destroy(Game $match)
    {
        $match->delete();
        
        return redirect()->route('admin.matchs.index')
            ->with('success', 'Match supprimé.');
    }

    private function validateMatch(Request $request)
    {
        return $request->validate([
            'equipe_domicile_id' => 'required|exists:equipes,id',
            'equipe_visiteur_id' => 'required|exists:equipes,id|different:equipe_domicile_id',
            'categorie_id' => 'required|exists:categories,id',  
            
            'arbitre_central_id' => 'required|exists:arbitres,id',
            'arbitre_assistant1_id' => 'nullable|exists:arbitres,id|different:arbitre_central_id',
            'arbitre_assistant2_id' => 'nullable|exists:arbitres,id|different:arbitre_central_id|different:arbitre_assistant1_id',
            'quatrieme_arbitre_id' => 'nullable|exists:arbitres,id',
            
            'date_heure' => 'required|date|after_or_equal:now',
            'terrain' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'statut' => 'required|in:en_attente,confirmer,jouer,annuler,reporter',
        ]);
    }

    private function isArbitreBusy(Request $request, $excludeMatchId = null)
    {
        $arbitres = array_values(array_filter([
            $request->arbitre_central_id,
            $request->arbitre_assistant1_id,
            $request->arbitre_assistant2_id,
            $request->quatrieme_arbitre_id,
        ]));
        
        if (empty($arbitres)) {
            return false;
        }
        
        return Game::when($excludeMatchId, function ($q) use ($excludeMatchId) {
                $q->where('id', '!=', $excludeMatchId);
            })
            ->where('date_heure', $request->date_heure)
            ->where(function ($q) use ($arbitres) {
                $q->whereIn('arbitre_central_id', $arbitres)
                    ->orWhereIn('arbitre_assistant1_id', $arbitres)
                    ->orWhereIn('arbitre_assistant2_id', $arbitres)
                    ->orWhereIn('quatrieme_arbitre_id', $arbitres);
            })
            ->exists();
    }
}