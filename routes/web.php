<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\PostController;
Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register_store'])->name('register-store');

Route::get('/login',[AuthController::class, 'login'])->name('login');
Route::middleware('throttle:5,1')->group(function () {
    Route::post('/login', [AuthController::class, 'login_store'])->name('login-store');
});
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/bootstrap', function(){
    return view('admin.projects.index');
});

Route::get('/product-posts', [ProductController::class, 'getProductPost'])->name('product-posts');
Route::group(['middleware' => 'web'], function () {
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('posts', PostController::class);
});

Route::get('/product-view', [ProductController::class, 'view_product'])->name('product-view');
Route::get('/get-categories', [ProductController::class, 'getProductCategory'])->name('get-categories');

Route::get('/get-product-categories', [ProductController::class, 'getProductCategoryById'])->name('get-product-categories');


