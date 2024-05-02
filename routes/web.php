<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ChooseActionController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WebsiteController;

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
    return view('account');
});


//show index view
Route::get("index", [WebsiteController::class, 'getindex'])->name('index');


Route::get("account", 'App\Http\Controllers\WebsiteController@getaccount')->name('account');


Route::get("cart", 'App\Http\Controllers\WebsiteController@getcart')->name('cart');


Route::get("product/{id}", 'App\Http\Controllers\WebsiteController@getproduct')->name('product');


Route::get("product_details", 'App\Http\Controllers\WebsiteController@getproduct_details')->name('product_details');


Route::post('/login', 'App\Http\Controllers\LoginController@login')->name('login');


Route::post('/register', 'App\Http\Controllers\RegisterController@register');


Route::get('auth/google', 'App\Http\Controllers\LoginController@redirectToGoogle')->name('auth/google');


Route::get('auth/google/callback', 'App\Http\Controllers\LoginController@handleGoogleCallback')->name('auth/google/callback');


Route::get('/profile/{userId}/edit', 'App\Http\Controllers\ProfileController@edit')->name('profile.edit');


Route::put('/profile/{userId}/update', 'App\Http\Controllers\ProfileController@update')->name('profile.update');


Route::get("profile", 'App\Http\Controllers\WebsiteController@getprofile')->name('profile');


Route::get('verify/email/{token}', 'App\Http\Controllers\VerificationController@verifyEmail')->name('email.verify');


//Route::get('/chooseaction', [VerificationController::class, 'verifyEmail'])->name('chooseaction');
Route::get('/chooseaction/{id}', [ChooseActionController::class, 'index'])->name('chooseaction');


Route::get('/createstore/{id}', [StoreController::class, 'create'])->name('createstore'); // Updated route name

Route::post('/store', [StoreController::class, 'store'])->name('stores.store');

//tell wadih about the change from view to show
Route::get('/viewstore/{store}', [StoreController::class, 'show'])->name('viewstore');


// Route to view all stores for the current user
Route::get('/viewallstores', [StoreController::class, 'viewAllStores'])->name('viewallstores');



// Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
// Route::post('/admin/approve/{store}', [AdminController::class, 'approve'])->name('admin.approve');
// Route::post('/admin/reject/{store}', [AdminController::class, 'reject'])->name('admin.reject');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin/approve/{storeRequest}', [AdminController::class, 'approveRequest'])->name('admin.approveRequest');
Route::post('/admin/reject/{storeRequest}', [AdminController::class, 'rejectRequest'])->name('admin.rejectRequest');
