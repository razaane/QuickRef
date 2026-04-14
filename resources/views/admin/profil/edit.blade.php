@extends('layouts.admin')

@section('page-title', 'Mon Profil')

@section('admin-content')
<div class="max-w-2xl mx-auto p-6">

    {{-- Notification de succès --}}
    @if(session('success'))
    <div class="mb-8 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl flex items-center gap-3">
        <span class="material-symbols-outlined text-emerald-600 text-sm">check_circle</span>
        <p class="text-emerald-700 font-bold text-xs uppercase tracking-wider">{{ session('success') }}</p>
    </div>
    @endif

    <div class="bg-surface rounded-xl border border-outline-variant shadow-sm overflow-hidden">

        {{-- Header Profil --}}
        <div class="bg-sidebar px-8 py-10 flex items-center gap-6 border-b border-white/5">
            <div class="w-20 h-20 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center shadow-inner">
                <span class="material-symbols-outlined text-white/40 text-4xl font-light">person</span>
            </div>
            <div>
                <h2 class="text-2xl font-black text-white uppercase tracking-tighter">{{ $user->name }}</h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <p class="text-white/40 text-[10px] font-black uppercase tracking-[0.2em]">Administrateur Système</p>
                </div>
            </div>
        </div>

        {{-- Formulaire --}}
        <form action="{{ route('admin.profil.update') }}" method="POST" class="px-8 py-8 space-y-8">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nom --}}
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-on-surface-muted uppercase tracking-widest ml-1">Identité</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-3.5 rounded-xl bg-background border border-outline-variant text-sm font-bold text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all shadow-inner"
                        placeholder="Nom complet">
                    @error('name') <p class="text-primary text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-on-surface-muted uppercase tracking-widest ml-1">Email de contact</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-3.5 rounded-xl bg-background border border-outline-variant text-sm font-bold text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all shadow-inner"
                        placeholder="adresse@mail.com">
                    @error('email') <p class="text-primary text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Sécurité --}}
            <div class="pt-6 border-t border-outline-variant/50">
                <div class="mb-6">
                    <h3 class="text-[10px] font-black text-primary uppercase tracking-widest mb-1">Sécurité du compte</h3>
                    <p class="text-[9px] text-on-surface-muted font-medium italic">Laissez vide si vous ne souhaitez pas modifier votre mot de passe actuel.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-bold text-on-surface-muted uppercase ml-1">Nouveau mot de passe</label>
                        <input type="password" name="password"
                            class="w-full px-4 py-3.5 rounded-xl bg-background border border-outline-variant text-sm font-bold focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                            placeholder="••••••••">
                        @error('password') <p class="text-primary text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-bold text-on-surface-muted uppercase ml-1">Confirmation</label>
                        <input type="password" name="password_confirmation"
                            class="w-full px-4 py-3.5 rounded-xl bg-background border border-outline-variant text-sm font-bold focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                            placeholder="••••••••">
                    </div>
                </div>
            </div>

            {{-- Bouton Actions --}}
            <div class="flex items-center justify-between pt-4">
                <p class="text-[9px] text-on-surface-muted font-bold italic uppercase tracking-tighter opacity-50">Dernière mise à jour : {{ $user->updated_at->format('d/m/Y') }}</p>
                
                <button type="submit"
                    class="bg-primary text-white px-10 py-4 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-primary-dark transition-all shadow-xl shadow-primary/20 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">save</span>
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection