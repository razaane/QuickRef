@extends('layouts.app')

@section('content')
    {{-- NAVBAR ARBITRE --}}
    <nav class="fixed top-0 w-full z-50 flex justify-between items-center px-8 h-20 bg-[#1B6B3A] text-white shadow-lg">
        <span class="text-2xl font-extrabold font-headline">QuickRef</span>
        <div class="hidden lg:flex items-center gap-8 font-headline text-sm font-semibold">
            <a href="{{ route('arbitre.dashboard') }}" class="hover:opacity-100 opacity-70">Tableau de Bord</a>
            <a href="#" class="hover:opacity-100 opacity-70">Matchs</a>
            <a href="#" class="hover:opacity-100 opacity-70">Profil</a>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="opacity-60 hover:opacity-100">
                <span class="material-symbols-outlined text-white">logout</span>
            </button>
        </form>
    </nav>

    <main class="pt-32 pb-16 px-8 max-w-7xl mx-auto min-h-screen">
        @yield('arbitre-content') {{-- Hna l-content d arbitre --}}
    </main>

    {{-- FOOTER SHARED --}}
    @include('partials.footer')
@endsection