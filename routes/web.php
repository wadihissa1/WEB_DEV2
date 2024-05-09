<?php

use App\Http\Controllers\BidController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
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
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
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

// Basic routes
Route::get('/', fn() => view('account'))->name('account'); // Show account view
Route::get("index", [WebsiteController::class, 'getindex'])->name('index'); // Show index view
Route::get("account", [WebsiteController::class, 'getaccount'])->name('account'); // Show account view
Route::get("cart", [WebsiteController::class, 'getcart'])->name('cart'); // Show cart view
Route::get("product/{id}", [WebsiteController::class, 'getproduct'])->name('product'); // Show product details
Route::get("product_details/{id}", [WebsiteController::class, 'getproduct_details'])->name('product_details'); // Show product details
Route::post('/login', [LoginController::class, 'login'])->name('login'); // Process login form submission
Route::post('/register', [RegisterController::class, 'register'])->name('register'); // Process registration form submission
Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth/google'); // Redirect to Google OAuth
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback'])->name('auth/google/callback'); // Handle Google OAuth callback
Route::get('/profile/{userId}/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Show profile edit form
Route::put('/profile/{userId}/update', [ProfileController::class, 'update'])->name('profile.update'); // Process profile update form submission
Route::get("profile", [WebsiteController::class, 'getprofile'])->name('profile'); // Show user profile

// Email verification route
Route::get('verify/email/{token}', [VerificationController::class, 'verifyEmail'])->name('email.verify'); // Verify email address

// Choose action route
Route::get('/chooseaction/{id}', [ChooseActionController::class, 'index'])->name('chooseaction'); // Show choose action page

//botman
Route::match(['get','post'],'/botman', 'App\Http\Controllers\BotManController@handle');


// Follow/unfollow routes
Route::post('store/{store}/follow', [FollowController::class, 'follow'])->name('users.follow'); // Follow a store
Route::post('store/{store}/unfollow', [FollowController::class, 'unfollow'])->name('users.unfollow'); // Unfollow a store

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Store related routes
    Route::get('/viewallstores', [StoreController::class, 'viewAllStores'])->name('viewallstores'); // Show all stores
    Route::get('/createstore/{id}', [StoreController::class, 'create'])->name('createstore'); // Show store creation form
    Route::post('/store', [StoreController::class, 'store'])->name('stores.store'); // Process store creation form submission
    Route::get('/viewstore/{store}', [StoreController::class, 'show'])->name('viewstore'); // Show store details
    Route::get('/editstore/{storeId}', [StoreController::class, 'edit'])->name('editstore'); // Show store edit form
    Route::put('/updatestore/{storeId}', [StoreController::class, 'update'])->name('updatestore'); // Process store edit form submission
    Route::delete('/deletestore/{storeId}', [StoreController::class, 'destroy'])->name('deletestore'); // Delete store
    // Product related routes
    Route::get('/createproduct/{storeId}', [ProductController::class, 'create'])->name('createproduct'); // Show product creation form
    Route::post('/storeproduct', [ProductController::class, 'store'])->name('storeproduct'); // Process product creation form submission
    Route::get('/viewproducts/{storeId}', [ProductController::class, 'viewProducts'])->name('viewproducts'); // Show all products of a store
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit'); // Show product edit form
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update'); // Process product edit form submission
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy'); // Delete product
    // Review submission route
    Route::post('/submitreview', [ReviewController::class, 'submitReview'])->name('submitreview'); // Submit a review
    // View pending requests route
    Route::get('/view-pending-requests', [StoreController::class, 'viewPendingRequests'])->name('viewpendingrequests'); // Show pending store requests
});

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index'); // Show admin dashboard
    Route::post('/approve/{storeRequest}', [AdminController::class, 'approveRequest'])->name('admin.approveRequest'); // Approve store request
    Route::post('/reject/{storeRequest}', [AdminController::class, 'rejectRequest'])->name('admin.rejectRequest'); // Reject store request
    Route::get('/viewcategories', [AdminController::class, 'viewCategories'])->name('admin.viewcategories'); // Show all categories (admin)
});



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
  Route::post('/submitreview', [ReviewController::class, 'submitReview'])->name('submitreview');
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
   Route::get('/admin-dashboard', [AdminController::class,"index"])->name('admin.dashboard');
   //Route::post('/admin/activate-store/{store}', [AdminController::class,'activateStore'])->name('admin.activateStore');
  /// Route::post('/admin/deactivate-store/{store}', [AdminController::class,'deactivateStore'])->name('admin.deactivateStore');
  // Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
  Route::post('/admin/activate-store/{storeId}', [StoreController::class, 'activateStore'])->name('admin.activateStore');

  // Route for deactivating a store
  Route::post('/admin/deactivate-store/{storeId}', [StoreController::class, 'deactivateStore'])->name('admin.deactivateStore');


