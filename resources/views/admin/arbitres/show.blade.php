@extends('layouts.admin')
@section('page-title', 'Profil de ' . $arbitre->user->name)

@section('admin-content')
<div class="max-w-2xl bg-surface rounded-[2.5rem] shadow-sm border border-outline-variant overflow-hidden">
    <div class="bg-sidebar p-10 text-center relative overflow-hidden">
        {{-- Subtle background decoration --}}
        <div class="absolute top-0 right-0 w-32 h-32 bg-primary/10 rounded-full -mr-16 -mt-16"></div>
        
        <div class="relative">
            <div class="w-28 h-28 bg-primary rounded-full mx-auto flex items-center justify-center mb-4 border-4 border-white/10 shadow-2xl shadow-primary/40">
                <span class="material-symbols-outlined text-white text-5xl">person</span>
            </div>
            <h2 class="text-3xl font-black text-white tracking-tight">{{ $arbitre->user->name }}</h2>
            <span class="px-5 py-1.5 bg-primary text-white rounded-full text-[10px] font-black uppercase tracking-[0.2em] mt-3 inline-block shadow-lg">
                {{ $arbitre->grade }}
            </span>
        </div>
    </div>
    
    <div class="p-10 space-y-8">
        <div class="grid grid-cols-1 gap-6">
            <div class="flex items-center gap-4 group">
                <div class="w-10 h-10 rounded-xl bg-background flex items-center justify-center text-primary border border-outline-variant group-hover:bg-primary group-hover:text-white transition-all">
                    <span class="material-symbols-outlined text-xl">mail</span>
                </div>
                <div>
                    <p class="text-[10px] font-black text-on-surface-muted uppercase tracking-widest">Email Officiel</p>
                    <p class="font-bold text-on-surface">{{ $arbitre->user->email }}</p>
                </div>
            </div>

            <div class="flex items-center gap-4 group">
                <div class="w-10 h-10 rounded-xl bg-background flex items-center justify-center text-primary border border-outline-variant group-hover:bg-primary group-hover:text-white transition-all">
                    <span class="material-symbols-outlined text-xl">call</span>
                </div>
                <div>
                    <p class="text-[10px] font-black text-on-surface-muted uppercase tracking-widest">Téléphone</p>
                    <p class="font-bold text-on-surface">{{ $arbitre->telephone }}</p>
                </div>
            </div>

            <div class="flex items-center gap-4 group">
                <div class="w-10 h-10 rounded-xl bg-background flex items-center justify-center text-primary border border-outline-variant group-hover:bg-primary group-hover:text-white transition-all">
                    <span class="material-symbols-outlined text-xl">location_on</span>
                </div>
                <div>
                    <p class="text-[10px] font-black text-on-surface-muted uppercase tracking-widest">Adresse</p>
                    <p class="font-bold text-on-surface">{{ $arbitre->adresse ?? 'Non renseignée' }}</p>
                </div>
            </div>
        </div>

        <div class="pt-8 text-center border-t border-outline-variant">
            <a href="{{ route('admin.arbitres.edit', $arbitre->id) }}" class="inline-flex items-center gap-2 text-primary font-black text-xs uppercase tracking-widest hover:text-primary-dark transition-all">
                <span class="material-symbols-outlined text-lg">edit</span>
                Modifier les informations
            </a>
        </div>
    </div>
</div>
@endsection