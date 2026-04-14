@extends('layouts.admin')
@section('page-title', 'Modifier le Profil')

@section('admin-content')
<div class="max-w-4xl bg-surface rounded-2xl shadow-sm border border-outline-variant p-8">
    <form action="{{ route('admin.arbitres.update', $arbitre->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="space-y-4">
                <h3 class="font-black text-primary uppercase text-xs tracking-widest border-b border-outline-variant pb-2">Identifiants de connexion</h3>
                <div>
                    <label class="block text-sm font-bold text-on-surface mb-1">Nom Complet</label>
                    <input type="text" name="name" value="{{ old('name', $arbitre->user->name) }}" 
                           class="w-full px-4 py-2.5 rounded-xl border border-outline-variant outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-on-surface mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $arbitre->user->email) }}" 
                           class="w-full px-4 py-2.5 rounded-xl border border-outline-variant outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                </div>
                <div class="bg-background p-4 rounded-xl border border-dashed border-outline-variant">
                    <p class="text-[10px] text-primary font-black uppercase mb-1 tracking-widest">Sécurité</p>
                    <p class="text-xs text-on-surface-variant italic">Laissez vide pour conserver le mot de passe actuel.</p>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="font-black text-accent-gold uppercase text-xs tracking-widest border-b border-outline-variant pb-2">Informations Professionnelles</h3>
                <div>
                    <label class="block text-sm font-bold text-on-surface mb-1">Téléphone</label>
                    <input type="text" name="telephone" value="{{ old('telephone', $arbitre->telephone) }}" 
                           class="w-full px-4 py-2.5 rounded-xl border border-outline-variant outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-on-surface mb-1">Grade</label>
                    <select name="grade" class="w-full px-4 py-2.5 rounded-xl border border-outline-variant outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all appearance-none bg-white">
                        <option value="regional" {{ $arbitre->grade == 'regional' ? 'selected' : '' }}>Régional</option>
                        <option value="national" {{ $arbitre->grade == 'national' ? 'selected' : '' }}>National</option>
                        <option value="international" {{ $arbitre->grade == 'international' ? 'selected' : '' }}>International</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-on-surface mb-1">Adresse</label>
                    <input type="text" name="adresse" value="{{ old('adresse', $arbitre->adresse) }}" 
                           class="w-full px-4 py-2.5 rounded-xl border border-outline-variant outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-6 pt-4 border-t border-outline-variant">
            <button type="submit" class="bg-primary text-white px-10 py-3.5 rounded-xl font-black hover:bg-primary-dark shadow-lg shadow-primary/20 transition-all">
                Mettre à jour le profil
            </button>
            <a href="{{ route('admin.arbitres.index') }}" class="text-on-surface-variant font-bold hover:text-on-surface transition-colors">Annuler</a>
        </div>
    </form>
</div>
@endsection