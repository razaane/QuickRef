@extends('layouts.arbitre')
@section('arbitre-content')

<div>
    <!-- Infos user -->
    <p>{{ $user->name }}</p>
    <p>{{ $user->email }}</p>

    <!-- Infos arbitre -->
    <p>{{ $arbitre->telephone }}</p>
    <p>{{ $arbitre->grade }}</p>
    <p>{{ $arbitre->adresse ?? 'Non renseignée' }}</p>

    <!-- Bouton modifier -->
    <a href="{{ route('arbitre.profil.edit') }}">Modifier profil</a>

    <!-- Form supprimer compte -->
    <form method="POST" action="{{ route('arbitre.compte.destroy') }}">
        @csrf
        @method('DELETE')
        <input type="password" name="password_confirm"
               placeholder="Confirmer mot de passe">
        <button type="submit"
                onclick="return confirm('Supprimer définitivement ?')">
            Supprimer mon compte
        </button>
    </form>
</div>

@endsection