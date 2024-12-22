<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\OrderController;



Route::group(['prefix' => 'user'],function(){
    Route::get('/',[UserController::class,'index'])->name('user-dashboard');

    Route::group(['prefix' => 'order'],function(){
        Route::get('/',[OrderController::class,'index'])->name('user-order-index');
        Route::get('/{id}',[OrderController::class,'detail'])->name('user-order-detail');
    });
});