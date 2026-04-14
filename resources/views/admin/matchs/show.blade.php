@extends('layouts.admin')
@section('admin-content')
<div class="max-w-4xl p-6">
    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-3xl font-black text-on-surface uppercase tracking-tighter">Match #{{ $match->id }}</h1>
            <p class="text-on-surface-muted font-medium uppercase text-[10px] tracking-widest">Fiche de rencontre officielle</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.matchs.index') }}" class="p-3 bg-surface border border-outline-variant rounded-xl text-on-surface-muted hover:text-primary transition-all">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <a href="{{ route('admin.matchs.edit', $match->id) }}" class="bg-primary text-white px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest shadow-md">Modifier</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Détails du Match --}}
        <div class="md:col-span-2 space-y-6">
            <div class="bg-surface p-8 rounded-xl border border-outline-variant">
                <div class="flex items-center justify-between mb-8 pb-8 border-b border-outline-variant">
                    <div class="text-center flex-1">
                        <p class="text-2xl font-black text-on-surface uppercase">{{ $match->equipeDomicile->nom }}</p>
                        <p class="text-[9px] font-black text-primary uppercase">Domicile</p>
                    </div>
                    <div class="px-6 text-2xl font-black italic text-on-surface-muted">VS</div>
                    <div class="text-center flex-1">
                        <p class="text-2xl font-black text-on-surface uppercase">{{ $match->equipeVisiteur->nom }}</p>
                        <p class="text-[9px] font-black text-on-surface-muted uppercase">Visiteur</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <p class="text-[10px] font-black text-on-surface-muted uppercase tracking-widest mb-1">Lieu de la rencontre</p>
                        <p class="font-bold text-on-surface">{{ $match->ville }}</p>
                        <p class="text-sm text-on-surface-variant">{{ $match->terrain }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-on-surface-muted uppercase tracking-widest mb-1">Coup d'envoi</p>
                        <p class="font-bold text-on-surface">{{ \Carbon\Carbon::parse($match->date_heure)->format('d/m/Y') }}</p>
                        <p class="text-sm text-on-surface-variant">{{ \Carbon\Carbon::parse($match->date_heure)->format('H:i') }}</p>
                    </div>
                </div>
            </div>

            {{-- Indemnités --}}
            <div class="bg-background p-6 rounded-xl border border-outline-variant flex justify-between items-center">
                <div>
                    <p class="text-[10px] font-black text-on-surface-muted uppercase">Catégorie</p>
                    <p class="font-black text-on-surface uppercase text-lg">{{ $match->categorie->nom }}</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-black text-on-surface-muted uppercase">Indemnité totale</p>
                    <p class="font-black text-primary text-2xl">{{ number_format($match->categorie->montant, 2) }} DH</p>
                </div>
            </div>
        </div>

        {{-- Arbitres --}}
        <div class="bg-sidebar rounded-xl p-6 text-white shadow-lg">
            <h3 class="text-[10px] font-black uppercase text-white/40 tracking-widest mb-6 border-b border-white/10 pb-4">Corps Arbitral</h3>
            <div class="space-y-6">
                <div>
                    <p class="text-[9px] font-black uppercase text-primary mb-1">Central</p>
                    <p class="font-bold">{{ $match->arbitreCentral->user->name ?? '---' }}</p>
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <p class="text-[9px] font-black uppercase text-white/40 mb-1">Assistant 1</p>
                        <p class="font-bold text-sm">{{ $match->assistant1->user->name ?? '---' }}</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black uppercase text-white/40 mb-1">Assistant 2</p>
                        <p class="font-bold text-sm">{{ $match->assistant2->user->name ?? '---' }}</p>
                    </div>
                </div>
                @if($match->quatrieme)
                <div class="pt-4 border-t border-white/10">
                    <p class="text-[9px] font-black uppercase text-white/40 mb-1">4ème Arbitre</p>
                    <p class="font-medium text-sm text-white/70">{{ $match->quatrieme->user->name }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection