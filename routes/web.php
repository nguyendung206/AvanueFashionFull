<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleoffController;
use App\Http\Controllers\ShipperController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminController::class, 'index'])->name('login');
Route::get('admin/login', [AdminController::class, 'index']);
Route::post('admin/login', [AdminController::class, 'login']);
Route::get('admin/signout', [AdminController::class, 'SignOut'])->name('signout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'Index'])->name('admin');
        Route::get('main', [AdminController::class, 'Index']);
        Route::prefix('employee')->group(function () {
            Route::get('/', [EmployeeController::class, 'Index'])->name('employee');
            Route::get('/search', [EmployeeController::class, 'Index'])->name('searchemployee');
            Route::get('add', [EmployeeController::class, 'Create'])->name('addemployee');
            Route::post('add', [EmployeeController::class, 'Save'])->name('saveemployee');
            Route::get('/edit/{EmployeeId}', [EmployeeController::class, 'Edit'])->name('editemployee');
            Route::get('/delete/{EmployeeId}', [EmployeeController::class, 'showDeleteForm'])->name('deleteemployee');
            Route::post('/delete/{EmployeeId}', [EmployeeController::class, 'delete'])->name('deleteemployee.post');
        });

        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'Index'])->name('category');
            Route::get('/search', [CategoryController::class, 'Index'])->name('searchcategory');
            Route::get('add', [CategoryController::class, 'Create'])->name('addcategory');
            Route::post('add', [CategoryController::class, 'Save'])->name('savecategory');
            Route::get('/edit/{CategoryId}', [CategoryController::class, 'Edit'])->name('editcategory');
            Route::get('/delete/{CategoryId}', [CategoryController::class, 'showDeleteForm'])->name('deletecategory');
            Route::post('/delete/{CategoryId}', [CategoryController::class, 'delete'])->name('deletecategory.post');
        });

        Route::prefix('customer')->group(function () {
            Route::get('/', [CustomerController::class, 'Index'])->name('customer');
            Route::get('/search', [CustomerController::class, 'Index'])->name('searchcustomer');
            Route::get('add', [CustomerController::class, 'Create'])->name('addcustomer');
            Route::post('add', [CustomerController::class, 'Save'])->name('savecustomer');
            Route::get('/edit/{CustomerId}', [CustomerController::class, 'Edit'])->name('editcustomer');
            Route::get('/delete/{CustomerId}', [CustomerController::class, 'showDeleteForm'])->name('deletecustomer');
            Route::post('/delete/{CustomerId}', [CustomerController::class, 'delete'])->name('deletecustomer.post');
        });

        Route::prefix('store')->group(function () {
            Route::get('/', [StoreController::class, 'Index'])->name('store');
            Route::get('/search', [StoreController::class, 'Index'])->name('searchstore');
            Route::get('add', [StoreController::class, 'Create'])->name('addstore');
            Route::post('add', [StoreController::class, 'Save'])->name('savestore');
            Route::get('/edit/{StoreId}', [StoreController::class, 'Edit'])->name('editstore');
            Route::get('/delete/{StoreId}', [StoreController::class, 'showDeleteForm'])->name('deletestore');
            Route::post('/delete/{StoreId}', [StoreController::class, 'delete'])->name('deletestore.post');
        });

        Route::prefix('color')->group(function () {
            Route::get('/', [ColorController::class, 'Index'])->name('color');
            Route::get('/search', [ColorController::class, 'Index'])->name('searchcolor');
            Route::get('add', [ColorController::class, 'Create'])->name('addcolor');
            Route::post('add', [ColorController::class, 'Save'])->name('savecolor');
            Route::get('/edit/{ColorId}', [ColorController::class, 'Edit'])->name('editcolor');
            Route::get('/delete/{ColorId}', [ColorController::class, 'showDeleteForm'])->name('deletecolor');
            Route::post('/delete/{ColorId}', [ColorController::class, 'delete'])->name('deletecolor.post');
        });

        Route::prefix('size')->group(function () {
            Route::get('/', [SizeController::class, 'Index'])->name('size');
            Route::get('/search', [SizeController::class, 'Index'])->name('searchsize');
            Route::get('add', [SizeController::class, 'Create'])->name('addsize');
            Route::post('add', [SizeController::class, 'Save'])->name('savesize');
            Route::get('/edit/{SizeId}', [SizeController::class, 'Edit'])->name('editsize');
            Route::get('/delete/{SizeId}', [SizeController::class, 'showDeleteForm'])->name('deletesize');
            Route::post('/delete/{SizeId}', [SizeController::class, 'delete'])->name('deletecolor.post');
        });

        Route::prefix('tag')->group(function () {
            Route::get('/', [TagController::class, 'Index'])->name('tag');
            Route::get('/search', [TagController::class, 'Index'])->name('searchtag');
            Route::get('add', [TagController::class, 'Create'])->name('addtag');
            Route::post('add', [TagController::class, 'Save'])->name('savetag');
            Route::get('/edit/{TagId}', [TagController::class, 'Edit'])->name('edittag');
            Route::get('/delete/{TagId}', [TagController::class, 'showDeleteForm'])->name('deletetag');
            Route::post('/delete/{TagId}', [TagController::class, 'delete'])->name('deletecolor.post');
        });

        Route::prefix('saleoff')->group(function () {
            Route::get('/', [SaleoffController::class, 'Index'])->name('saleoff');
            Route::get('/search', [SaleoffController::class, 'Index'])->name('searchsaleoff');
            Route::get('add', [SaleoffController::class, 'Create'])->name('addsaleoff');
            Route::post('add', [SaleoffController::class, 'Save'])->name('savesaleoff');
            Route::get('/edit/{SaleOffId}', [SaleoffController::class, 'Edit'])->name('editsaleoff');
            Route::get('/delete/{SaleOffId}', [SaleoffController::class, 'showDeleteForm'])->name('deletesaleoff');
            Route::post('/delete/{SaleOffId}', [SaleoffController::class, 'delete'])->name('deletesaleoff.post');
        });

        Route::prefix('product')->group(function () {
            Route::get('/', [ProductController::class, 'Index'])->name('product');
            Route::get('/search', [ProductController::class, 'Index'])->name('searchproduct');
            Route::get('add', [ProductController::class, 'Create'])->name('addproduct');
            Route::post('add', [ProductController::class, 'Save'])->name('saveproduct');
            Route::get('/edit/{ProductId}', [ProductController::class, 'Edit'])->name('editproduct');
            Route::get('/delete/{ProductId}', [ProductController::class, 'showDeleteForm'])->name('deleteproduct');
            Route::post('/delete/{ProductId}', [ProductController::class, 'delete'])->name('deleteproduct.post');
            Route::get('/edit/addcolor/{ProductId}/{method}/{ColorId}', [ProductController::class, 'Color'])->name('addcolorproduct');
            Route::post('/edit/addcolor/save', [ProductController::class, 'SaveColor'])->name('savecolorproduct');
            Route::get('/edit/deletecolor/{ProductId}/{method}/{ColorId}', [ProductController::class, 'Color'])->name('deletecolorproduct');

            Route::get('/edit/addsize/{ProductId}/{method}/{SizeId}', [ProductController::class, 'Size'])->name('addsizeproduct');
            Route::post('/edit/addsize/save', [ProductController::class, 'SaveSize'])->name('savesizeproduct');
            Route::get('/edit/deletesize/{ProductId}/{method}/{SizeId}', [ProductController::class, 'Size'])->name('deletesizeproduct');

            Route::get('/edit/addsaleoff/{ProductId}/{method}/{SaleOffId}', [ProductController::class, 'Saleoff'])->name('addsaleoffproduct');
            Route::post('/edit/addsaleoff/save', [ProductController::class, 'SaveSaleoff'])->name('savesaleoffproduct');
            Route::get('/edit/deletesaleoff/{ProductId}/{method}/{SaleOffId}', [ProductController::class, 'Saleoff'])->name('deletesaleoffproduct');

            Route::get('/edit/addtag/{ProductId}/{method}/{TagId}', [ProductController::class, 'Tag'])->name('addtagproduct');
            Route::post('/edit/addtag/save', [ProductController::class, 'SaveTag'])->name('savetagproduct');
            Route::get('/edit/deletetag/{ProductId}/{method}/{TagId}', [ProductController::class, 'Tag'])->name('deletetagproduct');

            Route::get('/edit/addphoto/{ProductId}/{method}/{PhotoId}', [ProductController::class, 'Photo'])->name('addphotoproduct');
            Route::post('/edit/addphoto/save', [ProductController::class, 'SavePhoto'])->name('savephotoproduct');
            Route::get('/edit/deletephoto/{ProductId}/{method}/{PhotoId}', [ProductController::class, 'Photo'])->name('deletephotoproduct');
        });

        Route::prefix('shipper')->group(function () {
            Route::get('/', [ShipperController::class, 'Index'])->name('shipper');
            Route::get('/search', [ShipperController::class, 'Index'])->name('searchshipper');
            Route::get('add', [ShipperController::class, 'Create'])->name('addshipper');
            Route::post('add', [ShipperController::class, 'Save'])->name('saveshipper');
            Route::get('/edit/{ShipperId}', [ShipperController::class, 'Edit'])->name('editshipper');
            Route::get('/delete/{ShipperId}', [ShipperController::class, 'showDeleteForm'])->name('deleteshipper');
            Route::post('/delete/{ShipperId}', [ShipperController::class, 'delete'])->name('deleteshipper.post');
        });

        Route::prefix('order')->group(function () {
            Route::get('/', [OrderController::class, 'Index'])->name('order');
            Route::get('/search', [OrderController::class, 'Index'])->name('searchorder');
            Route::get('/orderdetail/{OrderId}', [OrderController::class, 'Detail'])->name('orderdetail');
            Route::get('/orderdetail/accept/{OrderId}', [OrderController::class, 'Accept'])->name('accept');
            Route::get('/orderdetail/reject/{OrderId}', [OrderController::class, 'Reject'])->name('reject');
            Route::get('/orderdetail/finish/{OrderId}', [OrderController::class, 'Finish'])->name('finish');
            Route::get('/orderdetail/cancel/{OrderId}', [OrderController::class, 'Cancel'])->name('cancel');
            Route::post('/orderdetail/shipping', [OrderController::class, 'Shipping'])->name('shipping');
            Route::post('/orderdetail/changeaddress', [OrderController::class, 'Address'])->name('changeaddress');
            Route::get('/orderdetail/delete/{OrderId}', [OrderController::class, 'Delete'])->name('delete');
        });
    });
});
