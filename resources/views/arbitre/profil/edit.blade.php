@extends('layouts.arbitre')

@section('arbitre-content')
<div class="max-w-2xl mx-auto">
    @if(session('success'))
    <div class="mb-8 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl flex items-center gap-3">
        <span class="material-symbols-outlined text-emerald-500 text-sm">check_circle</span>
        <p class="text-emerald-700 font-bold text-[10px] uppercase tracking-widest">{{ session('success') }}</p>
    </div>
    @endif

    <div class="bg-surface rounded-xl border border-outline-variant shadow-sm overflow-hidden">
        <div class="bg-sidebar px-8 py-10 flex items-center gap-6 border-b border-white/5">
            <div class="w-20 h-20 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center shadow-inner">
                <span class="material-symbols-outlined text-white/40 text-4xl">account_circle</span>
            </div>
            <div>
                <h2 class="text-2xl font-black text-white uppercase tracking-tighter">{{ $user->name }}</h2>
                <span class="inline-block mt-2 text-[8px] font-black uppercase tracking-[0.2em] px-3 py-1 rounded-full border border-primary/40 bg-primary/10 text-primary">
                    {{ ucfirst($arbitre->grade) }}
                </span>
            </div>
        </div>

        <form action="{{ route('arbitre.profil.update') }}" method="POST" class="px-8 py-8 space-y-8">
            @csrf
            @method('PATCH')

            <div class="space-y-6">
                <h3 class="text-[10px] font-black text-primary uppercase tracking-[0.2em]">Coordonnées Personnelles</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach(['name' => 'Nom Complet', 'email' => 'Adresse Email', 'telephone' => 'Téléphone', 'adresse' => 'Adresse'] as $key => $label)
                    <div class="space-y-2">
                        <label class="block text-[9px] font-black text-on-surface-muted uppercase tracking-widest ml-1">{{ $label }}</label>
                        <input type="{{ $key === 'email' ? 'email' : 'text' }}" name="{{ $key }}" value="{{ old($key, $key === 'name' || $key === 'email' ? $user->$key : $arbitre->$key) }}"
                            class="w-full px-4 py-3 rounded-xl bg-background border border-outline-variant text-sm font-bold text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                        @error($key) <p class="text-primary text-[9px] font-bold mt-1 uppercase">{{ $message }}</p> @enderror
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="pt-8 border-t border-outline-variant/50 space-y-6">
                <div>
                    <h3 class="text-[10px] font-black text-primary uppercase tracking-[0.2em]">Sécurité</h3>
                    <p class="text-[9px] text-on-surface-muted italic font-medium mt-1">Laissez vide pour conserver votre mot de passe actuel.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[9px] font-black text-on-surface-muted uppercase tracking-widest ml-1">Nouveau Password</label>
                        <input type="password" name="password" class="w-full px-4 py-3 rounded-xl bg-background border border-outline-variant text-sm font-bold focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[9px] font-black text-on-surface-muted uppercase tracking-widest ml-1">Confirmation</label>
                        <input type="password" name="password_confirmation" class="w-full px-4 py-3 rounded-xl bg-background border border-outline-variant text-sm font-bold focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none transition-all">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-primary-dark transition-all shadow-xl shadow-primary/20 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">save</span> Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection