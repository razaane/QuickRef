@extends('layouts.admin')
@section('page-title', 'Liste des Arbitres')

@section('admin-content')
<div class="flex justify-between items-center mb-8">
    <p class="text-on-surface-variant font-medium">Gérez les comptes et les profils des arbitres officiels.</p>
    <a href="{{ route('admin.arbitres.create') }}" class="bg-primary text-white px-6 py-3 rounded-xl font-black flex items-center gap-2 hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
        <span class="material-symbols-outlined">person_add</span>
        Ajouter un Arbitre
    </a>
</div>

<div class="bg-surface rounded-2xl shadow-sm border border-outline-variant overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-background border-b border-outline-variant">
            <tr>
                <th class="px-6 py-4 text-xs font-black text-on-surface-muted uppercase tracking-widest">Arbitre</th>
                <th class="px-6 py-4 text-xs font-black text-on-surface-muted uppercase tracking-widest">Contact</th>
                <th class="px-6 py-4 text-xs font-black text-on-surface-muted uppercase tracking-widest">Grade</th>
                <th class="px-6 py-4 text-xs font-black text-on-surface-muted uppercase tracking-widest text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-outline-variant">
            @foreach($arbitres as $arbitre)
            <tr class="hover:bg-slate-50 transition-colors">
                <td class="px-6 py-4">
                    <p class="font-bold text-on-surface">{{ $arbitre->user->name }}</p>
                    <p class="text-xs text-on-surface-variant">{{ $arbitre->user->email }}</p>
                </td>
                <td class="px-6 py-4 text-sm text-on-surface-variant font-medium">{{ $arbitre->telephone }}</td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase {{ $arbitre->grade == 'international' ? 'bg-amber-100 text-amber-700' : 'bg-primary/10 text-primary' }}">
                        {{ $arbitre->grade }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right flex justify-end gap-2">
                    <a href="{{ route('admin.arbitres.edit', $arbitre->id) }}" class="p-2 text-on-surface-muted hover:text-primary transition-colors">
                        <span class="material-symbols-outlined">edit</span>
                    </a>
                    <form action="{{ route('admin.arbitres.destroy', $arbitre->id) }}" method="POST" onsubmit="return confirm('Supprimer cet arbitre ?')">
                        @csrf @method('DELETE')
                        <button class="p-2 text-on-surface-muted hover:text-primary-dark transition-colors">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4 border-t border-outline-variant">
        {{ $arbitres->links() }}
    </div>
</div>
@endsection