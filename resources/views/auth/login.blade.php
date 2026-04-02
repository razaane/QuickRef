{{-- auth/login.blade.php --}}
@extends('layouts.guest')

@section('title', 'Connexion — QuickRef')

@section('content')
<main class="w-full max-w-md">

    {{-- Zellige texture background --}}
    <div class="fixed inset-0 pointer-events-none opacity-[0.03] overflow-hidden">
        <svg height="100%" width="100%" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern height="80" id="zellige" patternUnits="userSpaceOnUse" width="80">
                    <path d="M40 0l40 40-40 40-40-40z" fill="none" stroke="#005127" stroke-width="0.5"/>
                    <circle cx="40" cy="40" fill="none" r="10" stroke="#755b00" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect fill="url(#zellige)" height="100%" width="100%"/>
        </svg>
    </div>

    {{-- Login Card --}}
    <div class="relative bg-surface-container-lowest border border-tertiary/20 shadow-[0px_12px_32px_rgba(27,27,27,0.04)] rounded-xl overflow-hidden p-8 md:p-12">

        {{-- Brand Identity --}}
        <div class="flex flex-col items-center mb-10">
            <div class="w-16 h-16 mb-4 flex items-center justify-center bg-primary/5 rounded-full">
                <span class="material-symbols-outlined text-primary text-3xl">sports_soccer</span>
            </div>
            <h1 class="text-3xl font-extrabold tracking-tighter text-tertiary font-headline uppercase">QuickRef</h1>
            <p class="text-on-surface-variant text-sm mt-2 font-medium">Direction de l'Arbitrage — FRMF</p>
        </div>

        {{-- Session errors --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                @foreach ($errors->all() as $error)
                    <p class="text-xs text-red-600 font-medium">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Login Form --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            {{-- Email --}}
            <div class="space-y-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant font-label" for="email">
                    Email
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 w-1 bg-transparent group-focus-within:bg-primary transition-colors"></div>
                    <input
                        class="w-full px-4 py-3 bg-surface-container-low border-0 text-on-surface placeholder:text-outline-variant focus:ring-0 focus:bg-surface-container-lowest transition-all @error('email') ring-1 ring-red-400 @enderror"
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        placeholder="nom@exemple.ma"
                        required
                        autocomplete="email"
                    />
                </div>
            </div>

            {{-- Password --}}
            <div class="space-y-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant font-label" for="password">
                    Mot de passe
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 w-1 bg-transparent group-focus-within:bg-primary transition-colors"></div>
                    <input
                        class="w-full px-4 py-3 bg-surface-container-low border-0 text-on-surface placeholder:text-outline-variant focus:ring-0 focus:bg-surface-container-lowest transition-all @error('password') ring-1 ring-red-400 @enderror"
                        id="password"
                        name="password"
                        type="password"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                    />
                </div>
            </div>

            {{-- Remember me --}}
            <div class="flex items-center gap-2">
                <input type="checkbox" id="remember" name="remember" class="rounded border-outline-variant text-primary focus:ring-primary">
                <label for="remember" class="text-xs text-on-surface-variant font-medium">Se souvenir de moi</label>
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button
                    class="w-full py-4 px-6 bg-secondary text-on-secondary font-bold text-sm tracking-wide rounded-md hover:bg-[#a00022] active:scale-[0.98] transition-all duration-200 shadow-sm"
                    type="submit">
                    Se connecter
                </button>
            </div>
        </form>

        {{-- Footer links --}}
        <div class="mt-8 flex flex-col items-center gap-4">
            @if (Route::has('password.request'))
                <a class="text-primary text-sm font-semibold hover:text-primary-container transition-colors inline-flex items-center gap-1 group" href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                    <span class="material-symbols-outlined text-[18px] group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                </a>
            @endif
        </div>

    </div>

    {{-- Institutional footer --}}
    <footer class="mt-12 text-center">
        <p class="text-[10px] text-on-surface-variant font-medium tracking-widest uppercase opacity-60">
            © {{ date('Y') }} Fédération Royale Marocaine de Football — QuickRef
        </p>
    </footer>

</main>
@endsection