@extends('layouts.arbitre')

@section('arbitre-content')
<div class="space-y-10">

    {{-- Greeting --}}
    <div>
        <h1 class="text-3xl font-black text-slate-800 uppercase tracking-tighter">
            Bonjour, {{ auth()->user()->name }} 👋
        </h1>
        <p class="text-slate-400 text-sm mt-1 font-medium">
            {{ ucfirst(auth()->user()->arbitre->grade) }} —
            {{ \Carbon\Carbon::now()->isoFormat('dddd D MMMM YYYY') }}
        </p>
    </div>

    {{-- Cards stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Total Indemnités --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm px-8 py-6 flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-[#1B6B3A]/10 flex items-center justify-center">
                <span class="material-symbols-outlined text-[#1B6B3A] text-2xl">account_balance_wallet</span>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Indemnités</p>
                <p class="text-2xl font-black text-slate-800 mt-1">{{ number_format($totalIndemnites, 2) }} <span class="text-xs text-slate-400">MAD</span></p>
            </div>
        </div>

        {{-- Total Payé --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm px-8 py-6 flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center">
                <span class="material-symbols-outlined text-emerald-500 text-2xl">verified</span>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Déjà Payé</p>
                <p class="text-2xl font-black text-emerald-600 mt-1">{{ number_format($totalPaye, 2) }} <span class="text-xs text-slate-400">MAD</span></p>
            </div>
        </div>

        {{-- En Attente --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm px-8 py-6 flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-orange-50 flex items-center justify-center">
                <span class="material-symbols-outlined text-orange-400 text-2xl">hourglass_empty</span>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">En Attente</p>
                <p class="text-2xl font-black text-orange-500 mt-1">{{ number_format($totalAttente, 2) }} <span class="text-xs text-slate-400">MAD</span></p>
            </div>
        </div>
    </div>

    {{-- Prochains Matchs --}}
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-8 py-5 border-b border-slate-50 flex justify-between items-center">
            <h2 class="font-black text-slate-800 uppercase tracking-tight text-sm">Prochains Matchs</h2>
            <a href="{{ route('arbitre.matchs.index') }}" class="text-[10px] font-black text-[#1B6B3A] uppercase tracking-widest hover:underline">
                Voir tous →
            </a>
        </div>

        @forelse($upcomingMatches as $match)
        <div class="px-8 py-5 border-b border-slate-50 last:border-0 flex flex-wrap items-center justify-between gap-4 hover:bg-slate-50/50 transition-all">
            <div class="flex items-center gap-5">
                {{-- Date --}}
                <div class="text-center bg-[#1B6B3A]/5 rounded-2xl px-4 py-3 min-w-[60px]">
                    <p class="text-[10px] font-black text-[#1B6B3A] uppercase">{{ \Carbon\Carbon::parse($match->date_heure)->format('M') }}</p>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ \Carbon\Carbon::parse($match->date_heure)->format('d') }}</p>
                </div>
                {{-- Match --}}
                <div>
                    <p class="font-black text-slate-800 text-sm uppercase tracking-tight">
                        {{ $match->equipeDomicile->nom ?? '?' }}
                        <span class="text-slate-300 font-light mx-1">vs</span>
                        {{ $match->equipeVisiteur->nom ?? '?' }}
                    </p>
                    <p class="text-[11px] text-slate-400 font-bold mt-0.5">
                        {{ $match->terrain }} — {{ \Carbon\Carbon::parse($match->date_heure)->format('H:i') }}
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-[9px] font-black uppercase tracking-widest px-3 py-1 rounded-full
                    {{ $match->statut === 'confirmer' ? 'bg-emerald-100 text-emerald-700' : 'bg-orange-100 text-orange-600' }}">
                    {{ $match->statut === 'confirmer' ? 'Confirmé' : 'En attente' }}
                </span>
                <a href="{{ route('arbitre.matchs.show', $match->id) }}"
                   class="text-[10px] font-black text-slate-400 hover:text-[#1B6B3A] uppercase tracking-widest transition-all">
                    Détails →
                </a>
            </div>
        </div>
        @empty
        <div class="px-8 py-12 text-center text-slate-400 text-xs font-bold uppercase tracking-widest">
            Aucun match prévu prochainement ⚽
        </div>
        @endforelse
    </div>

    {{-- Matchs Joués --}}
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-8 py-5 border-b border-slate-50">
            <h2 class="font-black text-slate-800 uppercase tracking-tight text-sm">Matchs Joués</h2>
        </div>

        @forelse($playedMatches as $match)
        @php
            $paiement = \Illuminate\Support\Facades\DB::table('paiements')
                ->where('arbitre_id', auth()->user()->arbitre->id)
                ->where('mois', $match->id)
                ->first();
            $statut = $paiement->statut ?? 'en_attente';
        @endphp
        <div class="px-8 py-5 border-b border-slate-50 last:border-0 flex flex-wrap items-center justify-between gap-4 hover:bg-slate-50/50 transition-all">
            <div class="flex items-center gap-5">
                <div class="text-center bg-slate-50 rounded-2xl px-4 py-3 min-w-[60px]">
                    <p class="text-[10px] font-black text-slate-400 uppercase">{{ \Carbon\Carbon::parse($match->date_heure)->format('M') }}</p>
                    <p class="text-2xl font-black text-slate-600 leading-none">{{ \Carbon\Carbon::parse($match->date_heure)->format('d') }}</p>
                </div>
                <div>
                    <p class="font-black text-slate-700 text-sm uppercase tracking-tight">
                        {{ $match->equipeDomicile->nom ?? '?' }}
                        <span class="text-slate-300 font-light mx-1">vs</span>
                        {{ $match->equipeVisiteur->nom ?? '?' }}
                    </p>
                    <p class="text-[11px] text-slate-400 font-bold mt-0.5">
                        {{ $match->categorie->nom ?? '—' }} — {{ number_format($match->categorie->montant ?? 0, 2) }} MAD
                    </p>
                </div>
            </div>
            <span class="text-[9px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full
                {{ $statut === 'paye' ? 'bg-emerald-100 text-emerald-700' : ($statut === 'non_paye' ? 'bg-red-100 text-red-500' : 'bg-orange-100 text-orange-600') }}">
                {{ $statut === 'paye' ? '✓ Payé' : ($statut === 'non_paye' ? '✗ Non payé' : '⏳ En attente') }}
            </span>
        </div>
        @empty
        <div class="px-8 py-12 text-center text-slate-400 text-xs font-bold uppercase tracking-widest">
            Aucun match joué pour le moment
        </div>
        @endforelse
    </div>

</div>
@endsection