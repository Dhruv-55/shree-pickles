<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\BannerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'],function(){
    Route::match(['get', 'post'], '/', [LoginController::class, 'login'])->name('admin-login');

    Route::get('/logout',[LoginController::class,'logout'])->name('admin-logout');

    Route::group(['middleware' => 'admin'],function(){
        Route::get('dashboard',[DashboardController::class,'index'])->name('admin-dashboard');

        Route::group(['prefix' => 'category'],function(){
            Route::get('/',[CategoryController::class,'index'])->name('admin-category-view');
            Route::match(['get','post'],'create',[CategoryController::class,'create'])->name('admin-category-create');
            Route::match(['get','post'],'update',[CategoryController::class,'update'])->name('admin-category-update');
        });

        Route::group(['prefix' => 'brand'],function(){
            Route::get('/',[BrandController::class,'index'])->name('admin-brand-view');
            Route::match(['get','post'],'create',[BrandController::class,'create'])->name('admin-brand-create');
            Route::match(['get','post'],'update',[BrandController::class,'update'])->name('admin-brand-update');
        });

        Route::group(['prefix' => 'product'],function(){
            Route::get('/',[ProductController::class,'index'])->name('admin-product-view');
            Route::match(['get','post'],'create',[ProductController::class,'create'])->name('admin-product-create');
            Route::match(['get','post'],'update',[ProductController::class,'update'])->name('admin-product-update');
            Route::post('/delete-image', [ProductController::class, 'deleteImage'])->name('admin-product-delete-image');

           
            Route::group(['prefix' => 'orders'],function(){
                Route::get('/',[OrderController::class,'index'])->name('admin-order-view');
                Route::get('/cancel',[OrderController::class,'cancel'])->name('admin-cancel-order-view');
                Route::match(['get','post'],'update',[OrderController::class,'update'])->name('admin-order-update');
            });

            Route::group(['prefix' => 'banner'],function(){
                Route::get('/',[BannerController::class,'index'])->name('admin-banner-view');
                Route::match(['get','post'],'create',[BannerController::class,'create'])->name('admin-banner-create');
                Route::match(['get','post'],'update',[BannerController::class,'update'])->name('admin-banner-update');
            });
        });
    });
});