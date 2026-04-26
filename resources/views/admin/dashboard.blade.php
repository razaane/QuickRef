@extends('layouts.admin')

@section('admin-content')
<div class="p-4 lg:p-6">

    {{-- En-tête --}}
    <div class="mb-8">
        <h2 class="text-2xl font-black text-on-surface uppercase tracking-tighter">Vue d'ensemble</h2>
        <p class="text-on-surface-muted text-sm font-medium">Statistiques et activités récentes</p>
    </div>

    {{-- Stats Cards (Style Index Matchs) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        
        {{-- Card 1 --}}
        <div class="bg-surface p-5 rounded-2xl border border-outline-variant shadow-sm">
            <div class="flex justify-between items-start mb-3">
                <span class="material-symbols-outlined text-emerald-500 bg-emerald-50 p-2 rounded-lg">sports_soccer</span>
                <span class="text-[10px] font-black text-on-surface-muted uppercase tracking-widest">Total</span>
            </div>
            <p class="text-3xl font-black text-on-surface tracking-tighter">{{ $totalMatchsJoues }}</p>
            <p class="text-xs font-bold text-on-surface-muted uppercase mt-1 italic">Matchs Joués</p>
        </div>

        {{-- Card 2 --}}
        <div class="bg-surface p-5 rounded-2xl border border-outline-variant shadow-sm">
            <div class="flex justify-between items-start mb-3">
                <span class="material-symbols-outlined text-amber-500 bg-amber-50 p-2 rounded-lg">hourglass_empty</span>
                <span class="text-[10px] font-black text-on-surface-muted uppercase tracking-widest">Action</span>
            </div>
            <p class="text-3xl font-black text-on-surface tracking-tighter">{{ $totalMatchsAttente }}</p>
            <p class="text-xs font-bold text-on-surface-muted uppercase mt-1 italic">En Attente</p>
        </div>

        {{-- Card 3 --}}
        <div class="bg-surface p-5 rounded-2xl border border-outline-variant shadow-sm">
            <div class="flex justify-between items-start mb-3">
                <span class="material-symbols-outlined text-blue-500 bg-blue-50 p-2 rounded-lg">groups</span>
                <span class="text-[10px] font-black text-on-surface-muted uppercase tracking-widest">Effectif</span>
            </div>
            <p class="text-3xl font-black text-on-surface tracking-tighter">{{ $totalArbitres }}</p>
            <p class="text-xs font-bold text-on-surface-muted uppercase mt-1 italic">Arbitres</p>
        </div>

        {{-- Card 4 --}}
        <div class="bg-surface p-5 rounded-2xl border border-outline-variant shadow-sm">
            <div class="flex justify-between items-start mb-3">
                <span class="material-symbols-outlined text-primary bg-primary/5 p-2 rounded-lg">payments</span>
                <span class="text-[10px] font-black text-on-surface-muted uppercase tracking-widest">MAD</span>
            </div>
            <p class="text-3xl font-black text-on-surface tracking-tighter">{{ number_format($totalPaiementsAttente, 0, ',', ' ') }}</p>
            <p class="text-xs font-bold text-primary uppercase mt-1 italic tracking-tight">À Régler</p>
        </div>
    </div>

    {{-- Section Derniers Matchs (Exactement comme ton tableau) --}}
    <div class="bg-surface rounded-2xl shadow-sm border border-outline-variant overflow-hidden">
        <div class="px-6 py-4 border-b border-outline-variant flex justify-between items-center bg-background">
            <h3 class="text-sm font-black text-on-surface uppercase tracking-widest">Dernières Activités</h3>
            <a href="{{ route('admin.matchs.index') }}" class="text-xs font-black text-primary uppercase hover:underline">Voir tout</a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[800px] border-collapse">
                <thead class="bg-background border-b border-outline-variant">
                    <tr>
                        <th class="px-6 py-4 text-xs font-black uppercase text-on-surface-muted tracking-widest">Date / Heure</th>
                        <th class="px-6 py-4 text-xs font-black uppercase text-on-surface-muted tracking-widest">Affiche</th>
                        <th class="px-6 py-4 text-xs font-black uppercase text-on-surface-muted tracking-widest text-center">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($derniersMatchs as $match)
                    <tr class="hover:bg-slate-50 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="block text-sm font-black text-on-surface uppercase tracking-tighter">
                                {{ \Carbon\Carbon::parse($match->date_heure)->format('d M Y') }}
                            </span>
                            <span class="text-xs font-bold text-primary">
                                {{ \Carbon\Carbon::parse($match->date_heure)->format('H:i') }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-black text-on-surface uppercase tracking-tight">{{ $match->equipeDomicile->nom }}</span>
                                <span class="text-primary font-black text-xs px-2 py-0.5 bg-primary/5 rounded">VS</span>
                                <span class="text-sm font-black text-on-surface uppercase tracking-tight">{{ $match->equipeVisiteur->nom }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @php
                                $isJouer = $match->statut == 'jouer';
                            @endphp
                            <span class="px-4 py-1.5 text-[10px] rounded-lg font-black uppercase tracking-widest border shadow-sm {{ $isJouer ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-amber-50 text-amber-700 border-amber-200' }}">
                                {{ str_replace('_', ' ', $match->statut) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-on-surface-muted font-black uppercase text-xs tracking-widest">
                            Aucune activité récente
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection