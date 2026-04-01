@extends('layouts.admin')
@section('page-title', 'Modifier la Catégorie')

@section('admin-content')
<div class="max-w-2xl bg-white rounded-3xl shadow-sm border border-slate-200 p-8 relative overflow-hidden">
    {{-- Decorative Background Element --}}
    <div class="absolute top-0 right-0 w-32 h-32 bg-[#C9A84C]/5 rounded-bl-full -mr-10 -mt-10"></div>

    <form method="POST" action="{{ route('admin.categories.update', $categorie->id) }}" class="relative z-10">
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            {{-- Nom de la Catégorie --}}
            <div>
                <label class="block text-sm font-black text-slate-700 uppercase tracking-widest mb-2">Nom de la Catégorie</label>
                <input type="text" name="nom" value="{{ old('nom', $categorie->nom) }}" 
                       class="w-full px-5 py-4 rounded-2xl border {{ $errors->has('nom') ? 'border-red-300 ring-2 ring-red-50' : 'border-slate-200' }} focus:ring-4 focus:ring-[#1B6B3A]/10 focus:border-[#1B6B3A] outline-none transition-all font-medium text-slate-800">
                @error('nom') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
            </div>

            {{-- Montant --}}
            <div>
                <label class="block text-sm font-black text-slate-700 uppercase tracking-widest mb-2">Indemnité (DH)</label>
                <div class="relative">
                    <input type="number" step="0.01" name="montant" value="{{ old('montant', $categorie->montant) }}" 
                           class="w-full px-5 py-4 rounded-2xl border {{ $errors->has('montant') ? 'border-red-300 ring-2 ring-red-50' : 'border-slate-200' }} focus:ring-4 focus:ring-[#1B6B3A]/10 focus:border-[#1B6B3A] outline-none transition-all font-medium text-slate-800">
                    <span class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 font-bold">MAD</span>
                </div>
                @error('montant') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex items-center gap-6 mt-10">
            <button type="submit" class="flex-1 bg-[#1B6B3A] text-white py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-[#14522c] hover:shadow-lg transition-all shadow-md">
                Mettre à jour
            </button>
            <a href="{{ route('admin.categories.index') }}" class="text-slate-400 font-bold hover:text-slate-600 transition-colors uppercase text-xs tracking-widest">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection