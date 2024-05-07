<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ChooseActionController;
use App\Http\Controllers\VerificationController;


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

//Route::get('/viewallstores/{id}', [StoreController::class, 'viewAllStores'])->name('viewallstores');
//Route::get('/createstore/{id}', [StoreController::class, 'create'])->name('createstore');

//Route for follows
Route::post('store/{store}/follow', [FollowController::class,'follow'])->middleware('auth')->name('users.follow');

Route::post('store/{store}/unfollow', [FollowController::class,'unfollow'])->middleware('auth')->name('users.unfollow');

    
Route::get('/createstore/{id}', [StoreController::class, 'create'])->name('createstore'); // Updated route name
//Route::get('/viewallstores/{id}', [StoreController::class, 'viewAllStores'])->name('viewallstores');
Route::post('/store', [StoreController::class, 'store'])->name('stores.store');
    Route::get('/viewstore/{store}', [StoreController::class, 'view'])->name('viewstore');
    

    // Route to view all stores for the current user
  Route::get('/viewallstores/{id}', [StoreController::class, 'viewAllStores'])->name('viewallstores');
  Route::get('/editstore/{storeId}', [StoreController::class, 'edit'])->name('editstore');
Route::put('/updatestore/{storeId}', [StoreController::class, 'update'])->name('updatestore');
Route::delete('/deletestore/{storeId}', [StoreController::class, 'destroy'])->name('deletestore');

  Route::get('/createproduct/{storeId}', [ProductController::class, 'create'])->name('createproduct');
  Route::post('/storeproduct', [ProductController::class, 'store'])->name('storeproduct');
  
  Route::get('/viewproducts/{storeId}', [ProductController::class, 'viewProducts'])->name('viewproducts');
  Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
//   Route::post('/submitreview', [ReviewController::class, 'submitReview'])->name('submitreview');
  Route::get('/view-pending-requests', [StoreController::class, 'viewPendingRequests'])->name('viewpendingrequests');

  //Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
  Route::get('/products/{id}/edit',[ProductController::class,'edit'])->name('products.edit');
 //Route::put('/products/{id}', [ProductController::class, "update"])->name('products.update');

 // Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
  Route::get('/stores/{storeId}', [StoreController::class, 'show'])->name('stores.show');
 
  Route::get('/products', [ProductController::class, 'index'])->name('products.index');

 // Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
  Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
  //Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
  

 // Route::post('/submitreview', [ReviewController::class, 'submitReview'])->name('submitreview');
  
  // Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    // Route::post('/admin/approve/{store}', [AdminController::class, 'approve'])->name('admin.approve');
    // Route::post('/admin/reject/{store}', [AdminController::class, 'reject'])->name('admin.reject');
      
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/approve/{storeRequest}', [AdminController::class, 'approveRequest'])->name('admin.approveRequest');
    Route::post('/admin/reject/{storeRequest}', [AdminController::class, 'rejectRequest'])->name('admin.rejectRequest');

    Route::get('/createcategory', [CategoryController::class, 'create'])->name('createcategory');
    Route::post('/storecategory', [CategoryController::class, 'store'])->name('storecategory');
   
    Route::get('/admin/viewcategories', [AdminController::class, 'viewCategories'])->name('admin.viewcategories');
     // Route::get('/createcategory', [CategoryController::class, 'create'])->name('createcategory');
   Route::get('/viewcategories', [AdminController::class, 'viewCategories'])->name('viewcategories');
   


//Route::post('/store/product', [ProductController::class, 'store'])->name('store.product');

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