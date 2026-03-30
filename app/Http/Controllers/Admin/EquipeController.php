<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use APp\Model\Equipe;

class EquipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipe=Equipe::orderBy('nom')->paginae(10);
        return view('admin.equipes.index',compact('equipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.equipes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom'=>'required|string|max:100|unique:equipes,nom',
            'ville'=>'required|required|max:100',
        ]);
        Equipe::create($request->only('nom','ville'));
        return redirect()->route('admin.equipes.index')->with('success'.'equipe ajouter avec success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipe $equipe)
    {
        return redirect()->route('admin.equipes.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipe $equipe)
    {
        return redirect()->route('admin.equipes',compact('equipes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom'=>'required|string|max:100unique:equipes,nom,'.$equipe->id,
            'ville'=>'required|string|max:100',
        ]);
        $equipe->update($request->only('nom','ville'));

        return redirect()->route('admin.equipes.index')->with('success','modifier avec success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipe $equipe)
    {
        $equipe->delete();
        return redirect()->route('admin.equipes.index')->with('success','equipe supprimer');
    }
}
