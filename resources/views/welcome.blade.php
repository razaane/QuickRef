<x-guest-layout>
<div class="min-h-screen w-full bg-[#0f172a] relative overflow-hidden flex flex-col justify-center py-10 font-sans">
    
    {{-- Subtile Radial Gradient pour la profondeur --}}
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-rose-500/5 via-transparent to-transparent pointer-events-none"></div>

    <main class="relative text-center flex flex-col items-center px-6 z-10">
        
        {{-- Logo Section --}}
        <div class="relative mb-12 lg:mb-16 flex justify-center items-center">
            {{-- Glow effect wra l-logo b-rose --}}
            <div class="absolute w-32 h-32 lg:w-40 lg:h-40 bg-rose-600/80 rounded-full blur-[60px]"></div>
            
            {{-- Logo Image --}}
            <div class="relative w-28 h-36 lg:w-36 lg:h-44">
                <img src="{{ asset('images/marocLogo.png') }}" alt="FRMF" class="w-full h-full object-contain drop-shadow-2xl">
            </div>
        </div>

        {{-- Titre --}}
        <h1 class="text-6xl sm:text-8xl lg:text-9xl font-black text-white uppercase tracking-tighter leading-none mb-4 italic">
            QUICK<span class="text-rose-600">REF</span>
        </h1>
        
        <p class="max-w-xs sm:max-w-xl mx-auto text-slate-400 text-[10px] lg:text-xs font-bold uppercase tracking-[0.3em] leading-relaxed mb-12">
            Gestion simplifiée des désignations, indemnités et performances de l'arbitrage marocain.
        </p>
        
        <div class="w-full sm:w-auto flex flex-col sm:flex-row items-center justify-center gap-6">
            @if(auth()->check())
                <a href="{{ route(auth()->user()->role === 'admin' ? 'admin.dashboard' : 'arbitre.dashboard') }}" 
                   class="w-[85%] sm:w-auto px-12 py-5 bg-rose-600 hover:bg-rose-700 text-white font-black text-[10px] uppercase tracking-[0.2em] rounded-xl shadow-2xl shadow-rose-600/20 transition-all active:scale-95">
                    Mon Tableau de Bord
                </a>
            @else
                <a href="{{ route('login') }}" 
                   class="w-[85%] sm:w-auto px-12 py-5 bg-rose-600 hover:bg-rose-700 text-white font-black text-[10px] uppercase tracking-[0.2em] rounded-xl shadow-2xl shadow-rose-600/20 transition-all active:scale-95">
                    Accéder à l'Espace Pro
                </a>
            @endif
        </div>
    </main>

    {{-- Bottom bar --}}
    <div class="absolute bottom-8 w-full text-center px-4">
        <p class="text-[9px] font-black text-slate-500 uppercase tracking-[0.4em]">Fédération Royale Marocaine de Football</p>
    </div>
</div>
</x-guest-layout>