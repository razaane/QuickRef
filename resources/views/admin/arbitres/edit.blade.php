@extends('layouts.admin')
@section('page-title', 'Modifier le Profil Arbitre')

@section('admin-content')
<div class="max-w-4xl bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
    {{-- 1. Tashi7 l-Action o l-Method --}}
    <form action="{{ route('admin.arbitres.update', $arbitre->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Darori l-Laravel bach y-3refha Update --}}

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            {{-- User Info --}}
            <div class="space-y-4">
                <h3 class="font-black text-[#1B6B3A] uppercase text-xs tracking-widest border-b pb-2">Identifiants de connexion</h3>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Nom Complet</label>
                    <input type="text" name="name" value="{{ old('name', $arbitre->user->name) }}" 
                           class="w-full px-4 py-2.5 rounded-lg border border-slate-200 outline-none focus:ring-2 focus:ring-[#1B6B3A]">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $arbitre->user->email) }}" 
                           class="w-full px-4 py-2.5 rounded-lg border border-slate-200 outline-none focus:ring-2 focus:ring-[#1B6B3A]">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="bg-slate-50 p-3 rounded-lg border border-dashed border-slate-200">
                    <p class="text-[10px] text-slate-500 font-bold uppercase mb-1">Sécurité</p>
                    <p class="text-xs text-slate-400 italic">Laissez vide pour conserver le mot de passe actuel.</p>
                </div>
            </div>

            {{-- Arbitre Info --}}
            <div class="space-y-4">
                <h3 class="font-black text-[#C9A84C] uppercase text-xs tracking-widest border-b pb-2">Informations Professionnelles</h3>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Téléphone</label>
                    <input type="text" name="telephone" value="{{ old('telephone', $arbitre->telephone) }}" 
                           class="w-full px-4 py-2.5 rounded-lg border border-slate-200 outline-none focus:ring-2 focus:ring-[#1B6B3A]">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Grade</label>
                    <select name="grade" class="w-full px-4 py-2.5 rounded-lg border border-slate-200 outline-none focus:ring-2 focus:ring-[#1B6B3A]">
                        <option value="regional" {{ $arbitre->grade == 'regional' ? 'selected' : '' }}>Régional</option>
                        <option value="national" {{ $arbitre->grade == 'national' ? 'selected' : '' }}>National</option>
                        <option value="international" {{ $arbitre->grade == 'international' ? 'selected' : '' }}>International</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Adresse (Optionnel)</label>
                    <input type="text" name="adresse" value="{{ old('adresse', $arbitre->adresse) }}" 
                           class="w-full px-4 py-2.5 rounded-lg border border-slate-200 outline-none focus:ring-2 focus:ring-[#1B6B3A]">
                </div>
            </div>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-[#1B6B3A] text-white px-8 py-3 rounded-lg font-bold hover:shadow-lg transition-all">
                Enregistrer les modifications
            </button>
            <a href="{{ route('admin.arbitres.index') }}" class="px-8 py-3 text-slate-500 font-bold">Annuler</a>
        </div>
    </form>
</div>
@endsection