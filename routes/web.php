<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardPetugasController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Detail Buku
Route::get('/buku/detail', function () {
    return view('frontend.detail-buku');
})->name('buku.detail');


Route::get('/admin/login', [AdminAuthController::class, 'create'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'store'])
    ->name('admin.login.store');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])
        ->name('admin.dashboard');

    // Kategori
    Route::get('/kategori', [CategoryController::class, 'index'])
        ->name('admin.kategori.index');

    Route::get('/kategori/create', [CategoryController::class, 'create'])
        ->name('admin.kategori.create');

    Route::post('/kategori', [CategoryController::class, 'store'])
        ->name('admin.kategori.store');

    // Buku
    Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])
        ->name('admin.buku.edit');

    Route::put('/buku/{id}', [BukuController::class, 'update'])
        ->name('admin.buku.update');
});



Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/petugas/dashboard', [DashboardPetugasController::class, 'index'])
        ->name('petugas.dashboard');
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/dashboard', function () {
        return view('siswa.home');
    })->name('siswa.dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});



Route::prefix('admin')->middleware(['auth','role:admin'])->group(function () {

    // Kategori
    Route::get('/kategori', [CategoryController::class, 'index'])->name('admin.kategori.index');
    Route::get('/kategori/create', [CategoryController::class, 'create'])->name('admin.kategori.create');
    Route::post('/kategori/store', [CategoryController::class, 'store'])->name('admin.kategori.store');

    // Buku
    Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('admin.buku.edit');
    Route::put('/buku/{id}', [BukuController::class, 'update'])->name('admin.buku.update');

  
// Buku
Route::get('/buku', [BukuController::class, 'index'])
    ->name('dashboard_admin.buku.data_buku');

// Form tambah buku
Route::get('/buku/create', [BukuController::class, 'create'])
    ->name('dashboard_admin.buku.create');

// Simpan buku baru
Route::post('/buku/store', [BukuController::class, 'store'])
    ->name('dashboard_admin.buku.store');

// Edit & Update
Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])
    ->name('admin.buku.edit');
Route::put('/buku/{id}', [BukuController::class, 'update'])
    ->name('admin.buku.update');

// Hapus
Route::delete('/buku/{id}', [BukuController::class, 'destroy'])
    ->name('admin.buku.destroy');


});


require __DIR__.'/auth.php';
