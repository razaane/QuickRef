@extends('layouts.arbitre')

@section('arbitre-content')
<div class="space-y-6">

    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-slate-800 uppercase tracking-tighter">Mes Matchs</h1>
            <p class="text-slate-400 text-sm mt-1">Tous vos matchs désignés</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        @forelse($matchs as $match)
        @php
            $arbitreId = auth()->user()->arbitre->id;
            $role = '';
            if ($match->arbitre_central_id == $arbitreId)      $role = 'Arbitre Central';
            elseif ($match->arbitre_assistant1_id == $arbitreId) $role = 'Assistant 1';
            elseif ($match->arbitre_assistant2_id == $arbitreId) $role = 'Assistant 2';
            elseif ($match->quatrieme_arbitre_id == $arbitreId)  $role = '4ème Arbitre';

            $statusColor = match($match->statut) {
                'confirmer'  => 'bg-emerald-100 text-emerald-700',
                'jouer'      => 'bg-blue-100 text-blue-700',
                'annuler'    => 'bg-red-100 text-red-500',
                'reporter'   => 'bg-purple-100 text-purple-600',
                default      => 'bg-orange-100 text-orange-600',
            };
            $statusLabel = match($match->statut) {
                'confirmer'  => 'Confirmé',
                'jouer'      => 'Joué',
                'annuler'    => 'Annulé',
                'reporter'   => 'Reporté',
                default      => 'En attente',
            };
        @endphp
        <div class="px-8 py-6 border-b border-slate-50 last:border-0 flex flex-wrap items-center justify-between gap-4 hover:bg-slate-50/30 transition-all">
            
            {{-- Date + Match --}}
            <div class="flex items-center gap-5">
                <div class="text-center rounded-2xl px-4 py-3 min-w-[60px]
                    {{ $match->statut === 'jouer' ? 'bg-slate-100' : 'bg-[#1B6B3A]/5' }}">
                    <p class="text-[10px] font-black uppercase {{ $match->statut === 'jouer' ? 'text-slate-400' : 'text-[#1B6B3A]' }}">
                        {{ \Carbon\Carbon::parse($match->date_heure)->format('M') }}
                    </p>
                    <p class="text-2xl font-black text-slate-800 leading-none">
                        {{ \Carbon\Carbon::parse($match->date_heure)->format('d') }}
                    </p>
                    <p class="text-[9px] text-slate-400 font-bold">
                        {{ \Carbon\Carbon::parse($match->date_heure)->format('H:i') }}
                    </p>
                </div>
                <div>
                    <p class="font-black text-slate-800 text-sm uppercase tracking-tight">
                        {{ $match->equipeDomicile->nom ?? '?' }}
                        <span class="text-slate-300 font-light mx-1">vs</span>
                        {{ $match->equipeVisiteur->nom ?? '?' }}
                    </p>
                    <p class="text-[11px] text-slate-400 font-bold mt-1">
                        {{ $match->terrain }} — {{ $match->ville }}
                    </p>
                    <div class="flex items-center gap-2 mt-1.5">
                        <span class="text-[9px] font-black uppercase tracking-widest px-2 py-0.5 rounded-full bg-slate-100 text-slate-500">
                            {{ $role }}
                        </span>
                        <span class="text-[9px] text-slate-300">•</span>
                        <span class="text-[9px] font-bold text-slate-400">{{ $match->categorie->nom ?? '—' }}</span>
                    </div>
                </div>
            </div>

            {{-- Statut + Montant + Détails --}}
            <div class="flex items-center gap-4">
                <p class="text-lg font-black text-slate-700">
                    {{ number_format($match->categorie->montant ?? 0, 2) }} <span class="text-xs text-slate-400">MAD</span>
                </p>
                <span class="text-[9px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full {{ $statusColor }}">
                    {{ $statusLabel }}
                </span>
                <a href="{{ route('arbitre.matchs.show', $match->id) }}"
                   class="text-[10px] font-black text-slate-400 hover:text-[#1B6B3A] uppercase tracking-widest transition-all">
                    Voir →
                </a>
            </div>
        </div>
        @empty
        <div class="px-8 py-16 text-center text-slate-400 text-xs font-bold uppercase tracking-widest">
            Aucun match désigné pour le moment ⚽
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $matchs->links() }}
    </div>

</div>
@endsection