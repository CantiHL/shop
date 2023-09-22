<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\StatisticalController;
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


Route::get('/auth/google',[GoogleAuthController::class,'redirect'])->name('google-auth');
Route::get('/auth/google/call-back',[GoogleAuthController::class,'callbackGoogle']);

Route::prefix('/pay/paypal')->group(function (){
    Route::post('/',[PaypalController::class,'checkout'])->name('pay');
    Route::get('/success',[PaypalController::class,'success'])->name('success');
    Route::get('/cancel',[PaypalController::class,'cancel'])->name('cancel');
});

Route::middleware('auth.middleware')->group(function (){
    Route::get('/admin',[AdminController::class,'index'])->name('dashboard');
    Route::prefix('/order')->group(function (){
        Route::get('/list-order',[OrderController::class,'order'])->name('order');
        Route::get('/statistical',[StatisticalController::class,'statistical'])->name('statistical');
        Route::get('/export-orders',[OrderController::class,'expportOrders'])->name('expport_orders');
        Route::get('/list-order/update-order',[OrderController::class,'update_order'])->name('update_order');
        Route::get('/list-order/delete-order',[OrderController::class,'delete_order'])->name('delete_order');
    });
    Route::prefix('/product')->group(function (){
        Route::get('/',[ProductController::class,'index'])->name('product_list');
        Route::get('/add',[ProductController::class,'add_form'])->name('add_product');
        Route::post('/add',[ProductController::class,'add_to_db']);
        Route::get('/edit/{id}',[ProductController::class,'update_form'])->name('edit_form_product');
        Route::post('/edit/{id}',[ProductController::class,'update_to_db']);
        Route::get('/delete/{id}',[ProductController::class,'delete_product'])->name('delete_product');
        Route::get('/update-status/{id}/{value}',[ProductController::class,'update_status_product'])->name('update_status_product');
        Route::post('/import',[ProductController::class,'import'])->name('import-product');
    });

    Route::prefix('/brand')->group(function (){
        Route::get('/',[BrandController::class,'index'])->name('brand_list');
        Route::get('/add',[BrandController::class,'add_form'])->name('add_brand');
        Route::post('/add',[BrandController::class,'add_to_db']);
        Route::get('/edit/{id}',[BrandController::class,'update_form'])->name('edit_form_brand');
        Route::post('/edit/{id}',[BrandController::class,'update_to_db']);
        Route::get('/delete/{id}',[BrandController::class,'delete_brand'])->name('delete_brand');
        Route::get('/update-status/{id}/{value}',[BrandController::class,'update_status_brand'])->name('update_status_brand');
    });
    Route::prefix('/category')->group(function (){
        Route::get('/',[CategoryController::class,'index'])->name('category_list');
        Route::get('/add',[CategoryController::class,'add_form'])->name('add_category');
        Route::post('/add',[CategoryController::class,'add_to_db']);
        Route::get('/edit/{id}',[CategoryController::class,'update_form'])->name('edit_form_category');
        Route::post('/edit/{id}',[CategoryController::class,'update_to_db']);
        Route::get('/delete/{id}',[CategoryController::class,'delete_category'])->name('delete_category');
        Route::get('/update-status-category/{id}/{value}',[CategoryController::class,'update_status_category'])->name('update_status_category');
    });
    Route::prefix('/user')->group(function (){
        Route::get('/list',[UserController::class,'userInfo'])->name('user_list');
        Route::get('/add',[UserController::class,'add_form'])->name('add_user');
        Route::post('/add',[UserController::class,'add_to_db']);
        Route::get('/edit/{id}',[UserController::class,'update_form'])->name('edit_form_user');
        Route::post('/edit/{id}',[UserController::class,'update_to_db']);
        Route::get('/delete/{id}',[UserController::class,'delete_category'])->name('delete_user');
    });
});

Route::prefix('/cart')->group(function (){
    Route::get('/',[CartController::class,'index'])->name('cart');
    Route::post('/update_item',[CartController::class,'update_cart_item'])->name('update_cart_item');
    Route::get('/add/{id}',[CartController::class,'add_to_cart'])->name('add_to_cart');
    Route::get('/delete_item',[CartController::class,'delete_item_cart'])->name('delete_item_cart');

});

Route::prefix('/auth')->group(function (){
    Route::get('/login',[AuthController::class,'login'])->name('login');
    Route::post('/user/register',[AuthController::class,'register'])->name('register');
    Route::post('/check',[AuthController::class,'check'])->name('checkuser');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
});

Route::middleware('idcheck')->group(function (){
    Route::get('/account/detail',[UserController::class,'account'])->name('user_account');
    Route::post('/account/upadtepasword',[UserController::class,'updatePassword'])->name('upadtepasword');
    Route::post('/account/update',[UserController::class,'update_account'])->name('update_account');
    Route::post('/account/update-order',[OrderController::class,'updateOrderQuantity'])->name('updateOrderQuantity');
});

Route::get('/',[HomeController::class,'index'])->name('client_home');
Route::get('/search',[HomeController::class,'index'])->name('search');
Route::post('/review',[ReviewController::class,'review'])->name('review');
Route::post('/checkout',[CheckoutController::class,'checkout'])->name('checkout');
Route::get('/product-detail/{id}',[ProductController::class,'product_detail'])->name('product_detail');
Route::get('/sendemail',[UserController::class,'sendemail']);
