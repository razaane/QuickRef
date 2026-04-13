@extends('layouts.app')

@section('content')
    {{-- SIDEBAR ADMIN --}}
    <aside class="fixed left-0 top-0 h-screen w-64 flex flex-col p-6 z-40 bg-[#1B6B3A] shadow-2xl">
        {{-- Brand --}}
        <div class="flex items-center gap-3 px-2 mb-12">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                <span class="material-symbols-outlined text-[#1B6B3A]">verified</span>
            </div>
            <h2 class="text-lg font-extrabold text-[#C9A84C] font-headline">QUICKREF</h2>
        </div>
        {{-- Nav --}}
        <nav class="flex-1 space-y-1.5">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-white hover:bg-white/10 rounded-lg">
                <span class="material-symbols-outlined text-[#C9A84C]">dashboard</span>
                <span class="text-sm font-semibold">Vue d'ensemble</span>
            </a>

            {{-- Gestion des Arbitres --}}
            <a href="{{ route('admin.arbitres.index') }}" 
               class="flex items-center gap-3 px-4 py-3 text-white rounded-lg {{ request()->routeIs('admin.arbitres.*') ? 'bg-white/10' : 'hover:bg-white/5 opacity-80' }}">
                <span class="material-symbols-outlined text-[#C9A84C]">person_search</span>
                <span class="text-sm font-semibold">Gestion des Arbitres</span>
            </a>

            {{-- Gestion des Équipes --}}
            <a href="{{ route('admin.equipes.index') }}" 
            class="flex items-center gap-3 px-4 py-3 text-white rounded-lg {{ request()->routeIs('admin.equipes.*') ? 'bg-white/10' : 'hover:bg-white/5' }}">
                <span class="material-symbols-outlined text-[#C9A84C]">shield</span>
                <span class="text-sm font-semibold">Gestion des Équipes</span>
            </a>
            {{-- Gestion des Catégories --}}
            <a href="{{ route('admin.categories.index') }}" 
               class="flex items-center gap-3 px-4 py-3 text-white rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-white/10' : 'hover:bg-white/5 opacity-80' }}">
                <span class="material-symbols-outlined text-[#C9A84C]">category</span>
                <span class="text-sm font-semibold">Catégories & Tarifs</span>
            </a>


             {{-- Prochainement: Matchs --}}

            <a href="{{ route('admin.matchs.index') }}" 
               class="flex items-center gap-3 px-4 py-3 text-white rounded-lg {{ request()->routeIs('admin.matchs.*') ? 'bg-white/10' : 'hover:bg-white/5 opacity-80' }}">
                <span class="material-symbols-outlined text-[#C9A84C]">sports_soccer</span>
                <span class="text-sm font-semibold">Matchs & Désignations</span>
            </a>

            {{-- paiements --}}
            <a href="{{ route('admin.paiements.index') }}" 
               class="flex items-center gap-3 px-4 py-3 text-white rounded-lg {{ request()->routeIs('admin.matchs.*') ? 'bg-white/10' : 'hover:bg-white/5 opacity-80' }}">
                <span class="material-symbols-outlined text-[#C9A84C]">payments</span>
                <span class="text-sm font-semibold">Paiements</span>
            </a>

            <a href="{{ route('admin.profil.edit') }}" 
                class="flex items-center gap-3 px-4 py-3 text-white rounded-lg {{ request()->routeIs('admin.profil.*') ? 'bg-white/10' : 'hover:bg-white/5 opacity-80' }}">
                    <span class="material-symbols-outlined text-[#C9A84C]">manage_accounts</span>
                    <span class="text-sm font-semibold">Mon Profil</span>
            </a>

        </nav>
        <form method="POST" action="{{ route('logout') }}" class="mt-auto pt-6 border-t border-white/10">
            @csrf
            <button type="submit" class="flex items-center gap-3 text-white/60 hover:text-white">
                <span class="material-symbols-outlined">logout</span>
                <span class="text-sm font-semibold">Déconnexion</span>
            </button>
        </form>
    </aside>

    <main class="ml-64 min-h-screen flex flex-col">
        {{-- HEADER ADMIN --}}
        <header class="fixed top-0 right-0 left-64 h-20 bg-white/80 backdrop-blur-md z-30 flex justify-between items-center px-10 border-b">
            <h1 class="text-2xl font-extrabold text-[#1B6B3A]">@yield('page-title')</h1>
            <div class="flex items-center gap-4">
                <p class="text-sm font-bold">{{ auth()->user()->name }}</p>
                <div class="w-10 h-10 rounded-full bg-[#1B6B3A]/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[#1B6B3A]">account_circle</span>
                </div>
            </div>
        </header>

        <div class="mt-20 p-10 flex-1">
            @yield('admin-content') {{-- Hna l-content d admin --}}
        </div>

        {{-- FOOTER SHARED --}}
        @include('partials.footer')
    </main>
@endsection