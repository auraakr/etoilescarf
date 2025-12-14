<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\SalesController;
use App\Models\Product;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/', function () {
    $featuredProducts = Product::with('category')
        ->where('is_featured', true)
        ->where('availability', true)
        ->latest()
        ->take(5)
        ->get();
    
    $products = Product::with('category')
        ->where('availability', true)
        ->latest()
        ->paginate(8);
    
    return view('welcome', compact('featuredProducts', 'products'));
});

Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// Redirect /login ke 404 atau homepage
Route::get('/login', function () {
    abort(404);
});

// Custom login route
Route::get('/masuk-admin', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/masuk-admin', [AuthenticatedSessionController::class, 'store'])
    ->middleware(['guest', 'throttle:login']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard - semua admin bisa akses
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Products - hanya super_admin dan product_admin
    Route::middleware(['role:super_admin,product_admin'])->group(function () {
        Route::resource('products', ProductController::class);
        Route::resource('categories', ProductCategoryController::class);
    });

    // Sales/Transactions - hanya super_admin dan sales_admin
    Route::middleware(['role:super_admin,sales_admin'])->group(function () {
        Route::resource('sales', SalesController::class);
        // atau bisa pakai nama lain seperti 'orders', 'transactions', dll
    });

    // Users - hanya super_admin
    Route::middleware(['role:super_admin'])->group(function () {
        Route::resource('users', UserController::class);
    });
});