@extends('layouts.guest')

@section('title', 'QuickRef — Arbitrage FRMF')

@section('content')
<div class="min-h-screen w-full bg-sidebar relative overflow-hidden flex flex-col justify-center py-10">
    
    {{-- Decorative pattern --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
        <div class="zellige-pattern h-full w-full"></div>
    </div>

    <main class="relative text-center flex flex-col items-center px-6 z-10">
        
        {{-- Logo Section - Fixed & Centered --}}
        <div class="relative mb-12 lg:mb-16 flex justify-center items-center">
            {{-- Glow effect wra l-logo --}}
            <div class="absolute w-32 h-32 lg:w-40 lg:h-40 bg-primary/30 rounded-full blur-[50px]"></div>
            
            {{-- Logo Image --}}
            <div class="relative w-32 h-40 lg:w-40 lg:h-48">
                <img src="{{ asset('images/marocLogo.png') }}" alt="FRMF" class="w-full h-full object-contain drop-shadow-2xl">
            </div>
        </div>

        {{-- Titre - Responsive size --}}
        <h1 class="text-5xl sm:text-7xl lg:text-9xl font-black text-white uppercase tracking-tighter leading-none mb-4">
            QUICK<span class="text-primary italic">REF</span>
        </h1>
        
        <p class="max-w-xs sm:max-w-xl mx-auto text-white/40 text-[10px] lg:text-xs font-bold uppercase tracking-[0.3em] leading-relaxed mb-12">
            Gestion simplifiée des désignations, indemnités et performances de l'arbitrage marocain.
        </p>
        
        <div class="w-full sm:w-auto flex flex-col sm:flex-row items-center justify-center gap-6">
            @if(auth()->check())
                <a href="{{ route(auth()->user()->role === 'admin' ? 'admin.dashboard' : 'arbitre.dashboard') }}" 
                   class="w-[80%] sm:w-auto group relative px-12 py-5 bg-primary overflow-hidden rounded-xl transition-all shadow-2xl shadow-primary/30 active:scale-95">
                    <span class="relative text-white font-black text-[10px] uppercase tracking-[0.2em]">Mon Tableau de Bord</span>
                </a>
            @else
                <a href="{{ route('login') }}" 
                   class="w-[80%] sm:w-auto group relative px-12 py-5 bg-primary overflow-hidden rounded-xl transition-all shadow-2xl shadow-primary/30 active:scale-95">
                    <span class="relative text-white font-black text-[10px] uppercase tracking-[0.2em]">Se connecter</span>
                </a>
            @endif
        </div>
    </main>

    {{-- Bottom bar --}}
    <div class="absolute bottom-6 w-full text-center px-4 sm:block">
        <p class="text-[8px] font-black text-white/10 uppercase tracking-[0.4em]">Fédération Royale Marocaine de Football</p>
    </div>
</div>
@endsection