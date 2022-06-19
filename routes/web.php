<?php

use App\Http\Controllers\GeneralController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [GeneralController::class, 'welcomeIndex']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['prefix' => '/'],function () {
    Route::get('home', [GeneralController::class, 'welcomeIndex']);
    Route::get('view-product-details/{product_id}', [GeneralController::class, 'viewProductDetails']);
    Route::get('add-to-cart/{product_id}', [GeneralController::class, 'addToCart']);
    Route::get('cart', [GeneralController::class, 'cart']);
    Route::get('delete-cart/{product_id}', [GeneralController::class, 'deleteCart']);
    Route::get('buy-now', [GeneralController::class, 'buyNow']);
});

Route::group(['middleware' => 'auth:vendor', 'prefix' => 'vendor'], function(){
    Route::get('dashboard', [VendorController::class, 'showDashboard'])->name('vendor.dashboard');
    Route::match(['get', 'post'], 'add-product', [VendorController::class, 'addProduct'])->name('vendor.add-product');
    Route::get('product-deactivate/{status}/{product_id}', [VendorController::class, 'changeProductStatus']);
});


require __DIR__.'/auth.php';
require __DIR__.'/vendorAuth.php';
