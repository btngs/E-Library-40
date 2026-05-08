<?php

use App\Http\Controllers\AnggotaBukuController;
use App\Http\Controllers\AnggotaDashboardController;
use App\Http\Controllers\AnggotaProfileController;
use App\Http\Controllers\AdminAnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (! Auth::check()) {
        return redirect()->route('login');
    }

    return Auth::user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('anggota.dashboard');
});

Route::middleware('auth')->group(function () {
    // Admin routes
    Route::prefix('admin')->name('admin.')->middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::resource('anggota', AdminAnggotaController::class)->except(['show']);
        Route::post('/anggota/{anggota}/approve', [AdminAnggotaController::class, 'approve'])->name('anggota.approve');
        Route::delete('/anggota/{anggota}/reject', [AdminAnggotaController::class, 'reject'])->name('anggota.reject');
        
        Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
        Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
        Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::post('/peminjaman/{peminjaman}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
        Route::delete('/peminjaman/{peminjaman}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');
        Route::post('/peminjaman/{peminjaman}/confirm-return', [PeminjamanController::class, 'confirmReturn'])->name('peminjaman.confirm-return');
        Route::post('/peminjaman/{peminjaman}/reject-return', [PeminjamanController::class, 'rejectReturn'])->name('peminjaman.reject-return');
        Route::get('/denda', [DendaController::class, 'index'])->name('denda.index');
        Route::post('/denda/{peminjaman}/selesaikan', [DendaController::class, 'selesaikan'])->name('denda.selesaikan');
        Route::resource('buku', BukuController::class)->except('show');
        Route::resource('kategori', KategoriController::class)->except('show');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::middleware(['role:siswa'])->group(function () {
        Route::get('/anggota/dashboard', AnggotaDashboardController::class)->name('anggota.dashboard');
        Route::get('/anggota/peminjaman', [AnggotaBukuController::class, 'index'])->name('anggota.peminjaman.index');
        Route::get('/anggota/peminjaman/saya', [AnggotaBukuController::class, 'pinjamanSaya'])->name('anggota.peminjaman.saya');
        Route::get('/anggota/peminjaman/saya/{peminjaman}', [AnggotaBukuController::class, 'pinjamanSayaShow'])->name('anggota.peminjaman.saya.show');
        Route::patch('/anggota/peminjaman/saya/{peminjaman}/kembalikan', [AnggotaBukuController::class, 'ajukanKembali'])->name('anggota.peminjaman.saya.kembalikan');
        Route::get('/anggota/buku/{buku}', [AnggotaBukuController::class, 'show'])->name('anggota.buku.show');
        Route::post('/anggota/buku/{buku}/request', [AnggotaBukuController::class, 'requestPinjam'])->name('anggota.buku.request');
        Route::get('/anggota/informasi-pengguna', [AnggotaProfileController::class, 'show'])->name('anggota.profile.show');
    });
});

require __DIR__ . '/auth.php';
