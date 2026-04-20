@extends('layouts.arbitre')

@section('arbitre-content')
<div class="space-y-8 lg:space-y-10 px-2 lg:px-0">

    {{-- Greeting --}}
    <div class="text-center lg:text-left">
        <h1 class="text-2xl lg:text-3xl font-black text-on-surface uppercase tracking-tighter">
            Bonjour, {{ explode(' ', auth()->user()->name)[0] }} 
        </h1>
        <p class="text-on-surface-muted text-[10px] lg:text-[11px] font-black uppercase tracking-widest mt-1">
            {{ ucfirst(auth()->user()->arbitre->grade) }} — {{ \Carbon\Carbon::now()->isoFormat('dddd D MMMM YYYY') }}
        </p>
    </div>

    {{-- Cards stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 lg:gap-6">
        @php
            $stats = [
                ['label' => 'Total Indemnités', 'val' => $totalIndemnites, 'icon' => 'account_balance_wallet', 'color' => 'bg-on-surface/5', 'text' => 'text-on-surface'],
                ['label' => 'Déjà Payé', 'val' => $totalPaye, 'icon' => 'verified', 'color' => 'bg-emerald-500/10', 'text' => 'text-emerald-500'],
                ['label' => 'En Attente', 'val' => $totalAttente, 'icon' => 'hourglass_empty', 'color' => 'bg-primary/10', 'text' => 'text-primary'],
            ];
        @endphp
        @foreach($stats as $s)
        <div class="bg-surface rounded-2xl border border-outline-variant shadow-sm px-6 py-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl {{ $s['color'] }} flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined {{ $s['text'] }} text-xl">{{ $s['icon'] }}</span>
            </div>
            <div>
                <p class="text-[9px] font-black text-on-surface-muted uppercase tracking-widest leading-none">{{ $s['label'] }}</p>
                <p class="text-xl font-black text-on-surface mt-1.5">{{ number_format($s['val'], 0) }} <span class="text-[10px] opacity-40">MAD</span></p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Prochains Matchs --}}
    <div class="bg-surface rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
        <div class="px-6 lg:px-8 py-5 border-b border-outline-variant flex justify-between items-center bg-background/50">
            <h2 class="font-black text-on-surface uppercase tracking-tight text-xs">Prochains Matchs</h2>
            <a href="{{ route('arbitre.matchs.index') }}" class="text-[9px] font-black text-primary uppercase tracking-widest hover:underline">Voir tous</a>
        </div>

        @forelse($upcomingMatches as $match)
        <div class="px-6 lg:px-8 py-5 border-b border-outline-variant last:border-0 flex items-center justify-between gap-4 hover:bg-on-surface/[0.02] transition-all">
            <div class="flex items-center gap-4">
                <div class="text-center bg-primary/5 border border-primary/10 rounded-xl px-2.5 py-2 min-w-[50px]">
                    <p class="text-[8px] font-black text-primary uppercase">{{ \Carbon\Carbon::parse($match->date_heure)->format('M') }}</p>
                    <p class="text-lg font-black text-on-surface leading-none">{{ \Carbon\Carbon::parse($match->date_heure)->format('d') }}</p>
                </div>
                <div>
                    <p class="font-black text-on-surface text-xs uppercase tracking-tight leading-tight">
                        {{ $match->equipeDomicile->nom ?? '?' }} <span class="text-primary italic">vs</span> {{ $match->equipeVisiteur->nom ?? '?' }}
                    </p>
                    <p class="text-[9px] text-on-surface-muted font-bold mt-1 uppercase">{{ \Carbon\Carbon::parse($match->date_heure)->format('H:i') }} — {{ $match->terrain }}</p>
                </div>
            </div>
            <a href="{{ route('arbitre.matchs.show', $match->id) }}" class="p-2 text-on-surface-muted hover:text-primary"><span class="material-symbols-outlined text-sm">arrow_forward_ios</span></a>
        </div>
        @empty
        <div class="px-8 py-12 text-center text-on-surface-muted text-[10px] font-black uppercase tracking-widest opacity-30">Aucun match prévu</div>
        @endforelse
    </div>

    {{-- Matchs Joués --}}
    <div class="bg-surface rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
        <div class="px-6 lg:px-8 py-5 border-b border-outline-variant bg-background/50">
            <h2 class="font-black text-on-surface uppercase tracking-tight text-xs">Matchs Joués & Paiements</h2>
        </div>
        @forelse($playedMatches as $match)
            @php
                $statut = $match->paiement_statut ?? 'en_attente';
            @endphp
            <div class="px-6 lg:px-8 py-5 border-b border-outline-variant last:border-0 flex items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-8 h-8 rounded-lg bg-background border border-outline-variant flex items-center justify-center">
                        <span class="material-symbols-outlined text-xs text-on-surface-muted">sports_soccer</span>
                    </div>
                    <div>
                        <p class="font-black text-on-surface text-xs uppercase">{{ $match->equipeDomicile->nom }} vs {{ $match->equipeVisiteur->nom }}</p>
                        <p class="text-[9px] text-on-surface-muted font-bold">{{ number_format($match->categorie->montant ?? 0, 0) }} MAD</p>
                    </div>
                </div>
                <span class="text-[7px] lg:text-[8px] font-black uppercase tracking-widest px-2 py-1 rounded border
                    {{ $statut === 'paye' ? 'border-emerald-500/20 text-emerald-600 bg-emerald-500/5' : 'border-on-surface/10 text-on-surface-muted bg-on-surface/5' }}">
                    {{ $statut === 'paye' ? 'Payé' : 'Attente' }}
                </span>
            </div>
        @empty
            <div class="px-8 py-10 text-center text-on-surface-muted text-[10px] font-black uppercase tracking-widest opacity-30">Aucun historique</div>
        @endforelse
    </div>
</div>
@endsection