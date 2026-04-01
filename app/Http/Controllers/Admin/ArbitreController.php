<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Arbitre;


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
            'name'=>'required|string|max:50',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:8',
            'telephone'=>'required|string|max:20',
            'grade'=>'required|in:regional,national,international',
        ]);
        DB::transation(function() use ($request){
            $user=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'role'=>'arbitre',
            ]);

            Arbitre::create([
                'user_id'=>$user->id,
                'telephone'=>$request->telephone,
                'grade'=>$request->grade,
                'adresse'=>$request->adresse,
            ]);
        });
        return redirect()->route('admin.arbitres.index')->with('success','Arbitre ajouter avec success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.arbitres.index');
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
            'name'=>'required|string|max:50',
            'email'=>'required|string|email|max:255|unique:users',
            'telephone'=>'required|string|max:20',
            'grade'=>'required|in:regional,national,international',
        ]);
        $arbitre->user->update([
            'name'->$request->name,
            'email'->$request->email,
        ]);
        $arbitre =update($request->only('telephone','grade','adresse'));

        return redirect()->route('admin.arbitres.index')->with('success','arbitre à mise à jour par success');
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
