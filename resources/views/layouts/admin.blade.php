@extends('layouts.app')

@section('content')
    {{-- SIDEBAR ADMIN --}}
    <aside class="fixed left-0 top-0 h-screen w-64 flex flex-col p-6 z-40 bg-slate-950 shadow-2xl border-r border-white/5">
        {{-- Brand --}}
        <div class="flex flex-col items-center gap-3 px-2 mb-16">
            <div class="w-18 h-20 drop-shadow-xl">
                <img src="{{ asset('images/marocLogo.pngp') }}" alt="FRMF" class="w-full h-full object-contain">
            </div>
            <span class="text-xxl font-black text-white uppercase tracking-tighter italic">Quick<span class=" text-xxl text-primary">Ref</span></span>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-rose-600 text-white shadow-lg shadow-rose-900/40' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-rose-500' }}">dashboard</span>
                <span class="text-sm font-bold">Vue d'ensemble</span>
            </a>

            <a href="{{ route('admin.arbitres.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.arbitres.*') ? 'bg-rose-600 text-white shadow-lg shadow-rose-900/40' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.arbitres.*') ? 'text-white' : 'text-rose-500' }}">person_search</span>
                <span class="text-sm font-bold">Gestion des Arbitres</span>
            </a>

            <a href="{{ route('admin.equipes.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.equipes.*') ? 'bg-rose-600 text-white shadow-lg shadow-rose-900/40' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.equipes.*') ? 'text-white' : 'text-rose-500' }}">shield</span>
                <span class="text-sm font-bold">Gestion des Équipes</span>
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.categories.*') ? 'bg-rose-600 text-white shadow-lg shadow-rose-900/40' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.categories.*') ? 'text-white' : 'text-rose-500' }}">category</span>
                <span class="text-sm font-bold">Catégories & Tarifs</span>
            </a>

            <a href="{{ route('admin.matchs.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.matchs.*') ? 'bg-rose-600 text-white shadow-lg shadow-rose-900/40' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.matchs.*') ? 'text-white' : 'text-rose-500' }}">sports_soccer</span>
                <span class="text-sm font-bold">Matchs & Désignations</span>
            </a>

            <a href="{{ route('admin.paiements.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.paiements.*') ? 'bg-rose-600 text-white shadow-lg shadow-rose-900/40' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.paiements.*') ? 'text-white' : 'text-rose-500' }}">payments</span>
                <span class="text-sm font-bold">Paiements</span>
            </a>

            <a href="{{ route('admin.profil.edit') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.profil.*') ? 'bg-rose-600 text-white shadow-lg shadow-rose-900/40' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined {{ request()->routeIs('admin.profil.*') ? 'text-white' : 'text-rose-500' }}">manage_accounts</span>
                <span class="text-sm font-bold">Mon Profil</span>
            </a>
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="mt-auto pt-6 border-t border-white/5">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-slate-500 hover:text-rose-400 transition-colors group">
                <span class="material-symbols-outlined transition-transform group-hover:-translate-x-1">logout</span>
                <span class="text-sm font-bold">Déconnexion</span>
            </button>
        </form>
    </aside>

    <main class="ml-64 min-h-screen flex flex-col bg-slate-50">
        {{-- HEADER --}}
        <header class="fixed top-0 right-0 left-64 h-20 bg-white/80 backdrop-blur-xl z-30 flex justify-between items-center px-10 border-b border-slate-200">
            <h1 class="text-2xl font-black text-slate-900 font-headline uppercase tracking-tight">
                @yield('page-title')
            </h1>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Administrateur</p>
                    <p class="text-sm font-black text-slate-900">{{ auth()->user()->name }}</p>
                </div>
                <div class="w-11 h-11 rounded-full bg-rose-600 flex items-center justify-center shadow-lg shadow-rose-200 border-2 border-white">
                    <span class="material-symbols-outlined text-white text-xl">person</span>
                </div>
            </div>
        </header>

        <div class="mt-20 p-10 flex-1 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:20px_20px]">
            @yield('admin-content')
        </div>

        @include('partials.footer')
    </main>
@endsection