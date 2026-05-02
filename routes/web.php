<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InternLogController;
use App\Http\Controllers\ProfileController;

// The default homepage
Route::get('/', function () {
    return view('welcome'); 
});

// Your secure, locked-down Logbook routes!
Route::middleware(['auth'])->group(function () {
    Route::get('/logs', [InternLogController::class, 'index']);
    Route::post('/logs', [InternLogController::class, 'store']);
    Route::get('/logs/{id}/edit', [InternLogController::class, 'edit']);
    Route::put('/logs/{id}', [InternLogController::class, 'update']);
    Route::delete('/logs/{id}', [InternLogController::class, 'destroy']);
    Route::patch('/logs/{id}/status', [InternLogController::class, 'updateStatus']);
});

// THE SETTINGS PAGE ROUTES
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// THE FIX: Tell Breeze that the Dashboard is actually the Logbook!
Route::get('/dashboard', function () {
    return redirect('/logs');
})->middleware(['auth'])->name('dashboard');

// Instantly redirect visitors to the Login page!
Route::get('/', function () {
    return redirect('/login'); 
});

// This tells Laravel where the Login/Register pages are
require __DIR__.'/auth.php';