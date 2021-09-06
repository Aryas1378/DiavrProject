<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

include 'site.php';
include 'admin.php';

Route::post('admin/tokens/create', [AuthController::class, 'register']);
Route::post('admin/profile', function (Request $request){
    return auth()->user();
})->middleware('auth:sanctum');
