<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\Arbitre;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'telephone' => ['required', 'string', 'max:20'],
            'grade'     => ['required', 'in:regional,national,international'],
            'adresse'   => ['nullable', 'string', 'max:255'],
            
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=> 'arbitre',
        ]);
        Arbitre::create([
            'user_id'=>$user->id,
            'telephone'=>$request->telephone,
            'grade'=>$request->grade,
            'adresse'=>$request->adresse,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('arbitre.dashboard'));
    }
}
