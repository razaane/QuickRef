@extends('layouts.guest')

@section('title', 'QuickRef — Arbitrage FRMF')

@section('content')
<div class="min-h-screen w-full bg-sidebar relative overflow-hidden flex flex-col justify-center">
    
    {{-- Decorative pattern --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
        <div class="zellige-pattern h-full w-full"></div>
    </div>

   

    <main class="relative  text-center  flex flex-col items-center px-6">
        <div class="relative drop-shadow-xl z-0 mb-20">
            <div class="w-40 h-40 rounded-full shadow-[0_10px_30px] shadow-primary rounded-full" id="logoBg"></div>
            <img src="{{ asset('images/marocLogo.png') }}" alt="FRMF" class="w-40 object-contain absolute top-0">
        </div>

        <h1 class="text-7xl md:text-9xl font-black text-white uppercase tracking-tighter leading-none mb-4">
            QUICK<span class="text-primary italic">REF</span>
        </h1>
        
        <p class="max-w-xl mx-auto text-white/40 text-sm font-bold uppercase tracking-widest leading-relaxed mb-12">
            Gestion simplifiée des désignations, indemnités et performances de l'arbitrage marocain.
        </p>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
            @if(auth()->check())
                <a href="{{ route('arbitre.dashboard') }}" 
                   class="group relative px-16 py-5 bg-primary overflow-hidden rounded-xl transition-all shadow-2xl shadow-primary/30">
                    <span class="relative text-white font-black text-xs uppercase tracking-[0.2em]">Mon Tableau de Bord</span>
                </a>
            @else
                <a href="{{ route('login') }}" 
                   class="group relative px-16 py-5 bg-primary overflow-hidden rounded-xl transition-all shadow-2xl shadow-primary/30">
                    <span class="relative text-white font-black text-xs uppercase tracking-[0.2em]">Se connecter</span>
                </a>
            @endif
        </div>
    </main>

    {{-- Bottom bar --}}
    <div class="absolute bottom-10 w-full text-center">
        <p class="text-[9px] font-black text-white/20 uppercase tracking-[0.5em]">Fédération Royale Marocaine de Football</p>
    </div>
</div>
@endsection