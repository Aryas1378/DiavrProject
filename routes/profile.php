<?php

use App\Http\Controllers\ChatMessengerController;
use App\Http\Controllers\Profile\AdController;
use App\Http\Controllers\Profile\UserProfileController;
use App\Http\Controllers\UserAdController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')->middleware('auth:sanctum')->group(function () {

    Route::post('/', function (Request $request){
        return auth()->user();
    });

    Route::get('/ads', [UserAdController::class, 'index']);

    Route::get('/ads/{ad}', [UserAdController::class, 'show']);

    Route::post('/ads', [AdController::class, 'store']);

    Route::patch('ads/{ad}', [AdController::class, 'update']);

    Route::delete('ads/{ad}', [AdController::class, 'destroy']);

    Route::get('users', [UserProfileController::class, 'show']);

    Route::patch('users/{user}', [UserProfileController::class, 'update']);

    Route::post('/chats/user/{ad}', [ChatMessengerController::class, 'sendMessage']);

    Route::get('/chats/user', [ChatMessengerController::class, 'index']);

    Route::get('/chats/channel/{channel}', [ChatMessengerController::class, 'showMessages']);

});
