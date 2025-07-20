<?php
declare(strict_types=1);

use App\Http\Controllers\Api\{
    AuthController,
    AuthTgController
};

Route::prefix('v1')
    ->as('auth.')
    ->group(function () {
        Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::post('logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum'])->name('logout');
        Route::post('loginbottg', [AuthController::class, 'logoutbottg']);
        Route::post('telegram/mini-app/auth', [AuthTgController::class, 'authenticate'])->name('telegram.mini-app.auth');
        Route::middleware('auth:sanctum')->post('change_password', [AuthController::class, 'password'])->name('password');
    });
