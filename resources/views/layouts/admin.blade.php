@extends('layouts.app')

@section('title', isset($pageTitle) ? $pageTitle . ' — QuickRef Admin' : 'QuickRef Admin')

@section('body-class', 'bg-background font-body text-on-surface antialiased')

@section('content')

    {{-- ========== SIDEBAR ========== --}}
    <aside class="fixed left-0 top-0 h-screen w-64 flex flex-col p-6 z-40 bg-[#1B6B3A] shadow-2xl">

        {{-- Brand --}}
        <div class="flex items-center gap-3 px-2 mb-12">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm">
                <span class="material-symbols-outlined text-[#1B6B3A] text-xl">verified</span>
            </div>
            <div>
                <h2 class="text-lg font-extrabold text-[#C9A84C] tracking-tight leading-none font-headline">QUICKREF</h2>
                <p class="text-[10px] font-bold text-white/60 uppercase tracking-widest mt-1 font-headline">Admin Portal</p>
            </div>
        </div>

        {{-- Nav links --}}
        <nav class="flex-1 space-y-1.5">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200
                      {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white border border-white/5' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined text-[#C9A84C]">dashboard</span>
                <span class="font-headline text-sm font-semibold">Vue d'ensemble</span>
            </a>
            <a href="{{ route('admin.arbitres.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200
                      {{ request()->routeIs('admin.arbitres*') ? 'bg-white/10 text-white border border-white/5' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined text-[#C9A84C]">groups</span>
                <span class="font-headline text-sm font-semibold">Arbitres</span>
            </a>
            <a href="{{ route('admin.matchs.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200
                      {{ request()->routeIs('admin.matchs*') ? 'bg-white/10 text-white border border-white/5' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined text-[#C9A84C]">sports_soccer</span>
                <span class="font-headline text-sm font-semibold">Matchs</span>
            </a>
            <a href="{{ route('admin.finances.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200
                      {{ request()->routeIs('admin.finances*') ? 'bg-white/10 text-white border border-white/5' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined text-[#C9A84C]">payments</span>
                <span class="font-headline text-sm font-semibold">Finances</span>
            </a>
            <a href="{{ route('admin.parametres.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200
                      {{ request()->routeIs('admin.parametres*') ? 'bg-white/10 text-white border border-white/5' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined text-[#C9A84C]">settings</span>
                <span class="font-headline text-sm font-semibold">Paramètres</span>
            </a>
        </nav>

        {{-- Bottom: CTA + logout --}}
        <div class="mt-auto space-y-4">
            <a href="{{ route('admin.convocations.create') }}"
               class="w-full bg-[#C9A84C] text-[#1B6B3A] py-3 rounded-lg font-headline text-sm font-extrabold shadow-lg hover:bg-[#b59640] transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-lg">add_circle</span>
                CONVOCATION
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-3 text-white/60 hover:text-white transition-all border-t border-white/10 pt-6">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="font-headline text-sm font-semibold">Déconnexion</span>
                </button>
            </form>
        </div>

    </aside>

    {{-- ========== MAIN WRAPPER ========== --}}
    <main class="ml-64 min-h-screen flex flex-col">

        {{-- TOPBAR --}}
        <header class="fixed top-0 right-0 left-64 h-20 bg-white/80 backdrop-blur-md z-30 flex justify-between items-center px-10 border-b border-slate-200">
            <h1 class="text-2xl font-extrabold text-[#1B6B3A] tracking-tight font-headline">
                @yield('page-title', 'Tableau de Bord')
            </h1>
            <div class="flex items-center gap-6">
                <div class="relative">
                    <span class="material-symbols-outlined text-slate-400 cursor-pointer hover:text-[#1B6B3A] transition-colors text-2xl">notifications</span>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
                </div>
                <div class="flex items-center gap-4 border-l border-slate-200 pl-6">
                    <div class="text-right">
                        <p class="font-headline text-sm font-bold text-slate-900">{{ auth()->user()->name ?? 'Admin' }}</p>
                        <p class="font-headline text-[11px] text-slate-500 font-bold uppercase tracking-wider">Directeur Central</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-[#1B6B3A]/10 flex items-center justify-center ring-2 ring-[#C9A84C]/20">
                        <span class="material-symbols-outlined text-[#1B6B3A]">account_circle</span>
                    </div>
                </div>
            </div>
        </header>

        {{-- PAGE CONTENT --}}
        <div class="mt-20 p-10 flex-1 space-y-10">
            @yield('admin-content')
        </div>

        {{-- FOOTER --}}
        <footer class="w-full py-10 px-12 flex flex-col md:flex-row justify-between items-center border-t border-slate-200 bg-white">
            <p class="font-body text-xs text-slate-500">
                © {{ date('Y') }} Fédération Royale Marocaine de Football —
                <span class="font-black text-[#1B6B3A]">QuickRef</span>. Tous droits réservés.
            </p>
            <div class="flex gap-8 mt-4 md:mt-0">
                <a href="#" class="font-body text-[11px] font-bold text-slate-400 hover:text-[#1B6B3A] uppercase tracking-wider transition-colors">Mentions Légales</a>
                <a href="#" class="font-body text-[11px] font-bold text-slate-400 hover:text-[#1B6B3A] uppercase tracking-wider transition-colors">Confidentialité</a>
                <a href="#" class="font-body text-[11px] font-bold text-slate-400 hover:text-[#1B6B3A] uppercase tracking-wider transition-colors">Support</a>
            </div>
        </footer>

    </main>

@endsection