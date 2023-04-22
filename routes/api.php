<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ItemController;
use App\Http\Controllers\API\ItemCategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::name('api')->group(function () {
    Route::prefix('items')->name('.items')->group(function () {
        Route::get('/', [ItemController::class, 'index'])->name('.index');
        Route::post('/', [ItemController::class, 'store'])->name('.store');
        Route::get('{id}', [ItemController::class, 'show'])->name('.show');
        Route::match(['put', 'patch'], '{id}', [ItemController::class, 'update'])->name('.update');
        Route::delete('{id}', [ItemController::class, 'destroy'])->name('.destroy');
    });

    Route::prefix('item-categories')->name('.items-categories')->group(function () {
        Route::get('/', [ItemCategoryController::class, 'index'])->name('.index');
        Route::post('/', [ItemCategoryController::class, 'store'])->name('.store');
        Route::get('{id}', [ItemCategoryController::class, 'show'])->name('.show');
        Route::match(['put', 'patch'], '{id}', [ItemCategoryController::class, 'update'])->name('.update');
        Route::delete('{id}', [ItemCategoryController::class, 'destroy'])->name('.destroy');
    });
});

