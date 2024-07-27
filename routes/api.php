<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::put('/users', [UserController::class, 'update']);
Route::delete('/users', [UserController::class, 'delete']);
