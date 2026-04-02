@extends('layouts.admin')
@section('admin-content')
<div class="max-w-4xl bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-100">
    <form action="{{ route('admin.matchs.store') }}" method="POST" class="space-y-8">
        @csrf
        
        {{-- Section 1: Les Équipes --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Équipe Domicile</label>
                <select name="equipe_domicile_id" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4 focus:ring-2 focus:ring-[#1B6B3A]/20">
                    @foreach($equipes as $e) <option value="{{ $e->id }}">{{ $e->nom }}</option> @endforeach
                </select>
            </div>
            <div class="text-center pb-4 text-[#C9A84C] font-black italic">CONTRE</div>
            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Équipe Visiteur</label>
                <select name="equipe_visiteur_id" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4 focus:ring-2 focus:ring-[#1B6B3A]/20">
                    @foreach($equipes as $e) <option value="{{ $e->id }}">{{ $e->nom }}</option> @endforeach
                </select>
            </div>
        </div>

        {{-- Section 2: Détails --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Date & Heure</label>
                <input type="datetime-local" name="date_heure" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Terrain</label>
                <input type="text" name="terrain" placeholder="Ex: Stade d'Honneur" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Catégorie</label>
                <select name="categorie_id" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-4">
                    @foreach($categories as $c) <option value="{{ $c->id }}">{{ $c->nom }} ({{ $c->montant }} DH)</option> @endforeach
                </select>
            </div>
        </div>

        {{-- Section 3: Arbitres --}}
        <div class="p-6 bg-[#C9A84C]/5 rounded-3xl border border-[#C9A84C]/10">
            <h3 class="text-xs font-black uppercase text-[#C9A84C] mb-4">Désignation Arbitrale</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-slate-400">Arbitre Central</label>
                    <select name="arbitre_central_id" class="w-full bg-white border-slate-100 rounded-xl px-3 py-3 text-sm">
                        @foreach($arbitres as $a) <option value="{{ $a->id }}">{{ $a->user->name }}</option> @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-slate-400">Assistant 1</label>
                    <select name="arbitre_assistant1_id" class="w-full bg-white border-slate-100 rounded-xl px-3 py-3 text-sm">
                        @foreach($arbitres as $a) <option value="{{ $a->id }}">{{ $a->user->name }}</option> @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-slate-400">Assistant 2</label>
                    <select name="arbitre_assistant2_id" class="w-full bg-white border-slate-100 rounded-xl px-3 py-3 text-sm">
                        @foreach($arbitres as $a) <option value="{{ $a->id }}">{{ $a->user->name }}</option> @endforeach
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="w-full bg-[#1B6B3A] text-white py-5 rounded-2xl font-black uppercase tracking-widest hover:shadow-2xl transition-all">
            Confirmer la Programmation
        </button>
    </form>
</div>
@endsection