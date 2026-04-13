<?php

namespace App\Http\Controllers\Arbitre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $arbitre = $user->arbitre; // relation inverse
        return view('arbitre.profil.edit', compact('user', 'arbitre'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $arbitre = $user->arbitre;

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password'  => 'nullable|string|min:8|confirmed',
            'telephone' => 'required|string|max:20',
            'adresse'   => 'nullable|string|max:255',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        $arbitre->update([
            'telephone' => $request->telephone,
            'adresse'   => $request->adresse,
        ]);

        return redirect()->route('arbitre.profil.edit')->with('success', 'Profil mis à jour !');
    }
}