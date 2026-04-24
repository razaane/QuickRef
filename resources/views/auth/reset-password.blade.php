<x-guest-layout>
<div class="min-h-screen w-full bg-[#0f172a] flex items-center justify-center p-6 font-sans">
    
    {{-- Subtile Radial Gradient --}}
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
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.2em] mt-2">Nouveau mot de passe</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                {{-- Email (Read-only ou pré-rempli) --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 block">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $request->email) }}"
                        class="w-full bg-[#0f172a]/50 border border-slate-700 text-white rounded-xl px-5 py-3.5 text-sm focus:border-rose-600 focus:ring-0 transition-all placeholder:text-slate-600 opacity-70"
                        required
                        readonly
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-[9px] text-rose-500 font-bold uppercase tracking-widest" />
                </div>

                {{-- Nouveau Password --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 block">Nouveau mot de passe</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="w-full bg-[#0f172a]/50 border border-slate-700 text-white rounded-xl px-5 py-3.5 text-sm focus:border-rose-600 focus:ring-0 transition-all placeholder:text-slate-600"
                        placeholder="••••••••"
                        required
                        autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-[9px] text-rose-500 font-bold uppercase tracking-widest" />
                </div>

                {{-- Confirmation Password --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 block">Confirmer le mot de passe</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        class="w-full bg-[#0f172a]/50 border border-slate-700 text-white rounded-xl px-5 py-3.5 text-sm focus:border-rose-600 focus:ring-0 transition-all placeholder:text-slate-600"
                        placeholder="••••••••"
                        required
                        autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-[9px] text-rose-500 font-bold uppercase tracking-widest" />
                </div>

                {{-- Button --}}
                <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white font-black text-[11px] uppercase tracking-[0.2em] py-4 rounded-xl shadow-lg shadow-rose-600/20 transition-all active:scale-95">
                    Mettre à jour le mot de passe
                </button>
            </form>

        </div>

        {{-- Footer --}}
        <div class="mt-10 text-center">
            <p class="text-[9px] text-slate-500 font-bold uppercase tracking-[0.3em]">Fédération Royale Marocaine de Football</p>
        </div>

    </main>
</div>
</x-guest-layout>