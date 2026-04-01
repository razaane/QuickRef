@extends('layouts.admin')
@section('page-title', 'Modifier l\'Équipe')

@section('admin-content')
<div class="max-w-2xl bg-white rounded-3xl shadow-sm border border-slate-200 p-8 relative">
    <form method="POST" action="{{ route('admin.equipes.update', $equipe) }}">
        @csrf @method('PUT')
        
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-black text-slate-700 uppercase tracking-widest mb-2">Nom de l'Équipe</label>
                <input type="text" name="nom" value="{{ old('nom', $equipe->nom) }}" 
                       class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-[#1B6B3A]/10 focus:border-[#1B6B3A] outline-none transition-all font-medium">
                @error('nom') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-black text-slate-700 uppercase tracking-widest mb-2">Ville</label>
                <input type="text" name="ville" value="{{ old('ville', $equipe->ville) }}" 
                       class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-[#1B6B3A]/10 focus:border-[#1B6B3A] outline-none transition-all font-medium">
                @error('ville') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex items-center gap-6 mt-10">
            <button type="submit" class="flex-1 bg-[#C9A84C] text-[#1B6B3A] py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-[#b39542] hover:shadow-lg transition-all shadow-md border border-[#1B6B3A]/10">
                Sauvegarder les modifications
            </button>
            <a href="{{ route('admin.equipes.index') }}" class="text-slate-400 font-bold hover:text-slate-600 transition-colors uppercase text-xs tracking-widest">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection