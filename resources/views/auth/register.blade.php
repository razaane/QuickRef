{{-- auth/register.blade.php --}}
@extends('layouts.guest')

@section('title', 'Inscription — QuickRef')

@section('content')
<main class="w-full max-w-4xl bg-surface-container-lowest border border-tertiary/20 shadow-xl shadow-on-surface/[0.03] rounded-lg overflow-hidden flex flex-col">

    {{-- Header Branding --}}
    <header class="pt-10 pb-6 px-8 flex flex-col items-center border-b border-surface-container-low">
        <div class="mb-4 w-16 h-16 bg-primary/5 rounded-full flex items-center justify-center">
            <span class="material-symbols-outlined text-primary text-3xl">sports_soccer</span>
        </div>
        <h1 class="font-headline text-3xl font-extrabold text-tertiary tracking-tighter uppercase">QuickRef</h1>
        <p class="font-label text-sm text-on-surface-variant mt-1 tracking-wide">Direction Nationale de l'Arbitrage</p>
    </header>

    {{-- Form Content --}}
    <div class="p-8 md:p-12">

        <div class="mb-10">
            <h2 class="font-headline text-2xl font-bold text-primary mb-2">Inscription au Portail Arbitre</h2>
            <p class="text-on-surface-variant text-sm">Veuillez renseigner vos informations officielles pour créer votre compte.</p>
        </div>

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                @foreach ($errors->all() as $error)
                    <p class="text-xs text-red-600 font-medium">• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">

                {{-- Left Column --}}
                <div class="space-y-6">

                    {{-- Full name --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label text-xs font-bold text-on-surface uppercase tracking-wider" for="name">
                            Nom complet
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-lg">person</span>
                            <input
                                class="w-full pl-10 pr-4 py-3 bg-surface text-on-surface border border-primary/20 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary transition-all outline-none placeholder:text-outline-variant @error('name') border-red-400 @enderror"
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                placeholder="Ex: Mohamed Amine"
                                required
                                autocomplete="name"
                            />
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label text-xs font-bold text-on-surface uppercase tracking-wider" for="email">
                            Email
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-lg">mail</span>
                            <input
                                class="w-full pl-10 pr-4 py-3 bg-surface text-on-surface border border-primary/20 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary transition-all outline-none placeholder:text-outline-variant @error('email') border-red-400 @enderror"
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                placeholder="arbitre@frmf.ma"
                                required
                                autocomplete="email"
                            />
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label text-xs font-bold text-on-surface uppercase tracking-wider" for="phone">
                            Téléphone
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-lg">call</span>
                            <input
                                class="w-full pl-10 pr-4 py-3 bg-surface text-on-surface border border-primary/20 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary transition-all outline-none placeholder:text-outline-variant @error('phone') border-red-400 @enderror"
                                id="telephone"
                                name="telephone"
                                type="tel"
                                value="{{ old('phone') }}"
                                placeholder="+212 600-000000"
                            />
                        </div>
                    </div>

                </div>

                {{-- Right Column --}}
                <div class="space-y-6">

                    {{-- Password --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label text-xs font-bold text-on-surface uppercase tracking-wider" for="password">
                            Mot de passe
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-lg">lock</span>
                            <input
                                class="w-full pl-10 pr-4 py-3 bg-surface text-on-surface border border-primary/20 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary transition-all outline-none placeholder:text-outline-variant @error('password') border-red-400 @enderror"
                                id="password"
                                name="password"
                                type="password"
                                placeholder="••••••••"
                                required
                                autocomplete="new-password"
                            />
                        </div>
                    </div>

                    {{-- Confirm password --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label text-xs font-bold text-on-surface uppercase tracking-wider" for="password_confirmation">
                            Confirmer mot de passe
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-lg">lock_reset</span>
                            <input
                                class="w-full pl-10 pr-4 py-3 bg-surface text-on-surface border border-primary/20 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary transition-all outline-none placeholder:text-outline-variant"
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                placeholder="••••••••"
                                required
                                autocomplete="new-password"
                            />
                        </div>
                    </div>

                    {{-- Grade --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label text-xs font-bold text-on-surface uppercase tracking-wider" for="grade">
                            Grade
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-lg">military_tech</span>
                            <select
                                class="w-full pl-10 pr-10 py-3 bg-surface text-on-surface border border-primary/20 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary transition-all outline-none appearance-none cursor-pointer @error('grade') border-red-400 @enderror"
                                id="grade"
                                name="grade"
                            >
                                <option value="" disabled {{ old('grade') ? '' : 'selected' }}>Sélectionnez votre grade</option>
                                <option value="regional" {{ old('grade') == 'regional' ? 'selected' : '' }}>Arbitre Régional</option>
                                <option value="national" {{ old('grade') == 'national' ? 'selected' : '' }}>Arbitre National</option>
                                <option value="international" {{ old('grade') == 'international' ? 'selected' : '' }}>Arbitre de International</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Footer Actions --}}
            <div class="pt-6 space-y-6">
                <button
                    class="w-full bg-secondary text-on-secondary py-4 px-6 rounded-lg font-headline font-bold text-sm tracking-widest uppercase hover:opacity-90 active:scale-[0.99] transition-all flex items-center justify-center gap-2 group shadow-lg shadow-secondary/20"
                    type="submit">
                    Créer un compte
                    <span class="material-symbols-outlined text-xl group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </button>

                <div class="flex flex-col md:flex-row justify-between items-center gap-4 py-4 px-2">
                    <p class="text-xs text-on-surface-variant font-medium">
                        En vous inscrivant, vous acceptez les
                        <a class="text-tertiary hover:underline font-bold" href="#">Conditions Générales d'Utilisation</a>
                        de la FRMF.
                    </p>
                    <p class="text-xs text-on-surface-variant">
                        Déjà membre ?
                        <a class="text-primary hover:underline font-bold" href="{{ route('login') }}">Se connecter</a>
                    </p>
                </div>
            </div>

        </form>
    </div>

    {{-- Card Footer --}}
    <footer class="w-full py-6 px-12 flex flex-col md:flex-row justify-between items-center bg-surface-container-low border-t border-surface-container-high">
        <span class="font-label text-[10px] text-on-surface-variant/70 uppercase tracking-widest">
            © {{ date('Y') }} Fédération Royale Marocaine de Football — QuickRef
        </span>
        <div class="flex gap-6 mt-4 md:mt-0">
            <a class="font-label text-[10px] text-on-surface-variant/70 hover:text-primary transition-colors uppercase tracking-widest" href="#">Support Technique</a>
            <a class="font-label text-[10px] text-on-surface-variant/70 hover:text-primary transition-colors uppercase tracking-widest" href="#">Confidentialité</a>
        </div>
    </footer>

</main>
@endsection