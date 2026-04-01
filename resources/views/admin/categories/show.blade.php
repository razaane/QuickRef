@extends('layouts.admin')
@section('page-title', 'Détails Catégorie')

@section('admin-content')
<div class="max-w-xl">
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        {{-- Header Card --}}
        <div class="h-32 bg-[#C9A84C] flex items-center justify-center relative">
            <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center shadow-2xl relative z-10">
                <span class="material-symbols-outlined text-[#1B6B3A] text-4xl">payments</span>
            </div>
            {{-- Pattern overlay --}}
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fff 2px, transparent 2px); background-size: 20px 20px;"></div>
        </div>

        <div class="p-8 text-center">
            <span class="text-[10px] font-black text-[#1B6B3A] bg-[#1B6B3A]/10 px-4 py-1 rounded-full uppercase tracking-[0.2em] mb-4 inline-block">
                Classification
            </span>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight mb-6">{{ $categorie->nom }}</h2>
            
            {{-- Big Amount Display --}}
            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Tarif par match</p>
                <p class="text-4xl font-black text-[#1B6B3A] tracking-tighter">
                    {{ number_format($categorie->montant, 2) }} <span class="text-lg text-slate-400">DH</span>
                </p>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 flex justify-around items-center">
                <div class="text-center">
                    <p class="text-[10px] font-black text-slate-400 uppercase">Créée le</p>
                    <p class="font-bold text-slate-700 text-sm">{{ $categorie->created_at->format('d/m/Y') }}</p>
                </div>
                <div class="w-px h-8 bg-slate-100"></div>
                <div class="text-center">
                    <p class="text-[10px] font-black text-slate-400 uppercase">Statut</p>
                    <p class="font-bold text-emerald-600 text-sm">Opérationnel</p>
                </div>
            </div>
        </div>

        {{-- Footer Actions --}}
        <div class="bg-slate-50 p-6 flex justify-between items-center">
            <a href="{{ route('admin.categories.index') }}" class="text-slate-500 font-bold text-sm flex items-center gap-1 hover:text-slate-900 transition-colors">
                <span class="material-symbols-outlined text-sm">arrow_back</span> Retour
            </a>
            <div class="flex gap-3">
                <a href="{{ route('admin.categories.edit', $categorie->id) }}" class="bg-[#1B6B3A] text-white px-6 py-2 rounded-xl text-sm font-bold hover:bg-[#14522c] transition-all">
                    Modifier
                </a>
            </div>
        </div>
    </div>
</div>
@endsection