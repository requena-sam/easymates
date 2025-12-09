<?php

use App\Http\Controllers\CreationsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\PlayersController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');
});


// Creations route
Route::get('creations', [CreationsController::class, 'index'])->name('creations')->middleware(['auth']);

//Events route
Route::get('events', [EventsController::class, 'index'])->name('events')->middleware(['auth']);
Route::get('events/{event}', [EventsController::class, 'show'])->name('events.show')->middleware(['auth']);

//Players route
Route::get('players', [PlayersController::class, 'index'])->name('players')->middleware(['auth']);
