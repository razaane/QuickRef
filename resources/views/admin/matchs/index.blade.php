@extends('layouts.admin')

@section('admin-content')
<div class="p-4 lg:p-6">

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl shadow-sm">
            <span class="material-symbols-outlined text-emerald-500">check_circle</span>
            <p class="text-sm font-black uppercase tracking-tight">{{ session('success') }}</p>
        </div>
    @endif

    <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-black text-on-surface uppercase tracking-tighter">Gestion des Matchs</h2>
            <p class="text-on-surface-muted text-sm font-medium">Planning et désignations officielles</p>
        </div>
        <a href="{{ route('admin.matchs.create') }}" class="bg-primary text-white px-6 py-3 rounded-xl font-black uppercase text-xs tracking-widest hover:bg-primary-dark transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-sm">add_circle</span>
            Nouveau Match
        </a>
    </div>

    <div class="bg-surface rounded-2xl shadow-sm border border-outline-variant overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[800px] border-collapse">
                <thead class="bg-background border-b border-outline-variant">
                    <tr>
                        {{-- Augmentation de text-[9px] vers text-xs --}}
                        <th class="px-6 py-4 text-xs font-black uppercase text-on-surface-muted tracking-widest">Date / Heure</th>
                        <th class="px-6 py-4 text-xs font-black uppercase text-on-surface-muted tracking-widest">Affiche</th>
                        <th class="hidden md:table-cell px-6 py-4 text-xs font-black uppercase text-on-surface-muted tracking-widest">Localisation</th>
                        <th class="px-6 py-4 text-xs font-black uppercase text-on-surface-muted tracking-widest text-center">Statut</th>
                        <th class="px-6 py-4 text-xs font-black uppercase text-on-surface-muted tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($matchs as $match)
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
                        <td class="hidden md:table-cell px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-on-surface-variant">{{ $match->ville }}</span>
                                <span class="text-xs text-on-surface-muted italic">{{ $match->terrain }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-4 py-1.5 text-[10px] rounded-lg font-black uppercase tracking-widest border shadow-sm {{ $match->statut == 'jouer' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-amber-50 text-amber-700 border-amber-200' }}">
                                {{ str_replace('_', ' ', $match->statut) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
    <div class="flex justify-end gap-2">
        {{-- Voir --}}
        <a href="{{ route('admin.matchs.show', $match->id) }}" class="p-2 text-on-surface-muted hover:text-primary transition-colors" title="Voir les détails">
            <span class="material-symbols-outlined text-[22px]">visibility</span>
        </a>

        {{-- Modifier --}}
        <a href="{{ route('admin.matchs.edit', $match->id) }}" class="p-2 text-on-surface-muted hover:text-primary transition-colors" title="Modifier">
            <span class="material-symbols-outlined text-[22px]">edit</span>
        </a>
        
        {{-- Supprimer --}}
        <form action="{{ route('admin.matchs.destroy', $match->id) }}" method="POST" class="inline" onsubmit="return confirm('Confirmer la suppression ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="p-2 text-on-surface-muted hover:text-red-500 transition-colors">
                <span class="material-symbols-outlined text-[22px]">delete</span>
            </button>
        </form>
    </div>
</td>
                    </tr>
                    @empty
                    {{-- ... (reste inchangé) --}}
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection