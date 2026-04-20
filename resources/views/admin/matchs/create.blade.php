@extends('layouts.admin')
@section('admin-content')
<div class="p-4 lg:p-6">
    <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-black text-on-surface uppercase tracking-tighter">Gestion des Matchs</h2>
            <p class="text-on-surface-muted text-xs font-medium">Planning et désignations officielles</p>
        </div>
        <a href="{{ route('admin.matchs.create') }}" class="bg-primary text-white px-6 py-3 rounded-xl font-black uppercase text-[10px] tracking-[0.2em] hover:bg-primary-dark transition-all shadow-md text-center">
            Nouveau Match
        </a>
    </div>

    <div class="bg-surface rounded-2xl shadow-sm border border-outline-variant overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[600px]">
                <thead class="bg-background border-b border-outline-variant">
                    <tr>
                        <th class="px-6 py-4 text-[9px] font-black uppercase text-on-surface-muted tracking-widest">Date / Heure</th>
                        <th class="px-6 py-4 text-[9px] font-black uppercase text-on-surface-muted tracking-widest">Affiche</th>
                        <th class="hidden md:table-cell px-6 py-4 text-[9px] font-black uppercase text-on-surface-muted tracking-widest">Localisation</th>
                        <th class="px-6 py-4 text-[9px] font-black uppercase text-on-surface-muted tracking-widest">Statut</th>
                        <th class="px-6 py-4 text-[9px] font-black uppercase text-on-surface-muted tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @foreach($matchs as $match)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 text-xs font-bold text-on-surface">
                            <span class="block">{{ \Carbon\Carbon::parse($match->date_heure)->format('d/m/y') }}</span>
                            <span class="text-[10px] text-on-surface-muted">{{ \Carbon\Carbon::parse($match->date_heure)->format('H:i') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col lg:flex-row lg:items-center gap-1">
                                <span class="text-xs font-black text-on-surface uppercase">{{ $match->equipeDomicile->nom }}</span>
                                <span class="text-primary font-black text-[10px] mx-1">VS</span>
                                <span class="text-xs font-black text-on-surface uppercase">{{ $match->equipeVisiteur->nom }}</span>
                            </div>
                        </td>
                        <td class="hidden md:table-cell px-6 py-4 text-xs text-on-surface-variant">
                            {{ $match->ville }} <span class="opacity-50 italic">({{ $match->terrain }})</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-[8px] rounded-lg font-black uppercase tracking-widest border {{ $match->statut == 'jouer' ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-primary/5 text-primary border-primary/20' }}">
                                {{ str_replace('_', ' ', $match->statut) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-1">
                                <a href="{{ route('admin.matchs.show', $match->id) }}" class="p-2 text-on-surface-muted hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                </a>
                                <a href="{{ route('admin.matchs.edit', $match->id) }}" class="p-2 text-on-surface-muted hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection