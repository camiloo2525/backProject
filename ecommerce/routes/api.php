<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Ruta pública de prueba para verificar que la API funciona correctamente
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

// Ruta para obtener información del usuario autenticado
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas públicas de la API
Route::get('/categories', [CategoryController::class, 'index'])->name('api.categories.index');
Route::get('/categories/{slug}', [CategoryController::class, 'showBySlug'])->name('api.categories.showBySlug');
Route::get('/products', [ProductController::class, 'index'])->name('api.products.index');
Route::get('/products/{slug}', [ProductController::class, 'showBySlug'])->name('api.products.showBySlug');
Route::get('/products/search/{name}', [ProductController::class, 'search'])->name('api.products.search');
Route::get('/categories/search/{name}', [CategoryController::class, 'search'])->name('api.categories.search');


// Rutas protegidas con Sanctum para la administración de categorías y productos
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);
    Route::apiResource('products', ProductController::class)->except(['index', 'show']);
    Route::get('/categories/{slug}/products', [CategoryController::class, 'getProducts'])->name('api.categories.products');
    Route::get('/products/search/{name}', [ProductController::class, 'search'])->name('api.products.search');
});




