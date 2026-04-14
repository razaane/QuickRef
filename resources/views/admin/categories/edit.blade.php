@extends('layouts.admin')
@section('page-title', 'Modifier la Catégorie')

@section('admin-content')
<div class="max-w-2xl bg-surface rounded-[2.5rem] shadow-sm border border-outline-variant p-10 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-full -mr-10 -mt-10"></div>

    <form method="POST" action="{{ route('admin.categories.update', ['category' => $categorie]) }}" class="relative z-10"> 
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            <div>
                <label class="block text-[10px] font-black text-on-surface-muted uppercase tracking-[0.2em] mb-2">Nom de la Catégorie</label>
                <input type="text" name="nom" value="{{ old('nom', $categorie->nom) }}" 
                       class="w-full px-5 py-4 rounded-2xl border {{ $errors->has('nom') ? 'border-primary ring-4 ring-primary/5' : 'border-outline-variant' }} focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all font-bold text-on-surface">
                @error('nom') <p class="text-primary text-xs mt-2 font-bold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-[10px] font-black text-on-surface-muted uppercase tracking-[0.2em] mb-2">Indemnité (DH)</label>
                <div class="relative">
                    <input type="number" step="0.01" name="montant" value="{{ old('montant', $categorie->montant) }}" 
                           class="w-full px-5 py-4 rounded-2xl border {{ $errors->has('montant') ? 'border-primary ring-4 ring-primary/5' : 'border-outline-variant' }} focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all font-bold text-on-surface">
                    <span class="absolute right-5 top-1/2 -translate-y-1/2 text-on-surface-muted font-black text-xs">MAD</span>
                </div>
                @error('montant') <p class="text-primary text-xs mt-2 font-bold">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex items-center gap-6 mt-12 pt-8 border-t border-outline-variant">
            <button type="submit" class="flex-1 bg-sidebar text-white py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-primary transition-all shadow-lg">
                Sauvegarder
            </button>
            <a href="{{ route('admin.categories.index') }}" class="text-on-surface-variant font-black hover:text-on-surface transition-colors uppercase text-[10px] tracking-[0.2em]">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection