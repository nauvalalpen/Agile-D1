<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FacilityController as AdminFacilityController;
use App\Http\Controllers\TouristController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\CheckpointController;
use App\Http\Controllers\TourGuideController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProdukUMKMController;
use App\Http\Controllers\SettingsController;

Route::get('/index', function () {
    return view('index');
});

// Authentication Routes
// Auth::routes(['verify' => true]);

// Google OAuth Routes
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Settings Routes (Protected)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::post('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update');
    Route::post('/settings/notifications', [SettingsController::class, 'updateNotifications'])->name('settings.notifications.update');
    Route::post('/settings/privacy', [SettingsController::class, 'updatePrivacy'])->name('settings.privacy.update');
    Route::post('/settings/2fa/enable', [SettingsController::class, 'enable2FA'])->name('settings.2fa.enable');
    Route::post('/settings/2fa/disable', [SettingsController::class, 'disable2FA'])->name('settings.2fa.disable');
    Route::get('/settings/2fa/setup', [SettingsController::class, 'setup2FA'])->name('settings.2fa.setup');
    Route::get('/settings/export', [SettingsController::class, 'exportData'])->name('settings.export');
    Route::delete('/settings/account', [SettingsController::class, 'deleteAccount'])->name('settings.account.delete');
});

// Your existing routes...
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/minimap', function () {
        return view('minimap.index');
    })->name('minimap.index');
    
    Route::get('/weather', function () {
        return view('weather.index');
    });
    
    Route::get('/facilities', function () {
        return view('facilities.index');
    });
    
    Route::get('/gallery', function () {
        return view('gallery.index');
    });
    
    Route::get('/beritas', function () {
        return view('beritas.index');
    });
    
    Route::get('/contact', function () {
        return view('contact.index');
    });
    
    Route::get('/tourguides', function () {
        return view('tourguides.index');
    });
    
    Route::get('/madu', function () {
        return view('madu.index');
    })->name('madu.index');
    
    Route::get('/produk-umkm', function () {
        return view('produk-umkm.index');
    })->name('produkUMKM.index');
    
    Route::get('/order-history', function () {
        return view('order-history.index');
    })->name('order-history.index');
    
    Route::get('/order-history/{id}/{type}', function ($id, $type) {
        return view('order-history.show', compact('id', 'type'));
    })->name('order-history.show');
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

    // Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    
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

// Route::middleware(['auth', 'admin'])->group(function() {
//     // Route::resource('tourists', TouristController::class);
//     Route::resource('guides', GuideController::class);
//     // Route::get('weather', [WeatherController::class, 'dashboard']);
//     // Route::post('checkout/{tourist}', [CheckpointController::class, 'checkout']);
// });

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/weather', [WeatherController::class, 'updateWeatherInfo'])->name('updateWeatherInfo');

Route::get('/weather', [App\Http\Controllers\WeatherController::class, 'index'])->name('weather');


// Main features
Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');
// Route::get('/guides', [App\Http\Controllers\GuideController::class, 'index'])->name('guides');
// Route::get('/honey', [App\Http\Controllers\HoneyController::class, 'index'])->name('honey');
// Route::get('/umkm', [App\Http\Controllers\UmkmController::class, 'index'])->name('umkm');
Route::get('/gallery', [App\Http\Controllers\GalleryController::class, 'index'])->name('gallery');
// Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news');
Route::get('/facilities', [App\Http\Controllers\FacilityController::class, 'index'])->name('facilities');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact/submit', [App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');
// Route::get('/map', [App\Http\Controllers\MapController::class, 'index'])->name('map');
Route::get('/weather', [App\Http\Controllers\WeatherController::class, 'index'])->name('weather');
//Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile')->middleware('auth');

