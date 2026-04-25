@extends('layouts.admin')

@section('admin-content')
<div class="max-w-4xl mx-auto p-4 lg:p-6">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-black text-on-surface uppercase tracking-tight">
            Modifier le Match #{{ $match->id }}
        </h1>
        <p class="text-on-surface-muted text-sm">
            Édition des informations du match
        </p>
    </div>

    {{-- Errors --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
            <ul class="text-red-600 text-xs font-bold space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.matchs.update', $match->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- MATCH DETAILS --}}
        <div class="bg-surface p-6 rounded-2xl border border-outline-variant space-y-6">

            <h3 class="text-xs font-black uppercase text-primary">
                Détails du match
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Equipe domicile --}}
                <div>
                    <label class="text-xs font-bold text-on-surface-muted">Équipe Domicile</label>
                    <select name="equipe_domicile_id" class="w-full border rounded-xl p-3">
                        @foreach($equipes as $e)
                            <option value="{{ $e->id }}" {{ $match->equipe_domicile_id == $e->id ? 'selected' : '' }}>
                                {{ $e->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Equipe visiteur --}}
                <div>
                    <label class="text-xs font-bold text-on-surface-muted">Équipe Visiteur</label>
                    <select name="equipe_visiteur_id" class="w-full border rounded-xl p-3">
                        @foreach($equipes as $e)
                            <option value="{{ $e->id }}" {{ $match->equipe_visiteur_id == $e->id ? 'selected' : '' }}>
                                {{ $e->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Date --}}
                <div>
                    <label class="text-xs font-bold text-on-surface-muted">Date & Heure</label>
                    <input type="datetime-local"
                           name="date_heure"
                           value="{{ \Carbon\Carbon::parse($match->date_heure)->format('Y-m-d\TH:i') }}"
                           class="w-full border rounded-xl p-3">
                </div>

                {{-- Statut --}}
                <div>
                    <label class="text-xs font-bold text-on-surface-muted">Statut</label>
                    <select name="statut" class="w-full border rounded-xl p-3">
                        @foreach(['en_attente','confirmer','jouer','annuler','reporter'] as $status)
                            <option value="{{ $status }}" {{ $match->statut == $status ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_',' ',$status)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Terrain --}}
                <div>
                    <label class="text-xs font-bold text-on-surface-muted">Terrain</label>
                    <input type="text"
                           name="terrain"
                           value="{{ $match->terrain }}"
                           class="w-full border rounded-xl p-3">
                </div>

                {{-- Ville --}}
                <div>
                    <label class="text-xs font-bold text-on-surface-muted">Ville</label>
                    <input type="text"
                           name="ville"
                           value="{{ $match->ville }}"
                           class="w-full border rounded-xl p-3">
                </div>

            </div>
        </div>

        {{-- ARBITRES --}}
        <div class="bg-surface p-6 rounded-2xl border border-outline-variant space-y-6">

            <h3 class="text-xs font-black uppercase text-primary">
                Arbitres
            </h3>

            @foreach([
                'arbitre_central_id' => 'Arbitre Central',
                'arbitre_assistant1_id' => 'Assistant 1',
                'arbitre_assistant2_id' => 'Assistant 2',
                'quatrieme_arbitre_id' => '4ème Arbitre (optionnel)'
            ] as $field => $label)

                <div>
                    <label class="text-xs font-bold text-on-surface-muted">
                        {{ $label }}
                    </label>

                    <select name="{{ $field }}" class="w-full border rounded-xl p-3">

                        <option value="">-- Aucun --</option>

                        @foreach($arbitres as $a)
                            <option value="{{ $a->id }}"
                                {{ $match->$field == $a->id ? 'selected' : '' }}>
                                {{ $a->user->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

            @endforeach

        </div>

        {{-- BUTTONS --}}
        <div class="flex gap-4">
            <button type="submit"
                    class="flex-1 bg-primary text-white py-3 rounded-xl font-black uppercase">
                Mettre à jour
            </button>

            <a href="{{ route('admin.matchs.index') }}"
               class="px-6 py-3 border rounded-xl font-black uppercase text-center">
                Annuler
            </a>
        </div>

    </form>
</div>
@endsection