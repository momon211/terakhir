<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentAccountController;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'create'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'store']);

    Route::get('/admin/login', [LoginController::class, 'admin'])
        ->name('admin.login');

    Route::post('/admin/login', [LoginController::class, 'adminStore'])
        ->name('admin.login.store');

    Route::get('/register', [RegisterController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'store'])
        ->name('register.store');
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    Route::get('/store', [StoreController::class, 'index'])
        ->name('store');

    Route::get('/store/category/{category}', [StoreController::class, 'category'])
        ->name('store.category');

    /*
    |--------------------------------------------------------------------------
    | Catalog
    |--------------------------------------------------------------------------
    */

    Route::get('/catalog', function () {

        $products = Product::latest()->get();

        return view('user.catalog', compact('products'));

    })->name('catalog');

    /*
    |--------------------------------------------------------------------------
    | Payment Account
    |--------------------------------------------------------------------------
    */

    Route::get('/payment/register', [PaymentAccountController::class, 'create'])
        ->name('payment.create');

    Route::post('/payment/register', [PaymentAccountController::class, 'store'])
        ->name('payment.store');

    Route::get('/payment/edit', [PaymentAccountController::class, 'edit'])
        ->name('payment.edit');

    Route::put('/payment/update', [PaymentAccountController::class, 'update'])
        ->name('payment.update');

    Route::get('/payment/change-pin', [PaymentAccountController::class, 'changePinForm'])
        ->name('payment.change-pin.form');

    Route::put('/payment/change-pin', [PaymentAccountController::class, 'changePin'])
        ->name('payment.change-pin');

    /*
    |--------------------------------------------------------------------------
    | Payment
    |--------------------------------------------------------------------------
    */

    Route::get('/payment/{order}', [PaymentController::class, 'show'])
        ->name('payment.show');

    Route::post('/payment/{order}', [PaymentController::class, 'process'])
        ->name('payment.process');

    /*
    |--------------------------------------------------------------------------
    | Orders
    |--------------------------------------------------------------------------
    */

    Route::post('/order/{product}', [OrderController::class, 'store'])
        ->name('order.store');

    Route::get('/shipping/{order}', [OrderController::class, 'shipping'])
        ->name('shipping');

    Route::post('/order-confirm/{order}', [OrderController::class, 'confirm'])
        ->name('order.confirm');

    Route::get('/orders', [OrderController::class, 'orders'])
        ->name('orders');

    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])
        ->name('order.destroy');

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', LogoutController::class)
        ->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::resource('categories', CategoryController::class);

    Route::resource('products', ProductController::class);

    Route::get('/admin/orders', [AdminOrderController::class, 'index'])
        ->name('admin.orders.index');

    Route::put('/admin/orders/{order}', [AdminOrderController::class, 'updateStatus'])
        ->name('admin.orders.update');
});