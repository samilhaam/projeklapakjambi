<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\ProductImageController;
use App\Models\Category;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| FRONTEND PUBLIC ROUTES (Bisa diakses tanpa login)
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/details/{product:slug}', [FrontController::class, 'details'])->name('front.details');
Route::get('/category/{category}', [FrontController::class, 'category'])->name('front.category');
Route::get('/search', [FrontController::class, 'search'])->name('front.search');
Route::get('/stories/{slug}', [StoryController::class, 'show'])->name('front.story.detail');
Route::get('/stories', [FrontController::class, 'stories'])->name('front.stories');
Route::view('/about', 'about')->name('front.about');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES (Login Diperlukan)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // 🔐 Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🛒 Checkout
    Route::get('/checkout/{product:slug}', [CheckoutController::class, 'checkout'])->name('front.checkout');
    Route::post('/checkout/store/{product:slug}', [CheckoutController::class, 'store'])->name('front.checkout.store');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    
    // User Management
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users.index');
    Route::get('/users/{user}', [App\Http\Controllers\AdminController::class, 'userShow'])->name('users.show');
    Route::get('/users/{user}/edit', [App\Http\Controllers\AdminController::class, 'userEdit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\AdminController::class, 'userUpdate'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\AdminController::class, 'userDestroy'])->name('users.destroy');
    
    // Product Management
    Route::get('/products', [App\Http\Controllers\AdminController::class, 'products'])->name('products.index');
    Route::get('/products/create', [App\Http\Controllers\AdminController::class, 'productCreate'])->name('products.create');
    Route::post('/products', [App\Http\Controllers\AdminController::class, 'productStore'])->name('products.store');
    Route::get('/products/{product}', [App\Http\Controllers\AdminController::class, 'productShow'])->name('products.show');
    Route::get('/products/{product}/edit', [App\Http\Controllers\AdminController::class, 'productEdit'])->name('products.edit');
    Route::put('/products/{product}', [App\Http\Controllers\AdminController::class, 'productUpdate'])->name('products.update');
    Route::delete('/products/{product}', [App\Http\Controllers\AdminController::class, 'productDestroy'])->name('products.destroy');
    
    // Order Management
    Route::get('/orders', [App\Http\Controllers\AdminController::class, 'orders'])->name('orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\AdminController::class, 'orderShow'])->name('orders.show');
    Route::get('/orders/{order}/edit', [App\Http\Controllers\AdminController::class, 'orderEdit'])->name('orders.edit');
    Route::put('/orders/{order}', [App\Http\Controllers\AdminController::class, 'orderUpdate'])->name('orders.update');
    
    // Category Management
    Route::get('/categories', [App\Http\Controllers\AdminController::class, 'categories'])->name('categories.index');
    Route::get('/categories/create', [App\Http\Controllers\AdminController::class, 'categoryCreate'])->name('categories.create');
    Route::post('/categories', [App\Http\Controllers\AdminController::class, 'categoryStore'])->name('categories.store');
    Route::get('/categories/{category}/edit', [App\Http\Controllers\AdminController::class, 'categoryEdit'])->name('categories.edit');
    Route::put('/categories/{category}', [App\Http\Controllers\AdminController::class, 'categoryUpdate'])->name('categories.update');
    Route::delete('/categories/{category}', [App\Http\Controllers\AdminController::class, 'categoryDestroy'])->name('categories.destroy');
    
    // Reports & Analytics
    Route::get('/reports', [App\Http\Controllers\AdminController::class, 'reports'])->name('reports.index');
    Route::get('/analytics', [App\Http\Controllers\AdminController::class, 'analytics'])->name('analytics.index');
    
    // Settings
    Route::get('/settings', [App\Http\Controllers\AdminController::class, 'settings'])->name('settings.index');
    Route::put('/settings', [App\Http\Controllers\AdminController::class, 'settingsUpdate'])->name('settings.update');
});

/*
|--------------------------------------------------------------------------
| PELAKU UMKM ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('pelaku-umkm')
    ->middleware(['auth', 'role:pelaku_umkm'])
    ->name('pelaku_umkm.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', function () {
            $products = Product::where('creator_id', auth()->id())->get();
            $totalRevenue = \App\Models\ProductOrder::where('creator_id', auth()->id())->where('is_paid', 1)->sum('total_price');
            $totalOrders = \App\Models\ProductOrder::where('creator_id', auth()->id())->count();
            return view('pelaku_umkm.dashboard', compact('products', 'totalRevenue', 'totalOrders'));
        })->name('dashboard');

        // Products Management
        Route::resource('products', ProductController::class);
        
        // Product Images Management
        Route::prefix('products/{product}/images')->name('products.images.')->group(function () {
            Route::get('/', [ProductImageController::class, 'index'])->name('index');
            Route::post('/', [ProductImageController::class, 'store'])->name('store');
            Route::put('/{image}', [ProductImageController::class, 'update'])->name('update');
            Route::delete('/{image}', [ProductImageController::class, 'destroy'])->name('destroy');
            Route::post('/reorder', [ProductImageController::class, 'reorder'])->name('reorder');
        });
        
        // Orders & Transactions
        Route::resource('orders', ProductOrderController::class);
        Route::get('/transactions', [ProductOrderController::class, 'transactions'])->name('transactions');
        Route::get('/orders/details/{productOrder}', [ProductOrderController::class, 'show'])->name('orders.details');
    });

/*
|--------------------------------------------------------------------------
| PEMBELI ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('pembeli')
    ->middleware(['auth', 'role:pembeli'])
    ->name('pembeli.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', function () {
            $categories = Category::all();
            $products = Product::latest()->get();
            $myPurchases = \App\Models\ProductOrder::where('pembeli_id', auth()->id())->get();
            return view('pembeli.sidebar-dashboard', compact('categories', 'products', 'myPurchases'));
        })->name('dashboard');
        
        // My Purchases
        Route::get('/purchases', function () {
            $myPurchases = \App\Models\ProductOrder::where('pembeli_id', auth()->id())->get();
            return view('pembeli.purchases', compact('myPurchases'));
        })->name('purchases');
        
        // Download purchased products
        Route::get('/download/{productOrder}', [ProductOrderController::class, 'download_file'])->name('download')->middleware('throttle:1,1');
    });

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Login, Register, Forgot Password)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
