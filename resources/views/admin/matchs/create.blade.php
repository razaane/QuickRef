@extends('layouts.admin')

@section('admin-content')
<div class="max-w-5xl mx-auto px-4 py-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-black text-on-surface uppercase tracking-tighter">
                Programmer un Match
            </h1>
            <p class="text-on-surface-muted text-sm font-medium">
                Configuration de la rencontre et désignations
            </p>
        </div>

        <a href="{{ route('admin.matchs.index') }}"
           class="flex items-center gap-2 text-on-surface-muted hover:text-primary font-black uppercase text-[10px] tracking-widest">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Retour
        </a>
    </div>

    {{-- Global Error Summary --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl">
            <div class="flex items-center mb-2">
                <span class="material-symbols-outlined text-red-500 mr-2">warning</span>
                <h3 class="text-red-800 font-black uppercase text-xs">Veuillez corriger les erreurs suivantes :</h3>
            </div>
            <ul class="text-red-600 text-xs font-bold space-y-1 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.matchs.store') }}" method="POST" class="space-y-6">
        @csrf

        <input type="hidden" name="statut" value="en_attente">

        {{-- MATCH SECTION --}}
        <div class="bg-surface p-6 rounded-xl border border-outline-variant space-y-6 shadow-sm">

            <h3 class="text-xs font-black uppercase text-primary">Informations du Match</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">

                {{-- Domicile --}}
                <div class="space-y-1">
                    <label class="text-xs font-black uppercase text-on-surface-muted">Domicile</label>
                    <select name="equipe_domicile_id" 
                            class="w-full border rounded-xl p-3 @error('equipe_domicile_id') border-red-500 bg-red-50 @enderror">
                        <option value="">Choisir l'équipe</option>
                        @foreach($equipes as $e)
                            <option value="{{ $e->id }}" {{ old('equipe_domicile_id') == $e->id ? 'selected' : '' }}>
                                {{ $e->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('equipe_domicile_id')
                        <p class="text-red-500 text-[10px] font-bold uppercase">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-center font-black text-primary pt-4">VS</div>

                {{-- Visiteur --}}
                <div class="space-y-1">
                    <label class="text-xs font-black uppercase text-on-surface-muted">Visiteur</label>
                    <select name="equipe_visiteur_id" 
                            class="w-full border rounded-xl p-3 @error('equipe_visiteur_id') border-red-500 bg-red-50 @enderror">
                        <option value="">Choisir l'équipe</option>
                        @foreach($equipes as $e)
                            <option value="{{ $e->id }}" {{ old('equipe_visiteur_id') == $e->id ? 'selected' : '' }}>
                                {{ $e->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('equipe_visiteur_id')
                        <p class="text-red-500 text-[10px] font-bold uppercase">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1">
                    <input type="text" name="terrain" placeholder="Terrain" value="{{ old('terrain') }}"
                           class="border rounded-xl p-3 w-full @error('terrain') border-red-500 @enderror">
                    @error('terrain') <p class="text-red-500 text-[10px] font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1">
                    <input type="text" name="ville" placeholder="Ville" value="{{ old('ville') }}"
                           class="border rounded-xl p-3 w-full @error('ville') border-red-500 @enderror">
                    @error('ville') <p class="text-red-500 text-[10px] font-bold uppercase">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1">
                    <input type="datetime-local" name="date_heure" value="{{ old('date_heure') }}"
                           class="border rounded-xl p-3 w-full @error('date_heure') border-red-500 @enderror">
                    @error('date_heure') <p class="text-red-500 text-[10px] font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1">
                    <select name="categorie_id" class="border rounded-xl p-3 w-full @error('categorie_id') border-red-500 @enderror">
                        <option value="">Sélectionner une catégorie</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" {{ old('categorie_id') == $c->id ? 'selected' : '' }}>
                                {{ $c->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('categorie_id') <p class="text-red-500 text-[10px] font-bold uppercase">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- ARBITRES SECTION --}}
        <div class="bg-sidebar text-white p-6 rounded-xl space-y-4 shadow-lg">

            <h3 class="text-xs font-black uppercase tracking-widest text-primary-light">Désignations des Arbitres</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach([
                    'arbitre_central_id' => 'Arbitre Central',
                    'arbitre_assistant1_id' => '1er Assistant',
                    'arbitre_assistant2_id' => '2ème Assistant',
                    'quatrieme_arbitre_id' => '4ème Arbitre (Optionnel)'
                ] as $field => $label)

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-white/70">{{ $label }}</label>
                        <select name="{{ $field }}" 
                                class="w-full border rounded-xl p-3 text-black @error($field) border-4 border-red-500 @enderror">
                            <option value="">-- Choisir un arbitre --</option>
                            @foreach($arbitres as $a)
                                <option value="{{ $a->id }}" {{ old($field) == $a->id ? 'selected' : '' }}>
                                    {{ $a->user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error($field)
                            <p class="text-red-400 text-[10px] font-black uppercase mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                @endforeach
            </div>

        </div>

        {{-- Submit Button --}}
        <div class="pt-4">
            <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white py-4 rounded-xl font-black uppercase tracking-widest transition-all transform hover:scale-[1.01] active:scale-95 shadow-lg">
                Confirmer et créer le match
            </button>
        </div>

    </form>
</div>
@endsection