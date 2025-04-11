<?php

use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('users', function () {
//    return Inertia::render('Users');
//})->middleware(['auth', 'verified'])->name('users');
//
//Route::get('providers', function () {
//    return Inertia::render('Providers');
//})->middleware(['auth', 'verified'])->name('providers');

Route::get('users', [UserController::class, 'index'])->name('users');

Route::get('providers', [ProviderController::class, 'index'])->name('providers');

Route::get('offers', [OfferController::class, 'index'])->name('offers');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
