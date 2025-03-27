<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\TouristController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\CheckpointController;
use App\Http\Controllers\TourGuideController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\AdminOrderController;


Route::get('/index', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('welcome');
});

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        // Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
        // Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    });

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    
    // Route::middleware(['auth', 'admin'])->group(function () {
        // Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    // });
});

// User routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserLoginController::class, 'login'])->name('login.submit');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
});

// User Dashboard Route
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');
    Route::post('/logout', [UserLoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'admin'])->group(function() {
    Route::resource('tourists', TouristController::class);
    Route::resource('guides', GuideController::class);
    // Route::get('weather', [WeatherController::class, 'dashboard']);
    // Route::post('checkout/{tourist}', [CheckpointController::class, 'checkout']);
});

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/weather', [WeatherController::class, 'updateWeatherInfo'])->name('updateWeatherInfo');

Route::get('/weather', [App\Http\Controllers\WeatherController::class, 'index'])->name('weather');


// Main features
Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');
Route::get('/guides', [App\Http\Controllers\GuideController::class, 'index'])->name('guides');
Route::get('/honey', [App\Http\Controllers\HoneyController::class, 'index'])->name('honey');
Route::get('/umkm', [App\Http\Controllers\UmkmController::class, 'index'])->name('umkm');
Route::get('/gallery', [App\Http\Controllers\GalleryController::class, 'index'])->name('gallery');
Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news');
Route::get('/facilities', [App\Http\Controllers\FacilityController::class, 'index'])->name('facilities');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact/submit', [App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');
Route::get('/map', [App\Http\Controllers\MapController::class, 'index'])->name('map');
Route::get('/weather', [App\Http\Controllers\WeatherController::class, 'index'])->name('weather');
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile')->middleware('auth');

//Tour Guides
Route::get('tourguides', [TourGuideController::class, 'index'])->name('tourguides.index');
Route::get('tourguides/create', [TourGuideController::class, 'create'])->name('tourguides.create');
Route::post('tourguides', [TourGuideController::class, 'store'])->name('tourguides.store');
Route::get('tourguides/{id}/edit', [TourGuideController::class, 'edit'])->name('tourguides.edit');
Route::put('tourguides/{id}', [TourGuideController::class, 'update'])->name('tourguides.update');
Route::delete('tourguides/{id}', [TourGuideController::class, 'destroy'])->name('tourguides.destroy');
Route::get('/tourguides/{id}/order', [TourGuideController::class, 'order'])->name('tourguides.order');
Route::post('/tourguides/{id}/order', [TourGuideController::class, 'orderSubmit'])->name('tourguides.orderSubmit');

// User Order History Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/order-history', [OrderHistoryController::class, 'index'])->name('order-history.index');
    Route::get('/order-history/{id}', [OrderHistoryController::class, 'show'])->name('order-history.show');
});

// Admin Order Management Routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}/edit', [AdminOrderController::class, 'edit'])->name('admin.orders.edit');
    Route::put('/orders/{id}', [AdminOrderController::class, 'update'])->name('admin.orders.update');
});



// Route::get('/weather', function () {
//     return view('weather');
// });

// Admin Dashboard Route (already exists in your admin routes group)
// Route::prefix('admin')->name('admin.')->group(function () {
    // Route::middleware(['auth', 'admin'])->group(function () {
        // Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        // Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    // });
// });

// Route::post('logout', 'Auth\LoginController@logout')->name('logout');

