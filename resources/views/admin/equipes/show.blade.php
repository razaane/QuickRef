@extends('layouts.admin')
@section('page-title', 'Détails de l\'Équipe')

@section('admin-content')
<div class="max-w-xl">
    <div class="bg-surface rounded-[2.5rem] shadow-sm border border-outline-variant overflow-hidden">
        <div class="h-40 bg-sidebar flex items-center justify-center relative">
            {{-- Zellige pattern overlay for the header --}}
            <div class="absolute inset-0 zellige-pattern opacity-10"></div>
            
            <div class="relative w-24 h-24 bg-surface rounded-[2rem] flex items-center justify-center shadow-2xl border-4 border-primary/20">
                <span class="material-symbols-outlined text-primary text-5xl font-bold">shield</span>
            </div>
        </div>

        <div class="p-10 text-center">
            <h2 class="text-3xl font-black text-on-surface tracking-tighter mb-2 uppercase">{{ $equipe->nom }}</h2>
            <p class="text-primary font-black flex items-center justify-center gap-2 uppercase text-[10px] tracking-[0.2em]">
                <span class="material-symbols-outlined text-base">location_on</span>
                {{ $equipe->ville }}
            </p>

            <div class="mt-12 grid grid-cols-2 gap-6 border-t border-outline-variant pt-10">
                <div class="text-left">
                    <p class="text-[10px] font-black text-on-surface-muted uppercase tracking-widest">Date d'enregistrement</p>
                    <p class="font-black text-on-surface text-lg">{{ $equipe->created_at->format('d/m/Y') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-black text-on-surface-muted uppercase tracking-widest">Statut Club</p>
                    <div class="flex items-center justify-end gap-1.5 mt-1">
                        <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></span>
                        <p class="font-black text-on-surface uppercase text-sm">Actif</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-background/50 p-6 px-10 flex justify-between items-center border-t border-outline-variant">
            <a href="{{ route('admin.equipes.index') }}" class="text-on-surface-muted font-black text-[10px] uppercase tracking-widest flex items-center gap-2 hover:text-primary transition-all">
                <span class="material-symbols-outlined text-lg">arrow_back</span> Retour
            </a>
            <a href="{{ route('admin.equipes.edit', $equipe) }}" class="bg-primary text-white px-8 py-3 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
                Modifier
            </a>
        </div>
    </div>
</div>
@endsection