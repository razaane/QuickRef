@extends('layouts.arbitre')

@section('arbitre-content')
<div class="space-y-8">
    <div>
        <h1 class="text-3xl font-black text-on-surface uppercase tracking-tighter">Mes Désignations</h1>
        <p class="text-on-surface-muted text-[10px] font-black uppercase tracking-[0.2em] mt-1">Historique complet des rencontres</p>
    </div>

    <div class="bg-surface rounded-xl border border-outline-variant shadow-sm overflow-hidden divide-y divide-outline-variant">
        @forelse($matchs as $match)
        @php
            $arbitreId = auth()->user()->arbitre->id;
            $role = match(true) {
                $match->arbitre_central_id == $arbitreId => 'Central',
                $match->arbitre_assistant1_id == $arbitreId => 'Assistant 1',
                $match->arbitre_assistant2_id == $arbitreId => 'Assistant 2',
                $match->quatrieme_arbitre_id == $arbitreId => '4ème Arbitre',
                default => 'Arbitre'
            };
        @endphp
        <div class="px-8 py-6 flex flex-wrap items-center justify-between gap-6 hover:bg-on-surface/[0.01] transition-colors">
            <div class="flex items-center gap-6">
                <div class="text-center bg-background border border-outline-variant rounded-xl px-4 py-3 min-w-[70px]">
                    <p class="text-[9px] font-black text-primary uppercase">{{ \Carbon\Carbon::parse($match->date_heure)->format('M') }}</p>
                    <p class="text-2xl font-black text-on-surface leading-none">{{ \Carbon\Carbon::parse($match->date_heure)->format('d') }}</p>
                    <p class="text-[8px] text-on-surface-muted font-bold mt-1 uppercase">{{ \Carbon\Carbon::parse($match->date_heure)->format('H:i') }}</p>
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-[8px] font-black px-1.5 py-0.5 rounded bg-primary text-white uppercase tracking-widest">{{ $role }}</span>
                        <span class="text-[8px] font-black text-on-surface-muted uppercase tracking-widest italic opacity-60">{{ $match->categorie->nom ?? '—' }}</span>
                    </div>
                    <p class="font-black text-on-surface text-base uppercase tracking-tight">
                        {{ $match->equipeDomicile->nom ?? '?' }} <span class="text-primary mx-1">VS</span> {{ $match->equipeVisiteur->nom ?? '?' }}
                    </p>
                    <p class="text-[10px] text-on-surface-muted font-bold mt-1 uppercase tracking-wider">📍 {{ $match->terrain }} — {{ $match->ville }}</p>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <div class="text-right">
                    <p class="text-[8px] font-black text-on-surface-muted uppercase tracking-widest mb-0.5">Indemnité</p>
                    <p class="text-lg font-black text-on-surface">{{ number_format($match->categorie->montant ?? 0, 0) }} <span class="text-[10px] opacity-40">DH</span></p>
                </div>
                <div class="h-10 w-[1px] bg-outline-variant"></div>
                <a href="{{ route('arbitre.matchs.show', $match->id) }}" class="p-3 rounded-lg bg-background border border-outline-variant text-on-surface-muted hover:text-primary hover:border-primary transition-all shadow-sm">
                    <span class="material-symbols-outlined text-lg">visibility</span>
                </a>
            </div>
        </div>
        @empty
        <div class="p-20 text-center text-on-surface-muted font-black uppercase text-xs tracking-[0.2em] opacity-30">Aucun match désigné</div>
        @endforelse
    </div>

    <div class="mt-4">{{ $matchs->links() }}</div>
</div>
@endsection