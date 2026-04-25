<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories= Categorie::orderBy('montant')->paginate(10);
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom'=>'required|string|max:100|unique:categories,nom',
            'montant'=>'required|numeric|min:0 ',
        ]);

        Categorie::create([
            'nom'=>$request->nom,
            'montant'=>$request->montant,
        ]);
        return redirect()->route('admin.categories.index')->with('success','categorie crée avec success');
    }


    /**
     * Display the specified resource.
     */
    public function show(Categorie $category)
    {
        return redirect()->route('admin.categories.index',compact('categorie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $category) 
{
    return view('admin.categories.edit', ['categorie' => $category]);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $category) 
{
    $category->update($request->all());
    return redirect()->route('admin.categories.index');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success','deleted with success');
    }
}
