@extends('layouts.arbitre')

@section('arbitre-content')
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
                <span class="inline-block mt-1 text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-full
                    {{ $arbitre->grade === 'international' ? 'bg-yellow-400/20 text-yellow-300' : ($arbitre->grade === 'national' ? 'bg-blue-400/20 text-blue-300' : 'bg-white/10 text-white/60') }}">
                    {{ ucfirst($arbitre->grade) }}
                </span>
            </div>
        </div>

        <form action="{{ route('arbitre.profil.update') }}" method="POST" class="px-8 py-8 space-y-6">
            @csrf
            @method('PATCH')

            {{-- Infos personnelles --}}
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Informations personnelles</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-400 mb-2">Nom complet</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6B3A]/30 focus:border-[#1B6B3A]">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6B3A]/30 focus:border-[#1B6B3A]">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 mb-2">Téléphone</label>
                    <input type="text" name="telephone" value="{{ old('telephone', $arbitre->telephone) }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6B3A]/30 focus:border-[#1B6B3A]">
                    @error('telephone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 mb-2">Adresse</label>
                    <input type="text" name="adresse" value="{{ old('adresse', $arbitre->adresse) }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6B3A]/30 focus:border-[#1B6B3A]">
                </div>
            </div>

            {{-- Password --}}
            <div class="border-t border-slate-100 pt-6">
                <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Changer le mot de passe <span class="font-normal normal-case">(laisser vide pour ne pas changer)</span></p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-2">Nouveau mot de passe</label>
                        <input type="password" name="password"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-[#1B6B3A]/30 focus:border-[#1B6B3A]">
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-2">Confirmer</label>
                        <input type="password" name="password_confirmation"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-[#1B6B3A]/30 focus:border-[#1B6B3A]">
                    </div>
                </div>
            </div>

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