@extends('layouts.arbitre')

@section('arbitre-content')
<div class="max-w-7xl mx-auto px-4 py-8">
    
    {{-- Header --}}
    <header class="mb-12 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-4xl font-extrabold tracking-tight text-slate-800 mb-2 uppercase">
                Bonjour, {{ explode(' ', auth()->user()->name)[0] }} 
            </h1>
            <p class="text-slate-500 text-lg">
                Préparation pour vos {{ $upcomingMatches->count() }} prochains matchs.
            </p>
        </div>

        <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-xl shadow-sm border border-slate-100">
            <span class="material-symbols-outlined text-[#C9A84C]">verified</span>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Statut Actuel</p>
                <p class="text-sm font-bold">{{ optional(auth()->user()->arbitre)->grade ?? 'National' }}</p>
            </div>
        </div>
    </header>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex items-center gap-6">
            <div class="w-12 h-12 bg-[#1B6B3A]/10 rounded-xl flex items-center justify-center text-[#1B6B3A]">
                <span class="material-symbols-outlined">payments</span>
            </div>
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Indemnités (Mois)</p>
                <p class="text-xl font-black text-slate-800">{{ number_format($monthlyPayment ?? 0, 0) }} MAD</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex items-center gap-6">
            <div class="w-12 h-12 bg-pink-50 rounded-xl flex items-center justify-center text-pink-400">
                <span class="material-symbols-outlined">sports_soccer</span>
            </div>
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Matchs à venir</p>
                <p class="text-xl font-black text-slate-800">{{ $upcomingMatches->count() }}</p>
            </div>
        </div>
    </div>

    {{-- Matchs List --}}
    <section class="space-y-6">
        <h2 class="text-xl font-bold mb-4">Désignations à venir</h2>

        @forelse($upcomingMatches as $match)
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 mb-4">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 class="text-lg font-black text-slate-800 uppercase">
                            {{ $match->equipeDomicile->nom }} vs {{ $match->equipeVisiteur->nom }}
                        </h3>
                        <p class="text-xs font-bold text-[#C9A84C] tracking-widest uppercase">
                            {{ $match->categorie->nom ?? 'Match' }}
                        </p>
                    </div>

                    @php
                        $role = '';
                        if($match->arbitre_central_id == $arbitreId) $role = 'Central';
                        elseif($match->arbitre_assistant1_id == $arbitreId) $role = 'Assistant 1';
                        elseif($match->arbitre_assistant2_id == $arbitreId) $role = 'Assistant 2';
                        else $role = '4ème Arbitre';
                    @endphp

                    <span class="text-[10px] font-black px-4 py-2 rounded-full uppercase tracking-tighter
                        {{ $role === 'Central' ? 'bg-[#1B6B3A] text-white' : 'bg-slate-100 text-slate-600' }}">
                        Role: {{ $role }}
                    </span>
                </div>

                {{-- Corps Arbitral (New Section) --}}
                <div class="mb-6 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                    <p class="text-[9px] font-black text-slate-400 uppercase mb-3">Corps Arbitral</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <p class="text-[9px] font-bold text-slate-400 uppercase">Central</p>
                            <p class="text-xs font-bold text-slate-700">{{ $match->arbitreCentral->user->name ?? '---' }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-bold text-slate-400 uppercase">Assistant 1</p>
                            <p class="text-xs font-bold text-slate-700">{{ $match->assistant1->user->name ?? '---' }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-bold text-slate-400 uppercase">Assistant 2</p>
                            <p class="text-xs font-bold text-slate-700">{{ $match->assistant2->user->name ?? '---' }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-bold text-slate-400 uppercase">4ème</p>
                            <p class="text-xs font-bold text-slate-700">{{ $match->quatrieme->user->name ?? '---' }}</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm font-medium text-slate-500 pt-4 border-t border-slate-50">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">location_on</span>
                        {{ $match->terrain }}, {{ $match->ville }}
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">schedule</span>
                        {{ \Carbon\Carbon::parse($match->date_heure)->format('d M Y | H:i') }}
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-slate-400 py-10 font-medium">Aucun match programmé pour le moment.</p>
        @endforelse
    </section>
</div>
@endsection