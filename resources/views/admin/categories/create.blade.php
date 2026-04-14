@extends('layouts.admin')
@section('page-title', 'Nouvelle Catégorie')

@section('admin-content')
<div class="max-w-xl bg-surface rounded-[2.5rem] shadow-sm border border-outline-variant p-10 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-full -mr-10 -mt-10"></div>

    <form method="POST" action="{{ route('admin.categories.store') }}" class="relative z-10">
        @csrf
        <div class="space-y-6">
            <div>
                <label class="block text-[10px] font-black text-on-surface-muted uppercase tracking-[0.2em] mb-2">Désignation (ex: U15, Botola...)</label>
                <input type="text" name="nom" placeholder="Saisir le nom..." 
                       class="w-full px-5 py-4 rounded-2xl border border-outline-variant focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all font-bold text-on-surface">
            </div>
            <div>
                <label class="block text-[10px] font-black text-on-surface-muted uppercase tracking-[0.2em] mb-2">Indemnité de match</label>
                <div class="relative">
                    <input type="number" step="0.01" name="montant" placeholder="0.00" 
                           class="w-full px-5 py-4 rounded-2xl border border-outline-variant focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all font-bold text-on-surface">
                    <span class="absolute right-5 top-1/2 -translate-y-1/2 text-on-surface-muted font-black text-xs">MAD</span>
                </div>
            </div>
            
            <div class="pt-6">
                <button type="submit" class="w-full bg-primary text-white py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
                    Enregistrer la catégorie
                </button>
                <a href="{{ route('admin.categories.index') }}" class="block text-center mt-4 text-on-surface-variant font-black text-[10px] uppercase tracking-widest hover:text-on-surface">Annuler</a>
            </div>
        </div>
    </form>
</div>
@endsection