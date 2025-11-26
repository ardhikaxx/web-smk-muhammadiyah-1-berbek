<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManajemenAdminController;
use App\Http\Controllers\SettingsController;

Route::get('/', function () {
    return view('index');
})->name('landing-page');

Route::get('/profil-sekolah', function () {
    return view('profil');
})->name('profil');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
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