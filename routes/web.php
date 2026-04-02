<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EquipeController;
use App\Http\Controllers\Admin\ArbitreController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\MatchController as AdminMatchController;
use App\Http\Controllers\Arbitre\ArbitreMatchController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin']) 
    ->prefix('admin')
    ->name('admin.')
    ->group(function() {
        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
        Route::resource('equipes', EquipeController::class);
        Route::resource('arbitres', ArbitreController::class);
        Route::resource('categories', CategorieController::class);
        Route::resource('matchs', AdminMatchController::class); 
    });

Route::middleware(['auth', 'arbitre'])
    ->prefix('arbitre')
    ->name('arbitre.')
    ->group(function () {
        Route::get('/dashboard', [ArbitreMatchController::class, 'dashboard'])->name('dashboard');
        Route::get('/matchs', [ArbitreMatchController::class, 'index'])->name('matchs.index');
        Route::get('/matchs/{match}', [ArbitreMatchController::class, 'show'])->name('matchs.show');
    });

require __DIR__.'/auth.php';