@extends('layouts.admin')
@section('page-title', 'Tarification par Catégorie')

@section('admin-content')
<div class="flex justify-between items-center mb-8">
    <p class="text-on-surface-variant font-medium">Définissez les indemnités d'arbitrage par catégorie de match.</p>
    <a href="{{ route('admin.categories.create') }}" class="bg-primary text-white px-6 py-3 rounded-xl font-black flex items-center gap-2 hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
        <span class="material-symbols-outlined font-bold">payments</span>
        Nouvelle Catégorie
    </a>
</div>

<div class="bg-surface rounded-2xl shadow-sm border border-outline-variant overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-background border-b border-outline-variant">
            <tr>
                <th class="px-6 py-4 text-xs font-black text-on-surface-muted uppercase tracking-widest">Nom de Catégorie</th>
                <th class="px-6 py-4 text-xs font-black text-on-surface-muted uppercase tracking-widest text-center">Montant (Indemnité)</th>
                <th class="px-6 py-4 text-xs font-black text-on-surface-muted uppercase tracking-widest text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-outline-variant">
            @foreach($categories as $cat)
            <tr class="hover:bg-slate-50 transition-colors group">
                <td class="px-6 py-4">
                    <span class="font-black text-on-surface tracking-tight uppercase">{{ $cat->nom }}</span>
                </td>
                <td class="px-6 py-4 text-center">
                    <span class="bg-primary/10 text-primary px-4 py-1.5 rounded-lg font-black text-sm border border-primary/10">
                        {{ number_format($cat->montant, 2) }} <span class="text-[10px] opacity-70">MAD</span>
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.categories.edit', $cat) }}" class="p-2 text-on-surface-muted hover:text-primary transition-colors">
                            <span class="material-symbols-outlined">edit</span>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="p-2 text-on-surface-muted hover:text-primary-dark transition-colors" onclick="return confirm('Supprimer cette catégorie ?')">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection