<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetaPanganController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\AgroEduwisataController;
use App\Http\Controllers\PotensiPanganController;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/peta-pangan', [PetaPanganController::class, 'index'])->name('peta-pangan');
Route::get('/market', [MarketController::class, 'index'])->name('market');
Route::get('/agro-eduwisata', [AgroEduwisataController::class, 'index'])->name('agro-eduwisata');

Route::get('/peta-potensi-pangan', [PotensiPanganController::class, 'map'])->name('potensi-pangan.map');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
