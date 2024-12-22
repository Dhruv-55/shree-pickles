<?php

use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\ProductController;
use App\Http\Controllers\Website\AuthController;
use App\Http\Controllers\Website\WebsiteController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\CheckoutController;
use App\Http\Controllers\Admin\ProductDetailController;
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

Route::get('/', [HomeController::class,'home'])->name('website-home');

Route::prefix('product')->group(function () {
    Route::get('/{category?}',[ProductController::class,'index'])->name('website-product-view');
    Route::get('/detail/{slug}',[ProductController::class,'detail'])->name('website-product-detail');
});

Route::get('/about',[WebsiteController::class,'about'])->name('website-about');
Route::get('/contact',[WebsiteController::class,'contact'])->name('website-contact');
Route::prefix('auth')->group(function () {
    Route::match(['get','post'],'/register',[AuthController::class,'register'])->name('website-auth-register');
    Route::match(['get','post'],'/login',[AuthController::class,'login'])->name('website-auth-login');
    Route::get('/logout',[AuthController::class,'logout'])->name('website-auth-logout');
});


Route::get('/cart',[CartController::class,'index'])->name('website-cart');
// Route::get('/wishlist',[WishlistController::class,'index'])->name('website-wishlist');
Route::match(['get','post'],'/checkout',[CheckoutController::class,'index'])->name('website-checkout');
Route::get('/order/success',[CheckoutController::class,'success'])->name('website-order-success');
