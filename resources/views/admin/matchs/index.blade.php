@extends('layouts.admin')
@section('admin-content')
<div class="p-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-black text-on-surface uppercase tracking-tighter">Gestion des Matchs</h2>
            <p class="text-on-surface-muted text-sm font-medium">Planning et désignations officielles</p>
        </div>
        <a href="{{ route('admin.matchs.create') }}" class="bg-primary text-white px-6 py-3 rounded-xl font-black uppercase text-xs tracking-widest hover:bg-primary-dark transition-all shadow-md">
            Nouveau Match
        </a>
    </div>

    <div class="bg-surface rounded-xl shadow-sm border border-outline-variant overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-background border-b border-outline-variant">
                <tr>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-on-surface-muted tracking-widest">Date / Heure</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-on-surface-muted tracking-widest">Affiche</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-on-surface-muted tracking-widest">Localisation</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-on-surface-muted tracking-widest">Statut</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-on-surface-muted tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant">
                @foreach($matchs as $match)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 text-sm font-bold text-on-surface">
                        {{ \Carbon\Carbon::parse($match->date_heure)->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <span class="font-black text-on-surface uppercase">{{ $match->equipeDomicile->nom }}</span>
                        <span class="text-primary font-black mx-1">VS</span>
                        <span class="font-black text-on-surface uppercase">{{ $match->equipeVisiteur->nom }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-on-surface-variant">
                        {{ $match->ville }} <span class="opacity-50">({{ $match->terrain }})</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-[10px] rounded-lg font-black uppercase tracking-tighter border {{ $match->statut == 'jouer' ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-primary/10 text-primary border-primary/10' }}">
                            {{ str_replace('_', ' ', $match->statut) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-1">
                            <a href="{{ route('admin.matchs.show', $match->id) }}" class="p-2 text-on-surface-muted hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">visibility</span>
                            </a>
                            <a href="{{ route('admin.matchs.edit', $match->id) }}" class="p-2 text-on-surface-muted hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">edit</span>
                            </a>
                            <form action="{{ route('admin.matchs.destroy', $match->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="p-2 text-on-surface-muted hover:text-primary-dark transition-colors" onclick="return confirm('Supprimer ce match ?')">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection