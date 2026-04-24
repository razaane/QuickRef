<x-guest-layout>
    <div class="min-h-screen w-full flex items-center justify-center p-6">
        
        {{-- Radial Gradient pour la profondeur --}}
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-rose-500/5 via-transparent to-transparent pointer-events-none"></div>

        <main class="w-full max-w-[400px] relative z-10">

            <div class="bg-[#1e293b]/50 backdrop-blur-xl border border-slate-700/50 rounded-3xl shadow-2xl p-10">
                
                {{-- Header --}}
                <div class="text-center mb-10">
                    <div class="w-18 h-20 drop-shadow-xl mb-2 mx-auto">
                        <img src="{{ asset('images/marocLogo.png') }}" alt="FRMF" class="w-full h-full object-contain">
                    </div>
                    <h1 class="text-2xl font-black text-white tracking-tight uppercase italic">
                        Quick<span class="text-rose-600">Ref</span>
                    </h1>
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.2em] mt-2">Récupération de compte</p>
                </div>

                {{-- Message --}}
                <div class="mb-8 text-center px-2">
                    <p class="text-slate-400 text-xs leading-relaxed">
                        {{ __('Pas de souci. Indiquez-nous votre adresse email et nous vous enverrons un lien de réinitialisation.') }}
                    </p>
                </div>

                @if (session('status'))
                    <div class="mb-6 p-4 bg-emerald-500/10 border-l-4 border-emerald-600 rounded-r-xl">
                        <p class="text-[10px] text-emerald-500 font-bold uppercase tracking-wider">Lien envoyé avec succès</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    {{-- Input Email --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email professionnel</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full bg-[#0f172a]/50 border border-slate-700 text-white rounded-xl px-5 py-3.5 text-sm focus:border-rose-600 focus:ring-0 transition-all placeholder:text-slate-600"
                            placeholder="arbitre@frmf.ma"
                            required
                            autofocus
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-[10px] font-bold text-rose-500 uppercase tracking-widest" />
                    </div>

                    {{-- Button --}}
                    <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white font-black text-[11px] uppercase tracking-[0.2em] py-4 rounded-xl shadow-lg shadow-rose-600/20 transition-all active:scale-95">
                        Envoyer le lien
                    </button>
                </form>

            </div>

            {{-- Footer --}}
            <div class="mt-10 text-center space-y-4">
                <p class="text-[9px] text-slate-500 font-bold uppercase tracking-[0.3em]">Fédération Royale Marocaine de Football</p>
                <div class="flex justify-center gap-6">
                    <a href="{{ route('login') }}" class="text-[10px] text-slate-400 hover:text-white transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        Retour à la connexion
                    </a>
                </div>
            </div>

        </main>
    </div>
</x-guest-layout>