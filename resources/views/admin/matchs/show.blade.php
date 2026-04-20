@extends('layouts.admin')
@section('admin-content')
<div class="max-w-4xl p-4 lg:p-6 mx-auto">
    <div class="flex flex-col sm:flex-row justify-between items-start mb-8 gap-6">
        <div>
            <h1 class="text-2xl lg:text-3xl font-black text-on-surface uppercase tracking-tighter">Match #{{ $match->id }}</h1>
            <p class="text-on-surface-muted font-medium uppercase text-[9px] tracking-widest">Fiche officielle de rencontre</p>
        </div>
        <div class="flex gap-2 w-full sm:w-auto">
            <a href="{{ route('admin.matchs.index') }}" class="flex-1 sm:flex-none p-3 bg-surface border border-outline-variant rounded-xl text-on-surface-muted text-center hover:text-primary transition-all">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <a href="{{ route('admin.matchs.edit', $match->id) }}" class="flex-[3] sm:flex-none bg-primary text-white px-6 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest shadow-md text-center">Modifier</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Détails --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-surface p-6 lg:p-8 rounded-2xl border border-outline-variant shadow-sm">
                <div class="flex flex-col sm:flex-row items-center justify-between mb-8 pb-8 border-b border-outline-variant gap-4">
                    <div class="text-center">
                        <p class="text-xl font-black text-on-surface uppercase tracking-tight">{{ $match->equipeDomicile->nom }}</p>
                        <p class="text-[9px] font-black text-primary uppercase mt-1">Domicile</p>
                    </div>
                    <div class="text-xl font-black italic text-on-surface-muted opacity-30">VS</div>
                    <div class="text-center">
                        <p class="text-xl font-black text-on-surface uppercase tracking-tight">{{ $match->equipeVisiteur->nom }}</p>
                        <p class="text-[9px] font-black text-on-surface-muted uppercase mt-1">Visiteur</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div class="space-y-1">
                        <p class="text-[9px] font-black text-on-surface-muted uppercase tracking-widest">Lieu</p>
                        <p class="font-bold text-on-surface text-sm">{{ $match->ville }}</p>
                        <p class="text-xs text-on-surface-variant opacity-60 italic">{{ $match->terrain }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[9px] font-black text-on-surface-muted uppercase tracking-widest">Coup d'envoi</p>
                        <p class="font-bold text-on-surface text-sm">{{ \Carbon\Carbon::parse($match->date_heure)->format('d/m/Y') }}</p>
                        <p class="text-xs text-on-surface-variant opacity-60 italic">{{ \Carbon\Carbon::parse($match->date_heure)->format('H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-background p-6 rounded-2xl border border-outline-variant flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="text-center sm:text-left">
                    <p class="text-[9px] font-black text-on-surface-muted uppercase">Catégorie</p>
                    <p class="font-black text-on-surface uppercase text-lg leading-tight">{{ $match->categorie->nom }}</p>
                </div>
                <div class="text-center sm:text-right bg-primary/5 px-4 py-2 rounded-xl border border-primary/10">
                    <p class="text-[9px] font-black text-primary uppercase">Indemnité</p>
                    <p class="font-black text-primary text-xl">{{ number_format($match->categorie->montant, 2) }} <span class="text-xs">DH</span></p>
                </div>
            </div>
        </div>

        {{-- Arbitres --}}
        <div class="bg-sidebar rounded-2xl p-6 text-white shadow-xl h-fit">
            <h3 class="text-[10px] font-black uppercase text-white/40 tracking-widest mb-6 border-b border-white/10 pb-4 italic">Corps Arbitral</h3>
            <div class="space-y-6">
                <div>
                    <p class="text-[9px] font-black uppercase text-primary mb-1">Central</p>
                    <p class="font-bold text-sm">{{ $match->arbitreCentral->user->name ?? '---' }}</p>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-1 gap-4">
                    <div>
                        <p class="text-[9px] font-black uppercase text-white/40 mb-1">Assistant 1</p>
                        <p class="font-bold text-xs opacity-80">{{ $match->assistant1->user->name ?? '---' }}</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black uppercase text-white/40 mb-1">Assistant 2</p>
                        <p class="font-bold text-xs opacity-80">{{ $match->assistant2->user->name ?? '---' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection