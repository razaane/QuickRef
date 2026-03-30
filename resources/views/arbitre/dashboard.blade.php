@extends('layouts.guest')

@section('title', 'Tableau de Bord — QuickRef Arbitre')

@section('arbitre-content')

    {{-- Header --}}
    <header class="mb-12 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-4xl font-extrabold font-headline tracking-tight text-on-surface mb-2">
                Bonjour, {{ auth()->user()->name ?? 'Mehdi' }}
            </h1>
            <p class="text-on-surface-variant text-lg">
                Préparation pour vos {{ isset($upcomingMatches) ? $upcomingMatches->count() : 0 }} prochains matchs.
            </p>
        </div>

        <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-xl shadow-sm border border-outline-variant">
            <span class="material-symbols-outlined text-tertiary">verified</span>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">
                    Statut Actuel
                </p>
                <p class="text-sm font-bold font-headline">
                    {{ optional(auth()->user()->arbitre)->grade ?? 'Non défini' }}
                </p>
            </div>
        </div>
    </header>

    {{-- Content --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

        {{-- LEFT --}}
        <section class="lg:col-span-8 space-y-6">

            <h2 class="text-xl font-bold font-headline mb-4">
                Désignations à venir
            </h2>

            @forelse ($upcomingMatches ?? [] as $match)
                <div class="bg-white p-6 rounded-xl shadow border">
                    
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-lg font-bold">
                            {{ $match->home_team }} vs {{ $match->away_team }}
                        </h3>

                        <span class="text-xs font-bold px-3 py-1 rounded-full
                            {{ $match->pivot->role === 'central' ? 'bg-secondary text-white' : 'bg-primary text-white' }}">
                            {{ $match->pivot->role }}
                        </span>
                    </div>

                    <p class="text-sm text-gray-500">
                        📍 {{ $match->stadium }}
                    </p>

                    <p class="text-sm text-gray-500">
                        🕒 {{ \Carbon\Carbon::parse($match->kickoff)->format('H:i') }}
                    </p>

                </div>
            @empty
                <p class="text-gray-500">Aucun match prévu.</p>
            @endforelse

        </section>

        {{-- RIGHT --}}
        <aside class="lg:col-span-4 space-y-6">

            <div class="bg-primary text-white p-6 rounded-xl shadow">
                <h2 class="text-sm uppercase opacity-70 mb-2">
                    Indemnités
                </h2>

                <p class="text-3xl font-bold">
                    {{ $monthlyPayment ?? 0 }} MAD
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow border">
                <h3 class="font-bold mb-4">Notes</h3>

                @forelse ($technicalNotes ?? [] as $note)
                    <div class="mb-3">
                        <p class="font-semibold text-sm">{{ $note->title }}</p>
                        <p class="text-xs text-gray-500">
                            {{ $note->created_at->diffForHumans() }}
                        </p>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm">Aucune note.</p>
                @endforelse
            </div>

        </aside>

    </div>

@endsection