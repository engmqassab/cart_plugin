<?php

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

        Route::get('/', 'IndexController@index')->name('home');
        Route::get('/cart', 'CartController@index')->name('cart');
        Route::post('/cart', 'CartController@store')->name('cart.store');
        Route::delete('/cart', 'CartController@destroy')->name('cart.destroy');
        Route::patch('/cart', 'CartController@update')->name('cart.update');
        Route::delete('/cart/{id}', 'CartController@deleteItem')->name('cart.deleteItem');
        Route::POST('/cart/applyCoupon', 'CartController@applyCoupon')->name('cart.applyCoupon');
        
        
        Route::post('/checkout', 'CheckoutController@store')->name('checkout');
        Route::get('/orders', 'OrdersController@index')->name('orders.index');
    Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.',
], function() {
    // Route::resource('/products', 'ProductsController');
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/products', 'ProductsController');
    Route::resource('/coupons', 'CouponsController');
    



});
// Route::get('/', function () {
//     return view('welcome');
// });
