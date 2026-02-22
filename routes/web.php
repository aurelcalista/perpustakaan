<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardPetugasController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AnggotaController; 
use App\Http\Controllers\LogPinjamController;
use App\Http\Controllers\UserPinjamController;
use App\Http\Controllers\SirkulasiController;
use App\Models\User;



Route::get('/', [BukuController::class, 'home'])
    ->name('home');

// Detail buku - bisa diakses siapa aja (guest & logged in)
Route::get('/buku/{id}', [UserPinjamController::class, 'show'])
    ->name('buku.detail');

Route::get('/informasi', function () {
    return view('informasi');
})->name('informasi');

Route::get('/panduan', function () {
    return view('panduan');
})->name('panduan');



Route::get('/admin/login', [AdminAuthController::class, 'create'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'store'])
    ->name('admin.login.store');



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])
        ->name('admin.dashboard');
});

Route::prefix('admin')->middleware(['auth','role:admin'])->group(function () {

    // Kategori
    Route::get('/kategori', [CategoryController::class, 'index'])->name('admin.kategori.index');
    Route::get('/kategori/create', [CategoryController::class, 'create'])->name('admin.kategori.create');
    Route::post('/kategori/store', [CategoryController::class, 'store'])->name('admin.kategori.store');

    // Buku
    Route::get('/buku', [BukuController::class, 'index'])->name('admin.buku.index');  
    Route::get('/buku/create', [BukuController::class, 'create'])->name('admin.buku.create'); 
    Route::post('/buku/store', [BukuController::class, 'store'])->name('admin.buku.store'); 
    Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('admin.buku.edit');
    Route::put('/buku/{id}', [BukuController::class, 'update'])->name('admin.buku.update');
    Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('admin.buku.destroy');

    // Anggota (AGT)
    Route::get('/agt', [AnggotaController::class, 'index'])->name('admin.agt.index');
    Route::get('/agt/create', [AnggotaController::class, 'create'])->name('admin.agt.create');
    Route::post('/agt/store', [AnggotaController::class, 'store'])->name('admin.agt.store');
    Route::get('/agt/{nis}/edit', [AnggotaController::class, 'edit'])->name('admin.agt.edit');
    Route::put('/agt/{nis}', [AnggotaController::class, 'update'])->name('admin.agt.update');
    Route::delete('/agt/{nis}', [AnggotaController::class, 'destroy'])->name('admin.agt.destroy');
    
    // Print Anggota
    Route::get('/agt/print', [AnggotaController::class, 'printAll'])->name('admin.agt.print');
    Route::get('/agt/{nis}/print', [AnggotaController::class, 'printSingle'])->name('admin.agt.print-single');

    // Log Peminjaman
    Route::get('/log-peminjaman', [LogPinjamController::class, 'index'])->name('log.pinjam');

        // Sirkulasi
    Route::get('/sirkul', [SirkulasiController::class, 'index'])
        ->name('admin.sirkul.index');
    
    Route::get('/sirkul/pending', [SirkulasiController::class, 'pending'])
        ->name('admin.sirkul.pending');
    
    Route::post('/sirkul/approve/{id_sk}', [SirkulasiController::class, 'approve'])
        ->name('admin.sirkul.approve');
    
    Route::delete('/sirkul/reject/{id_sk}', [SirkulasiController::class, 'reject'])
        ->name('admin.sirkul.reject');
    
    Route::get('/sirkul/create', [SirkulasiController::class, 'create'])
        ->name('admin.sirkul.create');
    
    Route::post('/sirkul/store', [SirkulasiController::class, 'store'])
        ->name('admin.sirkul.store');
    
    Route::post('/sirkul/perpanjang/{id_sk}', [SirkulasiController::class, 'perpanjang'])
        ->name('admin.sirkul.perpanjang');
    
    Route::post('/sirkul/kembali/{id_sk}', [SirkulasiController::class, 'kembali'])
        ->name('admin.sirkul.kembali');
    
    Route::get('/sirkul/riwayat', [SirkulasiController::class, 'riwayat'])
        ->name('admin.sirkul.riwayat');
});


Route::delete('/pinjam-buku/{id_sk}/cancel', [UserPinjamController::class, 'cancel'])
    ->name('siswa.pinjam.cancel')
    ->middleware(['auth', 'role:siswa']);

Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/petugas/dashboard', [DashboardPetugasController::class, 'index'])
        ->name('petugas.dashboard');
});



Route::middleware(['auth', 'role:siswa'])->group(function () {

    Route::get('/siswa/dashboard', function () {
        return view('siswa.home');
    })->name('siswa.dashboard');

    Route::get('/siswa/buku-saya', [UserPinjamController::class, 'bukuSaya'])
        ->name('siswa.buku.saya');

    Route::get('/siswa/riwayat', [UserPinjamController::class, 'riwayat'])
        ->name('siswa.riwayat');

    Route::post('/pinjam', [UserPinjamController::class, 'store'])
        ->name('siswa.pinjam.store');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');
        
    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
        
    // Upload / ganti foto profil (file atau base64 dari kamera)
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])
         ->name('profile.updatePhoto');

    // Hapus foto profil
    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])
         ->name('profile.deletePhoto');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';