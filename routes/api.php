<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UserController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'register']);
    Route::put('/users', [UserController::class, 'update']);
    Route::delete('/users', [UserController::class, 'delete']);
    Route::post('/logout', [UserController::class, 'logout']);
});
