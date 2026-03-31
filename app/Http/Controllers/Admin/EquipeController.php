<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipe;

class EquipeController extends Controller
{
    /**
     * Afficher la liste des équipes
     */
    public function index()
    {
        $equipes = Equipe::orderBy('nom')->paginate(10);
        return view('admin.equipes.index', compact('equipes'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        return view('admin.equipes.create');
    }

    /**
     * Enregistrer une nouvelle équipe
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom'   => 'required|string|max:100|unique:equipes,nom',
            'ville' => 'required|string|max:100', // tashi7 l-validation hna
        ]);

        Equipe::create($request->only('nom', 'ville'));

        // tashi7 l-concaténation dyal 'with'
        return redirect()->route('admin.equipes.index')->with('success', 'Équipe ajoutée avec succès');
    }

    /**
     * Rediriger vers l'index (pas besoin de show pour le moment)
     */
    public function show(Equipe $equipe)
    {
        return redirect()->route('admin.equipes.index');
    }

    /**
     * Formulaire d'édition
     */
    public function edit(Equipe $equipe)
    {
        // tashi7: khass t-koun .edit f l-akhir
        return view('admin.equipes.edit', compact('equipe'));
    }

    /**
     * Mettre à jour l'équipe
     */
    public function update(Request $request, Equipe $equipe)
    {
        $request->validate([
            'nom'   => 'required|string|max:100|unique:equipes,nom,' . $equipe->id,
            'ville' => 'required|string|max:100',
        ]);

        $equipe->update($request->only('nom', 'ville'));

        return redirect()->route('admin.equipes.index')->with('success', 'Modifiée avec succès');
    }

    /**
     * Supprimer l'équipe
     */
    public function destroy(Equipe $equipe) // tashi7: $equipe (mofrad)
    {
        $equipe->delete();
        return redirect()->route('admin.equipes.index')->with('success', 'Équipe supprimée avec succès');
    }
}