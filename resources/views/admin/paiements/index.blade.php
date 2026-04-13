@extends('layouts.admin')

@section('admin-content')
<div class="p-8 max-w-7xl mx-auto font-sans">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-center gap-6 mb-10">
        <div>
            <h2 class="text-3xl font-black text-slate-800 uppercase tracking-tighter">Indemnités Arbitres</h2>
            <p class="text-slate-400 font-medium text-sm mt-1">Matchs joués — paiement individuel par arbitre</p>
        </div>
        <div class="bg-white px-8 py-4 rounded-3xl border-2 border-emerald-100 shadow-xl flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-500 rounded-full flex items-center justify-center text-white">
                <span class="material-symbols-outlined">account_balance_wallet</span>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Restant à Payer</p>
                <p class="text-2xl font-black text-emerald-600">{{ number_format($totalAttente, 2) }} <span class="text-xs">MAD</span></p>
            </div>
        </div>
    </div>

    {{-- Un bloc par match --}}
    @forelse($matchs as $match)
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm mb-6 overflow-hidden">

        {{-- Header du match --}}
        <div class="bg-slate-50 border-b border-slate-100 px-8 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-xs font-black text-slate-400 uppercase tracking-widest">
                    {{ \Carbon\Carbon::parse($match->date_heure)->format('d/m/Y à H:i') }}
                    — {{ $match->terrain }}, {{ $match->ville }}
                </p>
                <p class="text-lg font-black text-slate-800 mt-1">
                    {{ $match->equipeDomicile->nom ?? '?' }} 
                    <span class="text-slate-300 font-light mx-2">vs</span> 
                    {{ $match->equipeVisiteur->nom ?? '?' }}
                </p>
            </div>
            <div class="text-right">
                <p class="text-[10px] font-black text-slate-400 uppercase">Catégorie</p>
                <p class="text-sm font-black text-slate-700">{{ $match->categorie->nom ?? '—' }}</p>
                <p class="text-xl font-black text-slate-800">{{ number_format($match->categorie->montant ?? 0, 2) }} <span class="text-xs text-slate-400">MAD / arbitre</span></p>
            </div>
        </div>

        {{-- Liste des arbitres du match --}}
        <div class="divide-y divide-slate-50">
            @php
                $arbitresMatch = [
                    ['role' => 'Arbitre Central',    'obj' => $match->arbitreCentral],
                    ['role' => 'Assistant 1',         'obj' => $match->assistant1],
                    ['role' => 'Assistant 2',         'obj' => $match->assistant2],
                    ['role' => '4ème Arbitre',        'obj' => $match->quatrieme],
                ];
            @endphp

            @foreach($arbitresMatch as $item)
                @if($item['obj'])
                @php
                    $arbitre = $item['obj'];
                    $paiement = \Illuminate\Support\Facades\DB::table('paiements')
                        ->where('arbitre_id', $arbitre->id)
                        ->where('mois', $match->id)
                        ->first();
                    $statut = $paiement->statut ?? 'en_attente';
                @endphp
                <div class="px-8 py-5 flex flex-wrap items-center justify-between gap-4">
                    
                    {{-- Infos arbitre --}}
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-black text-slate-500 text-sm uppercase">
                            {{ substr($arbitre->user->name ?? '?', 0, 1) }}
                        </div>
                        <div>
                            <p class="font-black text-slate-800 text-sm uppercase">{{ $arbitre->user->name ?? '—' }}</p>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span class="text-[9px] font-bold uppercase tracking-widest px-2 py-0.5 rounded-full
                                    {{ $arbitre->grade === 'international' ? 'bg-yellow-100 text-yellow-700' : ($arbitre->grade === 'national' ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-500') }}">
                                    {{ $arbitre->grade }}
                                </span>
                                <span class="text-[9px] text-slate-400 font-bold uppercase">{{ $item['role'] }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Montant + Actions --}}
                    <div class="flex items-center gap-6">
                        <p class="text-lg font-black text-slate-700">
                            {{ number_format($match->categorie->montant ?? 0, 2) }} MAD
                        </p>

                        @if($statut === 'paye')
                            <div class="flex items-center gap-3">
                                {{-- Badge --}}
                                <div class="flex flex-col items-center gap-1">
                                    <span class="material-symbols-outlined text-emerald-500 font-bold">verified</span>
                                    <span class="text-[8px] font-black text-emerald-500 uppercase tracking-widest">Payé</span>
                                    @if($paiement->date_paiement)
                                        <span class="text-[8px] text-slate-400">{{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y') }}</span>
                                    @endif
                                </div>

                                {{-- Bouton Refuser pour changer d'avis --}}
                                <form action="{{ route('admin.paiements.arbitre') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="arbitre_id" value="{{ $arbitre->id }}">
                                    <input type="hidden" name="match_id" value="{{ $match->id }}">
                                    <input type="hidden" name="statut" value="non_paye">
                                    <button type="submit" class="text-[9px] font-black text-slate-300 uppercase tracking-widest hover:text-red-400 transition-all underline">
                                        Refuser
                                    </button>
                                </form>
                            </div>

                        @elseif($statut === 'non_paye')
                            <div class="flex items-center gap-3">
                                {{-- Badge --}}
                                <div class="flex flex-col items-center gap-1">
                                    <span class="material-symbols-outlined text-red-400 font-bold">cancel</span>
                                    <span class="text-[8px] font-black text-red-400 uppercase tracking-widest">Non payé</span>
                                </div>

                                {{-- Bouton Payer pour changer d'avis --}}
                                <form action="{{ route('admin.paiements.arbitre') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="arbitre_id" value="{{ $arbitre->id }}">
                                    <input type="hidden" name="match_id" value="{{ $match->id }}">
                                    <input type="hidden" name="statut" value="paye">
                                    <button type="submit" class="text-[9px] font-black text-slate-300 uppercase tracking-widest hover:text-emerald-500 transition-all underline">
                                        Payer
                                    </button>
                                </form>
                            </div>

                        @else
                            {{-- Etat initial : les deux boutons --}}
                            <div class="flex gap-2">
                                <form action="{{ route('admin.paiements.arbitre') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="arbitre_id" value="{{ $arbitre->id }}">
                                    <input type="hidden" name="match_id" value="{{ $match->id }}">
                                    <input type="hidden" name="statut" value="paye">
                                    <button type="submit" class="bg-slate-900 text-white px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-500 transition-all">
                                        Payer
                                    </button>
                                </form>
                                <form action="{{ route('admin.paiements.arbitre') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="arbitre_id" value="{{ $arbitre->id }}">
                                    <input type="hidden" name="match_id" value="{{ $match->id }}">
                                    <input type="hidden" name="statut" value="non_paye">
                                    <button type="submit" class="bg-white border border-slate-200 text-slate-400 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:text-red-500 hover:border-red-200 transition-all">
                                        Refuser
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
    @empty
    <div class="text-center py-20 text-slate-400 font-medium italic uppercase text-xs">
        Aucun match avec statut "jouer" pour le moment ⚽
    </div>
    @endforelse

</div>
@endsection