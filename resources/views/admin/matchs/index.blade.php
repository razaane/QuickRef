@extends('layouts.admin')
@section('admin-content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Gestion des Matchs</h2>
        <a href="{{ route('admin.matchs.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg">Nouveau Match</a>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-xs font-bold uppercase text-gray-500">Date</th>
                    <th class="px-6 py-3 text-xs font-bold uppercase text-gray-500">Match</th>
                    <th class="px-6 py-3 text-xs font-bold uppercase text-gray-500">Ville / Terrain</th>
                    <th class="px-6 py-3 text-xs font-bold uppercase text-gray-500">Statut</th>
                    <th class="px-6 py-3 text-xs font-bold uppercase text-gray-500 ">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($matchs as $match)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-sm font-medium">{{ \Carbon\Carbon::parse($match->date_heure)->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 text-sm font-bold">{{ $match->equipeDomicile->nom }} <span class="text-tertiary">vs</span> {{ $match->equipeVisiteur->nom }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $match->ville }} ({{ $match->terrain }})</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-[10px] rounded-full font-bold uppercase {{ $match->statut == 'jouer' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                            {{ $match->statut }}
                        </span>
                    </td>
                    
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                    <a href="{{ route('admin.matchs.show', $match->id) }}" class="p-2 text-slate-400 hover:text-blue-600 transition-colors" title="Voir">
                            <span class="material-symbols-outlined">visibility</span>
                    </a>
                    <a href="{{ route('admin.matchs.edit', $match->id) }}" class="p-2 text-slate-400 hover:text-[#1B6B3A]"><span class="material-symbols-outlined">edit</span></a>
                    <form action="{{ route('admin.matchs.edit', $match->id) }}}" method="POST">
                        @csrf @method('DELETE')
                        <button class="p-2 text-slate-400 hover:text-red-600" onclick="return confirm('Supprimer ?')"><span class="material-symbols-outlined">delete</span></button>
                    </form>

                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection