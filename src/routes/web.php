<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;

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

// Admin Dashboard Route (already exists in your admin routes group)
// Route::prefix('admin')->name('admin.')->group(function () {
    // Route::middleware(['auth', 'admin'])->group(function () {
        // Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        // Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    // });
// });
