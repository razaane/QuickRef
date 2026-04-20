@extends('layouts.arbitre')

@section('arbitre-content')
<div class="max-w-4xl mx-auto space-y-6 lg:space-y-8 px-2 lg:px-0">
    <a href="{{ route('arbitre.matchs.index') }}" class="inline-flex items-center gap-2 text-[9px] lg:text-[10px] font-black text-on-surface-muted hover:text-primary uppercase tracking-widest transition-colors">
        <span class="material-symbols-outlined text-sm">arrow_back</span> Retour
    </a>

    {{-- Match Header Card --}}
    <div class="bg-sidebar rounded-2xl border border-white/5 p-6 lg:p-10 relative overflow-hidden shadow-2xl">
        <div class="absolute top-0 right-0 p-4 lg:p-8 opacity-[0.03]">
            <span class="material-symbols-outlined text-7xl lg:text-9xl text-white">sports_soccer</span>
        </div>
        
        <div class="relative z-10 text-center">
            <div class="inline-block mb-8">
                <span class="bg-primary/20 text-primary text-[8px] lg:text-[10px] font-black px-4 py-1.5 rounded-full border border-primary/30 uppercase tracking-[0.15em] lg:tracking-[0.2em]">
                    {{ \Carbon\Carbon::parse($match->date_heure)->translatedFormat('l d F Y • H:i') }}
                </span>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-between gap-6 sm:gap-4 max-w-2xl mx-auto">
                <div class="flex-1 order-1 sm:order-none">
                    <p class="text-xl lg:text-2xl font-black text-white uppercase tracking-tighter">{{ $match->equipeDomicile->nom ?? '?' }}</p>
                    <p class="text-[8px] text-white/30 font-black uppercase tracking-widest mt-2 italic">Domicile</p>
                </div>
                <div class="text-3xl lg:text-4xl font-black text-primary italic px-4 order-2 sm:order-none">VS</div>
                <div class="flex-1 order-3 sm:order-none">
                    <p class="text-xl lg:text-2xl font-black text-white uppercase tracking-tighter">{{ $match->equipeVisiteur->nom ?? '?' }}</p>
                    <p class="text-[8px] text-white/30 font-black uppercase tracking-widest mt-2 italic">Visiteur</p>
                </div>
            </div>

            <div class="mt-10 pt-8 border-t border-white/5 flex flex-col sm:flex-row justify-center items-center gap-4 lg:gap-8 text-[9px] lg:text-[10px] font-black text-white/50 uppercase tracking-widest text-center">
                <span class="flex items-center gap-2"><span class="material-symbols-outlined text-sm text-primary">location_on</span> {{ $match->terrain }}</span>
                <span class="flex items-center gap-2"><span class="material-symbols-outlined text-sm text-primary">emoji_events</span> {{ $match->categorie->nom ?? '—' }}</span>
                <span class="flex items-center gap-2"><span class="material-symbols-outlined text-sm text-primary">payments</span> {{ number_format($match->categorie->montant ?? 0, 0) }} MAD</span>
            </div>
        </div>
    </div>

    {{-- Corps Arbitral --}}
    <div class="bg-surface rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
        <div class="px-6 lg:px-8 py-5 border-b border-outline-variant bg-background/50 text-center lg:text-left">
            <h2 class="font-black text-on-surface uppercase tracking-widest text-[9px] lg:text-[10px]">Composition de l'équipe</h2>
        </div>
        <div class="divide-y divide-outline-variant">
            @php $arbitreId = auth()->user()->arbitre->id; @endphp
            @foreach([['role' => 'Central', 'obj' => $match->arbitreCentral], ['role' => 'Assistant 1', 'obj' => $match->assistant1], ['role' => 'Assistant 2', 'obj' => $match->assistant2], ['role' => '4ème Arbitre', 'obj' => $match->quatrieme]] as $item)
                @if($item['obj'])
                <div class="px-6 lg:px-8 py-5 flex items-center justify-between {{ $item['obj']->id == $arbitreId ? 'bg-primary/[0.03]' : '' }}">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-background border border-outline-variant flex items-center justify-center font-black text-on-surface-muted text-xs uppercase">
                            {{ substr($item['obj']->user->name ?? '?', 0, 1) }}
                        </div>
                        <div>
                            <p class="font-black text-on-surface text-xs lg:text-sm uppercase {{ $item['obj']->id == $arbitreId ? 'text-primary' : '' }}">
                                {{ $item['obj']->user->name ?? '—' }}
                                @if($item['obj']->id == $arbitreId) <span class="text-[7px] bg-primary/10 text-primary px-1.5 py-0.5 rounded ml-1 tracking-widest">VOUS</span> @endif
                            </p>
                            <p class="text-[8px] lg:text-[9px] text-on-surface-muted font-bold uppercase tracking-widest mt-0.5">{{ $item['role'] }}</p>
                        </div>
                    </div>
                    <span class="hidden sm:inline-block text-[7px] font-black uppercase tracking-widest px-2 py-1 rounded bg-on-surface/5 text-on-surface-muted italic">Grade {{ $item['obj']->grade }}</span>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection