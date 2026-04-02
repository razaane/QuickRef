@extends('layouts.admin')

@section('admin-content')
<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Modifier le Match #{{ $match->id }}</h1>
            <p class="text-slate-500 text-sm">Mise à jour des informations et des désignations</p>
        </div>
        <a href="{{ route('admin.matchs.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">
            <span class="material-symbols-outlined text-3xl">cancel</span>
        </a>
    </div>

    {{-- Formulaire --}}
    <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-100">
        <form action="{{ route('admin.matchs.update', $match->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            {{-- Section 1: Les Équipes --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Équipe Domicile</label>
                    <select name="equipe_domicile_id" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4 focus:ring-2 focus:ring-[#1B6B3A]/20">
                        @foreach($equipes as $e)
                            <option value="{{ $e->id }}" {{ $match->equipe_domicile_id == $e->id ? 'selected' : '' }}>
                                {{ $e->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center pb-4 text-[#C9A84C] font-black italic text-xl">VS</div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Équipe Visiteur</label>
                    <select name="equipe_visiteur_id" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4 focus:ring-2 focus:ring-[#1B6B3A]/20">
                        @foreach($equipes as $e)
                            <option value="{{ $e->id }}" {{ $match->equipe_visiteur_id == $e->id ? 'selected' : '' }}>
                                {{ $e->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Section 2: Détails --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Date & Heure</label>
                    <input type="datetime-local" name="date_heure" 
                           value="{{ \Carbon\Carbon::parse($match->date_heure)->format('Y-m-d\TH:i') }}"
                           class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Terrain</label>
                    <input type="text" name="terrain" value="{{ $match->terrain }}" 
                           class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Ville</label>
                    <input type="text" name="ville" value="{{ $match->ville }}" 
                           class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Statut</label>
                    <select name="statut" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4">
                        @foreach(['en_attente', 'confirmer', 'jouer', 'annuler', 'reporter'] as $status)
                            <option value="{{ $status }}" {{ $match->statut == $status ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Section 3: Catégorie --}}
            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Catégorie & Indemnité</label>
                <select name="categorie_id" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4">
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ $match->categorie_id == $c->id ? 'selected' : '' }}>
                            {{ $c->nom }} ({{ $c->montant }} MAD)
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Section 4: Arbitres --}}
            <div class="p-8 bg-[#C9A84C]/5 rounded-[2rem] border border-[#C9A84C]/10">
                <h3 class="text-xs font-black uppercase text-[#C9A84C] mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">gavel</span> Désignation Arbitrale
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-slate-600 ml-1">Arbitre Central</label>
                        <select name="arbitre_central_id" class="w-full bg-white border-none rounded-xl px-4 py-3 shadow-sm text-sm">
                            @foreach($arbitres as $a)
                                <option value="{{ $a->id }}" {{ $match->arbitre_central_id == $a->id ? 'selected' : '' }}>
                                    {{ $a->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-slate-600 ml-1">Assistant 1</label>
                        <select name="arbitre_assistant1_id" class="w-full bg-white border-none rounded-xl px-4 py-3 shadow-sm text-sm">
                            @foreach($arbitres as $a)
                                <option value="{{ $a->id }}" {{ $match->arbitre_assistant1_id == $a->id ? 'selected' : '' }}>
                                    {{ $a->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-slate-600 ml-1">Assistant 2</label>
                        <select name="arbitre_assistant2_id" class="w-full bg-white border-none rounded-xl px-4 py-3 shadow-sm text-sm">
                            @foreach($arbitres as $a)
                                <option value="{{ $a->id }}" {{ $match->arbitre_assistant2_id == $a->id ? 'selected' : '' }}>
                                    {{ $a->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-slate-600 ml-1">4ème Arbitre (Optionnel)</label>
                        <select name="quatrieme_arbitre_id" class="w-full bg-white border-none rounded-xl px-4 py-3 shadow-sm text-sm">
                            <option value="">Aucun</option>
                            @foreach($arbitres as $a)
                                <option value="{{ $a->id }}" {{ $match->quatrieme_arbitre_id == $a->id ? 'selected' : '' }}>
                                    {{ $a->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="pt-4">
                <button type="submit" class="w-full bg-[#1B6B3A] text-white py-5 rounded-2xl font-black uppercase tracking-widest hover:bg-[#15522c] hover:shadow-xl transition-all flex items-center justify-center gap-3">
                    <span class="material-symbols-outlined">save</span> Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection