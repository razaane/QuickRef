@extends('layouts.admin')
@section('page-title', 'Nouveau Profil Arbitre')

@section('admin-content')
<div class="max-w-4xl bg-surface rounded-2xl shadow-sm border border-outline-variant p-8">
    
    {{-- 1. Affichage des erreurs Globales (Optionnel mais recommandé) --}}
    @if ($errors->any())
        <div class="mb-8 p-4 bg-rose-500/10 border-l-4 border-rose-600 rounded-r-xl">
            <h4 class="text-[11px] text-rose-500 font-black uppercase tracking-widest mb-1">Erreur de validation</h4>
            <ul class="list-disc list-inside text-[10px] text-rose-500/80 font-bold uppercase tracking-wider">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.arbitres.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            {{-- User Info --}}
            <div class="space-y-4">
                <h3 class="font-black text-rose-600 uppercase text-xs tracking-widest border-b border-outline-variant pb-2 italic">Identifiants de connexion</h3>
                
                {{-- Nom Complet --}}
                <div>
                    <label class="block text-sm font-bold text-on-surface mb-1">Nom Complet</label>
                    <input type="text" name="name" value="{{ old('name') }}" 
                           class="w-full px-4 py-2.5 rounded-xl border @error('name') border-rose-600 @else border-outline-variant @enderror outline-none focus:ring-2 focus:ring-rose-600/20 focus:border-rose-600 transition-all">
                    @error('name')
                        <p class="mt-1 text-[10px] text-rose-500 font-black uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-bold text-on-surface mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full px-4 py-2.5 rounded-xl border @error('email') border-rose-600 @else border-outline-variant @enderror outline-none focus:ring-2 focus:ring-rose-600/20 focus:border-rose-600 transition-all">
                    @error('email')
                        <p class="mt-1 text-[10px] text-rose-500 font-black uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-bold text-on-surface mb-1">Mot de passe provisoire</label>
                    <input type="password" name="password" 
                           class="w-full px-4 py-2.5 rounded-xl border @error('password') border-rose-600 @else border-outline-variant @enderror outline-none focus:ring-2 focus:ring-rose-600/20 focus:border-rose-600 transition-all">
                    @error('password')
                        <p class="mt-1 text-[10px] text-rose-500 font-black uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Arbitre Info --}}
            <div class="space-y-4">
                <h3 class="font-black text-rose-600 uppercase text-xs tracking-widest border-b border-outline-variant pb-2 italic">Informations Professionnelles</h3>
                
                {{-- Téléphone --}}
                <div>
                    <label class="block text-sm font-bold text-on-surface mb-1">Téléphone</label>
                    <input type="text" name="telephone" value="{{ old('telephone') }}"
                           class="w-full px-4 py-2.5 rounded-xl border @error('telephone') border-rose-600 @else border-outline-variant @enderror outline-none focus:ring-2 focus:ring-rose-600/20 focus:border-rose-600 transition-all">
                    @error('telephone')
                        <p class="mt-1 text-[10px] text-rose-500 font-black uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Grade --}}
                <div>
                    <label class="block text-sm font-bold text-on-surface mb-1">Grade</label>
                    <select name="grade" class="w-full px-4 py-2.5 rounded-xl border @error('grade') border-rose-600 @else border-outline-variant @enderror outline-none focus:ring-2 focus:ring-rose-600/20 focus:border-rose-600 transition-all appearance-none bg-white">
                        <option value="regional" {{ old('grade') == 'regional' ? 'selected' : '' }}>Régional</option>
                        <option value="national" {{ old('grade') == 'national' ? 'selected' : '' }}>National</option>
                        <option value="international" {{ old('grade') == 'international' ? 'selected' : '' }}>International</option>
                    </select>
                    @error('grade')
                        <p class="mt-1 text-[10px] text-rose-500 font-black uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Adresse --}}
                <div>
                    <label class="block text-sm font-bold text-on-surface mb-1">Adresse (Optionnel)</label>
                    <input type="text" name="adresse" value="{{ old('adresse') }}"
                           class="w-full px-4 py-2.5 rounded-xl border @error('adresse') border-rose-600 @else border-outline-variant @enderror outline-none focus:ring-2 focus:ring-rose-600/20 focus:border-rose-600 transition-all">
                    @error('adresse')
                        <p class="mt-1 text-[10px] text-rose-500 font-black uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex items-center gap-6 pt-4 border-t border-outline-variant">
            <button type="submit" class="bg-rose-600 text-white px-10 py-3.5 rounded-xl font-black hover:bg-rose-700 shadow-lg shadow-rose-600/20 transition-all active:scale-95 uppercase tracking-widest text-xs">
                Enregistrer l'arbitre
            </button>
            <a href="{{ route('admin.arbitres.index') }}" class="text-on-surface-variant font-bold hover:text-rose-600 transition-colors uppercase text-[10px] tracking-widest">Annuler</a>
        </div>
    </form>
</div>
@endsection