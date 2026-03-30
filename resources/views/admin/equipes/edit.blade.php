@extends('layouts.app')
@section('content')
<h2>Modifier Équipe</h2>

@if($errors->any())
    @foreach($errors->all() as $e)
        <p style="color:red">{{ $e }}</p>
    @endforeach
@endif

<form method="POST" action="{{ route('admin.equipes.update', $equipe) }}">
    @csrf @method('PUT')
    <input type="text" name="nom"   value="{{ old('nom',   $equipe->nom) }}">
    <input type="text" name="ville" value="{{ old('ville', $equipe->ville) }}">
    <button type="submit">Sauvegarder</button>
</form>
<a href="{{ route('admin.equipes.index') }}">← Retour</a>
@endsection