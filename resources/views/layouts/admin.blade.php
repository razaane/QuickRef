@extends('layouts.app')

@section('content')
    {{-- BOUTON HAMBURGER (Visible uniquement sur Mobile) --}}
    <div class="lg:hidden fixed top-5 left-5 z-[60]">
        <button id="toggleSidebar" class="p-3 bg-rose-600 text-white rounded-xl shadow-lg shadow-rose-900/40 flex items-center justify-center">
            <span class="material-symbols-outlined" id="menuIcon">menu</span>
        </button>
    </div>

    {{-- SIDEBAR ADMIN --}}
    {{-- On ajoute -translate-x-full (caché par défaut sur mobile) et lg:translate-x-0 (toujours visible sur desktop) --}}
    <aside id="adminSidebar" class="fixed left-0 top-0 h-screen w-64 flex flex-col p-6 z-50 bg-slate-950 shadow-2xl border-r border-white/5 transition-transform duration-300 transform -translate-x-full lg:translate-x-0">
        
        {{-- Brand --}}
        <div class="flex flex-col items-center gap-3 px-2 mb-10 lg:mb-16 mt-12 lg:mt-0">
            <div class="w-14 h-16 lg:w-18 lg:h-20 drop-shadow-xl">
                <img src="{{ asset('images/marocLogo.png') }}" alt="FRMF" class="w-full h-full object-contain">
            </div>
            <span class="text-xl lg:text-xxl font-black text-white uppercase tracking-tighter italic">Quick<span class="text-primary">Ref</span></span>
        </div>

        {{-- Nav (Scrollable si trop d'items) --}}
        <nav class="flex-1 space-y-1 overflow-y-auto pr-2 scrollbar-hide">
            @php
                $nav = [
                    ['route' => 'admin.dashboard', 'icon' => 'dashboard', 'label' => 'Vue d\'ensemble'],
                    ['route' => 'admin.arbitres.index', 'icon' => 'person_search', 'label' => 'Gestion des Arbitres'],
                    ['route' => 'admin.equipes.index', 'icon' => 'shield', 'label' => 'Gestion des Équipes'],
                    ['route' => 'admin.categories.index', 'icon' => 'category', 'label' => 'Catégories & Tarifs'],
                    ['route' => 'admin.matchs.index', 'icon' => 'sports_soccer', 'label' => 'Matchs & Désignations'],
                    ['route' => 'admin.paiements.index', 'icon' => 'payments', 'label' => 'Paiements'],
                    ['route' => 'admin.profil.edit', 'icon' => 'manage_accounts', 'label' => 'Mon Profil'],
                ];
            @endphp

            @foreach($nav as $item)
                <a href="{{ route($item['route']) }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs($item['route'].'*') ? 'bg-rose-600 text-white shadow-lg shadow-rose-900/40' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                    <span class="material-symbols-outlined {{ request()->routeIs($item['route'].'*') ? 'text-white' : 'text-rose-500' }}">{{ $item['icon'] }}</span>
                    <span class="text-sm font-bold">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="mt-auto pt-6 border-t border-white/5">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-slate-500 hover:text-rose-400 transition-colors group">
                <span class="material-symbols-outlined">logout</span>
                <span class="text-sm font-bold">Déconnexion</span>
            </button>
        </form>
    </aside>

    {{-- OVERLAY (Floute le fond quand le menu est ouvert sur mobile) --}}
    <div id="sidebarOverlay" class="fixed inset-0 bg-slate-950/50 backdrop-blur-sm z-40 hidden lg:hidden"></div>

    {{-- MAIN CONTENT --}}
    {{-- On change ml-64 en ml-0 (mobile) et lg:ml-64 (desktop) --}}
    <main class="ml-0 lg:ml-64 min-h-screen flex flex-col bg-slate-50 transition-all duration-300">
        
        {{-- HEADER RESPONSIVE --}}
        {{-- left-0 sur mobile, left-64 sur desktop --}}
        <header class="fixed top-0 right-0 left-0 lg:left-64 h-20 bg-white/80 backdrop-blur-xl z-30 flex justify-between items-center px-6 lg:px-10 border-b border-slate-200">
            {{-- On laisse de la place pour le bouton menu à gauche sur mobile --}}
            <h1 class="text-lg lg:text-2xl font-black text-slate-900 font-headline uppercase tracking-tight ml-14 lg:ml-0">
                @yield('page-title')
            </h1>
            
            <div class="flex items-center gap-3 lg:gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Admin</p>
                    <p class="text-sm font-black text-slate-900 leading-none">{{ auth()->user()->name }}</p>
                </div>
                <div class="w-10 h-10 lg:w-11 lg:h-11 rounded-full bg-rose-600 flex items-center justify-center shadow-lg shadow-rose-200 border-2 border-white">
                    <span class="material-symbols-outlined text-white text-lg lg:text-xl">person</span>
                </div>
            </div>
        </header>

        {{-- CONTENT WRAPPER --}}
        <div class="mt-20 p-4 lg:p-10 flex-1 zellige-pattern">
            @yield('admin-content')
        </div>

        @include('partials.footer')
    </main>
@endsection

@section('scripts')
<script>
    const btn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const icon = document.getElementById('menuIcon');

    function toggle() {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
        icon.innerText = sidebar.classList.contains('-translate-x-full') ? 'menu' : 'close';
    }

    btn.addEventListener('click', toggle);
    overlay.addEventListener('click', toggle);
</script>
@endsection