//Route::post('/store/product', [ProductController::class, 'store'])->name('store.product');

Route::get('/createstore/{id}', [StoreController::class, 'create'])->name('createstore'); // Updated route name

Route::post('/store', [StoreController::class, 'store'])->name('stores.store');

//tell wadih about the change from view to show
Route::get('/viewstore/{store}', [StoreController::class, 'show'])->name('viewstore');
Route::get('/viewstore/{store}', [StoreController::class, 'view'])->name('viewstore');



// Route to view all stores for the current user
Route::get('/viewallstores/{id}', [StoreController::class, 'viewAllStores'])->name('viewallstores');
Route::get('/createproduct/{storeId}', [ProductController::class, 'create'])->name('createproduct');
Route::post('/storeproduct', [ProductController::class, 'store'])->name('storeproduct');
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

//Route for follows
Route::post('store/{store}/follow', [FollowController::class,'follow'])->middleware('auth')->name('users.follow');

Route::post('store/{store}/unfollow', [FollowController::class,'unfollow'])->middleware('auth')->name('users.unfollow');

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

//Events and bid routes
Route::post('/bids/store', 'BidController@store')->name('bids.store');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events/store', [EventController::class, 'store'])->name('events.store');
Route::get('/stores/{storeId}/events', [EventController::class, 'viewEvents'])->name('viewevents');
Route::get('/events/{eventId}/store/{storeId}/products', [EventController::class, 'viewEventProducts'])->name('vieweventproducts');
Route::post('/events/{eventId}/store/{storeId}/products/{productId}', [EventController::class, 'addEventProduct'])->name('addeventproduct');
Route::get('/events/{eventId}/products', [BidController::class, 'showEventProducts'])->name('event.products');
Route::get('/events', [EventController::class, 'buyerEvents'])->name('event.buyereventshow');
Route::get('/events/{eventId}', [EventController::class, 'eventDetails'])->name('event.details');
Route::post('/place-bid', [BidController::class, 'store'])->name('place.bid')->middleware('auth');
Route::put('/events/{eventId}/close', [EventController::class, 'closeEvent'])->name('closeevent');
// Category routes
Route::get('/createcategory', [CategoryController::class, 'create'])->name('createcategory'); // Show category creation form
Route::post('/storecategory', [CategoryController::class, 'store'])->name('storecategory'); // Process category creation form submission
Route::get('/viewcategories', [AdminController::class, 'viewCategories'])->name('viewcategories'); // Show all categories

//forget password routes
Route::get('/forgot-password', [ForgotPasswordController::class,'showForgotPasswordForm'])->name('forgot.password.form');
Route::post('/forgot-password', [ForgotPasswordController::class,'sendPasswordResetLink'])->name('forgot.password.send');
Route::get('/reset-password/{token}', [ResetPasswordController::class,'showResetPasswordForm'])->name('reset.password.form');
Route::post('/reset-password', [ResetPasswordController::class,'resetPassword'])->name('reset.password');
Route::get('/reset-your-password', [LoginController::class,'showForgotPasswordForm'])->name('forgot.password');

//github sign in
Route::get('/login/github', [LoginController::class,'redirectToGitHub'])->name('login.github');
Route::get('/login/github/callback', [LoginController::class,'handleGitHubCallback']);
