<?php

use App\Http\Controllers\Site\AdController;
//use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


Route::prefix('/site')->group(function () {

    Route::get('/ads', [AdController::class, 'index']);

    Route::get('/ads/{ad}', [AdController::class, 'show']);

    Route::post('/ads', [AdController::class, 'store']);

    Route::patch('/ads/{ad}', [AdController::class, 'update']);

    Route::delete('/ads/{ad}', [AdController::class, 'destroy']);

    //    Route::get('/categories', [CategoryController::class, 'index']);

//    Route::get('/categories/{category}', [CategoryController::class, 'show']);





});



