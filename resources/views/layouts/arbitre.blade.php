@extends('layouts.app')

@section('content')
    {{-- NAVBAR ARBITRE (Thème Slate & Rose Red) --}}
    <nav class="fixed top-0 w-full z-50 flex justify-between items-center px-10 h-20 bg-sidebar border-b border-white/5 backdrop-blur-md shadow-2xl">
        <div class="flex items-center gap-3">
            <div class="w-14 h-14 drop-shadow-xl">
                <img src="{{ asset('images/marocLogo.pngp') }}" alt="FRMF" class="w-full h-full object-contain">
            </div>
            <span class="text-xl font-black text-white uppercase tracking-tighter italic">Quick<span class="text-primary">Ref</span></span>
        </div>

        {{-- Desktop Menu --}}
        <div class="hidden lg:flex items-center gap-10">
            @php
                $links = [
                    ['route' => 'arbitre.dashboard', 'label' => 'Dashboard', 'active' => 'arbitre.dashboard'],
                    ['route' => 'arbitre.matchs.index', 'label' => 'Désignations', 'active' => 'arbitre.matchs*'],
                    ['route' => 'arbitre.profil.edit', 'label' => 'Mon Profil', 'active' => 'arbitre.profil*'],
                ];
            @endphp

            @foreach($links as $link)
                <a href="{{ route($link['route']) }}"
                   class="text-[10px] font-black uppercase tracking-[0.2em] transition-all duration-300 {{ request()->routeIs($link['active']) ? 'text-primary' : 'text-white/40 hover:text-white' }}">
                    {{ $link['label'] }}
                    @if(request()->routeIs($link['active']))
                        <span class="block h-0.5 w-4 bg-primary mt-1 rounded-full animate-pulse"></span>
                    @endif
                </a>
            @endforeach
        </div>

        {{-- Logout --}}
        <div class="flex items-center gap-6">
            <div class="h-6 w-[1px] bg-white/10 hidden lg:block"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="group flex items-center gap-2 text-white/40 hover:text-primary transition-all">
                    <span class="text-[9px] font-black uppercase tracking-widest hidden lg:block group-hover:mr-1 transition-all">Déconnexion</span>
                    <span class="material-symbols-outlined text-xl">logout</span>
                </button>
            </form>
        </div>
    </nav>

    {{-- Background Wrapper --}}
    <div class="bg-background min-h-screen">
        <main class="pt-32 pb-20 px-6 max-w-7xl mx-auto">
            {{-- Le contenu injecté ici profitera du style Slate --}}
            @yield('arbitre-content')
        </main>
    </div>

    {{-- FOOTER --}}
    @include('partials.footer')
@endsection