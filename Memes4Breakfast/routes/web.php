<?php

use App\Http\Controllers\MemeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Our homepage
Route::get('/', [MemeController::class, 'index'])->name('home');

// Handle meme routes
Route::get('/upload', [MemeController::class, 'upload'])->name('upload');
Route::post('create', [MemeController::class, 'create'])->name('create');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
