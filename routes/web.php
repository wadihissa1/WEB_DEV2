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

Route::get("home",'App\Http\Controllers\WebsiteController@getindex');
Route::get("account",'App\Http\Controllers\WebsiteController@getaccount');
Route::get("cart",'App\Http\Controllers\WebsiteController@getcart');
Route::get("product",'App\Http\Controllers\WebsiteController@getproduct');
Route::get("product_details",'App\Http\Controllers\WebsiteController@getproduct_details');



