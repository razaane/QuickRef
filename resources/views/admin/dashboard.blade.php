@extends('layouts.admin')
@section('page-title', 'Vue d\'ensemble')

@section('admin-content')
<div class="space-y-6 lg:space-y-8">

    {{-- Stats Cards : 1 col sur mobile, 2 sur tablette, 4 sur desktop --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">

        {{-- Matchs joués --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 lg:p-6 transition-transform hover:scale-[1.02]">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined">sports_soccer</span>
                </div>
                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Total</span>
            </div>
            <p class="text-2xl lg:text-3xl font-black text-slate-800 tracking-tighter">{{ $totalMatchsJoues }}</p>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Matchs Joués</p>
        </div>

        {{-- Matchs en attente --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 lg:p-6 transition-transform hover:scale-[1.02]">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-orange-50 text-orange-500 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined">hourglass_empty</span>
                </div>
                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Action</span>
            </div>
            <p class="text-2xl lg:text-3xl font-black text-slate-800 tracking-tighter">{{ $totalMatchsAttente }}</p>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">En Attente</p>
        </div>

        {{-- Total Arbitres --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 lg:p-6 transition-transform hover:scale-[1.02]">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined">person_search</span>
                </div>
                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Effectif</span>
            </div>
            <p class="text-2xl lg:text-3xl font-black text-slate-800 tracking-tighter">{{ $totalArbitres }}</p>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Arbitres</p>
        </div>

        {{-- Paiements en attente --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 lg:p-6 transition-transform hover:scale-[1.02]">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined">payments</span>
                </div>
                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">MAD</span>
            </div>
            <p class="text-2xl lg:text-3xl font-black text-slate-800 tracking-tighter">{{ number_format($totalPaiementsAttente, 0, ',', ' ') }}</p>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">À Régler</p>
        </div>

    </div>

    {{-- Section Tableaux --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-5 lg:px-8 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h2 class="text-[10px] lg:text-xs font-black text-slate-500 uppercase tracking-[0.2em]">Derniers Matchs</h2>
            <a href="{{ route('admin.matchs.index') }}"
               class="text-[9px] lg:text-[10px] font-black text-rose-600 uppercase tracking-widest hover:underline">
                Tout voir →
            </a>
        </div>

        {{-- Le scroll horizontal est crucial ici --}}
        <div class="overflow-x-auto w-full">
            <table class="w-full min-w-[700px]"> {{-- min-w garantit que le tableau ne s'écrase pas --}}
                <thead class="bg-slate-50/80">
                    <tr>
                        <th class="px-6 lg:px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest text-left">Date</th>
                        <th class="px-6 lg:px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest text-left">Affiche du Match</th>
                        <th class="hidden sm:table-cell px-6 lg:px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest text-left">Catégorie</th>
                        <th class="px-6 lg:px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest text-left">Arbitre Central</th>
                        <th class="px-6 lg:px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest text-center">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($derniersMatchs as $match)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 lg:px-8 py-5 text-xs font-bold text-slate-500 italic">
                            {{ \Carbon\Carbon::parse($match->date_heure)->format('d/m/y') }}
                        </td>
                        <td class="px-6 lg:px-8 py-5">
                            <div class="flex flex-col">
                                <span class="text-xs font-black text-slate-800 uppercase tracking-tight">
                                    {{ $match->equipeDomicile->nom ?? '?' }} 
                                    <span class="text-rose-600 font-light mx-0.5">vs</span> 
                                    {{ $match->equipeVisiteur->nom ?? '?' }}
                                </span>
                                <span class="text-[9px] text-slate-400 font-bold mt-1 uppercase italic opacity-70">{{ $match->terrain }}</span>
                            </div>
                        </td>
                        <td class="hidden sm:table-cell px-6 lg:px-8 py-5">
                            <span class="text-[9px] font-black text-slate-400 bg-slate-100 px-2 py-1 rounded-md uppercase">
                                {{ $match->categorie->nom ?? '—' }}
                            </span>
                        </td>
                        <td class="px-6 lg:px-8 py-5 text-xs font-bold text-slate-700">
                            {{ $match->arbitreCentral->user->name ?? '—' }}
                        </td>
                        <td class="px-6 lg:px-8 py-5 text-center">
                            @php
                                $statusClass = match($match->statut) {
                                    'jouer'     => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                    'confirmer' => 'bg-blue-50 text-blue-600 border-blue-100',
                                    'annuler'   => 'bg-rose-50 text-rose-600 border-rose-100',
                                    default     => 'bg-orange-50 text-orange-600 border-orange-100',
                                };
                            @endphp
                            <span class="text-[8px] font-black uppercase tracking-widest px-2.5 py-1.5 rounded-lg border {{ $statusClass }}">
                                {{ $match->statut ?? 'Attente' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-16 text-center text-slate-400 text-[10px] font-black uppercase tracking-[0.4em]">
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