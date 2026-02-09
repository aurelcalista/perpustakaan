<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardPetugasController;
use App\Http\Controllers\HomeController;

<<<<<<< HEAD
/*
|--------------------------------------------------------------------------
| PUBLIC (HALAMAN DEPAN)
|--------------------------------------------------------------------------
*/
<<<<<<< HEAD
Route::get('/', function () {
    return view('home');
})->name('home');

=======
Route::get('/buku/detail', function () {
    return view('frontend.detail-buku');
});
>>>>>>> 3652f38284298bae16ee7e10b133c2618075d222

/*
|--------------------------------------------------------------------------
| ADMIN LOGIN (GUEST)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'create'])
        ->name('admin.login');
=======

Route::get('/', function () {
    return view('home');
});

>>>>>>> e8b9b7898fb9d35df5039f722ec379f65437107b

// Route::middleware('guest')->group(function () {
//     Route::get('/admin/login', [AdminAuthController::class, 'create'])
//         ->name('admin.login');

//     Route::post('/admin/login', [AdminAuthController::class, 'store'])
//         ->name('admin.login.store');
// });

// Hapus middleware guest dari admin login
Route::get('/admin/login', [AdminAuthController::class, 'create'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'store'])
    ->name('admin.login.store');

<<<<<<< HEAD
/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
=======
>>>>>>> e8b9b7898fb9d35df5039f722ec379f65437107b
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])
        ->name('admin.dashboard');
});

<<<<<<< HEAD
/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/
=======

>>>>>>> e8b9b7898fb9d35df5039f722ec379f65437107b
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/petugas/dashboard', [DashboardPetugasController::class, 'index'])
        ->name('petugas.dashboard');
});

<<<<<<< HEAD
/*
|--------------------------------------------------------------------------
| SISWA
|--------------------------------------------------------------------------
*/
=======

>>>>>>> e8b9b7898fb9d35df5039f722ec379f65437107b
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/home', function () {
        return view('siswa.home');
    })->name('siswa.home');
});

<<<<<<< HEAD
/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
=======

>>>>>>> e8b9b7898fb9d35df5039f722ec379f65437107b
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
