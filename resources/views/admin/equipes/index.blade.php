@extends('layouts.app')
@section('content')

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<h2>Équipes</h2>
<a href="{{ route('admin.equipes.create') }}">+ Ajouter</a>

<table border="1">
    <tr><th>Nom</th><th>Ville</th><th>Actions</th></tr>
    @forelse($equipes as $equipe)
    <tr>
        <td>{{ $equipe->nom }}</td>
        <td>{{ $equipe->ville }}</td>
        <td>
            <a href="{{ route('admin.equipes.edit', $equipe) }}">Modifier</a>
            <form method="POST" action="{{ route('admin.equipes.destroy', $equipe) }}" style="display:inline">
                @csrf @method('DELETE')
                <button onclick="return confirm('Supprimer ?')">Supprimer</button>
            </form>
        </td>
    </tr>
    @empty
    <tr><td colspan="3">Aucune équipe.</td></tr>
    @endforelse
</table>

{{ $equipes->links() }}
@endsection