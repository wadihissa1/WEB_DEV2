<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("index",'App\Http\Controllers\WebsiteController@getindex')->name('index');
Route::get("account",'App\Http\Controllers\WebsiteController@getaccount')->name('account');
Route::get("cart",'App\Http\Controllers\WebsiteController@getcart')->name('cart');
Route::get("product",'App\Http\Controllers\WebsiteController@getproduct')->name('product');
Route::get("product_details",'App\Http\Controllers\WebsiteController@getproduct_details')->name('product_details');
Route::post('/login', 'App\Http\Controllers\LoginController@login')->name('login');
Route::post('/register', 'App\Http\Controllers\RegisterController@register');
Route::get('auth/google', 'App\Http\Controllers\LoginController@redirectToGoogle')->name('auth/google');
Route::get('auth/google/callback', 'App\Http\Controllers\LoginController@handleGoogleCallback')->name('auth/google/callback');
Route::get('/profile/{userId}/edit', 'App\Http\Controllers\ProfileController@edit')->name('profile.edit');
Route::put('/profile/{userId}/update', 'App\Http\Controllers\ProfileController@update')->name('profile.update');
Route::put("profile",'App\Http\Controllers\WebsiteController@getprofile')->name('profile');


