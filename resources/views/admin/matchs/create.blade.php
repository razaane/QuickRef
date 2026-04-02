@extends('layouts.admin')

@section('admin-content')
<div class="max-w-5xl mx-auto px-4 py-8">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-10">
        <div>
            <h1 class="text-3xl font-black text-slate-800 uppercase tracking-tighter">Programmer un Match</h1>
            <p class="text-slate-500 font-medium">Configuration de la rencontre et désignation des arbitres</p>
        </div>
        <a href="{{ route('admin.matchs.index') }}" class="flex items-center gap-2 text-slate-400 hover:text-[#1B6B3A] transition-all font-bold">
            <span class="material-symbols-outlined">arrow_back</span> Retour
        </a>
    </div>

    {{-- Affichage des erreurs si elles existent --}}
    @if ($errors->any())
        <div class="mb-8 p-6 bg-red-50 border-l-4 border-red-500 rounded-2xl shadow-sm">
            <div class="flex items-center gap-3 text-red-700 font-bold mb-2">
                <span class="material-symbols-outlined">error</span> Oups ! Il y a des erreurs :
            </div>
            <ul class="list-disc list-inside text-red-600 text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.matchs.store') }}" method="POST" class="space-y-8">
        @csrf
        
        {{-- Statut par défaut (Hidden) --}}
        <input type="hidden" name="statut" value="en_attente">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Colonne Gauche: Équipes et Détails --}}
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                    <h3 class="text-xs font-black uppercase text-slate-400 mb-8 tracking-widest flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm text-[#C9A84C]">sports_soccer</span> Confrontation
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-11 gap-4 items-center">
                        {{-- Domicile --}}
                        <div class="md:col-span-5 space-y-3">
                            <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Équipe Domicile</label>
                            <select name="equipe_domicile_id" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-[#1B6B3A]/20 transition-all font-bold text-slate-700 shadow-inner">
                                <option value="" disabled selected>Choisir domicile</option>
                                @foreach($equipes as $e)
                                    <option value="{{ $e->id }}" {{ old('equipe_domicile_id') == $e->id ? 'selected' : '' }}>{{ $e->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- VS --}}
                        <div class="md:col-span-1 text-center font-black italic text-[#C9A84C] text-2xl pt-6">VS</div>

                        {{-- Visiteur --}}
                        <div class="md:col-span-5 space-y-3">
                            <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Équipe Visiteur</label>
                            <select name="equipe_visiteur_id" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-[#1B6B3A]/20 transition-all font-bold text-slate-700 shadow-inner">
                                <option value="" disabled selected>Choisir visiteur</option>
                                @foreach($equipes as $e)
                                    <option value="{{ $e->id }}" {{ old('equipe_visiteur_id') == $e->id ? 'selected' : '' }}>{{ $e->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Terrain / Stade</label>
                            <input type="text" name="terrain" value="{{ old('terrain') }}" placeholder="Ex: Stade Municipal" 
                                   class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-[#1B6B3A]/20 font-bold shadow-inner">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Ville</label>
                            <input type="text" name="ville" value="{{ old('ville') }}" placeholder="Ex: Safi" 
                                   class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-[#1B6B3A]/20 font-bold shadow-inner">
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                    <h3 class="text-xs font-black uppercase text-slate-400 mb-8 tracking-widest flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm text-[#C9A84C]">calendar_month</span> Timing & Catégorie
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Date et Heure du Match</label>
                            <input type="datetime-local" name="date_heure" value="{{ old('date_heure') }}"
                                   class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-[#1B6B3A]/20 font-bold shadow-inner">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Catégorie du Match</label>
                            <select name="categorie_id" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-[#1B6B3A]/20 font-bold shadow-inner">
                                <option value="" disabled selected>Sélectionner catégorie</option>
                                @foreach($categories as $c)
                                    <option value="{{ $c->id }}" {{ old('categorie_id') == $c->id ? 'selected' : '' }}>{{ $c->nom }} ({{ $c->montant }} MAD)</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Colonne Droite: Arbitres --}}
            <div class="space-y-8">
                <div class="bg-[#1B6B3A] rounded-[2.5rem] p-8 shadow-xl text-white">
                    <h3 class="text-[10px] font-black uppercase text-white/50 mb-8 tracking-widest flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">gavel</span> Désignations
                    </h3>
                    
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-white/60 ml-2">Arbitre Central</label>
                            <select name="arbitre_central_id" class="w-full bg-white/10 border border-white/20 rounded-2xl px-4 py-4 focus:ring-2 focus:ring-white/30 font-bold text-white shadow-inner appearance-none">
                                <option value="" class="text-slate-800">Choisir central</option>
                                @foreach($arbitres as $a)
                                    <option value="{{ $a->id }}" class="text-slate-800" {{ old('arbitre_central_id') == $a->id ? 'selected' : '' }}>{{ $a->user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-white/60 ml-2">Assistant 1</label>
                            <select name="arbitre_assistant1_id" class="w-full bg-white/10 border border-white/20 rounded-2xl px-4 py-4 focus:ring-2 focus:ring-white/30 font-bold text-white shadow-inner appearance-none">
                                <option value="" class="text-slate-800">Choisir assistant 1</option>
                                @foreach($arbitres as $a)
                                    <option value="{{ $a->id }}" class="text-slate-800" {{ old('arbitre_assistant1_id') == $a->id ? 'selected' : '' }}>{{ $a->user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-white/60 ml-2">Assistant 2</label>
                            <select name="arbitre_assistant2_id" class="w-full bg-white/10 border border-white/20 rounded-2xl px-4 py-4 focus:ring-2 focus:ring-white/30 font-bold text-white shadow-inner appearance-none">
                                <option value="" class="text-slate-800">Choisir assistant 2</option>
                                @foreach($arbitres as $a)
                                    <option value="{{ $a->id }}" class="text-slate-800" {{ old('arbitre_assistant2_id') == $a->id ? 'selected' : '' }}>{{ $a->user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-white/60 ml-2">4ème Arbitre (Optionnel)</label>
                            <select name="quatrieme_arbitre_id" class="w-full bg-white/10 border border-white/20 rounded-2xl px-4 py-4 focus:ring-2 focus:ring-white/30 font-bold text-white shadow-inner appearance-none">
                                <option value="" class="text-slate-800">Aucun</option>
                                @foreach($arbitres as $a)
                                    <option value="{{ $a->id }}" class="text-slate-800" {{ old('quatrieme_arbitre_id') == $a->id ? 'selected' : '' }}>{{ $a->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="w-full mt-12 bg-white text-[#1B6B3A] py-5 rounded-2xl font-black uppercase tracking-widest hover:bg-[#C9A84C] hover:text-white transition-all shadow-lg flex items-center justify-center gap-3">
                        <span class="material-symbols-outlined">check_circle</span> Valider le Match
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection