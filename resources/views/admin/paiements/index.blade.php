@extends('layouts.admin')

@section('admin-content')
<div class="p-6 max-w-6xl mx-auto">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-10">
        <div>
            <h2 class="text-3xl font-black text-on-surface uppercase tracking-tighter">Indemnités Arbitres</h2>
            <p class="text-on-surface-muted font-medium text-sm">Gestion des paiements par match (Réf: mois)</p>
        </div>
        
        <div class="bg-surface px-6 py-4 rounded-xl border border-outline-variant shadow-sm flex items-center gap-4">
            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-xl">payments</span>
            </div>
            <div>
                <p class="text-[9px] font-black text-on-surface-muted uppercase tracking-[0.1em]">Total en attente</p>
                <p class="text-xl font-black text-on-surface">{{ number_format($totalAttente, 2) }} <span class="text-xs opacity-50">MAD</span></p>
            </div>
        </div>
    </div>

    @forelse($matchs as $match)
    <div class="bg-surface rounded-xl border border-outline-variant shadow-sm mb-8 overflow-hidden">

        {{-- Header du match --}}
        <div class="bg-background border-b border-outline-variant px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-[10px] font-black text-primary uppercase tracking-widest bg-primary/5 px-2 py-0.5 rounded">Match #{{ $match->id }}</span>
                    <span class="text-[10px] font-bold text-on-surface-muted uppercase italic">
                        {{ \Carbon\Carbon::parse($match->date_heure)->format('d/m/Y à H:i') }}
                    </span>
                </div>
                <p class="text-lg font-black text-on-surface uppercase tracking-tight">
                    {{ $match->equipeDomicile->nom ?? '?' }} 
                    <span class="text-primary mx-1">VS</span> 
                    {{ $match->equipeVisiteur->nom ?? '?' }}
                </p>
            </div>
            <div class="text-right">
                <p class="text-[9px] font-black text-on-surface-muted uppercase tracking-widest mb-1">Tarif</p>
                <p class="text-2xl font-black text-on-surface">{{ number_format($match->categorie->montant ?? 0, 0) }} <span class="text-xs opacity-40">MAD</span></p>
            </div>
        </div>

        {{-- Liste des arbitres --}}
        <div class="divide-y divide-outline-variant">
            @php
                $arbitresMatch = [
                    ['role' => 'Central',    'obj' => $match->arbitreCentral],
                    ['role' => 'Assistant 1', 'obj' => $match->assistant1],
                    ['role' => 'Assistant 2', 'obj' => $match->assistant2],
                    ['role' => '4ème',        'obj' => $match->quatrieme],
                ];
            @endphp

            @foreach($arbitresMatch as $item)
                @if($item['obj'])
                @php
                    $arbitre = $item['obj'];
                    $paiement = \Illuminate\Support\Facades\DB::table('paiements')
                        ->where('arbitre_id', $arbitre->id)
                        ->where('mois', (string)$match->id) // Utilisation de 'mois' comme dans ta table
                        ->first();
                    $statut = $paiement->statut ?? 'en_attente';
                @endphp
                <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4 hover:bg-on-surface/[0.02] transition-colors">
                    
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-lg bg-background border border-outline-variant flex items-center justify-center font-black text-on-surface-muted text-xs">
                            {{ substr($arbitre->user->name ?? '?', 0, 1) }}
                        </div>
                        <div>
                            <p class="font-black text-on-surface text-sm uppercase leading-tight">{{ $arbitre->user->name ?? '—' }}</p>
                            <span class="text-[8px] font-black uppercase tracking-widest px-1.5 py-0.5 rounded bg-on-surface/5 text-on-surface-muted">
                                {{ $item['role'] }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center gap-8">
                        <p class="font-black text-on-surface text-sm">{{ number_format($match->categorie->montant ?? 0, 2) }} DH</p>

                        <div class="min-w-[140px] flex justify-end">
                            @if($statut === 'paye')
                                <div class="flex items-center gap-3">
                                    <span class="text-[9px] font-black text-emerald-600 uppercase tracking-widest">Payé</span>
                                    <form action="{{ route('admin.paiements.arbitre') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="arbitre_id" value="{{ $arbitre->id }}">
                                        <input type="hidden" name="match_id" value="{{ $match->id }}">
                                        <input type="hidden" name="statut" value="non_paye">
                                        <button type="submit" class="text-on-surface-muted hover:text-primary transition-colors">
                                            <span class="material-symbols-outlined text-sm">undo</span>
                                        </button>
                                    </form>
                                </div>
                            @elseif($statut === 'non_paye')
                                <div class="flex items-center gap-3">
                                    <span class="text-[9px] font-black text-primary uppercase tracking-widest italic">Refusé</span>
                                    <form action="{{ route('admin.paiements.arbitre') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="arbitre_id" value="{{ $arbitre->id }}">
                                        <input type="hidden" name="match_id" value="{{ $match->id }}">
                                        <input type="hidden" name="statut" value="paye">
                                        <button type="submit" class="text-[9px] font-black text-on-surface-muted hover:text-emerald-600 uppercase underline">Payer</button>
                                    </form>
                                </div>
                            @else
                                <div class="flex gap-2">
                                    <form action="{{ route('admin.paiements.arbitre') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="arbitre_id" value="{{ $arbitre->id }}">
                                        <input type="hidden" name="match_id" value="{{ $match->id }}">
                                        <input type="hidden" name="statut" value="paye">
                                        <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg text-[9px] font-black uppercase tracking-widest hover:bg-primary-dark shadow-sm">Payer</button>
                                    </form>
                                    <form action="{{ route('admin.paiements.arbitre') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="arbitre_id" value="{{ $arbitre->id }}">
                                        <input type="hidden" name="match_id" value="{{ $match->id }}">
                                        <input type="hidden" name="statut" value="non_paye">
                                        <button type="submit" class="bg-background border border-outline-variant text-on-surface-muted px-3 py-2 rounded-lg text-[9px] font-black uppercase hover:border-primary">Refuser</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
    @empty
    <div class="bg-surface rounded-xl border border-outline-variant border-dashed p-20 text-center text-on-surface-muted font-black uppercase text-xs">
        Aucun match à payer ⚽
    </div>
    @endforelse

</div>
@endsection