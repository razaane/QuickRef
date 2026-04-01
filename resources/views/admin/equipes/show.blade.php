@extends('layouts.admin')
@section('page-title', 'Détails de l\'Équipe')

@section('admin-content')
<div class="max-w-xl">
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="h-32 bg-[#1B6B3A] flex items-center justify-center">
            <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center shadow-2xl">
                <span class="material-symbols-outlined text-[#1B6B3A] text-4xl">shield</span>
            </div>
        </div>
        <div class="p-8 text-center">
            <h2 class="text-3xl font-black text-slate-900 tracking-tight mb-2">{{ $equipe->nom }}</h2>
            <p class="text-slate-500 font-bold flex items-center justify-center gap-1 uppercase text-xs tracking-widest">
                <span class="material-symbols-outlined text-sm">location_on</span>
                {{ $equipe->ville }}
            </p>

            <div class="mt-10 grid grid-cols-2 gap-4 border-t border-slate-100 pt-8">
                <div class="text-left">
                    <p class="text-[10px] font-black text-slate-400 uppercase">Enregistré le</p>
                    <p class="font-bold text-slate-700">{{ $equipe->created_at->format('d/m/Y') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-black text-slate-400 uppercase">Statut</p>
                    <p class="font-bold text-emerald-600">Actif</p>
                </div>
            </div>
        </div>
        <div class="bg-slate-50 p-6 flex justify-between">
            <a href="{{ route('admin.equipes.index') }}" class="text-slate-500 font-bold text-sm flex items-center gap-1 hover:text-slate-900">
                <span class="material-symbols-outlined">arrow_back</span> Retour
            </a>
            <a href="{{ route('admin.equipes.edit', $equipe) }}" class="bg-[#1B6B3A] text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-[#14522c]">
                Modifier
            </a>
        </div>
    </div>
</div>
@endsection