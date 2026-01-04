<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('landing');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Rutas de perfil (de Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas del Password Vault
    Route::post('/passwords/generate', [PasswordController::class, 'generate']);
    Route::post('/passwords', [PasswordController::class, 'store']);
    Route::get('/passwords', [PasswordController::class, 'index']);
    Route::get('/passwords/{id}', [PasswordController::class, 'show']);
});

require __DIR__.'/auth.php';