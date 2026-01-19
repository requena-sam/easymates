<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CreationsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    // Dashboard route
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Profile route
    Route::get('profile', [ProfileController::class, 'show'])->name('profile');


    // Creations route
    Route::get('creations', [CreationsController::class, 'index'])->name('creations');

    // Events routes
    Route::get('events', [EventsController::class, 'index'])->name('events.index');
    Route::get('events/{event}', [EventsController::class, 'show'])->name('events.show');

    // Players route
    Route::get('players', [PlayersController::class, 'index'])->name('players');

    Route::get('notifications', [NotificationsController::class, 'index'])->name('notifications');

});

Route::middleware(['auth', 'role:admin|moderator'])->group(function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin');
});

