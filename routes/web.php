<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardPetugasController;

/*
|--------------------------------------------------------------------------
| FRONTEND (AGNIA)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('frontend.home');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return view('auth.login');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard_petugas', [DashboardPetugasController::class, 'index'])
        ->name('dashboard_petugas');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/dashboard_admin', function () {
    return view('dashboard_admin.index');
});

require __DIR__.'/auth.php';
