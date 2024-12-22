<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductDetailController;
use App\Http\Controllers\Admin\ProductVariationController;

Route::group(['prefix' => 'admin'],function(){
    Route::match(['get', 'post'], '/', [LoginController::class, 'login'])->name('admin-login');

    Route::get('/logout',[LoginController::class,'logout'])->name('admin-logout');

    Route::group(['middleware' => 'admin'],function(){
        Route::get('dashboard',[DashboardController::class,'index'])->name('admin-dashboard');

        Route::group(['prefix' => 'category'],function(){
            Route::get('/',[CategoryController::class,'index'])->name('admin-category-view');
            Route::match(['get','post'],'create',[CategoryController::class,'create'])->name('admin-category-create');
            Route::match(['get','post'],'update',[CategoryController::class,'update'])->name('admin-category-update');
            Route::get('view-child/{id}',[CategoryController::class,'viewChild'])->name('admin-category-view-child');
            Route::match(['get','post'],'child-create',[CategoryController::class,'childCreate'])->name('admin-category-child-create');
            Route::match(['get','post'],'child-update',[CategoryController::class,'childUpdate'])->name('admin-category-child-update');
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
            Route::get('/get-child-categories/{parentId}', [ProductController::class, 'getChildCategories']);
            Route::group(['prefix' => 'detail'], function() {
                Route::get('/{id}', [ProductDetailController::class, 'manage'])->name('admin-product-detail-manage');
                Route::post('/{id}', [ProductDetailController::class, 'manage'])->name('admin-product-detail-manage-post');
            });
            Route::group(['prefix' => 'variation'],function(){
                Route::get('/{id}',[ProductVariationController::class,'index'])->name('admin-product-variation-view');
                Route::match(['get','post'],'create/{id}',[ProductVariationController::class,'create'])->name('admin-product-variation-create');
                Route::match(['get','post'],'update/{id}',[ProductVariationController::class,'update'])->name('admin-product-variation-update');
                Route::get('/delete/{id}',[ProductVariationController::class,'delete'])->name('admin-product-variation-delete');
            });
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