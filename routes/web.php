<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardPetugasController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');
});

use App\Http\Controllers\HomeController;

Route::get('/buku/detail', [HomeController::class, 'detail'])
    ->name('buku.detail');

/*
|--------------------------------------------------------------------------
| ADMIN LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminAuthController::class, 'create'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'store'])
    ->name('admin.login.store');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])
        ->name('admin.dashboard');
});

/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/petugas/dashboard', [DashboardPetugasController::class, 'index'])
        ->name('petugas.dashboard');
});

/*
|--------------------------------------------------------------------------
| SISWA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/home', function () {
        return view('siswa.home');
    })->name('siswa.home');
});

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
