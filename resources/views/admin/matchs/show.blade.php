@extends('layouts.admin')

@section('admin-content')
<div class="max-w-5xl mx-auto px-4 py-8">
    {{-- Header avec Bouton Retour --}}
    <div class="flex items-center justify-between mb-10">
        <div>
            <h1 class="text-3xl font-black text-slate-800 uppercase tracking-tighter">Détails du Match #{{ $match->id }}</h1>
            <p class="text-slate-500 font-medium font-serif italic">Consultation de la fiche de rencontre</p>
        </div>
        <a href="{{ route('admin.matchs.index') }}" class="group flex items-center gap-2 bg-white px-6 py-3 rounded-2xl shadow-sm border border-slate-100 text-slate-500 hover:text-[#1B6B3A] transition-all font-bold">
            <span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span> 
            Retour à la liste
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Carte Principale: Score & Équipes --}}
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-100 relative overflow-hidden">
                {{-- Badge Statut --}}
                <div class="absolute top-8 right-8">
                    @php
                        $statusColors = [
                            'en_attente' => 'bg-amber-100 text-amber-700',
                            'confirmer'  => 'bg-emerald-100 text-emerald-700',
                            'jouer'      => 'bg-blue-100 text-blue-700',
                            'annuler'    => 'bg-red-100 text-red-700',
                            'reporter'   => 'bg-purple-100 text-purple-700',
                        ];
                    @endphp
                    <span class="px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest {{ $statusColors[$match->statut] ?? 'bg-slate-100' }}">
                        {{ str_replace('_', ' ', $match->statut) }}
                    </span>
                </div>

                <div class="flex flex-col md:flex-row items-center justify-between gap-8 mt-4">
                    {{-- Domicile --}}
                    <div class="text-center space-y-4 flex-1">
                        <div class="w-24 h-24 mx-auto bg-slate-50 rounded-full flex items-center justify-center border-4 border-[#C9A84C]/10">
                            <span class="material-symbols-outlined text-4xl text-[#C9A84C]">shield</span>
                        </div>
                        <h2 class="text-xl font-black text-slate-800 uppercase">{{ $match->equipeDomicile->nom }}</h2>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Domicile</span>
                    </div>

                    {{-- VS --}}
                    <div class="text-center">
                        <div class="text-4xl font-black text-slate-200 italic">VS</div>
                        <div class="mt-2 h-1 w-12 bg-[#C9A84C]/20 mx-auto rounded-full"></div>
                    </div>

                    {{-- Visiteur --}}
                    <div class="text-center space-y-4 flex-1">
                        <div class="w-24 h-24 mx-auto bg-slate-50 rounded-full flex items-center justify-center border-4 border-slate-100">
                            <span class="material-symbols-outlined text-4xl text-slate-300">shield</span>
                        </div>
                        <h2 class="text-xl font-black text-slate-800 uppercase">{{ $match->equipeVisiteur->nom }}</h2>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Visiteur</span>
                    </div>
                </div>

                {{-- Détails du lieu --}}
                <div class="mt-12 pt-8 border-t border-slate-50 grid grid-cols-2 gap-4 text-center">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase mb-1">Terrain</p>
                        <p class="font-bold text-slate-700">{{ $match->terrain }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase mb-1">Ville</p>
                        <p class="font-bold text-slate-700">{{ $match->ville }}</p>
                    </div>
                </div>
            </div>

            {{-- Carte Infos Complémentaires --}}
            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-[#1B6B3A]">
                            <span class="material-symbols-outlined">calendar_today</span>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase">Date & Heure</p>
                            <p class="text-lg font-bold text-slate-800">{{ \Carbon\Carbon::parse($match->date_heure)->format('d F Y') }}</p>
                            <p class="text-slate-500 font-medium">{{ \Carbon\Carbon::parse($match->date_heure)->format('H:i') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-[#C9A84C]">
                            <span class="material-symbols-outlined">payments</span>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase">Catégorie & Indemnité</p>
                            <p class="text-lg font-bold text-slate-800">{{ $match->categorie->nom }}</p>
                            <p class="text-[#1B6B3A] font-black">{{ number_format($match->categorie->montant, 2) }} MAD</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Colonne Droite: Arbitres --}}
        <div class="space-y-6">
            <div class="bg-[#1B6B3A] rounded-[2.5rem] p-8 shadow-xl text-white relative overflow-hidden">
                <div class="absolute -right-4 -top-4 opacity-10">
                    <span class="material-symbols-outlined text-[120px]">gavel</span>
                </div>
                
                <h3 class="text-xs font-black uppercase text-white/50 mb-8 tracking-widest relative z-10">Corps Arbitral</h3>
                
                <div class="space-y-6 relative z-10">
                    {{-- Central --}}
                    <div class="bg-white/10 p-4 rounded-2xl border border-white/10">
                        <p class="text-[9px] font-black uppercase text-white/50 mb-1">Arbitre Central</p>
                        <p class="font-bold text-lg">{{ $match->arbitreCentral->user->name ?? 'Non assigné' }}</p>
                    </div>

                    {{-- Assistants --}}
                    <div class="grid grid-cols-1 gap-4">
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                            <p class="text-[9px] font-black uppercase text-white/50 mb-1">Assistant 1</p>
                            <p class="font-bold">{{ $match->assistant1->user->name ?? 'Non assigné' }}</p>
                        </div>
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                            <p class="text-[9px] font-black uppercase text-white/50 mb-1">Assistant 2</p>
                            <p class="font-bold">{{ $match->assistant2->user->name ?? 'Non assigné' }}</p>
                        </div>
                    </div>

                    {{-- 4ème --}}
                    <div class="pt-4 border-t border-white/10">
                        <p class="text-[9px] font-black uppercase text-white/50 mb-1">Quatrième Arbitre</p>
                        <p class="font-medium text-white/90 italic">{{ $match->quatrieme->user->name ?? 'Aucun' }}</p>
                    </div>
                </div>
            </div>

            {{-- Bouton Modifier --}}
            <a href="{{ route('admin.matchs.edit', $match->id) }}" class="w-full bg-[#C9A84C] text-white py-5 rounded-[2rem] font-black uppercase tracking-widest hover:bg-[#b39540] transition-all shadow-lg flex items-center justify-center gap-3">
                <span class="material-symbols-outlined">edit</span> Modifier le match
            </a>
        </div>
    </div>
</div>
@endsection