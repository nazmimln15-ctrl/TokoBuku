<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// welcome.blade.php
Route::get('/', function () {
    return view('welcome');
})->name('landing');

// Resource routes untuk books 
Route::resource('books', BookController::class);

Route::resource('books', BookController::class)->only(['index', 'show']);

// Protected: create, store, edit, update, destroy 
Route::middleware('auth')->group(function () {
    Route::resource('books', BookController::class)->only([
        'create', 'store', 'edit', 'update', 'destroy'
    ]);
});

// Dashboard 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
