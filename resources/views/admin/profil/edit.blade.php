@extends('layouts.admin')

@section('page-title', 'Mon Profil')

@section('admin-content')
<div class="max-w-2xl mx-auto">

    @if(session('success'))
    <div class="mb-6 px-6 py-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-700 font-bold text-sm">
        ✓ {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">

        {{-- Header --}}
        <div class="bg-[#1B6B3A] px-8 py-8 flex items-center gap-5">
            <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center">
                <span class="material-symbols-outlined text-white text-3xl">account_circle</span>
            </div>
            <div>
                <p class="text-white font-black text-xl">{{ $user->name }}</p>
                <p class="text-white/60 text-xs font-bold uppercase tracking-widest mt-1">Administrateur</p>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('admin.profil.update') }}" method="POST" class="px-8 py-8 space-y-6">
            @csrf
            @method('PATCH')

            {{-- Nom --}}
            <div>
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Nom complet</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6B3A]/30 focus:border-[#1B6B3A]">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Adresse Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6B3A]/30 focus:border-[#1B6B3A]">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Divider --}}
            <div class="border-t border-slate-100 pt-6">
                <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Changer le mot de passe <span class="font-normal normal-case">(laisser vide pour ne pas changer)</span></p>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-2">Nouveau mot de passe</label>
                        <input type="password" name="password"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-[#1B6B3A]/30 focus:border-[#1B6B3A]">
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-2">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-[#1B6B3A]/30 focus:border-[#1B6B3A]">
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex justify-end pt-2">
                <button type="submit"
                    class="bg-[#1B6B3A] text-white px-8 py-3 rounded-xl text-sm font-black uppercase tracking-widest hover:bg-[#155c30] transition-all shadow-lg shadow-[#1B6B3A]/20">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection