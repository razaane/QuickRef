@extends('layouts.admin')
@section('page-title', 'Gestion des Équipes')

@section('admin-content')
<div class="flex justify-between items-center mb-8">
    <p class="text-on-surface-variant font-medium">Consultez et gérez les clubs enregistrés dans le système.</p>
    <a href="{{ route('admin.equipes.create') }}" class="bg-primary text-white px-6 py-3 rounded-xl font-black flex items-center gap-2 hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
        <span class="material-symbols-outlined font-bold">add_circle</span>
        Nouvelle Équipe
    </a>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 text-sm font-bold rounded-r-lg shadow-sm">
        {{ session('success') }}
    </div>
@endif

<div class="bg-surface rounded-2xl shadow-sm border border-outline-variant overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-background border-b border-outline-variant">
            <tr>
                <th class="px-6 py-4 text-xs font-black text-on-surface-muted uppercase tracking-widest">Équipe</th>
                <th class="px-6 py-4 text-xs font-black text-on-surface-muted uppercase tracking-widest">Ville</th>
                <th class="px-6 py-4 text-xs font-black text-on-surface-muted uppercase tracking-widest text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-outline-variant">
            @forelse($equipes as $equipe)
            <tr class="hover:bg-slate-50 transition-colors group">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-background rounded-xl flex items-center justify-center border border-outline-variant group-hover:bg-primary/5 group-hover:border-primary/20 transition-all">
                            <span class="material-symbols-outlined text-on-surface-muted group-hover:text-primary transition-colors text-xl">shield</span>
                        </div>
                        <span class="font-black text-on-surface tracking-tight uppercase">{{ $equipe->nom }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm font-bold text-on-surface-variant">
                    <span class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-primary text-sm">location_on</span>
                        {{ $equipe->ville }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.equipes.edit', $equipe) }}" class="p-2 text-on-surface-muted hover:text-primary transition-colors" title="Modifier">
                            <span class="material-symbols-outlined">edit</span>
                        </a>
                        <form method="POST" action="{{ route('admin.equipes.destroy', $equipe) }}" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Supprimer cette équipe ?')" class="p-2 text-on-surface-muted hover:text-primary-dark transition-colors" title="Supprimer">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-6 py-12 text-center text-on-surface-muted italic font-medium">Aucune équipe enregistrée pour le moment.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($equipes->hasPages())
        <div class="p-4 border-t border-outline-variant bg-background/50">
            {{ $equipes->links() }}
        </div>
    @endif
</div>
@endsection