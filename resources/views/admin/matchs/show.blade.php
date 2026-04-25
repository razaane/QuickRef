@extends('layouts.admin')

@section('admin-content')
<div class="max-w-5xl mx-auto p-6">
    
    {{-- Header avec Retour --}}
    <div class="flex justify-between items-center mb-10">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.matchs.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-surface border border-outline-variant hover:border-primary hover:text-primary transition-all shadow-sm">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <h1 class="text-3xl font-black text-on-surface uppercase tracking-tighter leading-none">Détails Match</h1>
                <p class="text-primary font-bold text-[9px] uppercase tracking-[0.3em] mt-1">Fiche #{{ $match->id }}</p>
            </div>
        </div>
        <a href="{{ route('admin.matchs.edit', $match->id) }}" class="bg-primary text-white px-6 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
            Modifier
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        {{-- Main Card : L'Affiche (Sans le cercle VS) --}}
        <div class="lg:col-span-8 bg-on-surface rounded-[2.5rem] p-10 text-white shadow-2xl relative overflow-hidden">
            <div class="relative z-10">
                <div class="flex flex-col md:flex-row items-center justify-between gap-12 text-center md:text-left">
                    <div class="flex-1">
                        <span class="text-primary font-black uppercase text-[10px] tracking-widest">Domicile</span>
                        <h2 class="text-3xl font-black uppercase mt-1 tracking-tight">{{ $match->equipeDomicile->nom }}</h2>
                    </div>
                    
                    {{-- VS Simple --}}
                    <div class="text-primary text-4xl font-black italic opacity-90">VS</div>

                    <div class="flex-1 md:text-right">
                        <span class="text-primary font-black uppercase text-[10px] tracking-widest">Visiteur</span>
                        <h2 class="text-3xl font-black uppercase mt-1 tracking-tight">{{ $match->equipeVisiteur->nom }}</h2>
                    </div>
                </div>

                <div class="mt-12 pt-8 border-t border-white/10 grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-white/40 text-[9px] font-black uppercase tracking-widest">Lieu & Terrain</p>
                        <p class="text-base font-bold">{{ $match->ville }} <span class="text-primary">— {{ $match->terrain }}</span></p>
                    </div>
                    <div class="text-right">
                        <p class="text-white/40 text-[9px] font-black uppercase tracking-widest">Coup d'envoi</p>
                        <p class="text-base font-bold">{{ \Carbon\Carbon::parse($match->date_heure)->format('d.m.y') }} <span class="text-primary">— {{ \Carbon\Carbon::parse($match->date_heure)->format('H:i') }}</span></p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Side Card : Finance --}}
        <div class="lg:col-span-4 bg-primary rounded-[2.5rem] p-10 text-white flex flex-col justify-between shadow-xl shadow-primary/20">
            <div>
                <p class="text-white/60 text-[9px] font-black uppercase tracking-[0.2em] mb-1">Catégorie</p>
                <h3 class="text-2xl font-black uppercase">{{ $match->categorie->nom }}</h3>
            </div>
            <div class="mt-8">
                <p class="text-5xl font-black tracking-tighter">{{ number_format($match->categorie->montant, 0) }}<span class="text-lg ml-2 opacity-60 font-bold">MAD</span></p>
                <p class="text-[9px] font-black uppercase mt-3 bg-white/20 inline-block px-3 py-1 rounded-lg">Indemnité Officielle</p>
            </div>
        </div>

        {{-- Bottom Card : Arbitres --}}
        <div class="lg:col-span-12 bg-surface rounded-[2.5rem] p-8 border border-outline-variant">
            <h4 class="text-[10px] font-black text-on-surface-muted uppercase tracking-[0.4em] mb-8 flex items-center gap-4">
                Corps Arbitral <div class="h-[1px] bg-outline-variant flex-1"></div>
            </h4>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="flex items-center gap-4">
                    <div class="bg-primary text-white w-10 h-10 rounded-xl flex items-center justify-center font-black text-xs">AC</div>
                    <div>
                        <p class="text-[8px] font-black text-primary uppercase">Central</p>
                        <p class="text-sm font-black text-on-surface uppercase">{{ $match->arbitreCentral->user->name ?? '---' }}</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="bg-on-surface text-white w-10 h-10 rounded-xl flex items-center justify-center font-black text-xs">A1</div>
                    <div>
                        <p class="text-[8px] font-black text-on-surface-muted uppercase">Assistant 1</p>
                        <p class="text-sm font-black text-on-surface uppercase">{{ $match->assistant1->user->name ?? '---' }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="bg-on-surface text-white w-10 h-10 rounded-xl flex items-center justify-center font-black text-xs">A2</div>
                    <div>
                        <p class="text-[8px] font-black text-on-surface-muted uppercase">Assistant 2</p>
                        <p class="text-sm font-black text-on-surface uppercase">{{ $match->assistant2->user->name ?? '---' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection