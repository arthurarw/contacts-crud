<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{uuid}', [UserController::class, 'show']);
    Route::put('/{uuid}', [UserController::class, 'show']);
    Route::delete('/{uuid}', [UserController::class, 'destroy']);
});
