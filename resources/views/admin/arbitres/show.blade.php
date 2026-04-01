@extends('layouts.admin')
@section('page-title', 'Profil de ' . $arbitre->user->name)

@section('admin-content')
<div class="max-w-2xl bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="bg-[#1B6B3A] p-8 text-center text-white">
        <div class="w-24 h-24 bg-white/20 rounded-full mx-auto flex items-center justify-center mb-4 backdrop-blur-md">
            <span class="material-symbols-outlined text-4xl">person</span>
        </div>
        <h2 class="text-2xl font-black">{{ $arbitre->user->name }}</h2>
        <span class="px-4 py-1 bg-white/20 rounded-full text-xs font-bold uppercase tracking-widest mt-2 inline-block">
            Arbitre {{ $arbitre->grade }}
        </span>
    </div>
    <div class="p-8 space-y-6">
        <div class="flex justify-between border-b pb-4">
            <span class="text-slate-400 font-bold text-xs uppercase">Email</span>
            <span class="font-bold text-slate-700">{{ $arbitre->user->email }}</span>
        </div>
        <div class="flex justify-between border-b pb-4">
            <span class="text-slate-400 font-bold text-xs uppercase">Téléphone</span>
            <span class="font-bold text-slate-700">{{ $arbitre->telephone }}</span>
        </div>
        <div class="flex justify-between border-b pb-4">
            <span class="text-slate-400 font-bold text-xs uppercase">Adresse</span>
            <span class="font-bold text-slate-700">{{ $arbitre->adresse ?? 'N/A' }}</span>
        </div>
        <div class="pt-4 text-center">
            <a href="{{ route('admin.arbitres.edit', $arbitre->id) }}" class="text-[#1B6B3A] font-black text-sm uppercase hover:underline">Modifier le profil</a>
        </div>
    </div>
</div>
@endsection