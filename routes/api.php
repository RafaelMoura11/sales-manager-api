<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UserController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'register']);
    Route::put('/users', [UserController::class, 'update']);
    Route::delete('/users', [UserController::class, 'delete']);
    Route::post('/logout', [UserController::class, 'logout']);
});

Route::get('/customers', [CustomerController::class, 'index']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::get('/customers/{id}', [CustomerController::class, 'show']);
Route::put('/customers/{id}', [CustomerController::class, 'update']);
Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

