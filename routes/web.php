<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    SimulasiController,
    TabunganController,
    PinjamanController,
    DepositoController,
    PerusahaanController,
    JaringanKantorController,
    UmkmController,
    BeritaController,
    LelangController,
    KarirController,
    EprocController,
    LaporanController
};

/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA & TESTING
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('pages.home'))->name('home');
Route::get('/test-navbar', fn() => view('users.test-navbar'));

/*
|--------------------------------------------------------------------------
| PRODUK & LAYANAN
|--------------------------------------------------------------------------
*/
// Tabungan
Route::get('/tabungan/{slug}', [TabunganController::class, 'show'])->name('tabungan.show');

// Deposito
Route::prefix('deposito')->name('deposito.')->group(function () {
    Route::get('/', [DepositoController::class, 'index'])->name('index');
    Route::get('/{slug}', [DepositoController::class, 'show'])->name('show');
});

// Pinjaman
Route::prefix('pinjaman')->name('pinjaman.')->group(function () {
    Route::get('/', [PinjamanController::class, 'index'])->name('index');
    Route::get('/{slug}', [PinjamanController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| SIMULASI
|--------------------------------------------------------------------------
*/
Route::name('pages.simulasi.')->prefix('simulasi')->group(function () {
    Route::get('/deposito', fn() => view('pages.simulasi.deposito'))->name('deposito');
    Route::get('/kredit', fn() => view('pages.simulasi.kredit'))->name('kredit');
});

Route::get('/simulasi/{jenis}/permintaan', function ($jenis) {
    if (!in_array($jenis, ['deposito', 'kredit'])) abort(404);
    return view('users.simulasi.permintaan-simulasi', compact('jenis'));
})->name('simulasi.permintaan');

Route::post('/simulasi/permintaan/submit', [SimulasiController::class, 'submit'])->name('simulasi.permintaan.submit');

/*
|--------------------------------------------------------------------------
| PUBLIKASI (Berita, Lelang, Laporan)
|--------------------------------------------------------------------------
*/
// 1. DAFTAR LELANG (Harus di atas rute slug umum)
Route::prefix('lelang')->name('lelang.')->group(function () {
    Route::get('/', [LelangController::class, 'index'])->name('index');
    Route::get('/{slug}', [LelangController::class, 'show'])->name('show');
});

// 2. DAFTAR BERITA
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('index');
    Route::get('/{slug}', [BeritaController::class, 'show'])->name('show');
});

Route::get('/karir', [KarirController::class, 'index'])->name('karir.index');

Route::prefix('laporan')->name('laporan.')->group(function () {
    Route::get('/tahunan', [LaporanController::class, 'tahunan'])->name('tahunan');
    Route::get('/keuangan', [LaporanController::class, 'keuangan'])->name('keuangan');
    Route::get('/gcg', [LaporanController::class, 'gcg'])->name('gcg');
});

/*
|--------------------------------------------------------------------------
| PERUSAHAAN & JARINGAN
|--------------------------------------------------------------------------
*/
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('index');
    Route::get('/{slug}', [BeritaController::class, 'show'])->name('show');
});

Route::prefix('perusahaan')->name('perusahaan.')->group(function () {
    Route::get('/komisaris/{slug}', [PerusahaanController::class, 'komisarisDetail'])->name('komisaris.detail');
    Route::get('/direksi/{slug}', [PerusahaanController::class, 'direksiDetail'])->name('direksi.detail');
    Route::get('/{slug}', [PerusahaanController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| PENGADUAN
|--------------------------------------------------------------------------
*/
Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
    Route::get('/alur', fn() => view('pages.pengaduan.alur-pengaduan'))->name('alur');
    Route::get('/whistle-blowing-system', fn() => view('pages.pengaduan.whistleblowingsystem'))->name('wbs');
    Route::post('/whistle-blowing-system', fn() => redirect()->route('pengaduan.wbs'))->name('wbs.store');
});