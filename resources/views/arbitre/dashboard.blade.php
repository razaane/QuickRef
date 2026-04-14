@extends('layouts.arbitre')

@section('arbitre-content')
<div class="space-y-10">

    {{-- Greeting --}}
    <div>
        <h1 class="text-3xl font-black text-on-surface uppercase tracking-tighter">
            Bonjour, {{ auth()->user()->name }} 👋
        </h1>
        <p class="text-on-surface-muted text-[11px] font-black uppercase tracking-widest mt-1">
            {{ ucfirst(auth()->user()->arbitre->grade) }} —
            {{ \Carbon\Carbon::now()->isoFormat('dddd D MMMM YYYY') }}
        </p>
    </div>

    {{-- Cards stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Total Indemnités --}}
        <div class="bg-surface rounded-xl border border-outline-variant shadow-sm px-8 py-6 flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-on-surface/5 flex items-center justify-center">
                <span class="material-symbols-outlined text-on-surface text-2xl">account_balance_wallet</span>
            </div>
            <div>
                <p class="text-[10px] font-black text-on-surface-muted uppercase tracking-widest">Total Indemnités</p>
                <p class="text-2xl font-black text-on-surface mt-1">{{ number_format($totalIndemnites, 2) }} <span class="text-xs opacity-40">MAD</span></p>
            </div>
        </div>

        {{-- Total Payé --}}
        <div class="bg-surface rounded-xl border border-outline-variant shadow-sm px-8 py-6 flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-emerald-500/10 flex items-center justify-center">
                <span class="material-symbols-outlined text-emerald-500 text-2xl">verified</span>
            </div>
            <div>
                <p class="text-[10px] font-black text-on-surface-muted uppercase tracking-widest">Déjà Payé</p>
                <p class="text-2xl font-black text-emerald-600 mt-1">{{ number_format($totalPaye, 2) }} <span class="text-xs opacity-40">MAD</span></p>
            </div>
        </div>

        {{-- En Attente --}}
        <div class="bg-surface rounded-xl border border-outline-variant shadow-sm px-8 py-6 flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center">
                <span class="material-symbols-outlined text-primary text-2xl">hourglass_empty</span>
            </div>
            <div>
                <p class="text-[10px] font-black text-on-surface-muted uppercase tracking-widest">En Attente</p>
                <p class="text-2xl font-black text-primary mt-1">{{ number_format($totalAttente, 2) }} <span class="text-xs opacity-40">MAD</span></p>
            </div>
        </div>
    </div>

    {{-- Prochains Matchs --}}
    <div class="bg-surface rounded-xl border border-outline-variant shadow-sm overflow-hidden">
        <div class="px-8 py-5 border-b border-outline-variant flex justify-between items-center bg-background/50">
            <h2 class="font-black text-on-surface uppercase tracking-tight text-sm">Prochains Matchs</h2>
            <a href="{{ route('arbitre.matchs.index') }}" class="text-[10px] font-black text-primary uppercase tracking-widest hover:underline">
                Voir tous →
            </a>
        </div>

        @forelse($upcomingMatches as $match)
        <div class="px-8 py-5 border-b border-outline-variant last:border-0 flex flex-wrap items-center justify-between gap-4 hover:bg-on-surface/[0.02] transition-all">
            <div class="flex items-center gap-5">
                <div class="text-center bg-primary/5 border border-primary/10 rounded-2xl px-4 py-3 min-w-[60px]">
                    <p class="text-[10px] font-black text-primary uppercase">{{ \Carbon\Carbon::parse($match->date_heure)->format('M') }}</p>
                    <p class="text-2xl font-black text-on-surface leading-none">{{ \Carbon\Carbon::parse($match->date_heure)->format('d') }}</p>
                </div>
                <div>
                    <p class="font-black text-on-surface text-sm uppercase tracking-tight">
                        {{ $match->equipeDomicile->nom ?? '?' }}
                        <span class="text-primary font-light mx-1">vs</span>
                        {{ $match->equipeVisiteur->nom ?? '?' }}
                    </p>
                    <p class="text-[11px] text-on-surface-muted font-bold mt-0.5 uppercase">
                        {{ $match->terrain }} — {{ \Carbon\Carbon::parse($match->date_heure)->format('H:i') }}
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-[9px] font-black uppercase tracking-widest px-3 py-1 rounded-full border
                    {{ $match->statut === 'confirmer' ? 'border-emerald-500/20 text-emerald-600 bg-emerald-500/5' : 'border-primary/20 text-primary bg-primary/5' }}">
                    {{ $match->statut === 'confirmer' ? 'Confirmé' : 'En attente' }}
                </span>
                <a href="{{ route('arbitre.matchs.show', $match->id) }}"
                   class="p-2 text-on-surface-muted hover:text-primary transition-all">
                    <span class="material-symbols-outlined text-sm">arrow_forward_ios</span>
                </a>
            </div>
        </div>
        @empty
        <div class="px-8 py-12 text-center text-on-surface-muted text-xs font-black uppercase tracking-widest opacity-50">
            Aucun match prévu prochainement ⚽
        </div>
        @endforelse
    </div>

    {{-- Matchs Joués --}}
    <div class="bg-surface rounded-xl border border-outline-variant shadow-sm overflow-hidden">
        <div class="px-8 py-5 border-b border-outline-variant bg-background/50">
            <h2 class="font-black text-on-surface uppercase tracking-tight text-sm">Matchs Joués & Statut Paiement</h2>
        </div>

        @forelse($playedMatches as $match)
        @php
            $paiement = \Illuminate\Support\Facades\DB::table('paiements')
                ->where('arbitre_id', auth()->user()->arbitre->id)
                ->where('mois', $match->id)
                ->first();
            $statut = $paiement->statut ?? 'en_attente';
        @endphp
        <div class="px-8 py-5 border-b border-outline-variant last:border-0 flex flex-wrap items-center justify-between gap-4 hover:bg-on-surface/[0.02] transition-all">
            <div class="flex items-center gap-5">
                <div class="text-center bg-background border border-outline-variant rounded-2xl px-4 py-3 min-w-[60px]">
                    <p class="text-[10px] font-black text-on-surface-muted uppercase">{{ \Carbon\Carbon::parse($match->date_heure)->format('M') }}</p>
                    <p class="text-2xl font-black text-on-surface-muted leading-none">{{ \Carbon\Carbon::parse($match->date_heure)->format('d') }}</p>
                </div>
                <div>
                    <p class="font-black text-on-surface text-sm uppercase tracking-tight">
                        {{ $match->equipeDomicile->nom ?? '?' }}
                        <span class="text-primary font-light mx-1">vs</span>
                        {{ $match->equipeVisiteur->nom ?? '?' }}
                    </p>
                    <p class="text-[11px] text-on-surface-muted font-bold mt-0.5 uppercase">
                         {{ number_format($match->categorie->montant ?? 0, 2) }} MAD
                    </p>
                </div>
            </div>
            <span class="text-[9px] font-black uppercase tracking-widest px-3 py-1.5 rounded-lg border
                {{ $statut === 'paye' ? 'border-emerald-500/20 text-emerald-600 bg-emerald-500/5' : ($statut === 'non_paye' ? 'border-primary/20 text-primary bg-primary/5' : 'border-on-surface/10 text-on-surface-muted bg-on-surface/5') }}">
                {{ $statut === 'paye' ? '✓ Payé' : ($statut === 'non_paye' ? '✗ Refusé' : '⏳ En attente') }}
            </span>
        </div>
        @empty
        <div class="px-8 py-12 text-center text-on-surface-muted text-xs font-black uppercase tracking-widest opacity-50">
            Aucun match joué pour le moment
        </div>
        @endforelse
    </div>

</div>
@endsection