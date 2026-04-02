<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Arbitre;
use Illuminate\Support\Facades\Hash;


class ArbitreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arbitres=Arbitre::with('user')->paginate(10);
        return view('admin.arbitres.index',compact('arbitres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.arbitres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'name'      => 'required|string|max:255',
        'email'     => 'required|string|email|max:255|unique:users,email',
        'password'  => 'required|string|min:8',
        'telephone' => 'required|string|max:20',
        'grade'     => 'required|in:regional,national,international',
    ]);

    try {
        DB::beginTransaction();

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password), 
            'role'     => 'arbitre',
        ]);

        Arbitre::create([
            'user_id'   => $user->id, 
            'telephone' => $request->telephone,
            'grade'     => $request->grade,
            'adresse'   => $request->adresse,
        ]);

        DB::commit();
        return redirect()->route('admin.arbitres.index')->with('success', 'Arbitre créé avec succès !');

    } catch (\Exception $e) {
        DB::rollback();
        return back()->withInput()->withErrors(['db_error' => 'Erreur : ' . $e->getMessage()]);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Arbitre $arbitre)
    {
        return redirect()->route('admin.arbitres.show')->compact('arbitre');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Arbitre $arbitre)
    {
        return view('admin.arbitres.edit',compact('arbitre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Arbitre $arbitre)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $arbitre->user_id,
        'telephone' => 'required|string|max:20',
        'grade' => 'required|in:regional,national,international',
    ]);

    try {
        DB::beginTransaction();

        $arbitre->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $arbitre->update([
            'telephone' => $request->telephone,
            'grade' => $request->grade,
            'adresse' => $request->adresse,
        ]);

        DB::commit();
        return redirect()->route('admin.arbitres.index')->with('success', 'Arbitre mis à jour avec succès');

    } catch (\Exception $e) {
        DB::rollback();
        return back()->withInput()->withErrors(['error' => 'Erreur: ' . $e->getMessage()]);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Arbitre $arbitre)
    {
        $arbitre->delete();
        return redirect()->route('admin.arbitres.index')->with('success','supprimé avec success');
    }
}
