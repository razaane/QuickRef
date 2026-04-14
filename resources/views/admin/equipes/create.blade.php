@extends('layouts.admin')
@section('page-title', 'Ajouter une Équipe')

@section('admin-content')
<div class="max-w-2xl bg-surface rounded-[2.5rem] shadow-sm border border-outline-variant p-10 relative overflow-hidden">
    {{-- Decorative element --}}
    <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-full -mr-10 -mt-10"></div>

    <form method="POST" action="{{ route('admin.equipes.store') }}" class="relative z-10">
        @csrf
        <div class="space-y-6">
            <div>
                <label class="block text-[10px] font-black text-on-surface-muted uppercase tracking-[0.2em] mb-2">Nom du Club</label>
                <input type="text" name="nom" value="{{ old('nom') }}" placeholder="Ex: Raja Club Athletic" 
                       class="w-full px-5 py-4 rounded-2xl border {{ $errors->has('nom') ? 'border-primary ring-4 ring-primary/5' : 'border-outline-variant' }} focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all font-bold text-on-surface placeholder:text-on-surface-muted/50">
                @error('nom') <p class="text-primary text-xs mt-2 font-bold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-[10px] font-black text-on-surface-muted uppercase tracking-[0.2em] mb-2">Ville</label>
                <input type="text" name="ville" value="{{ old('ville') }}" placeholder="Ex: Casablanca" 
                       class="w-full px-5 py-4 rounded-2xl border {{ $errors->has('ville') ? 'border-primary ring-4 ring-primary/5' : 'border-outline-variant' }} focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all font-bold text-on-surface placeholder:text-on-surface-muted/50">
                @error('ville') <p class="text-primary text-xs mt-2 font-bold">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex items-center gap-6 mt-12 pt-8 border-t border-outline-variant">
            <button type="submit" class="flex-1 bg-primary text-white py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-primary-dark hover:shadow-xl hover:shadow-primary/20 transition-all shadow-md">
                Confirmer l'ajout
            </button>
            <a href="{{ route('admin.equipes.index') }}" class="text-on-surface-variant font-black hover:text-on-surface transition-colors uppercase text-[10px] tracking-[0.2em]">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection