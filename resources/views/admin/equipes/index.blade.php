@extends('layouts.admin')
@section('page-title', 'Gestion des Équipes')

@section('admin-content')
<div class="flex justify-between items-center mb-8">
    <p class="text-slate-500 font-medium">Consultez et gérez les clubs enregistrés dans le système.</p>
    <a href="{{ route('admin.equipes.create') }}" class="bg-[#1B6B3A] text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 hover:bg-[#14522c] transition-all shadow-md">
        <span class="material-symbols-outlined">add_circle</span>
        Nouvelle Équipe
    </a>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 text-sm font-bold rounded-r-lg shadow-sm">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-xs font-black text-slate-500 uppercase tracking-wider">Équipe</th>
                <th class="px-6 py-4 text-xs font-black text-slate-500 uppercase tracking-wider">Ville</th>
                <th class="px-6 py-4 text-xs font-black text-slate-500 uppercase tracking-wider text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($equipes as $equipe)
            <tr class="hover:bg-slate-50/50 transition-colors group">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center group-hover:bg-[#1B6B3A]/10 transition-colors">
                            <span class="material-symbols-outlined text-slate-400 group-hover:text-[#1B6B3A] text-sm">shield</span>
                        </div>
                        <span class="font-bold text-slate-900">{{ $equipe->nom }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm font-medium text-slate-600">
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">location_on</span>
                        {{ $equipe->ville }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.equipes.show', $equipe) }}" class="p-2 text-slate-400 hover:text-blue-600 transition-colors" title="Voir">
                            <span class="material-symbols-outlined">visibility</span>
                        </a>
                        <a href="{{ route('admin.equipes.edit', $equipe) }}" class="p-2 text-slate-400 hover:text-[#1B6B3A] transition-colors" title="Modifier">
                            <span class="material-symbols-outlined">edit</span>
                        </a>
                        <form method="POST" action="{{ route('admin.equipes.destroy', $equipe) }}" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Supprimer cette équipe ?')" class="p-2 text-slate-400 hover:text-red-600 transition-colors" title="Supprimer">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-6 py-12 text-center text-slate-400 italic">Aucune équipe enregistrée pour le moment.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($equipes->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            {{ $equipes->links() }}
        </div>
    @endif
</div>
@endsection