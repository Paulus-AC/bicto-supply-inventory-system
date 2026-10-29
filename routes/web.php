<?php

use App\Livewire\Users\Listing as UsersListing;
use App\Livewire\Items\Listing as ItemsListing;
use App\Livewire\Items\View as ItemsView;
use App\Livewire\Categories\Listing as CategoriesListing;
use App\Livewire\Units\Listing as UnitsListing;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login')->name('home');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::prefix('users')->group(function () {
        Route::livewire('/', UsersListing::class)->name('users.listing');
    });

    Route::prefix('items')->group(function() {
        Route::livewire('/', ItemsListing::class)->name('items.listing');
        Route::livewire('/view/{id}', ItemsView::class)->name('items.view');
    });

    Route::prefix('categories')->group(function () {
        Route::livewire('/', CategoriesListing::class)->name('categories.listing');
    });

    Route::prefix('units')->group(function () {
        Route::livewire('/', UnitsListing::class)->name('units.listing');
    });

});

require __DIR__.'/settings.php';
