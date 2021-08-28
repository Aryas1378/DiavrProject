<?php

use App\Http\Controllers\AdController;

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('ads')->group(function () {

    Route::get('/', [AdController::class, 'index']);

    Route::get('/{ad}', [AdController::class, 'show']);

    Route::post('/', [AdController::class, 'store']);

    Route::patch('{ad}', [AdController::class, 'update']);

    Route::delete('/{ad}', [AdController::class, 'destroy']);

});

Route::prefix('/categories')->group(function () {

    Route::get('/', [CategoryController::class, 'index']);

    Route::get('/{category}/attributes', [AttributeController::class, 'index']);

    Route::get('/{category}', [CategoryController::class, 'show']);

    Route::post('/', [CategoryController::class, 'store']);

    Route::patch('/{category}', [CategoryController::class, 'update']);

    Route::delete('/{category}', [CategoryController::class, 'destroy']);

});
