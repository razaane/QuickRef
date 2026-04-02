@extends('layouts.guest')

@section('title', 'QuickRef — Plateforme Officielle d\'Arbitrage FRMF')

@section('content')
<div class="min-h-screen w-full">
    {{-- TopNavBar --}}
    <nav class="fixed top-0 w-full z-50 flex justify-between items-center px-8 md:px-16 h-20 bg-white/90 backdrop-blur-md border-b border-primary/5">
        <div class="flex items-center gap-12">
            <span class="text-2xl font-extrabold text-primary font-headline tracking-tighter">QuickRef</span>
        </div>
    </nav>

    <main class="relative pt-48 pb-32 px-6 text-center max-w-5xl mx-auto">
        <h1 class="font-headline text-6xl md:text-8xl font-extrabold text-on-surface mb-6">
            Quick<span class="text-primary">Ref</span>
        </h1>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-6 mt-12">
            {{-- BOUTON Login --}}
            <a href="{{ route('login') }}" 
               class="px-12 py-5 bg-secondary text-white font-bold text-sm uppercase tracking-widest rounded-sm hover:brightness-110 transition-all shadow-xl cursor-pointer">
                Se connecter
            </a>
        </div>
    </main>
</div>
@endsection