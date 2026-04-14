@extends('layouts.admin')
@section('admin-content')
<div class="max-w-4xl p-6">
    <div class="mb-8">
        <h1 class="text-2xl font-black text-on-surface uppercase tracking-tight">Modifier le Match #{{ $match->id }}</h1>
        <p class="text-on-surface-muted text-sm">Mise à jour des informations de rencontre</p>

    </div>
    @error('arbitre')
        <div class="p-4 mb-4 text-sm text-primary bg-primary/10 border border-primary/20 rounded-xl font-bold">
            {{ $message }}
        </div>
    @enderror
    <form action="{{ route('admin.matchs.update', $match->id) }}" method="POST">
    @csrf
    @method('PUT')

        <div class="bg-surface p-8 rounded-xl border border-outline-variant shadow-sm">
            <h3 class="text-[10px] font-black uppercase text-primary tracking-[0.2em] mb-6">Détails de la rencontre</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Équipes --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-on-surface-muted ml-1">Équipe Domicile</label>
                    <select name="equipe_domicile_id" class="w-full bg-background border border-outline-variant rounded-xl px-4 py-3 font-bold text-on-surface">
                        @foreach($equipes as $e)
                            <option value="{{ $e->id }}" {{ $match->equipe_domicile_id == $e->id ? 'selected' : '' }}>{{ $e->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-on-surface-muted ml-1">Équipe Visiteur</label>
                    <select name="equipe_visiteur_id" class="w-full bg-background border border-outline-variant rounded-xl px-4 py-3 font-bold text-on-surface">
                        @foreach($equipes as $e)
                            <option value="{{ $e->id }}" {{ $match->equipe_visiteur_id == $e->id ? 'selected' : '' }}>{{ $e->nom }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Lieu --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-on-surface-muted ml-1">Ville</label>
                    <input type="text" name="ville" value="{{ $match->ville }}" class="w-full bg-background border border-outline-variant rounded-xl px-4 py-3 font-bold">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-on-surface-muted ml-1">Terrain</label>
                    <input type="text" name="terrain" value="{{ $match->terrain }}" class="w-full bg-background border border-outline-variant rounded-xl px-4 py-3 font-bold">
                </div>

                {{-- Timing & Catégorie --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-on-surface-muted ml-1">Date & Heure</label>
                    <input type="datetime-local" name="date_heure" value="{{ \Carbon\Carbon::parse($match->date_heure)->format('Y-m-d\TH:i') }}" class="w-full bg-background border border-outline-variant rounded-xl px-4 py-3 font-bold">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-on-surface-muted ml-1">Statut</label>
                    <select name="statut" class="w-full bg-background border border-outline-variant rounded-xl px-4 py-3 font-bold">
                        @foreach(['en_attente', 'confirmer', 'jouer', 'annuler', 'reporter'] as $status)
                            <option value="{{ $status }}" {{ $match->statut == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- Section Arbitres --}}
        <div class="bg-background p-8 rounded-xl border border-outline-variant">
            <h3 class="text-[10px] font-black uppercase text-on-surface-muted tracking-[0.2em] mb-6">Désignations Arbitrales</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach(['arbitre_central_id' => 'Central', 'arbitre_assistant1_id' => 'Assistant 1', 'arbitre_assistant2_id' => 'Assistant 2', 'quatrieme_arbitre_id' => '4ème Arbitre'] as $field => $label)
                <div class="space-y-1">
                    <label class="text-[9px] font-black uppercase text-on-surface-variant ml-1">{{ $label }}</label>
                    <select name="{{ $field }}" class="w-full border border-outline-variant rounded-lg px-4 py-2 text-sm font-bold">
                        <option value="">-- Aucun --</option>
                        @foreach($arbitres as $a)
                            <option value="{{ $a->id }}" {{ $match->$field == $a->id ? 'selected' : '' }}>{{ $a->user->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endforeach
            </div>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="flex-1 bg-primary text-white py-4 rounded-xl font-black uppercase tracking-widest hover:bg-primary-dark shadow-lg transition-all">
                Mettre à jour le match
            </button>
            <a href="{{ route('admin.matchs.index') }}" class="px-8 py-4 bg-surface border border-outline-variant rounded-xl font-black uppercase text-[10px] flex items-center">Annuler</a>
        </div>
    </form>
</div>
@endsection