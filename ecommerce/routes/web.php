<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

// Rutas protegidas para administración de categorías y productos
Route::middleware(['auth'])->group(function () {
    

    // Rutas de perfil de usuario (Laravel Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Ruta de prueba para confirmar autenticación
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

// Ruta principal para React (SPA)
Route::get('/{any}', function () {
    return view('app'); // Cambia 'app' por el nombre correcto de tu vista principal si es necesario
})->where('any', '^(?!api).*$');

// Archivo adicional de autenticación (Laravel Breeze)
require __DIR__ . '/auth.php';


