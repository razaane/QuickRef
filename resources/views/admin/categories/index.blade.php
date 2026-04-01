@extends('layouts.admin')
@section('page-title', 'Tarification par Catégorie')

@section('admin-content')
<div class="flex justify-between items-center mb-8">
    <p class="text-slate-500 font-medium">Définissez les indemnités d'arbitrage par catégorie de match.</p>
    <a href="{{ route('admin.categories.create') }}" class="bg-[#1B6B3A] text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 hover:shadow-lg transition-all">
        <span class="material-symbols-outlined text-[#C9A84C]">payments</span>
        Nouvelle Catégorie
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-xs font-black text-slate-500 uppercase">Nom de Catégorie</th>
                <th class="px-6 py-4 text-xs font-black text-slate-500 uppercase text-center">Montant (DH)</th>
                <th class="px-6 py-4 text-xs font-black text-slate-500 uppercase text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($categories as $cat)
            <tr class="hover:bg-slate-50/50">
                <td class="px-6 py-4">
                    <span class="font-bold text-slate-900">{{ $cat->nom }}</span>
                </td>
                <td class="px-6 py-4 text-center">
                    <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full font-black text-sm">
                        {{ number_format($cat->montant, 2) }} DH
                    </span>
                </td>
                <td class="px-6 py-4 text-right flex justify-end gap-2">
                    <a href="{{ route('admin.categories.edit', $cat) }}" class="p-2 text-slate-400 hover:text-[#1B6B3A]"><span class="material-symbols-outlined">edit</span></a>
                    <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="p-2 text-slate-400 hover:text-red-600" onclick="return confirm('Supprimer ?')"><span class="material-symbols-outlined">delete</span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection