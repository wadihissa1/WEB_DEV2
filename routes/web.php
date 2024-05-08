<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ChooseActionController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\ReviewController;


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

// Route for the home page
Route::get('/', function () {
  return view('account');
});

// Route for showing the index view
Route::get("index", [WebsiteController::class, 'getindex'])->name('index');

// Route for account page
Route::get("account", 'App\Http\Controllers\WebsiteController@getaccount')->name('account');

// Route for cart page
Route::get("cart", 'App\Http\Controllers\WebsiteController@getcart')->name('cart');



// Route for user login
Route::post('/login', 'App\Http\Controllers\LoginController@login')->name('login');

// Route for user registration
Route::post('/register', 'App\Http\Controllers\RegisterController@register');

// Route for Google authentication
Route::get('auth/google', 'App\Http\Controllers\LoginController@redirectToGoogle')->name('auth/google');
Route::get('auth/google/callback', 'App\Http\Controllers\LoginController@handleGoogleCallback')->name('auth/google/callback');

// Routes for user profile
Route::get('/profile/{userId}/edit', 'App\Http\Controllers\ProfileController@edit')->name('profile.edit');
Route::put('/profile/{userId}/update', 'App\Http\Controllers\ProfileController@update')->name('profile.update');
Route::get("profile", 'App\Http\Controllers\WebsiteController@getprofile')->name('profile');

// Route for email verification
Route::get('verify/email/{token}', 'App\Http\Controllers\VerificationController@verifyEmail')->name('email.verify');

// Route for choosing action
Route::get('/chooseaction/{id}', [ChooseActionController::class, 'index'])->name('chooseaction');

// Routes for store management
Route::get('/createstore/{id}', [StoreController::class, 'create'])->name('createstore');
Route::post('/store', [StoreController::class, 'store'])->name('stores.store');
Route::get('/viewstore/{store}', [StoreController::class, 'showstore'])->name('viewstore');
Route::get('/viewallstores/{id}', [StoreController::class, 'viewAllStores'])->name('viewallstores');
Route::get('/editstore/{storeId}', [StoreController::class, 'edit'])->name('editstore');
Route::put('/updatestore/{storeId}', [StoreController::class, 'update'])->name('updatestore');
Route::delete('/deletestore/{storeId}', [StoreController::class, 'destroy'])->name('deletestore');

// Routes for product management
Route::get('/createproduct/{storeId}', [ProductController::class, 'create'])->name('createproduct');
Route::post('/storeproduct', [ProductController::class, 'store'])->name('storeproduct');
Route::get('/viewproducts/{storeId}', [ProductController::class, 'viewProducts'])->name('viewproducts');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

// Route for getting product details view
Route::get('/product_details/{id}', 'ProductController@show')->name('product_details');

// Route for getting product list
Route::get('product/{id}', 'App\Http\Controllers\WebsiteController@getproduct')->name('product');

// Route for viewing pending requests in admin panel
Route::get('/view-pending-requests', [StoreController::class, 'viewPendingRequests'])->name('viewpendingrequests');

// Routes for admin actions
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin/approve/{storeRequest}', [AdminController::class, 'approveRequest'])->name('admin.approveRequest');
Route::post('/admin/reject/{storeRequest}', [AdminController::class, 'rejectRequest'])->name('admin.rejectRequest');

// Routes for category management
Route::get('/createcategory', [CategoryController::class, 'create'])->name('createcategory');
Route::post('/storecategory', [CategoryController::class, 'store'])->name('storecategory');
Route::get('/admin/viewcategories', [AdminController::class, 'viewCategories'])->name('admin.viewcategories');
Route::get('/viewcategories', [AdminController::class, 'viewCategories'])->name('viewcategories');

// Routes for user follows
Route::post('store/{store}/follow', [FollowController::class, 'follow'])->middleware('auth')->name('users.follow');
Route::post('store/{store}/unfollow', [FollowController::class, 'unfollow'])->middleware('auth')->name('users.unfollow');
