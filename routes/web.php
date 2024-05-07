<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ChooseActionController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ReviewController;
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
Route::get("product_details", [WebsiteController::class, 'getproduct_details'])->name('product_details'); // Show product details
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

// Category routes
Route::get('/createcategory', [CategoryController::class, 'create'])->name('createcategory'); // Show category creation form
Route::post('/storecategory', [CategoryController::class, 'store'])->name('storecategory'); // Process category creation form submission
Route::get('/viewcategories', [AdminController::class, 'viewCategories'])->name('viewcategories'); // Show all categories
