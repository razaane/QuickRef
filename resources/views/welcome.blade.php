{{-- welcome.blade.php --}}
@extends('layouts.guest')

@section('title', 'QuickRef — Plateforme Officielle d\'Arbitrage FRMF')

@section('extra-styles')
.letter-spacing-tightest { letter-spacing: -0.05em; }
.letter-spacing-wide { letter-spacing: 0.15em; }
.material-symbols-outlined {
    font-variation-settings: "FILL" 0, "wght" 300, "GRAD" 0, "opsz" 24;
}
@endsection

@section('content')
{{-- Override body to be block (not flex centered) for this page --}}
<div class="min-h-screen w-full">

    {{-- TopNavBar --}}
    <nav class="fixed top-0 w-full z-50 flex justify-between items-center px-8 md:px-16 h-20 bg-background/80 backdrop-blur-md border-b border-primary/5">
        <div class="flex items-center gap-12">
            <span class="text-2xl font-extrabold text-primary font-headline tracking-tighter">QuickRef</span>
            <div class="hidden md:flex gap-8 items-center">
                <a class="text-xs font-semibold uppercase tracking-widest text-on-surface/60 hover:text-primary transition-colors" href="#">Tableau de Bord</a>
                <a class="text-xs font-semibold uppercase tracking-widest text-on-surface/60 hover:text-primary transition-colors" href="#">Matchs</a>
                <a class="text-xs font-semibold uppercase tracking-widest text-on-surface/60 hover:text-primary transition-colors" href="#">Paiements</a>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('login') }}"
               class="px-6 py-2.5 bg-secondary text-white font-bold text-xs uppercase tracking-widest rounded-sm hover:brightness-110 transition-all">
                Se connecter
            </a>
        </div>
    </nav>

    <main class="relative min-h-screen">
        {{-- Zellige Texture --}}
        <div class="fixed inset-0 zellige-pattern pointer-events-none opacity-[0.03]"></div>

        {{-- Hero Section --}}
        <section class="relative pt-48 pb-32 px-6 text-center max-w-5xl mx-auto">
            <div class="mb-16 flex flex-col items-center">

                {{-- Logo --}}
            <div class="mb-12 relative">
                <div class="absolute inset-0 bg-primary/5 scale-150 blur-3xl rounded-full"></div>

                <div class="relative w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center overflow-hidden">
                    <img src="{{ asset('images/marocLogo.png') }}"
                        alt="Logo"
                        class="w-16 h-16 object-contain">
                </div>
            </div>

                <h1 class="font-headline text-6xl md:text-8xl font-extrabold text-on-surface letter-spacing-tightest mb-6">
                    Quick<span class="text-primary">Ref</span>
                </h1>

                <div class="flex items-center gap-4 mb-8">
                    <div class="h-[1px] w-8 bg-tertiary"></div>
                    <p class="font-headline text-sm md:text-base font-bold text-tertiary uppercase tracking-[0.3em]">
                        Excellence Institutionnelle
                    </p>
                    <div class="h-[1px] w-8 bg-tertiary"></div>
                </div>

                <p class="font-body text-xl md:text-2xl text-on-surface-variant max-w-2xl leading-relaxed font-light">
                    La plateforme de référence pour la gestion des officiels de la ligue régionale Marrakech-Safi.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-6 z-10 relative">
                <a href="{{ route('login') }}"
                   class="px-12 py-5 bg-secondary text-white font-bold text-sm uppercase tracking-widest rounded-sm hover:brightness-110 transition-all active:scale-95 shadow-2xl shadow-secondary/20">
                    Se connecter
                </a>
                <a href="{{ route('register') }}"
                   class="px-12 py-5 border border-primary/20 text-primary font-bold text-sm uppercase tracking-widest rounded-sm hover:bg-primary/5 transition-all active:scale-95">
                    S'inscrire
                </a>
            </div>
        </section>

        {{-- Institutional Pillars --}}
        <section class="py-40 px-8 bg-white/40 border-y border-primary/5">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-24">

                <div class="flex flex-col items-center text-center group">
                    <div class="w-16 h-16 flex items-center justify-center rounded-full bg-primary/5 text-primary mb-8 transition-colors group-hover:bg-primary group-hover:text-white">
                        <span class="material-symbols-outlined text-3xl">verified</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-primary uppercase tracking-wider mb-4">Standard Officiel</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed max-w-[280px] font-medium opacity-80">
                        Certification par la DNA pour la gestion rigoureuse des compétitions régionales.
                    </p>
                </div>

                <div class="flex flex-col items-center text-center group">
                    <div class="w-16 h-16 flex items-center justify-center rounded-full bg-primary/5 text-primary mb-8 transition-colors group-hover:bg-primary group-hover:text-white">
                        <span class="material-symbols-outlined text-3xl">account_balance</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-primary uppercase tracking-wider mb-4">Gouvernance</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed max-w-[280px] font-medium opacity-80">
                        Automatisation transparente des indemnités et des processus administratifs.
                    </p>
                </div>

                <div class="flex flex-col items-center text-center group">
                    <div class="w-16 h-16 flex items-center justify-center rounded-full bg-primary/5 text-primary mb-8 transition-colors group-hover:bg-primary group-hover:text-white">
                        <span class="material-symbols-outlined text-3xl">analytics</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-primary uppercase tracking-wider mb-4">Performance</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed max-w-[280px] font-medium opacity-80">
                        Suivi analytique des notations et accompagnement de carrière des arbitres.
                    </p>
                </div>

            </div>
        </section>

        {{-- Stats section --}}
        <section class="py-32 px-8 md:px-16">
            <div class="max-w-4xl mx-auto text-center space-y-12">
                <span class="inline-block px-5 py-2 border border-tertiary/30 text-tertiary text-[10px] font-extrabold tracking-[0.25em] uppercase rounded-full">Chiffres Clés</span>
                <h2 class="font-headline text-4xl md:text-5xl font-bold text-on-surface leading-[1.1] letter-spacing-tightest">
                    L'intégrité au cœur du <span class="text-primary italic">Football Marocain</span>.
                </h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-12 pt-8">
                    <div class="space-y-2">
                        <div class="text-4xl font-headline font-bold text-primary">2,400<span class="text-tertiary text-2xl font-light">+</span></div>
                        <div class="text-[10px] uppercase tracking-[0.2em] text-on-surface/50 font-bold">Matchs Annuels</div>
                    </div>
                    <div class="space-y-2">
                        <div class="text-4xl font-headline font-bold text-primary">584</div>
                        <div class="text-[10px] uppercase tracking-[0.2em] text-on-surface/50 font-bold">Arbitres Actifs</div>
                    </div>
                    <div class="space-y-2">
                        <div class="text-4xl font-headline font-bold text-primary">15</div>
                        <div class="text-[10px] uppercase tracking-[0.2em] text-on-surface/50 font-bold">Pôles Formation</div>
                    </div>
                    <div class="space-y-2">
                        <div class="text-4xl font-headline font-bold text-primary">98%</div>
                        <div class="text-[10px] uppercase tracking-[0.2em] text-on-surface/50 font-bold">Engagement</div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    {{-- Extended footer for welcome page --}}
    <footer class="w-full py-24 px-8 md:px-24 bg-white border-t border-primary/5">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-start gap-16">
            <div class="flex flex-col gap-6 max-w-sm">
                <span class="font-extrabold text-xl font-headline tracking-tighter text-primary">QuickRef</span>
                <p class="font-body text-xs text-on-surface-variant/70 leading-relaxed font-medium">
                    Plateforme officielle de gestion de l'arbitrage — Fédération Royale Marocaine de Football, Ligue Régionale Marrakech-Safi.
                </p>
                <p class="font-body text-[10px] text-on-surface-variant/40 tracking-wider">
                    © {{ date('Y') }} FRMF — TOUS DROITS RÉSERVÉS.
                </p>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-16">
                <div class="flex flex-col gap-4">
                    <h4 class="text-[10px] font-extrabold uppercase tracking-[0.2em] text-primary">Navigation</h4>
                    <a class="text-xs text-on-surface-variant/60 hover:text-tertiary transition-colors" href="{{ route('login') }}">Connexion</a>
                    <a class="text-xs text-on-surface-variant/60 hover:text-tertiary transition-colors" href="{{ route('register') }}">Inscription</a>
                </div>
                <div class="flex flex-col gap-4">
                    <h4 class="text-[10px] font-extrabold uppercase tracking-[0.2em] text-primary">Légal</h4>
                    <a class="text-xs text-on-surface-variant/60 hover:text-tertiary transition-colors" href="#">Mentions Légales</a>
                    <a class="text-xs text-on-surface-variant/60 hover:text-tertiary transition-colors" href="#">Confidentialité</a>
                </div>
                <div class="flex flex-col gap-4">
                    <h4 class="text-[10px] font-extrabold uppercase tracking-[0.2em] text-primary">Assistance</h4>
                    <a class="text-xs text-on-surface-variant/60 hover:text-tertiary transition-colors" href="#">Support IT</a>
                    <a class="text-xs text-on-surface-variant/60 hover:text-tertiary transition-colors" href="#">Contact</a>
                </div>
            </div>
        </div>
    </footer>

</div>
@endsection