//Tour Guides
Route::get('tourguides', [TourGuideController::class, 'index'])->name('tourguides.index');
Route::get('tourguides/create', [TourGuideController::class, 'create'])->name('tourguides.create');
Route::post('tourguides', [TourGuideController::class, 'store'])->name('tourguides.store');
Route::get('tourguides/{id}/edit', [TourGuideController::class, 'edit'])->name('tourguides.edit');
Route::put('tourguides/{id}', [TourGuideController::class, 'update'])->name('tourguides.update');
Route::delete('tourguides/{id}', [TourGuideController::class, 'destroy'])->name('tourguides.destroy');
Route::get('/tourguides/{id}/order', [TourGuideController::class, 'order'])->name('tourguides.order');
Route::post('/tourguides/{id}/order', [TourGuideController::class, 'orderSubmit'])->name('tourguides.orderSubmit');
Route::get('/', [App\Http\Controllers\TourGuideController::class, 'homepage']);

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

// Add these routes to your existing web.php file

Route::middleware(['auth'])->group(function () {
    // Account Settings routes
    Route::get('/settings', [App\Http\Controllers\AccountSettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings/profile', [App\Http\Controllers\AccountSettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::post('/settings/photo', [App\Http\Controllers\AccountSettingsController::class, 'updatePhoto'])->name('settings.photo.update');
    Route::put('/settings/password', [App\Http\Controllers\AccountSettingsController::class, 'updatePassword'])->name('settings.password.update');
    Route::put('/settings/notifications', [App\Http\Controllers\AccountSettingsController::class, 'updateNotifications'])->name('settings.notifications.update');
    Route::delete('/settings/account', [App\Http\Controllers\AccountSettingsController::class, 'deleteAccount'])->name('settings.account.delete');
    Route::post('/settings/resend-verification', [App\Http\Controllers\AccountSettingsController::class, 'resendVerification'])->name('settings.resend.verification');
    Route::post('/settings/verify-email', [App\Http\Controllers\AccountSettingsController::class, 'verifyEmail'])->name('settings.verify.email');
});


// Public routes
Route::get('/facilities', [App\Http\Controllers\FacilityController::class, 'index'])->name('facilities.index');

Route::get('/beritas', [App\Http\Controllers\BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [App\Http\Controllers\BeritaController::class, 'detail'])->name('berita.detail');

Route::get('/gallery', [GaleriController::class, 'index'])->name('gallery.index');



// Madu: 

// Honey Product Routes
Route::get('/honey', [App\Http\Controllers\MaduController::class, 'index'])->name('madu.index');
Route::get('/honey/{id}/order', [App\Http\Controllers\MaduController::class, 'order'])->name('madu.order')->middleware('auth');
Route::post('/honey/{id}/order', [App\Http\Controllers\MaduController::class, 'orderSubmit'])->name('madu.orderSubmit')->middleware('auth');

// User Honey Order History Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/order-madu', [App\Http\Controllers\OrderMaduController::class, 'index'])->name('order-madu.index');
    Route::get('/order-madu/{id}', [App\Http\Controllers\OrderMaduController::class, 'show'])->name('order-madu.show');
});

// Admin Honey Management Routes
Route::prefix('admin')->name('admin.')->middleware(
    ['auth', \App\Http\Middleware\AdminMiddleware::class]
)->group(function () {

    // Madu Routes
    Route::get('/madu', [App\Http\Controllers\MaduController::class, 'adminIndex'])->name('madu.index');
    Route::post('/madu', [App\Http\Controllers\MaduController::class, 'store'])->name('madu.store');
    Route::put('/madu/{madu}', [App\Http\Controllers\MaduController::class, 'update'])->name('madu.update');
    Route::delete('/madu/{madu}', [App\Http\Controllers\MaduController::class, 'destroy'])->name('madu.destroy');
    Route::post('/madu/{id}/restore', [App\Http\Controllers\MaduController::class, 'restore'])->name('madu.restore');
    Route::delete('/madu/{id}/force-delete', [App\Http\Controllers\MaduController::class, 'forceDelete'])->name('madu.force-delete');
    
    // Admin Honey Order Management
    Route::get('/orders-madu', [App\Http\Controllers\OrderMaduController::class, 'adminIndex'])->name('orders-madu.index');
    Route::put('/orders-madu/{id}', [App\Http\Controllers\OrderMaduController::class, 'update'])->name('orders-madu.update');


// Gallery Routes
    Route::get('/gallery', [App\Http\Controllers\GaleriController::class, 'adminIndex'])->name('gallery.index');
    Route::get('/gallery/{id}/details', [App\Http\Controllers\GaleriController::class, 'showDetails'])->name('gallery.details'); // ADD THIS LINE
    Route::get('/gallery/{gallery}/edit-modal', [App\Http\Controllers\GaleriController::class, 'editModal'])->name('gallery.edit-modal');
    Route::post('/gallery', [App\Http\Controllers\GaleriController::class, 'store'])->name('gallery.store');
    Route::put('/gallery/{gallery}', [App\Http\Controllers\GaleriController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{gallery}', [App\Http\Controllers\GaleriController::class, 'destroy'])->name('gallery.destroy');
    Route::post('/gallery/{id}/restore', [App\Http\Controllers\GaleriController::class, 'restore'])->name('gallery.restore');
    Route::delete('/gallery/{id}/force-delete', [App\Http\Controllers\GaleriController::class, 'forceDelete'])->name('gallery.force-delete');


    // Berita Routes
    Route::get('/beritas', [App\Http\Controllers\BeritaController::class, 'adminIndex'])->name('berita.index');
    Route::get('/beritas/{id}/edit-modal', [App\Http\Controllers\BeritaController::class, 'editModal'])->name('berita.edit-modal');
    Route::post('/beritas', [App\Http\Controllers\BeritaController::class, 'store'])->name('berita.store');
    Route::put('/beritas/{berita}', [App\Http\Controllers\BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/beritas/{berita}', [App\Http\Controllers\BeritaController::class, 'destroy'])->name('berita.destroy');
    Route::post('/beritas/{id}/restore', [App\Http\Controllers\BeritaController::class, 'restore'])->name('berita.restore');
    Route::delete('/beritas/{id}/force-delete', [App\Http\Controllers\BeritaController::class, 'forceDelete'])->name('berita.force-delete');

    // Facility Routes
    Route::get('/facilities', [App\Http\Controllers\FacilityController::class, 'adminIndex'])->name('facilities.index');
    Route::get('/facilities/{id}/edit-modal', [App\Http\Controllers\FacilityController::class, 'editModal'])->name('facilities.edit-modal');
    Route::post('/facilities', [App\Http\Controllers\FacilityController::class, 'store'])->name('facilities.store');
    Route::put('/facilities/{facility}', [App\Http\Controllers\FacilityController::class, 'update'])->name('facilities.update');
    Route::delete('/facilities/{facility}', [App\Http\Controllers\FacilityController::class, 'destroy'])->name('facilities.destroy');
    Route::post('/facilities/{id}/restore', [App\Http\Controllers\FacilityController::class, 'restore'])->name('facilities.restore');
    Route::delete('/facilities/{id}/force-delete', [App\Http\Controllers\FacilityController::class, 'forceDelete'])->name('facilities.force-delete');

    // Tiket Routes
    Route::get('/tiketmasuks', [App\Http\Controllers\TiketController::class, 'adminIndex'])->name('tiketmasuks.index');
    Route::get('/tiketmasuks/{id}/edit-modal', [App\Http\Controllers\TiketController::class, 'editModal'])->name('tiketmasuks.edit-modal');
    Route::post('/tiketmasuks', [App\Http\Controllers\TiketController::class, 'store'])->name('tiketmasuks.store');
    Route::put('/tiketmasuks/{tiket}', [App\Http\Controllers\TiketController::class, 'update'])->name('tiketmasuks.update');
    Route::post('/tiketmasuks/{id}/restore', [App\Http\Controllers\TiketController::class, 'restore'])->name('tiketmasuks.restore');
    Route::patch('/tiketmasuks/{id}/status', [App\Http\Controllers\TiketController::class, 'updateStatus'])->name('tiketmasuks.updateStatus');

    //Admin routes for Laporan Penjualan
    Route::get('/laporan-penjualan', [App\Http\Controllers\Admin\LaporanPenjualanController::class, 'index'])->name('laporan-penjualan.index');
    Route::get('/laporan-penjualan/export-pdf', [App\Http\Controllers\Admin\LaporanPenjualanController::class, 'exportPdf'])->name('laporan-penjualan.export-pdf');
    Route::get('/laporan-penjualan/export-excel', [App\Http\Controllers\Admin\LaporanPenjualanController::class, 'exportExcel'])->name('laporan-penjualan.export-excel');

    // Users Routes
    Route::resource('users', UsersController::class)->except(['show']);;
    // Route untuk menampilkan trash (soft deleted users)
    Route::get('users/trash', [UsersController::class, 'trash'])->name('users.trash');
    // Route untuk restore user yang dihapus soft delete
    Route::post('users/{id}/restore', [UsersController::class, 'restore'])->name('users.restore');
    // Route untuk force delete user (hapus permanen)
    Route::delete('users/{id}/force-delete', [UsersController::class, 'forceDelete'])->name('users.force-delete');

    // Dashboard Routes
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // OAuth Management routes
    Route::get('oauth', [App\Http\Controllers\Admin\OAuthController::class, 'index'])->name('oauth.index');
    Route::get('oauth/users', [App\Http\Controllers\Admin\OAuthController::class, 'users'])->name('oauth.users');
});

// User Order History Routes - Unified
Route::middleware(['auth'])->group(function () {
    Route::get('/order-history', [OrderHistoryController::class, 'index'])->name('order-history.index');
    Route::get('/order-history/{id}', [OrderHistoryController::class, 'show'])->name('order-history.show');
    
    // Redirect old routes to new unified system
    Route::get('/order-madu', function() {
        return redirect()->route('order-history.index', ['tab' => 'honey']);
    })->name('order-madu.index');
    
    Route::get('/order-madu/{id}', function($id) {
        return redirect()->route('order-history.show', ['id' => $id, 'type' => 'honey']);
    })->name('order-madu.show');
});


// Minimap Routes (add these lines to your existing web.php)
Route::get('/minimap', [App\Http\Controllers\MinimapController::class, 'index'])->name('minimap.index');
Route::get('/minimap/fullscreen', [App\Http\Controllers\MinimapController::class, 'fullscreen'])->name('minimap.fullscreen');

// Admin routes for produk UMKM+
Route::get('/produk-umkm', [App\Http\Controllers\ProdukUMKMController::class, 'index'])->name('produkUMKM.index');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/produkUMKM', [App\Http\Controllers\ProdukUMKMController::class, 'adminIndex'])->name('produkUMKM.index');
    Route::get('/produkUMKM/{id}/edit-modal', [App\Http\Controllers\ProdukUMKMController::class, 'editModal'])->name('produkUMKM.edit-modal');
    Route::post('/produkUMKM', [App\Http\Controllers\ProdukUMKMController::class, 'store'])->name('produkUMKM.store');
    Route::put('/produkUMKM/{produkUMKM}', [App\Http\Controllers\ProdukUMKMController::class, 'update'])->name('produkUMKM.update');
    Route::delete('/produkUMKM/{produkUMKM}', [App\Http\Controllers\ProdukUMKMController::class, 'destroy'])->name('produkUMKM.destroy');
    Route::post('/produkUMKM/{id}/restore', [App\Http\Controllers\ProdukUMKMController::class, 'restore'])->name('produkUMKM.restore');
    Route::delete('/produkUMKM/{id}/force-delete', [App\Http\Controllers\ProdukUMKMController::class, 'forceDelete'])->name('produkUMKM.force-delete');
});

// Email Verification Routes (must be before other auth routes)
Route::get('/email/verify', [RegisterController::class, 'showVerificationForm'])
    ->name('verification.show');
Route::post('/email/verify', [RegisterController::class, 'verify'])
    ->name('verification.verify');
Route::get('/email/verification-notice', function () {
    return view('auth.verification-notice');
})->name('verification.notice');
Route::post('/email/verification-notification', [RegisterController::class, 'resendVerification'])
    ->name('verification.resend');

// Google OAuth routes with error handling
Route::middleware(['socialite.errors'])->group(function () {
    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});

// Unlink Google account (for authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::post('auth/google/unlink', [GoogleController::class, 'unlinkGoogle'])->name('auth.google.unlink');
});

// Password Confirmation Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/confirm-password', [ConfirmPasswordController::class, 'show'])->name('password.confirm');
    Route::post('/confirm-password', [ConfirmPasswordController::class, 'confirm']);
});

// Add these routes to your existing web.php file

Route::middleware('auth')->group(function () {
    // Settings routes
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/profile', [App\Http\Controllers\SettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::post('/settings/password', [App\Http\Controllers\SettingsController::class, 'updatePassword'])->name('settings.password.update');
    Route::post('/settings/notifications', [App\Http\Controllers\SettingsController::class, 'updateNotifications'])->name('settings.notifications.update');
    Route::post('/settings/privacy', [App\Http\Controllers\SettingsController::class, 'updatePrivacy'])->name('settings.privacy.update');
    
    // 2FA routes
    Route::post('/settings/2fa/generate', [App\Http\Controllers\SettingsController::class, 'generate2FA'])->name('settings.2fa.generate');
    Route::post('/settings/2fa/enable', [App\Http\Controllers\SettingsController::class, 'enable2FA'])->name('settings.2fa.enable');
    Route::post('/settings/2fa/disable', [App\Http\Controllers\SettingsController::class, 'disable2FA'])->name('settings.2fa.disable');
    
    // Data management routes
    Route::get('/settings/export', [App\Http\Controllers\SettingsController::class, 'exportData'])->name('settings.export');
    Route::delete('/settings/account', [App\Http\Controllers\SettingsController::class, 'deleteAccount'])->name('settings.account.delete');
});


