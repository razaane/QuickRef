@extends('layouts.arbitre')
@section('content')

<form method="POST" action="{{ route('arbitre.profil.update') }}">
    @csrf
    @method('PUT')

    <input type="text"     name="name"      value="{{ old('name', $user->name) }}">
    <input type="email"    name="email"     value="{{ old('email', $user->email) }}">
    <input type="text"     name="telephone" value="{{ old('telephone', $arbitre->telephone) }}">
    <input type="text"     name="adresse"   value="{{ old('adresse', $arbitre->adresse) }}">

    <select name="grade">
        @foreach(['regional', 'national', 'international'] as $g)
            <option value="{{ $g }}"
                {{ old('grade', $arbitre->grade) === $g ? 'selected' : '' }}>
                {{ ucfirst($g) }}
            </option>
        @endforeach
    </select>

    <!-- Mot de passe optionnel -->
    <input type="password" name="password"              placeholder="Nouveau mot de passe (optionnel)">
    <input type="password" name="password_confirmation" placeholder="Confirmer nouveau mot de passe">

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p style="color:red">{{ $error }}</p>
        @endforeach
    @endif

    <button type="submit">Sauvegarder</button>
</form>

@endsection