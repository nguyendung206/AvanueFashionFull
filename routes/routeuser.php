<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('user/login', [UserController::class, 'index']);
Route::get('user/register', [UserController::class, 'index']);
Route::post('user/login', [UserController::class, 'login'])->name('login');
Route::post('user/register', [UserController::class, 'register'])->name('register');
Route::get('user/signout', [UserController::class, 'SignOut'])->name('signout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::get('main', [UserController::class, 'index']);
    });
});
