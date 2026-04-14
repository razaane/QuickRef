@extends('layouts.admin')
@section('page-title', 'Tableau de Bord')

@section('admin-content')
<div class="space-y-8">

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        {{-- Matchs joués --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <span class="material-symbols-outlined text-[#1B6B3A] bg-[#1B6B3A]/10 p-2 rounded-xl">sports_soccer</span>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total</span>
            </div>
            <p class="text-3xl font-black text-slate-800">{{ $totalMatchsJoues }}</p>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Matchs Joués</p>
        </div>

        {{-- Matchs en attente --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <span class="material-symbols-outlined text-orange-400 bg-orange-50 p-2 rounded-xl">hourglass_empty</span>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total</span>
            </div>
            <p class="text-3xl font-black text-slate-800">{{ $totalMatchsAttente }}</p>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Matchs En Attente</p>
        </div>

        {{-- Total Arbitres --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <span class="material-symbols-outlined text-blue-500 bg-blue-50 p-2 rounded-xl">person_search</span>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total</span>
            </div>
            <p class="text-3xl font-black text-slate-800">{{ $totalArbitres }}</p>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Arbitres</p>
        </div>

        {{-- Paiements en attente --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <span class="material-symbols-outlined text-red-400 bg-red-50 p-2 rounded-xl">pending_actions</span>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">MAD</span>
            </div>
            <p class="text-3xl font-black text-slate-800">{{ number_format($totalPaiementsAttente, 0) }}</p>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Paiements En Attente</p>
        </div>

    </div>


    {{-- Derniers Matchs --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-8 py-5 border-b border-slate-50 flex justify-between items-center">
            <h2 class="text-sm font-black text-slate-600 uppercase tracking-widest">Derniers Matchs</h2>
            <a href="{{ route('admin.matchs.index') }}"
               class="text-[10px] font-black text-[#1B6B3A] uppercase tracking-widest hover:underline">
                Voir tous →
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-left">Date</th>
                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-left">Match</th>
                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-left">Catégorie</th>
                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-left">Arbitre Central</th>
                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($derniersMatchs as $match)
                    @php
                        $statusColor = match($match->statut) {
                            'jouer'     => 'bg-blue-100 text-blue-700',
                            'confirmer' => 'bg-emerald-100 text-emerald-700',
                            'annuler'   => 'bg-red-100 text-red-500',
                            'reporter'  => 'bg-purple-100 text-purple-600',
                            default     => 'bg-orange-100 text-orange-600',
                        };
                        $statusLabel = match($match->statut) {
                            'jouer'     => 'Joué',
                            'confirmer' => 'Confirmé',
                            'annuler'   => 'Annulé',
                            'reporter'  => 'Reporté',
                            default     => 'En attente',
                        };
                    @endphp
                    <tr class="hover:bg-slate-50/50 transition-all">
                        <td class="px-8 py-5 text-sm font-bold text-slate-600">
                            {{ \Carbon\Carbon::parse($match->date_heure)->format('d/m/Y') }}
                        </td>
                        <td class="px-8 py-5">
                            <p class="text-sm font-black text-slate-800 uppercase">
                                {{ $match->equipeDomicile->nom ?? '?' }}
                                <span class="text-slate-300 font-light mx-1">vs</span>
                                {{ $match->equipeVisiteur->nom ?? '?' }}
                            </p>
                            <p class="text-[11px] text-slate-400 font-bold mt-0.5">{{ $match->terrain }}</p>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-[10px] font-black text-slate-500 bg-slate-100 px-3 py-1 rounded-full uppercase">
                                {{ $match->categorie->nom ?? '—' }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-sm font-bold text-slate-700">
                            {{ $match->arbitreCentral->user->name ?? '—' }}
                        </td>
                        <td class="px-8 py-5 text-center">
                            <span class="text-[9px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full {{ $statusColor }}">
                                {{ $statusLabel }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center text-slate-400 text-xs font-bold uppercase tracking-widest">
                            Aucun match enregistré
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection