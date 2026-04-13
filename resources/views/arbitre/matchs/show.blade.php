@extends('layouts.arbitre')

@section('arbitre-content')
<div class="max-w-3xl mx-auto space-y-6">

    {{-- Back --}}
    <a href="{{ route('arbitre.matchs.index') }}" class="inline-flex items-center gap-2 text-xs font-black text-slate-400 hover:text-[#1B6B3A] uppercase tracking-widest transition-all">
        <span class="material-symbols-outlined text-sm">arrow_back</span> Retour
    </a>

    {{-- Header match --}}
    <div class="bg-[#1B6B3A] rounded-3xl px-8 py-8 text-white">
        <p class="text-[10px] font-black uppercase tracking-widest text-white/50 mb-3">
            {{ \Carbon\Carbon::parse($match->date_heure)->isoFormat('dddd D MMMM YYYY — HH:mm') }}
        </p>
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div class="text-center">
                <p class="text-xl font-black uppercase tracking-tight">{{ $match->equipeDomicile->nom ?? '?' }}</p>
                <p class="text-[10px] text-white/50 font-bold uppercase mt-1">Domicile</p>
            </div>
            <div class="text-4xl font-black text-[#C9A84C]">VS</div>
            <div class="text-center">
                <p class="text-xl font-black uppercase tracking-tight">{{ $match->equipeVisiteur->nom ?? '?' }}</p>
                <p class="text-[10px] text-white/50 font-bold uppercase mt-1">Visiteur</p>
            </div>
        </div>
        <div class="mt-6 flex flex-wrap gap-4 text-[11px] font-bold text-white/60 uppercase tracking-widest">
            <span>📍 {{ $match->terrain }}, {{ $match->ville }}</span>
            <span>🏆 {{ $match->categorie->nom ?? '—' }}</span>
            <span>💰 {{ number_format($match->categorie->montant ?? 0, 2) }} MAD</span>
        </div>
    </div>

    {{-- Corps Arbitral --}}
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-8 py-5 border-b border-slate-50">
            <h2 class="font-black text-slate-800 uppercase tracking-tight text-sm">Corps Arbitral</h2>
        </div>

        @php
            $corps = [
                ['role' => 'Arbitre Central', 'obj' => $match->arbitreCentral],
                ['role' => 'Assistant 1',     'obj' => $match->assistant1],
                ['role' => 'Assistant 2',     'obj' => $match->assistant2],
                ['role' => '4ème Arbitre',    'obj' => $match->quatrieme],
            ];
        @endphp

        @foreach($corps as $item)
            @if($item['obj'])
            @php $isMe = $item['obj']->id == $arbitreId; @endphp
            <div class="px-8 py-4 border-b border-slate-50 last:border-0 flex items-center justify-between
                {{ $isMe ? 'bg-[#1B6B3A]/5' : '' }}">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full {{ $isMe ? 'bg-[#1B6B3A]' : 'bg-slate-100' }} flex items-center justify-center font-black text-sm {{ $isMe ? 'text-white' : 'text-slate-500' }} uppercase">
                        {{ substr($item['obj']->user->name ?? '?', 0, 1) }}
                    </div>
                    <div>
                        <p class="font-black text-slate-800 text-sm uppercase {{ $isMe ? 'text-[#1B6B3A]' : '' }}">
                            {{ $item['obj']->user->name ?? '—' }}
                            @if($isMe) <span class="text-[9px] font-bold text-[#1B6B3A] ml-1">(Vous)</span> @endif
                        </p>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">{{ $item['role'] }}</p>
                    </div>
                </div>
                <span class="text-[9px] font-black uppercase tracking-widest px-2 py-1 rounded-full
                    {{ $item['obj']->grade === 'international' ? 'bg-yellow-100 text-yellow-700' : ($item['obj']->grade === 'national' ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-500') }}">
                    {{ $item['obj']->grade }}
                </span>
            </div>
            @endif
        @endforeach
    </div>

    {{-- Statut --}}
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm px-8 py-6 flex items-center justify-between">
        <p class="font-black text-slate-600 uppercase tracking-widest text-xs">Statut du match</p>
        @php
            $statusColor = match($match->statut) {
                'confirmer' => 'bg-emerald-100 text-emerald-700',
                'jouer'     => 'bg-blue-100 text-blue-700',
                'annuler'   => 'bg-red-100 text-red-500',
                'reporter'  => 'bg-purple-100 text-purple-600',
                default     => 'bg-orange-100 text-orange-600',
            };
            $statusLabel = match($match->statut) {
                'confirmer' => 'Confirmé',
                'jouer'     => 'Joué',
                'annuler'   => 'Annulé',
                'reporter'  => 'Reporté',
                default     => 'En attente',
            };
        @endphp
        <span class="text-sm font-black uppercase tracking-widest px-5 py-2 rounded-full {{ $statusColor }}">
            {{ $statusLabel }}
        </span>
    </div>

</div>
@endsection