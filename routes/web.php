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
    GaleriController,
    LelangController,
    KarirController,
    EprocController,
    LaporanController
};

/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
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

// Halaman Daftar UMKM Mitra (Etalase)
Route::prefix('umkm-mitra')->name('umkm.')->group(function () {
    Route::get('/', [UmkmController::class, 'index'])->name('mitra');
    Route::get('/{slug}', [UmkmController::class, 'show'])->name('mitra.detail');
});

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
| PUBLIKASI & MEDIA CENTER
|--------------------------------------------------------------------------
*/

// 1. DAFTAR LELANG
Route::prefix('lelang')->name('lelang.')->group(function () {
    Route::get('/', [LelangController::class, 'index'])->name('index');
    Route::get('/{slug}', [LelangController::class, 'show'])->name('show');
});

// 2. DAFTAR BERITA
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('index');
    Route::get('/{slug}', [BeritaController::class, 'show'])->name('show');
});

// 3. DAFTAR GALERI
Route::prefix('galeri')->name('galeri.')->group(function () {
    Route::get('/', [GaleriController::class, 'index'])->name('index');
    Route::get('/{id}', [GaleriController::class, 'show'])->name('show');
});

// 4. DAFTAR KARIR
Route::get('/karir', [KarirController::class, 'index'])->name('karir.index');

// 5. DAFTAR LAPORAN
Route::prefix('laporan')->name('laporan.')->group(function () {
    // Rute utama menggunakan parameter dinamis {tipe}
    // Tipe: keuangan, tata-kelola, berkelanjutan
    Route::get('/{tipe}', [LaporanController::class, 'index'])->name('index');

    // Jika Anda tetap ingin rute eksplisit sesuai ServiceProvider sebelumnya:
    Route::get('/keuangan', [LaporanController::class, 'index'])->defaults('tipe', 'keuangan')->name('keuangan');
    Route::get('/tata-kelola', [LaporanController::class, 'index'])->defaults('tipe', 'tata-kelola')->name('gcg');
    Route::get('/berkelanjutan', [LaporanController::class, 'index'])->defaults('tipe', 'berkelanjutan')->name('berkelanjutan');
});

// 6. UMKM MITRA
Route::prefix('umkm-mitra')->name('umkm.')->group(function () {
    Route::get('/', [UmkmController::class, 'index'])->name('mitra');
    Route::get('/{slug}', [UmkmController::class, 'show'])->name('mitra.detail');
});
/*
|--------------------------------------------------------------------------
| PERUSAHAAN
|--------------------------------------------------------------------------
*/
Route::prefix('perusahaan')->name('perusahaan.')->group(function () {
    Route::get('/komisaris/{slug}', [PerusahaanController::class, 'komisarisDetail'])->name('komisaris.detail');
    Route::get('/direksi/{slug}', [PerusahaanController::class, 'direksiDetail'])->name('direksi.detail');
    Route::get('/{slug}', [PerusahaanController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| JARINGAN
|--------------------------------------------------------------------------
*/
Route::prefix('jaringan')->name('jaringan.')->group(function () {
    Route::get('/kantor', [JaringankantorController::class, 'index'])->name('kantor');
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
