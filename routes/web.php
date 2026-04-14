<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EquipeController;
use App\Http\Controllers\Admin\ArbitreController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\MatchController as AdminMatchController;
use App\Http\Controllers\Arbitre\ArbitreMatchController;
use App\Http\Controllers\Admin\PaiementController;
use App\Http\Controllers\Admin\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Profil Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/profil', [App\Http\Controllers\Admin\ProfilController::class, 'edit'])->name('profil.edit');
    Route::patch('/profil', [App\Http\Controllers\Admin\ProfilController::class, 'update'])->name('profil.update'); 
});

// Profil Arbitre
Route::middleware(['auth', 'arbitre'])->prefix('arbitre')->name('arbitre.')->group(function () {
    Route::get('/profil', [App\Http\Controllers\Arbitre\ProfilController::class, 'edit'])->name('profil.edit');
    Route::patch('/profil', [App\Http\Controllers\Arbitre\ProfilController::class, 'update'])->name('profil.update'); 
});

Route::middleware(['auth', 'admin']) 
    ->prefix('admin')
    ->name('admin.')
    ->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('equipes', EquipeController::class);
        Route::resource('arbitres', ArbitreController::class);
        Route::resource('categories', CategorieController::class);
        Route::resource('matchs', AdminMatchController::class); 
    });

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Hadu l-routes d l-paiements
    Route::get('/paiements', [PaiementController::class, 'index'])->name('paiements.index');
    
    // HADI HIYA LI NAQSAK:
    Route::post('/paiements/pay-all', [PaiementController::class, 'payAll'])->name('paiements.payAll');
    
    // Route dyal l-Update (Payer un par un)
    Route::put('/paiements/{id}', [PaiementController::class, 'update'])->name('paiements.update');
});



    Route::middleware(['auth', 'arbitre'])
    ->prefix('arbitre')
    ->name('arbitre.')
    ->group(function () {
        Route::get('/dashboard', [ArbitreMatchController::class, 'dashboard'])->name('dashboard');
        Route::get('/matchs', [ArbitreMatchController::class, 'index'])->name('matchs.index');
        Route::get('/matchs/{match}', [ArbitreMatchController::class, 'show'])->name('matchs.show');
    });

    Route::post('admin/paiements/arbitre', [PaiementController::class, 'payerArbitre'])
    ->name('admin.paiements.arbitre');
require __DIR__.'/auth.php';