<?php

use App\Http\Controllers\{
    DashboardController,
    AccountController,
    CategoryController,
    BudgetController,
    TransactionController,
    ProfileController
};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard con datos reales
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('accounts', AccountController::class)->only(['index','create','store','destroy']);
    Route::resource('categories', CategoryController::class)->only(['index','create','store','destroy']);
    Route::resource('budgets', BudgetController::class)->only(['index','create','store','destroy']);
    Route::resource('transactions', TransactionController::class)->only(['index','create','store','destroy']);

    // Perfil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
