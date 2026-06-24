<?php

use App\Livewire\Users\Listing as UsersListing;
use App\Livewire\Categories\Listing as CategoriesListing;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::prefix('users')->group(function () {
        Route::livewire('/', UsersListing::class)->name('users.listing');
    });

    Route::prefix('categories')->group(function () {
        Route::livewire('/', CategoriesListing::class)->name('categories.listing');
    });

});

require __DIR__.'/settings.php';
