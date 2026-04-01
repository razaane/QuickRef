@extends('layouts.admin')
@section('page-title', 'Liste des Arbitres')

@section('admin-content')
<div class="flex justify-between items-center mb-8">
    <p class="text-slate-500">Gérez les comptes et les profils des arbitres.</p>
    <a href="{{ route('admin.arbitres.create') }}" class="bg-[#1B6B3A] text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 hover:bg-[#14522c] transition-all">
        <span class="material-symbols-outlined">person_add</span>
        Ajouter un Arbitre
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-xs font-black text-slate-500 uppercase">Arbitre</th>
                <th class="px-6 py-4 text-xs font-black text-slate-500 uppercase">Contact</th>
                <th class="px-6 py-4 text-xs font-black text-slate-500 uppercase">Grade</th>
                <th class="px-6 py-4 text-xs font-black text-slate-500 uppercase text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($arbitres as $arbitre)
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4">
                    <p class="font-bold text-slate-900">{{ $arbitre->user->name }}</p>
                    <p class="text-xs text-slate-400">{{ $arbitre->user->email }}</p>
                </td>
                <td class="px-6 py-4 text-sm text-slate-600">{{ $arbitre->telephone }}</td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $arbitre->grade == 'international' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                        {{ $arbitre->grade }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right flex justify-end gap-2">
                    <a href="{{ route('admin.arbitres.edit', $arbitre->id) }}" class="p-2 text-slate-400 hover:text-[#1B6B3A] transition-colors">
                        <span class="material-symbols-outlined">edit</span>
                    </a>
                    <form action="{{ route('admin.arbitres.destroy', $arbitre->id) }}" method="POST" onsubmit="return confirm('Supprimer cet arbitre ?')">
                        @csrf @method('DELETE')
                        <button class="p-2 text-slate-400 hover:text-red-600">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4 border-t border-slate-100">
        {{ $arbitres->links() }}
    </div>
</div>
@endsection