@extends('layouts.admin')
@section('admin-content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-2xl shadow">
    <div class="border-b pb-4 mb-6">
        <h2 class="text-xl font-bold">Détails du Match #{{ $match->id }}</h2>
    </div>

    <div class="grid grid-cols-2 gap-8 mb-8">
        <div>
            <h3 class="text-xs font-bold uppercase text-gray-400 mb-2">Informations</h3>
            <p><strong>Catégorie:</strong> {{ $match->categorie->nom }}</p>
            <p><strong>Lieu:</strong> {{ $match->terrain }}, {{ $match->ville }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($match->date_heure)->format('d M Y - H:i') }}</p>
        </div>
        <div>
            <h3 class="text-xs font-bold uppercase text-gray-400 mb-2">Équipes</h3>
            <p class="text-lg font-bold">{{ $match->equipeDomicile->nom }} (H)</p>
            <p class="text-lg font-bold">{{ $match->equipeVisiteur->nom }} (V)</p>
        </div>
    </div>

    <div class="bg-gray-50 p-6 rounded-xl">
        <h3 class="text-sm font-bold uppercase text-gray-400 mb-4 italic">Corps Arbitral</h3>
        <div class="space-y-3">
            <div class="flex justify-between border-b pb-2">
                <span>Central:</span> <span class="font-bold">{{ $match->arbitreCentral->user->name }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span>Assistant 1:</span> <span class="font-bold">{{ $match->arbitreAssistant1->user->name }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span>Assistant 2:</span> <span class="font-bold">{{ $match->arbitreAssistant2->user->name }}</span>
            </div>
            @if($match->quatriemeArbitre)
            <div class="flex justify-between">
                <span>4ème Arbitre:</span> <span class="font-bold">{{ $match->quatriemeArbitre->user->name }}</span>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection