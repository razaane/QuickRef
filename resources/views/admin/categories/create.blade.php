@extends('layouts.admin')
@section('page-title', 'Nouvelle Catégorie')

@section('admin-content')
<div class="max-w-xl bg-white rounded-3xl shadow-sm border border-slate-200 p-8">
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-black text-slate-700 uppercase mb-2">Nom (U15, Botola...)</label>
                <input type="text" name="nom" class="w-full px-5 py-4 rounded-2xl border border-slate-200 outline-none focus:ring-4 focus:ring-[#1B6B3A]/10">
            </div>
            <div>
                <label class="block text-sm font-black text-slate-700 uppercase mb-2">Indemnité (DH)</label>
                <input type="number" step="0.01" name="montant" class="w-full px-5 py-4 rounded-2xl border border-slate-200 outline-none focus:ring-4 focus:ring-[#1B6B3A]/10">
            </div>
            <button type="submit" class="w-full bg-[#1B6B3A] text-white py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-[#14522c] transition-all shadow-md">
                Enregistrer la catégorie
            </button>
        </div>
    </form>
</div>
@endsection