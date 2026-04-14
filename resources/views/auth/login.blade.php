@extends('layouts.guest')

@section('title', 'Connexion — QuickRef')

@section('content')
<div class="min-h-screen w-full bg-[#0f172a] flex items-center justify-center p-6 font-sans">
    
    {{-- Subtile Radial Gradient pour la profondeur --}}
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-rose-500/5 via-transparent to-transparent"></div>

    <main class="w-full max-w-[400px] relative z-10">

        <div class="bg-[#1e293b]/50 backdrop-blur-xl border border-slate-700/50 rounded-3xl shadow-2xl p-10">
            
            {{-- Header --}}
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-rose-600 rounded-2xl mb-4 shadow-lg shadow-rose-600/20">
                    <span class="material-symbols-outlined text-white">shield_person</span>
                </div>
                <h1 class="text-2xl font-black text-white tracking-tight uppercase italic">
                    Quick<span class="text-rose-600">Ref</span>
                </h1>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.2em] mt-2">Espace Arbitrage Officiel</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-rose-500/10 border-l-4 border-rose-600 rounded-r-xl">
                    <p class="text-[10px] text-rose-500 font-bold uppercase tracking-wider">Identifiants incorrects</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Input Email --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full bg-[#0f172a]/50 border border-slate-700 text-white rounded-xl px-5 py-3.5 text-sm focus:border-rose-600 focus:ring-0 transition-all placeholder:text-slate-600"
                        placeholder="arbitre@frmf.ma"
                        required
                    />
                </div>

                {{-- Input Password --}}
                <div class="space-y-2">
                    <div class="flex justify-between items-center px-1">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Mot de passe</label>
                        <a href="{{ route('password.request') }}" class="text-[9px] font-bold text-rose-600 hover:text-rose-400">Oublié ?</a>
                    </div>
                    <input
                        type="password"
                        name="password"
                        class="w-full bg-[#0f172a]/50 border border-slate-700 text-white rounded-xl px-5 py-3.5 text-sm focus:border-rose-600 focus:ring-0 transition-all placeholder:text-slate-600"
                        placeholder="••••••••"
                        required
                    />
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center gap-3 px-1">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded border-slate-700 bg-slate-800 text-rose-600 focus:ring-rose-600 focus:ring-offset-[#0f172a]">
                    <label for="remember" class="text-xs text-slate-400 font-medium">Rester connecté</label>
                </div>

                {{-- Button --}}
                <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white font-black text-[11px] uppercase tracking-[0.2em] py-4 rounded-xl shadow-lg shadow-rose-600/20 transition-all active:scale-95">
                    Se Connecter
                </button>
            </form>

        </div>

        {{-- Footer --}}
        <div class="mt-10 text-center space-y-4">
            <p class="text-[9px] text-slate-500 font-bold uppercase tracking-[0.3em]">Fédération Royale Marocaine de Football</p>
            <div class="flex justify-center gap-6">
                <a href="/" class="text-[10px] text-slate-400 hover:text-white transition-colors">Retour à l'accueil</a>
            </div>
        </div>

    </main>
</div>
@endsection