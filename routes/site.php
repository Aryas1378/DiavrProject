<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Profile\AdController;
use App\Http\Controllers\Profile\CategoryAttributeController;
use Illuminate\Support\Facades\Route;


Route::prefix('/site')->middleware('auth:sanctum')->group(function () {

    Route::get('/ads', [AdController::class, 'index']);

    Route::get('/ads/{ad}', [AdController::class, 'show']);

    Route::post('/ads', [AdController::class, 'store']);

    Route::patch('/ads/{ad}', [AdController::class, 'update'])
        ->name('site.ads.update');

    Route::delete('/ads/{ad}', [AdController::class, 'destroy']);


    Route::post('/ads/categories/', [AdController::class, 'index'])
        ->name('site.adsCategory.show');

    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('site.categories.index');

    Route::get('/categories/{category}/attributes', [CategoryAttributeController::class, 'show'])
        ->name('site.categories.show');

});