// Update Settings Routes to use the correct middleware alias
Route::middleware(['auth', 'account.ownership'])->group(function () {
    // Profile Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::post('/settings/photo', [SettingsController::class, 'updatePhoto'])->name('settings.photo.update');
    Route::post('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update');
    
    // Email Verification
    Route::post('/settings/email/resend', [SettingsController::class, 'resendEmailVerification'])->name('settings.email.resend');
    Route::post('/settings/email/verify', [SettingsController::class, 'verifyEmail'])->name('settings.email.verify');
    
    // Two-Factor Authentication
    Route::post('/settings/2fa/generate', [SettingsController::class, 'generate2FA'])->name('settings.2fa.generate');
    Route::post('/settings/2fa/enable', [SettingsController::class, 'enable2FA'])->name('settings.2fa.enable');
    Route::post('/settings/2fa/disable', [SettingsController::class, 'disable2FA'])->name('settings.2fa.disable');
    
    // Preferences
    Route::post('/settings/notifications', [SettingsController::class, 'updateNotifications'])->name('settings.notifications.update');
    Route::post('/settings/privacy', [SettingsController::class, 'updatePrivacy'])->name('settings.privacy.update');
    
    // Data Management
    Route::post('/settings/data/export', [SettingsController::class, 'exportData'])->name('settings.data.export');
    // Add this route to your settings group
    Route::get('/settings/data/stats', [SettingsController::class, 'getDataStats'])->name('settings.data.stats');

    Route::delete('/settings/account', [SettingsController::class, 'deleteAccount'])->name('settings.account.delete');
    
    // Social Account Management
    Route::post('/auth/google/unlink', [SettingsController::class, 'unlinkGoogle'])->name('auth.google.unlink');
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

