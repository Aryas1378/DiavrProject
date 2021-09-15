<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MutualChatController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

include 'site.php';
include 'admin.php';
include 'profile.php';

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('search', SearchController::class);

Route::post('mutual-chat/send-message/ad/{ad}', [MutualChatController::class, 'sendMessage'])->middleware('auth:sanctum');
Route::get('mutual-chat/ad/{ad}', [MutualChatController::class, 'showMutualChats'])->middleware('auth:sanctum');
Route::get('ads/mutual-chats', [MutualChatController::class, 'index']);
