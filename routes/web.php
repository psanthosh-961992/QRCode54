<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/list', 'ProductController@index')->name('product.index');
Route::post('/store', 'ProductController@store')->name('product.store');
Route::get('/getmaxcount/{id?}', 'ProductController@getmaxcount')->name('product.getmaxcount');
Route::get('/qrcode', 'ProductController@qrcode')->name('product.qrcode');
Route::get('/add-qty-by-qr-code', 'ProductController@addqtybyqrcode')->name('product.add-qty-by-qr-code');
