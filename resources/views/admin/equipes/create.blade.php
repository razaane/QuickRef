@extends('layouts.admin')
@section('page-title', 'Ajouter une Équipe')

@section('admin-content')
<div class="max-w-2xl bg-white rounded-3xl shadow-sm border border-slate-200 p-8 relative overflow-hidden">
    {{-- Decorative element --}}
    <div class="absolute top-0 right-0 w-32 h-32 bg-[#1B6B3A]/5 rounded-bl-full -mr-10 -mt-10"></div>

    <form method="POST" action="{{ route('admin.equipes.store') }}" class="relative z-10">
        @csrf
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-black text-slate-700 uppercase tracking-widest mb-2">Nom du Club</label>
                <input type="text" name="nom" value="{{ old('nom') }}" placeholder="Ex: Raja Club Athletic" 
                       class="w-full px-5 py-4 rounded-2xl border {{ $errors->has('nom') ? 'border-red-300 ring-2 ring-red-50' : 'border-slate-200' }} focus:ring-4 focus:ring-[#1B6B3A]/10 focus:border-[#1B6B3A] outline-none transition-all font-medium text-slate-800">
                @error('nom') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-black text-slate-700 uppercase tracking-widest mb-2">Ville</label>
                <input type="text" name="ville" value="{{ old('ville') }}" placeholder="Ex: Casablanca" 
                       class="w-full px-5 py-4 rounded-2xl border {{ $errors->has('ville') ? 'border-red-300 ring-2 ring-red-50' : 'border-slate-200' }} focus:ring-4 focus:ring-[#1B6B3A]/10 focus:border-[#1B6B3A] outline-none transition-all font-medium text-slate-800">
                @error('ville') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex items-center gap-6 mt-10">
            <button type="submit" class="flex-1 bg-[#1B6B3A] text-white py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-[#14522c] hover:shadow-lg transition-all shadow-md">
                Confirmer l'ajout
            </button>
            <a href="{{ route('admin.equipes.index') }}" class="text-slate-400 font-bold hover:text-slate-600 transition-colors uppercase text-xs tracking-widest">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection