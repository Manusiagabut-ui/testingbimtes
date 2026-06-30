<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CbtController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PesertaController;

/*
|--------------------------------------------------------------------------
| Web Routes - CBT Universal
|--------------------------------------------------------------------------
*/

// ==================== SISI SISWA / LANDING PAGE (PUBLIK) ====================

// Halaman Utama / Landing Page (Menampilkan Gerbang Login Nomor Peserta)
Route::get('/', [CbtController::class, 'landing'])->name('landing');

// Halaman Tempat Ujian Siswa (Diproteksi session di Controller)
Route::get('/ujian', [CbtController::class, 'indexUser'])->name('page.ujian');

// Endpoint API data soal untuk JavaScript
Route::get('/api/soal', [CbtController::class, 'getExamData']);

// Proses Login & Logout Siswa (Harus Publik agar Siswa Bisa Masuk)
Route::post('/peserta/login', [PesertaController::class, 'loginPeserta'])->name('peserta.login');
Route::post('/peserta/logout', [PesertaController::class, 'logoutPeserta'])->name('peserta.logout');

Route::post('/api/submit-ujian', [CbtController::class, 'submitUjian']);



// ==================== AUTH ADMIN (PASSWORD PATEN) ====================

// Tampilan Form Login Admin
Route::get('/login-admin', [AdminAuthController::class, 'showLogin'])->name('admin.login');

// Proses Cek Password Admin
Route::post('/login-admin', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// Proses Logout Admin
Route::post('/logout-admin', [AdminAuthController::class, 'logout'])->name('admin.logout');


// ==================== DASHBOARD ADMIN ====================

// 🔓 PINDAHKAN KE SINI SEMENTARA UNTUK TESTING (Bebas Barikade Middleware)
Route::get('/admin', [CbtController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/admin/export-nilai', [CbtController::class, 'exportNilaiExcel'])->name('admin.export.nilai');

// 🔒 Sisa rute admin lainnya tetap di dalam proteksi middleware
Route::middleware(['admin.check'])->group(function () {
    
    // --- 1. Kelompok Pengelolaan Soal & Materi ---
    Route::post('/admin/upload', [CbtController::class, 'uploadExcel'])->name('admin.upload');
    Route::delete('/admin/materi/{id}', [CbtController::class, 'deleteMateri'])->name('admin.delete');
    
    // --- 2. Kelompok Pengelolaan Peserta Ujian ---
    Route::get('/admin/peserta', [PesertaController::class, 'index'])->name('admin.peserta.index');
    Route::post('/admin/peserta/store', [PesertaController::class, 'store'])->name('admin.peserta.store');
    Route::delete('/admin/peserta/delete/{id}', [PesertaController::class, 'destroy'])->name('admin.peserta.destroy');
    Route::post('/admin/peserta/import', [PesertaController::class, 'importExcel'])->name('admin.peserta.import');
    
});