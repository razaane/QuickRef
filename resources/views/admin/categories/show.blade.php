@extends('layouts.admin')
@section('page-title', 'Détails Catégorie')

@section('admin-content')
<div class="max-w-xl">
    <div class="bg-surface rounded-[2.5rem] shadow-sm border border-outline-variant overflow-hidden">
        {{-- Header Card --}}
        <div class="h-32 bg-sidebar flex items-center justify-center relative">
            <div class="absolute inset-0 zellige-pattern opacity-10"></div>
            <div class="relative z-10 w-20 h-20 bg-surface rounded-[1.5rem] flex items-center justify-center shadow-2xl border-4 border-primary/20">
                <span class="material-symbols-outlined text-primary text-4xl">payments</span>
            </div>
        </div>

        <div class="p-10 text-center">
            <span class="text-[10px] font-black text-primary bg-primary/10 px-4 py-1.5 rounded-full uppercase tracking-[0.2em] mb-6 inline-block">
                Classification Officielle
            </span>
            <h2 class="text-4xl font-black text-on-surface tracking-tighter mb-8 uppercase">{{ $categorie->nom }}</h2>
            
            {{-- Big Amount Display --}}
            <div class="bg-background/50 rounded-3xl p-8 border border-outline-variant shadow-inner">
                <p class="text-[10px] font-black text-on-surface-muted uppercase tracking-[0.2em] mb-2">Tarif désignation par match</p>
                <div class="flex items-center justify-center gap-2">
                    <p class="text-5xl font-black text-on-surface tracking-tighter">
                        {{ number_format($categorie->montant, 2) }}
                    </p>
                    <p class="text-xl font-black text-primary">MAD</p>
                </div>
            </div>

            <div class="mt-10 pt-8 border-t border-outline-variant flex justify-around items-center">
                <div class="text-center">
                    <p class="text-[10px] font-black text-on-surface-muted uppercase tracking-widest mb-1">Créée le</p>
                    <p class="font-black text-on-surface">{{ $categorie->created_at->format('d/m/Y') }}</p>
                </div>
                <div class="w-px h-10 bg-outline-variant"></div>
                <div class="text-center">
                    <p class="text-[10px] font-black text-on-surface-muted uppercase tracking-widest mb-1">Statut</p>
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                        <p class="font-black text-on-surface uppercase text-xs">Actif</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer Actions --}}
        <div class="bg-background/50 p-6 px-10 flex justify-between items-center border-t border-outline-variant">
            <a href="{{ route('admin.categories.index') }}" class="text-on-surface-muted font-black text-[10px] uppercase tracking-widest flex items-center gap-2 hover:text-primary transition-all">
                <span class="material-symbols-outlined text-lg">arrow_back</span> Retour
            </a>
            <a href="{{ route('admin.categories.edit', $categorie->id) }}" class="bg-primary text-white px-8 py-3 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
                Modifier le tarif
            </a>
        </div>
    </div>
</div>
@endsection