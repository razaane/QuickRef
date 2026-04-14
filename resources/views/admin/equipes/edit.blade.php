@extends('layouts.admin')
@section('page-title', 'Modifier l\'Équipe')

@section('admin-content')
<div class="max-w-2xl bg-surface rounded-[2.5rem] shadow-sm border border-outline-variant p-10 relative">
    <form method="POST" action="{{ route('admin.equipes.update', $equipe) }}">
        @csrf @method('PUT')
        
        <div class="space-y-6">
            <div>
                <label class="block text-[10px] font-black text-on-surface-muted uppercase tracking-[0.2em] mb-2">Nom de l'Équipe</label>
                <input type="text" name="nom" value="{{ old('nom', $equipe->nom) }}" 
                       class="w-full px-5 py-4 rounded-2xl border border-outline-variant focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all font-bold text-on-surface">
                @error('nom') <p class="text-primary text-xs mt-2 font-bold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-[10px] font-black text-on-surface-muted uppercase tracking-[0.2em] mb-2">Ville</label>
                <input type="text" name="ville" value="{{ old('ville', $equipe->ville) }}" 
                       class="w-full px-5 py-4 rounded-2xl border border-outline-variant focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all font-bold text-on-surface">
                @error('ville') <p class="text-primary text-xs mt-2 font-bold">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex items-center gap-6 mt-12 pt-8 border-t border-outline-variant">
            <button type="submit" class="flex-1 bg-sidebar text-white py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-primary transition-all shadow-lg">
                Mettre à jour
            </button>
            <a href="{{ route('admin.equipes.index') }}" class="text-on-surface-variant font-black hover:text-on-surface transition-colors uppercase text-[10px] tracking-[0.2em]">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection