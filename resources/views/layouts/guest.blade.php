@extends('layouts.app')

@section('title', isset($pageTitle) ? $pageTitle . ' — QuickRef Arbitre' : 'QuickRef Arbitre')

@section('body-class', 'bg-background font-body text-on-surface zellige-pattern min-h-screen')

@section('content')

    {{-- ========== NAVBAR ========== --}}
    <nav class="fixed top-0 w-full z-50 flex justify-between items-center px-8 h-20 bg-[#1B6B3A] text-white shadow-lg">

        {{-- Left: Logo + links --}}
        <div class="flex items-center gap-12">
            <span class="text-2xl font-extrabold font-headline tracking-tighter">QuickRef</span>
            <div class="hidden lg:flex items-center gap-8 font-headline text-sm font-semibold">
                <a href="{{ route('arbitre.dashboard') }}"
                   class="{{ request()->routeIs('arbitre.dashboard') ? 'border-b-2 border-[#C9A84C] pb-1' : 'opacity-70 hover:opacity-100 transition-opacity' }}">
                    Tableau de Bord
                </a>
                <a href="{{ route('arbitre.matchs.index') }}"
                   class="{{ request()->routeIs('arbitre.matchs*') ? 'border-b-2 border-[#C9A84C] pb-1' : 'opacity-70 hover:opacity-100 transition-opacity' }}">
                    Matchs
                </a>
                <a href="{{ route('arbitre.paiements.index') }}"
                   class="{{ request()->routeIs('arbitre.paiements*') ? 'border-b-2 border-[#C9A84C] pb-1' : 'opacity-70 hover:opacity-100 transition-opacity' }}">
                    Paiements
                </a>
                <a href="{{ route('arbitre.profil.index') }}"
                   class="{{ request()->routeIs('arbitre.profil*') ? 'border-b-2 border-[#C9A84C] pb-1' : 'opacity-70 hover:opacity-100 transition-opacity' }}">
                    Profil
                </a>
            </div>
        </div>

        {{-- Right: Search + notifs + user --}}
        <div class="flex items-center gap-6">
            <div class="hidden md:flex items-center bg-white/10 px-4 py-2 rounded-full border border-white/10">
                <span class="material-symbols-outlined text-white/60 text-lg mr-2">search</span>
                <input class="bg-transparent border-none text-sm focus:ring-0 w-48 p-0 placeholder-white/50 text-white"
                       placeholder="Rechercher un match..." type="text"/>
            </div>
            <div class="relative">
                <span class="material-symbols-outlined text-white/80 hover:text-white transition-colors cursor-pointer">notifications</span>
                <span class="absolute -top-1 -right-1 w-2 h-2 bg-[#C9A84C] rounded-full"></span>
            </div>
            <div class="flex items-center gap-3 pl-6 border-l border-white/20">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold font-headline leading-none">{{ auth()->user()->name ?? 'Arbitre' }}</p>
                    <p class="text-[11px] opacity-70 mt-1 uppercase tracking-wider font-semibold">
                        {{ auth()->user()->grade ?? 'Arbitre Fédéral' }}
                    </p>
                </div>
                <div class="w-10 h-10 rounded-full border-2 border-[#C9A84C] bg-white/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-white/80">account_circle</span>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="opacity-60 hover:opacity-100 transition-opacity">
                    <span class="material-symbols-outlined text-white text-xl">logout</span>
                </button>
            </form>
        </div>

    </nav>

    {{-- ========== PAGE CONTENT ========== --}}
    <main class="pt-32 pb-16 px-8 max-w-7xl mx-auto">
        @yield('arbitre-content')
    </main>

    {{-- ========== FOOTER ========== --}}
    <footer class="w-full py-12 px-8 flex flex-col md:flex-row justify-between items-center bg-white border-t border-outline-variant">
        <div class="flex flex-col md:flex-row items-center gap-6 mb-8 md:mb-0">
            <span class="text-xl font-bold text-primary font-headline tracking-tighter">QuickRef</span>
            <p class="text-xs text-on-surface-variant font-medium">
                © {{ date('Y') }} Fédération Royale Marocaine de Football. Plateforme Arbitrage Officielle.
            </p>
        </div>
        <div class="flex gap-8 text-[11px] font-bold uppercase tracking-widest text-on-surface-variant/60">
            <a class="hover:text-[#C9A84C] transition-colors" href="#">Mentions Légales</a>
            <a class="hover:text-[#C9A84C] transition-colors" href="#">Confidentialité</a>
            <a class="hover:text-[#C9A84C] transition-colors" href="#">Support</a>
        </div>
    </footer>

@endsection