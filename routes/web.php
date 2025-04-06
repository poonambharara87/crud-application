<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\BrandController;
Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register_store'])->name('register-store');

Route::get('/login',[AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_store'])->name('login-store');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/bootstrap', function(){
    return view('admin.projects.index');
});


Route::group(['middleware' => 'web'], function () {
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
    Route::resource('brands', BrandController::class);

});


