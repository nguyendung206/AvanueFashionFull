<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('user/login', [UserController::class, 'login'])->name('login');
Route::post('user/login', [UserController::class, 'login'])->name('login');
Route::get('user/register', [UserController::class, 'register'])->name('register');
Route::post('user/register', [UserController::class, 'register'])->name('register');
Route::get('user/signout', [UserController::class, 'SignOut'])->name('signout');
Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user');
    Route::prefix('home')->group(function () {
        Route::get('/', [HomeController::class, 'Index'])->name('home');
        Route::get('/search', [HomeController::class, 'Index'])->name('searchname');
        Route::get('/search/category/{CategoryId}', [HomeController::class, 'Index'])->name('searchcategoryid');
        Route::get('/search/color/{ColorId}', [HomeController::class, 'Index'])->name('searchcolorid');
        Route::get('/search/tag/{TagId}', [HomeController::class, 'Index'])->name('searchtagid');
        // Route::get('add', [HomeController::class, 'Create'])->name('addemployee');
        // Route::post('add', [HomeController::class, 'Save'])->name('saveemployee');
        // Route::get('/delete/{EmployeeId}', [HomeController::class, 'showDeleteForm'])->name('deleteemployee');
        // Route::post('/delete/{EmployeeId}', [HomeController::class, 'delete'])->name('deleteemployee.post');
    });
});
Route::middleware(['auth'])->group(function () {
});
