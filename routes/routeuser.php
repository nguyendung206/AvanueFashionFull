<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DetailController;
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
        Route::get('/details/{ProductId}', [HomeController::class, 'Detail'])->name('detail');
    });
    // Route::get('/addtocart', [CartController::class, 'AddToCart'])->name('addtocart');

});
Route::middleware(['auth'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::prefix('cart')->group(function () {
            Route::get('/cart}', [CartController::class, 'Index'])->name('cart');
            Route::post('/addtocart', [CartController::class, 'AddToCart'])->name('addtocart');
            Route::get('/updatecart/{productId}', [CartController::class, 'UpdateToCart'])->name('updatecart');
            Route::post('/updatecart/{productId}', [CartController::class, 'UpdateToCart'])->name('updatecart');
            Route::get('/deletecart/{productId}', [CartController::class, 'DeleteCart'])->name('deletecart');
            Route::get('/checkout', [CartController::class, 'CheckOut'])->name('checkout');
        });
    });
});
