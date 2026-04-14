@extends('layouts.admin')

@section('admin-content')
<div class="max-w-5xl p-6">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-black text-on-surface uppercase tracking-tighter">Programmer un Match</h1>
            <p class="text-on-surface-muted text-sm font-medium">Configuration de la rencontre et désignations</p>
        </div>
        <a href="{{ route('admin.matchs.index') }}" class="flex items-center gap-2 text-on-surface-muted hover:text-primary transition-all font-black uppercase text-[10px] tracking-widest">
            <span class="material-symbols-outlined text-sm">arrow_back</span> Retour
        </a>
    </div>

    {{-- Alertes Erreurs --}}
    @if ($errors->any())
        <div class="mb-8 p-4 bg-primary/5 border border-primary/20 rounded-xl">
            <div class="flex items-center gap-2 text-primary font-black uppercase text-[10px] mb-2">
                <span class="material-symbols-outlined text-sm">error</span> Erreurs de saisie :
            </div>
            <ul class="text-primary text-xs font-bold space-y-1 ml-6 list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @error('arbitre')
        <div class="p-4 mb-4 text-sm text-primary bg-primary/10 border border-primary/20 rounded-xl font-bold">
            {{ $message }}
        </div>
    @enderror

    <form action="{{ route('admin.matchs.store') }}" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="statut" value="en_attente">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            {{-- Colonne Gauche: Détails du Match --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-surface rounded-xl p-8 border border-outline-variant shadow-sm">
                    <h3 class="text-[10px] font-black uppercase text-primary tracking-[0.2em] mb-8 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">sports_soccer</span> Confrontation Directe
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-11 gap-4 items-center mb-10">
                        <div class="md:col-span-5 space-y-2">
                            <label class="text-[9px] font-black uppercase text-on-surface-muted ml-1">Équipe Domicile</label>
                            <select name="equipe_domicile_id" class="w-full bg-background border border-outline-variant rounded-xl px-4 py-4 font-bold text-on-surface focus:ring-2 focus:ring-primary/10 transition-all">
                                <option value="" disabled selected>Choisir domicile</option>
                                @foreach($equipes as $e)
                                    <option value="{{ $e->id }}" {{ old('equipe_domicile_id') == $e->id ? 'selected' : '' }}>{{ $e->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-1 text-center font-black italic text-on-surface-muted text-xl pt-4">VS</div>

                        <div class="md:col-span-5 space-y-2">
                            <label class="text-[9px] font-black uppercase text-on-surface-muted ml-1">Équipe Visiteur</label>
                            <select name="equipe_visiteur_id" class="w-full bg-background border border-outline-variant rounded-xl px-4 py-4 font-bold text-on-surface focus:ring-2 focus:ring-primary/10 transition-all">
                                <option value="" disabled selected>Choisir visiteur</option>
                                @foreach($equipes as $e)
                                    <option value="{{ $e->id }}" {{ old('equipe_visiteur_id') == $e->id ? 'selected' : '' }}>{{ $e->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[9px] font-black uppercase text-on-surface-muted ml-1">Stade / Terrain</label>
                            <input type="text" name="terrain" value="{{ old('terrain') }}" placeholder="Nom du terrain..." 
                                   class="w-full bg-background border border-outline-variant rounded-xl px-4 py-4 font-bold shadow-inner">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-black uppercase text-on-surface-muted ml-1">Ville</label>
                            <input type="text" name="ville" value="{{ old('ville') }}" placeholder="Lieu du match..." 
                                   class="w-full bg-background border border-outline-variant rounded-xl px-4 py-4 font-bold shadow-inner">
                        </div>
                    </div>
                </div>

                <div class="bg-background rounded-xl p-8 border border-outline-variant">
                    <h3 class="text-[10px] font-black uppercase text-on-surface-muted tracking-[0.2em] mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">schedule</span> Timing & Catégorie
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[9px] font-black uppercase text-on-surface-muted ml-1">Date et Heure du Match</label>
                            <input type="datetime-local" name="date_heure" value="{{ old('date_heure') }}"
                                   class="w-full bg-surface border border-outline-variant rounded-xl px-4 py-4 font-bold shadow-sm">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-black uppercase text-on-surface-muted ml-1">Catégorie Officielle</label>
                            <select name="categorie_id" class="w-full bg-surface border border-outline-variant rounded-xl px-4 py-4 font-bold shadow-sm">
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
            <div class="space-y-6">
                <div class="bg-sidebar rounded-xl p-8 shadow-lg text-white">
                    <h3 class="text-[10px] font-black uppercase text-white/40 mb-8 tracking-widest border-b border-white/10 pb-4">
                        Désignations
                    </h3>
                    
                    <div class="space-y-5">
                        @foreach([
                            'arbitre_central_id' => 'Arbitre Central',
                            'arbitre_assistant1_id' => 'Assistant 1',
                            'arbitre_assistant2_id' => 'Assistant 2',
                            'quatrieme_arbitre_id' => '4ème Arbitre (Optionnel)'
                        ] as $field => $label)
                        <div class="space-y-1">
                            <label class="text-[9px] font-black uppercase text-white/40 ml-1">{{ $label }}</label>
                            <select name="{{ $field }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm font-bold text-white focus:bg-white/10 outline-none">
                                <option value="" class="text-on-surface">-- Sélectionner --</option>
                                @foreach($arbitres as $a)
                                    <option value="{{ $a->id }}" class="text-on-surface" {{ old($field) == $a->id ? 'selected' : '' }}>{{ $a->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endforeach
                    </div>

                    <button type="submit" class="w-full mt-10 bg-primary text-white py-5 rounded-xl font-black uppercase tracking-widest hover:bg-primary-dark transition-all shadow-xl shadow-black/20 flex items-center justify-center gap-3">
                        <span class="material-symbols-outlined">verified</span> Valider le Match
                    </button>
                    <a href="{{ route('admin.matchs.index') }}" class="block text-center mt-4 text-white/40 font-black text-[9px] uppercase tracking-widest hover:text-white transition-colors">Annuler la création</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection