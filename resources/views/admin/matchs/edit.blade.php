@extends('layouts.admin')
@section('admin-content')
<div class="max-w-4xl p-4 lg:p-6 mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-black text-on-surface uppercase tracking-tight">Modifier le Match #{{ $match->id }}</h1>
        <p class="text-on-surface-muted text-xs lg:text-sm italic">Édition des informations de rencontre officielle</p>
    </div>

    <form action="{{ route('admin.matchs.update', $match->id) }}" method="POST" class="space-y-6">
        @csrf @method('PUT')

        <div class="bg-surface p-6 lg:p-8 rounded-2xl border border-outline-variant shadow-sm space-y-8">
            <h3 class="text-[10px] font-black uppercase text-primary tracking-[0.2em] border-b border-outline-variant pb-4">Détails de la rencontre</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                @foreach(['equipe_domicile_id' => 'Équipe Domicile', 'equipe_visiteur_id' => 'Équipe Visiteur'] as $name => $label)
                <div class="space-y-2">
                    <label class="text-[9px] font-black uppercase text-on-surface-muted ml-1">{{ $label }}</label>
                    <select name="{{ $name }}" class="w-full bg-background border border-outline-variant rounded-xl px-4 py-3 font-bold text-sm">
                        @foreach($equipes as $e)
                            <option value="{{ $e->id }}" {{ $match->$name == $e->id ? 'selected' : '' }}>{{ $e->nom }}</option>
                        @endforeach
                    </select>
                </div>
                @endforeach

                <div class="space-y-2">
                    <label class="text-[9px] font-black uppercase text-on-surface-muted ml-1">Date & Heure</label>
                    <input type="datetime-local" name="date_heure" value="{{ \Carbon\Carbon::parse($match->date_heure)->format('Y-m-d\TH:i') }}" class="w-full bg-background border border-outline-variant rounded-xl px-4 py-3 font-bold text-sm">
                </div>
                
                <div class="space-y-2">
                    <label class="text-[9px] font-black uppercase text-on-surface-muted ml-1">Statut</label>
                    <select name="statut" class="w-full bg-background border border-outline-variant rounded-xl px-4 py-3 font-bold text-sm">
                        @foreach(['en_attente', 'confirmer', 'jouer', 'annuler', 'reporter'] as $status)
                            <option value="{{ $status }}" {{ $match->statut == $status ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4">
            <button type="submit" class="flex-1 bg-primary text-white py-4 rounded-xl font-black uppercase tracking-widest hover:bg-primary-dark shadow-lg transition-all text-xs">
                Mettre à jour
            </button>
            <a href="{{ route('admin.matchs.index') }}" class="px-8 py-4 bg-surface border border-outline-variant rounded-xl font-black uppercase text-[10px] text-center">Annuler</a>
        </div>
    </form>
</div>
@endsection