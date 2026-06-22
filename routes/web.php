<?php

use App\Livewire\Users\Create;
use App\Livewire\Users\Listing;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::prefix('users')->group(function () {
        Route::livewire('/', Listing::class)->name('users.listing');
    });
});

require __DIR__.'/settings.php';
