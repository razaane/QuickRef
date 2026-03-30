@extends('layouts.admin')
@section('page-title', 'Tableau de Bord')
@section('admin-content')

    {{-- Statistics Bento Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

        {{-- Card: Matchs ce mois --}}
        <div class="bg-white p-6 rounded-xl border-t-2 border-[#C9A84C] shadow-sm hover:shadow-md transition-all">
            <div class="flex justify-between items-start mb-4">
                <span class="material-symbols-outlined text-[#1B6B3A] p-2 bg-[#1B6B3A]/5 rounded-lg">calendar_month</span>
                <span class="text-[10px] font-bold text-[#1B6B3A] bg-[#1B6B3A]/10 px-2 py-0.5 rounded-full uppercase tracking-wider">+12%</span>
            </div>
            <p class="text-slate-500 font-headline text-[11px] uppercase font-bold tracking-widest mb-1">Matchs ce mois</p>
            <h3 class="text-3xl font-extrabold text-slate-900 font-headline">{{ $matchesThisMonth ?? 142 }}</h3>
        </div>

        {{-- Card: Arbitres actifs --}}
        <div class="bg-white p-6 rounded-xl border-t-2 border-[#C9A84C] shadow-sm hover:shadow-md transition-all">
            <div class="flex justify-between items-start mb-4">
                <span class="material-symbols-outlined text-[#1B6B3A] p-2 bg-[#1B6B3A]/5 rounded-lg">person_check</span>
                <span class="text-[10px] font-bold text-[#1B6B3A] bg-[#1B6B3A]/10 px-2 py-0.5 rounded-full uppercase tracking-wider">Actifs</span>
            </div>
            <p class="text-slate-500 font-headline text-[11px] uppercase font-bold tracking-widest mb-1">Arbitres actifs</p>
            <h3 class="text-3xl font-extrabold text-slate-900 font-headline">{{ $activeReferees ?? 584 }}</h3>
        </div>

        {{-- Card: Paiements en attente --}}
        <div class="bg-white p-6 rounded-xl border-t-2 border-[#C9A84C] shadow-sm hover:shadow-md transition-all">
            <div class="flex justify-between items-start mb-4">
                <span class="material-symbols-outlined text-secondary p-2 bg-secondary/5 rounded-lg">pending_actions</span>
                <span class="text-[10px] font-bold text-secondary bg-secondary/10 px-2 py-0.5 rounded-full uppercase tracking-wider">Urgent</span>
            </div>
            <p class="text-slate-500 font-headline text-[11px] uppercase font-bold tracking-widest mb-1">Paiements en attente</p>
            <h3 class="text-3xl font-extrabold text-slate-900 font-headline">{{ $pendingPayments ?? 28 }}</h3>
        </div>

        {{-- Card: Feuilles reçues --}}
        <div class="bg-white p-6 rounded-xl border-t-2 border-[#C9A84C] shadow-sm hover:shadow-md transition-all">
            <div class="flex justify-between items-start mb-4">
                <span class="material-symbols-outlined text-[#1B6B3A] p-2 bg-[#1B6B3A]/5 rounded-lg">description</span>
                <span class="text-[10px] font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded-full uppercase tracking-wider">88%</span>
            </div>
            <p class="text-slate-500 font-headline text-[11px] uppercase font-bold tracking-widest mb-1">Feuilles reçues</p>
            <h3 class="text-3xl font-extrabold text-slate-900 font-headline">{{ $sheetsReceived ?? 125 }}</h3>
        </div>

    </div>

    {{-- Recent Convocations Table --}}
    <section class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-8 flex justify-between items-center border-b border-slate-100">
            <h2 class="text-xl font-extrabold text-[#1B6B3A] font-headline">Convocations Récentes</h2>
            <div class="flex gap-3">
                <button class="flex items-center gap-2 px-5 py-2.5 border border-slate-200 text-slate-600 text-sm font-bold rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="material-symbols-outlined text-lg">filter_list</span>
                    Filtrer
                </button>
                <button class="flex items-center gap-2 px-5 py-2.5 border border-slate-200 text-slate-600 text-sm font-bold rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="material-symbols-outlined text-lg">download</span>
                    Exporter PDF
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-5 font-headline text-[10px] font-extrabold text-slate-400 uppercase tracking-widest border-b border-slate-100">Date & Heure</th>
                        <th class="px-8 py-5 font-headline text-[10px] font-extrabold text-slate-400 uppercase tracking-widest border-b border-slate-100">Match / Équipes</th>
                        <th class="px-8 py-5 font-headline text-[10px] font-extrabold text-slate-400 uppercase tracking-widest border-b border-slate-100">Catégorie</th>
                        <th class="px-8 py-5 font-headline text-[10px] font-extrabold text-slate-400 uppercase tracking-widest border-b border-slate-100">Arbitre Central</th>
                        <th class="px-8 py-5 font-headline text-[10px] font-extrabold text-slate-400 uppercase tracking-widest border-b border-slate-100 text-center">Statut</th>
                        <th class="px-8 py-5 font-headline text-[10px] font-extrabold text-slate-400 uppercase tracking-widest border-b border-slate-100 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">

                    @forelse ($recentConvocations ?? [] as $convocation)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <p class="font-body text-sm font-bold text-slate-900">
                                    {{ \Carbon\Carbon::parse($convocation->match->date)->translatedFormat('d F Y') }}
                                </p>
                                <p class="font-body text-xs text-slate-400 mt-0.5">
                                    {{ \Carbon\Carbon::parse($convocation->match->kickoff)->format('H:i') }}
                                </p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="font-headline text-sm font-bold text-slate-900">
                                    {{ $convocation->match->home_team }} vs {{ $convocation->match->away_team }}
                                </p>
                                <p class="font-body text-xs text-slate-400 mt-0.5">{{ $convocation->match->stadium }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-500 text-[10px] font-extrabold rounded uppercase">
                                    {{ $convocation->match->competition }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#1B6B3A]/10 flex items-center justify-center text-[#1B6B3A] font-bold text-[10px]">
                                        {{ strtoupper(substr($convocation->centralReferee->name, 0, 2)) }}
                                    </div>
                                    <p class="font-headline text-sm font-bold text-slate-800">{{ $convocation->centralReferee->name }}</p>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                @if ($convocation->status === 'confirmed')
                                    <span class="inline-block px-4 py-1 bg-[#1B6B3A] text-white text-[10px] font-black rounded uppercase tracking-wider">Confirmé</span>
                                @else
                                    <span class="inline-block px-4 py-1 bg-secondary text-white text-[10px] font-black rounded uppercase tracking-wider">En attente</span>
                                @endif
                            </td>
                            <td class="px-8 py-6 text-right">
                                <a href=""
                                   class="text-slate-400 hover:text-[#1B6B3A] transition-colors">
                                    <span class="material-symbols-outlined">visibility</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        {{-- Fallback demo rows --}}
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <p class="font-body text-sm font-bold text-slate-900">12 Mai 2024</p>
                                <p class="font-body text-xs text-slate-400 mt-0.5">16:00</p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="font-headline text-sm font-bold text-slate-900">WAC vs RCA</p>
                                <p class="font-body text-xs text-slate-400 mt-0.5">Stade Mohammed V</p>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-500 text-[10px] font-extrabold rounded uppercase">Botola Pro 1</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#1B6B3A]/10 flex items-center justify-center text-[#1B6B3A] font-bold text-[10px]">RJ</div>
                                    <p class="font-headline text-sm font-bold text-slate-800">Redouane Jiyed</p>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="inline-block px-4 py-1 bg-[#1B6B3A] text-white text-[10px] font-black rounded uppercase tracking-wider">Confirmé</span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <button class="text-slate-400 hover:text-[#1B6B3A] transition-colors">
                                    <span class="material-symbols-outlined">visibility</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <p class="font-body text-sm font-bold text-slate-900">14 Mai 2024</p>
                                <p class="font-body text-xs text-slate-400 mt-0.5">18:00</p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="font-headline text-sm font-bold text-slate-900">ASFAR vs RSB</p>
                                <p class="font-body text-xs text-slate-400 mt-0.5">Stade Moulay Abdellah</p>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-500 text-[10px] font-extrabold rounded uppercase">Botola Pro 1</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#1B6B3A]/10 flex items-center justify-center text-[#1B6B3A] font-bold text-[10px]">SG</div>
                                    <p class="font-headline text-sm font-bold text-slate-800">Samir Guezzaz</p>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="inline-block px-4 py-1 bg-secondary text-white text-[10px] font-black rounded uppercase tracking-wider">En attente</span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <button class="text-slate-400 hover:text-[#1B6B3A] transition-colors">
                                    <span class="material-symbols-outlined">visibility</span>
                                </button>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <div class="p-6 bg-slate-50 flex justify-center border-t border-slate-100">
            <a href=""
               class="text-[#1B6B3A] font-headline text-xs font-black uppercase tracking-widest hover:text-[#C9A84C] transition-colors">
                Voir tous les matchs
            </a>
        </div>
    </section>

    {{-- Bottom Row: Finance + Quick Actions --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 pb-12">

        {{-- Finance Snapshot --}}
        <div class="lg:col-span-2 bg-white p-10 rounded-2xl shadow-sm border border-slate-200 relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#1B6B3A]/5 rounded-full blur-3xl"></div>
            <div class="relative z-10">
                <h2 class="text-xl font-extrabold text-[#1B6B3A] font-headline mb-8">Aperçu Financier (Mensuel)</h2>
                <div class="flex items-baseline gap-2 mb-10">
                    <span class="text-5xl font-black text-slate-900 tracking-tight">{{ $totalBudget ?? '428.500' }}</span>
                    <span class="text-lg font-bold text-[#C9A84C]">MAD</span>
                </div>
                <div class="space-y-6">
                    <div>
                        <div class="flex justify-between items-center text-xs font-bold uppercase tracking-wider mb-2">
                            <span class="text-slate-500">Indemnités versées</span>
                            <span class="text-[#1B6B3A]">{{ $salariesPaid ?? '315.000' }} MAD</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden">
                            <div class="bg-[#1B6B3A] h-full rounded-full" style="width: {{ $salariesPercent ?? 74 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center text-xs font-bold uppercase tracking-wider mb-2">
                            <span class="text-slate-500">Frais de déplacement</span>
                            <span class="text-[#1B6B3A]">{{ $travelExpenses ?? '113.500' }} MAD</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden">
                            <div class="bg-[#C9A84C] h-full rounded-full" style="width: {{ $travelPercent ?? 26 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-[#1B6B3A] p-10 rounded-2xl shadow-xl flex flex-col justify-between">
            <div>
                <h2 class="text-lg font-extrabold text-white font-headline mb-8">Actions Rapides</h2>
                <div class="grid grid-cols-1 gap-3">
                    <button class="flex items-center gap-4 px-5 py-4 bg-white/10 text-white rounded-xl hover:bg-white/20 transition-all text-left">
                        <span class="material-symbols-outlined text-[#C9A84C]">picture_as_pdf</span>
                        <span class="text-sm font-bold font-headline">Imprimer Feuilles de Match</span>
                    </button>
                    <a href=""
                       class="flex items-center gap-4 px-5 py-4 bg-white/10 text-white rounded-xl hover:bg-white/20 transition-all text-left">
                        <span class="material-symbols-outlined text-[#C9A84C]">group_add</span>
                        <span class="text-sm font-bold font-headline">Ajouter Nouvel Arbitre</span>
                    </a>
                    <button class="flex items-center gap-4 px-5 py-4 bg-white/10 text-white rounded-xl hover:bg-white/20 transition-all text-left">
                        <span class="material-symbols-outlined text-[#C9A84C]">mail</span>
                        <span class="text-sm font-bold font-headline">Envoyer Notifications SMS</span>
                    </button>
                </div>
            </div>
            <div class="mt-10 pt-6 border-t border-white/10">
                <p class="text-[10px] text-white/40 font-black uppercase tracking-[0.2em]">FRMF QuickRef v1.0.0</p>
            </div>
        </div>

    </div>

@endsection