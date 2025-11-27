<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManajemenBannerController;
use App\Http\Controllers\ManajemenFasilitasController;
use App\Http\Controllers\ManajemenGalleryController;
use App\Http\Controllers\ManajemenAdminController;
use App\Http\Controllers\SettingsController;

Route::get('/', [IndexController::class, 'index'])->name('landing-page');

Route::get('/profil-sekolah', function () {
    return view('profil');
})->name('profil');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Optional: Registration routes (bisa dihapus setelah admin pertama dibuat)
// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
// Route::post('/register', [AuthController::class, 'register'])->name('auth.register.submit');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/current', [AuthController::class, 'getCurrentAdmin'])->name('admin.current');
    // Dashboard Admin Routes
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('admin.dashboard');

    // Manajemen Banner Routes
    Route::get('/admin/manajemen-banner', [ManajemenBannerController::class, 'index'])->name('admin.manajemen-banner.index');
    Route::post('/admin/manajemen-banner', [ManajemenBannerController::class, 'store'])->name('admin.manajemen-banner.store');
    Route::get('/admin/manajemen-banner/{banner}', [ManajemenBannerController::class, 'show'])->name('admin.manajemen-banner.show');
    Route::put('/admin/manajemen-banner/{banner}', [ManajemenBannerController::class, 'update'])->name('admin.manajemen-banner.update');
    Route::delete('/admin/manajemen-banner/{banner}', [ManajemenBannerController::class, 'destroy'])->name('admin.manajemen-banner.destroy');
    Route::patch('/admin/manajemen-banner/{banner}/status', [ManajemenBannerController::class, 'updateStatus'])->name('admin.manajemen-banner.status');

    // Manajemen Fasilitas Routes
    Route::get('/admin/manajemen-fasilitas', [ManajemenFasilitasController::class, 'index'])->name('admin.manajemen-fasilitas.index');
    Route::post('/admin/manajemen-fasilitas', [ManajemenFasilitasController::class, 'store'])->name('admin.manajemen-fasilitas.store');
    Route::get('/admin/manajemen-fasilitas/{fasilitas}', [ManajemenFasilitasController::class, 'show'])->name('admin.manajemen-fasilitas.show');
    Route::put('/admin/manajemen-fasilitas/{fasilitas}', [ManajemenFasilitasController::class, 'update'])->name('admin.manajemen-fasilitas.update');
    Route::delete('/admin/manajemen-fasilitas/{fasilitas}', [ManajemenFasilitasController::class, 'destroy'])->name('admin.manajemen-fasilitas.destroy');
    Route::patch('/admin/manajemen-fasilitas/{fasilitas}/status', [ManajemenFasilitasController::class, 'updateStatus'])->name('admin.manajemen-fasilitas.status');

    // Manajemen Gallery Routes
    Route::get('/admin/manajemen-gallery', [ManajemenGalleryController::class, 'index'])->name('admin.manajemen-gallery.index');
    Route::post('/admin/manajemen-gallery', [ManajemenGalleryController::class, 'store'])->name('admin.manajemen-gallery.store');
    Route::get('/admin/manajemen-gallery/{gallery}', [ManajemenGalleryController::class, 'show'])->name('admin.manajemen-gallery.show');
    Route::put('/admin/manajemen-gallery/{gallery}', [ManajemenGalleryController::class, 'update'])->name('admin.manajemen-gallery.update');
    Route::delete('/admin/manajemen-gallery/{gallery}', [ManajemenGalleryController::class, 'destroy'])->name('admin.manajemen-gallery.destroy');
    Route::patch('/admin/manajemen-gallery/{gallery}/status', [ManajemenGalleryController::class, 'updateStatus'])->name('admin.manajemen-gallery.status');

    // Manajemen Admin Routes
    Route::get('/admin/manajemen-admin', [ManajemenAdminController::class, 'index'])->name('admin.manajemen-admin.index');
    Route::post('/admin/manajemen-admin', [ManajemenAdminController::class, 'store'])->name('admin.manajemen-admin.store');
    Route::get('/admin/manajemen-admin/{admin}', [ManajemenAdminController::class, 'show'])->name('admin.manajemen-admin.show');
    Route::put('/admin/manajemen-admin/{admin}', [ManajemenAdminController::class, 'update'])->name('admin.manajemen-admin.update');
    Route::delete('/admin/manajemen-admin/{admin}', [ManajemenAdminController::class, 'destroy'])->name('admin.manajemen-admin.destroy');
    Route::post('/admin/manajemen-admin/{admin}/password', [ManajemenAdminController::class, 'updatePassword'])->name('admin.manajemen-admin.password');

    // Settings Routes
    Route::get('/admin/settings', [SettingsController::class, 'index'])->name('admin.settings');
    Route::post('/admin/settings/profile', [SettingsController::class, 'updateProfile'])->name('admin.settings.profile');
    Route::post('/admin/settings/password', [SettingsController::class, 'updatePassword'])->name('admin.settings.password');
});