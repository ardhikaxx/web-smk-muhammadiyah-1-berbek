<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManajemenBannerController;
use App\Http\Controllers\ManajemenStrukturController;
use App\Http\Controllers\ManajemenPengumumanController;
use App\Http\Controllers\ManajemenFasilitasController;
use App\Http\Controllers\ManajemenPrestasiController;
use App\Http\Controllers\ManajemenJurusanController;
use App\Http\Controllers\ManajemenTenagaPendidikController;
use App\Http\Controllers\ManajemenGalleryController;
use App\Http\Controllers\ManajemenAdminController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PengumumanController;

Route::get('/', [IndexController::class, 'index'])->name('landing-page');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi');
Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

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

    // Manajemen Struktur Routes
    Route::get('/admin/manajemen-struktur', [ManajemenStrukturController::class, 'index'])->name('admin.manajemen-struktur.index');
    Route::post('/admin/manajemen-struktur', [ManajemenStrukturController::class, 'store'])->name('admin.manajemen-struktur.store');
    Route::get('/admin/manajemen-struktur/{struktur}', [ManajemenStrukturController::class, 'show'])->name('admin.manajemen-struktur.show');
    Route::put('/admin/manajemen-struktur/{struktur}', [ManajemenStrukturController::class, 'update'])->name('admin.manajemen-struktur.update');
    Route::delete('/admin/manajemen-struktur/{struktur}', [ManajemenStrukturController::class, 'destroy'])->name('admin.manajemen-struktur.destroy');
    Route::patch('/admin/manajemen-struktur/{struktur}/status', [ManajemenStrukturController::class, 'updateStatus'])->name('admin.manajemen-struktur.status');

    // Manajemen Pengumuman Routes
    Route::get('/admin/manajemen-pengumuman', [ManajemenPengumumanController::class, 'index'])->name('admin.manajemen-pengumuman.index');
    Route::post('/admin/manajemen-pengumuman', [ManajemenPengumumanController::class, 'store'])->name('admin.manajemen-pengumuman.store');
    Route::get('/admin/manajemen-pengumuman/{pengumuman}', [ManajemenPengumumanController::class, 'show'])->name('admin.manajemen-pengumuman.show');
    Route::put('/admin/manajemen-pengumuman/{pengumuman}', [ManajemenPengumumanController::class, 'update'])->name('admin.manajemen-pengumuman.update');
    Route::delete('/admin/manajemen-pengumuman/{pengumuman}', [ManajemenPengumumanController::class, 'destroy'])->name('admin.manajemen-pengumuman.destroy');
    Route::patch('/admin/manajemen-pengumuman/{pengumuman}/status', [ManajemenPengumumanController::class, 'updateStatus'])->name('admin.manajemen-pengumuman.status');

    // Manajemen Fasilitas Routes
    Route::get('/admin/manajemen-fasilitas', [ManajemenFasilitasController::class, 'index'])->name('admin.manajemen-fasilitas.index');
    Route::post('/admin/manajemen-fasilitas', [ManajemenFasilitasController::class, 'store'])->name('admin.manajemen-fasilitas.store');
    Route::get('/admin/manajemen-fasilitas/{fasilitas}', [ManajemenFasilitasController::class, 'show'])->name('admin.manajemen-fasilitas.show');
    Route::put('/admin/manajemen-fasilitas/{fasilitas}', [ManajemenFasilitasController::class, 'update'])->name('admin.manajemen-fasilitas.update');
    Route::delete('/admin/manajemen-fasilitas/{fasilitas}', [ManajemenFasilitasController::class, 'destroy'])->name('admin.manajemen-fasilitas.destroy');
    Route::patch('/admin/manajemen-fasilitas/{fasilitas}/status', [ManajemenFasilitasController::class, 'updateStatus'])->name('admin.manajemen-fasilitas.status');

    // Manajemen Prestasi Routes
    Route::get('/admin/manajemen-prestasi', [ManajemenPrestasiController::class, 'index'])->name('admin.manajemen-prestasi.index');
    Route::post('/admin/manajemen-prestasi', [ManajemenPrestasiController::class, 'store'])->name('admin.manajemen-prestasi.store');
    Route::get('/admin/manajemen-prestasi/{prestasi}', [ManajemenPrestasiController::class, 'show'])->name('admin.manajemen-prestasi.show');
    Route::put('/admin/manajemen-prestasi/{prestasi}', [ManajemenPrestasiController::class, 'update'])->name('admin.manajemen-prestasi.update');
    Route::delete('/admin/manajemen-prestasi/{prestasi}', [ManajemenPrestasiController::class, 'destroy'])->name('admin.manajemen-prestasi.destroy');
    Route::patch('/admin/manajemen-prestasi/{prestasi}/status', [ManajemenPrestasiController::class, 'updateStatus'])->name('admin.manajemen-prestasi.status');

    // Manajemen Jurusan Routes
    Route::get('/admin/manajemen-jurusan', [ManajemenJurusanController::class, 'index'])->name('admin.manajemen-jurusan.index');
    Route::post('/admin/manajemen-jurusan', [ManajemenJurusanController::class, 'store'])->name('admin.manajemen-jurusan.store');
    Route::get('/admin/manajemen-jurusan/{jurusan}', [ManajemenJurusanController::class, 'show'])->name('admin.manajemen-jurusan.show');
    Route::put('/admin/manajemen-jurusan/{jurusan}', [ManajemenJurusanController::class, 'update'])->name('admin.manajemen-jurusan.update');
    Route::delete('/admin/manajemen-jurusan/{jurusan}', [ManajemenJurusanController::class, 'destroy'])->name('admin.manajemen-jurusan.destroy');
    Route::patch('/admin/manajemen-jurusan/{jurusan}/status', [ManajemenJurusanController::class, 'updateStatus'])->name('admin.manajemen-jurusan.status');

    // Manajemen Tenaga Pendidik Routes
    Route::get('/admin/tenaga-pendidik', [ManajemenTenagaPendidikController::class, 'index'])->name('admin.tenaga-pendidik.index');
    Route::post('/admin/tenaga-pendidik', [ManajemenTenagaPendidikController::class, 'store'])->name('admin.tenaga-pendidik.store');
    Route::get('/admin/tenaga-pendidik/{pengajar}', [ManajemenTenagaPendidikController::class, 'show'])->name('admin.tenaga-pendidik.show');
    Route::put('/admin/tenaga-pendidik/{pengajar}', [ManajemenTenagaPendidikController::class, 'update'])->name('admin.tenaga-pendidik.update');
    Route::delete('/admin/tenaga-pendidik/{pengajar}', [ManajemenTenagaPendidikController::class, 'destroy'])->name('admin.tenaga-pendidik.destroy');
    Route::patch('/admin/tenaga-pendidik/{pengajar}/status', [ManajemenTenagaPendidikController::class, 'updateStatus'])->name('admin.tenaga-pendidik.status');

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