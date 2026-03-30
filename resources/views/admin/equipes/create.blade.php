@extends('layouts.app')
@section('content')
<h2>Ajouter Équipe</h2>

@if($errors->any())
    @foreach($errors->all() as $e)
        <p style="color:red">{{ $e }}</p>
    @endforeach
@endif

<form method="POST" action="{{ route('admin.equipes.store') }}">
    @csrf
    <input type="text" name="nom"   placeholder="Nom"   value="{{ old('nom') }}">
    <input type="text" name="ville" placeholder="Ville" value="{{ old('ville') }}">
    <button type="submit">Ajouter</button>
</form>
<a href="{{ route('admin.equipes.index') }}">← Retour</a>
@endsection