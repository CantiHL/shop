<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
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
use Laravel\Socialite\Facades\Socialite;

Route::get('/sendemail',[UserController::class,'sendemail']);

Route::middleware('auth.middleware')->group(function (){
    Route::prefix('/admin')->group(function (){
        Route::get('/',[AdminController::class,'index'])->name('dashboard');
        Route::get('/list-order',[AdminController::class,'order'])->name('order');
        Route::get('/list-order/update-order',[AdminController::class,'update_order'])->name('update_order');
        Route::get('/list-order/delete-order',[AdminController::class,'delete_order'])->name('delete_order');
    });
});

//product
Route::get('/product',[ProductController::class,'index'])->name('product_list');
Route::get('/add-product',[ProductController::class,'add_form'])->name('add_product');
Route::post('/add-product',[ProductController::class,'add_to_db']);
Route::get('/edit-product/{id}',[ProductController::class,'update_form'])->name('edit_form_product');
Route::post('/edit-product/{id}',[ProductController::class,'update_to_db']);
Route::get('/delete-product/{id}',[ProductController::class,'delete_product'])->name('delete_product');
Route::get('/update-status-product/{id}/{value}',[ProductController::class,'update_status_product'])->name('update_status_product');
Route::get('/product-detail/{id}',[ProductController::class,'product_detail'])->name('product_detail');

//brand
Route::get('/brand',[BrandController::class,'index'])->name('brand_list');
Route::get('/add-brand',[BrandController::class,'add_form'])->name('add_brand');
Route::post('/add-brand',[BrandController::class,'add_to_db']);
Route::get('/edit-brand/{id}',[BrandController::class,'update_form'])->name('edit_form_brand');
Route::post('/edit-brand/{id}',[BrandController::class,'update_to_db']);
Route::get('/delete-brand/{id}',[BrandController::class,'delete_brand'])->name('delete_brand');
Route::get('/update-status-brand/{id}/{value}',[BrandController::class,'update_status_brand'])->name('update_status_brand');

//category
Route::get('/category',[CategoryController::class,'index'])->name('category_list');
Route::get('/add-category',[CategoryController::class,'add_form'])->name('add_category');
Route::post('/add-category',[CategoryController::class,'add_to_db']);
Route::get('/edit-category/{id}',[CategoryController::class,'update_form'])->name('edit_form_category');
Route::post('/edit-category/{id}',[CategoryController::class,'update_to_db']);
Route::get('/delete-category/{id}',[CategoryController::class,'delete_category'])->name('delete_category');
Route::get('/update-status-category/{id}/{value}',[CategoryController::class,'update_status_category'])->name('update_status_category');

//user
Route::get('/login',[UserController::class,'login'])->name('login');
Route::post('/user/register',[UserController::class,'register'])->name('register');
Route::post('/check',[UserController::class,'check'])->name('checkuser');
Route::get('/user/logout',[UserController::class,'logout'])->name('logout');
Route::get('/home-page',[UserController::class,'index'])->name('client_home');
Route::get('/account/{id}',[UserController::class,'account'])->name('account');
Route::get('/search',[UserController::class,'index'])->name('search');
Route::post('/comment',[UserController::class,'comment'])->name('comment');
Route::post('/checkout',[UserController::class,'checkout'])->name('checkout');


//cart
Route::get('/cart',[CartController::class,'index'])->name('cart');
Route::post('/update_cart_item',[CartController::class,'update_cart_item'])->name('update_cart_item');
Route::get('/add-to-cart/{id}',[CartController::class,'add_to_cart'])->name('add_to_cart');
Route::get('/delete_item_cart',[CartController::class,'delete_item_cart'])->name('delete_item_cart');
