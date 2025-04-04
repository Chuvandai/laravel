<?php
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\client\HomecontrollerClient;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\CardController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\VariantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\PaymentController;
use Illuminate\Support\Facades\Route;
// Route cho trang chủ client
Route::get('/clients', [HomecontrollerClient::class, 'index'])->name('home');
Route::get('/clients/login', [HomecontrollerClient::class, 'login'])->name('login');
Route::post('/clients/login', [AuthController::class, 'login'])->name('login');
Route::get('/products/{id}', [HomecontrollerClient::class, 'show'])->name('products.show');
Route::get('/clients/profile', [AuthController::class, 'profile'])->name('profile');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/clients/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/clients/register', [AuthController::class, 'register'])->name('register.store');
Route::get('/clients/card', [CardController::class, 'index'])->name('card');
Route::post('/clients/card', [CardController::class, 'add'])->name('card');
Route::delete('/clients/card', [CardController::class, 'remove'])->name('card.remove');
Route::get('/clients/checkout', [OrderController::class, 'index'])->name('order.index');
Route::post('/clients/checkout', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/{order}/payment', [PaymentController::class, 'show'])->name('payment.form');
Route::post('/order/{order}/payment', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/order/{order}/payment/success', [PaymentController::class, 'success'])->name('payment.success');
//Route::get('/order/{order}/show-order', [OrderController::class, 'show'])->name('order.show');
// Route::get('/clients/show-order', [HomecontrollerClient::class, 'showOrder'])->name('clients.showOrder');

//Route cho admin
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('variants', VariantController::class);
    Route::resource('orders', OrderController::class);
});




