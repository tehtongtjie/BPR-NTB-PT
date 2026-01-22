<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimulasiController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\DepositoController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\JaringanKantorController;
use App\Http\Controllers\UmkmController;

/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('pages.home');
})->name('home');

/*
|--------------------------------------------------------------------------
| SIMULASI
|--------------------------------------------------------------------------
*/
Route::get('/simulasi/deposito', function () {
    return view('pages.simulasi.deposito');
})->name('pages.simulasi.deposito');

Route::get('/simulasi/kredit', function () {
    return view('pages.simulasi.kredit');
})->name('pages.simulasi.kredit');

/*
|--------------------------------------------------------------------------
| FORM PERMINTAAN SIMULASI
|--------------------------------------------------------------------------
*/
Route::get('/simulasi/{jenis}/permintaan', function ($jenis) {
    if (!in_array($jenis, ['deposito', 'kredit'])) {
        abort(404);
    }

    return view('users.simulasi.permintaan-simulasi', compact('jenis'));
})->name('simulasi.permintaan');

Route::post(
    '/simulasi/permintaan/submit',
    [SimulasiController::class, 'submit']
)->name('simulasi.permintaan.submit');

/*
|--------------------------------------------------------------------------
| DEPOSITO
|--------------------------------------------------------------------------
*/
Route::prefix('deposito')->group(function () {

    Route::get('/', [DepositoController::class, 'index'])
        ->name('deposito.index');

        // Add this line
    Route::get('/simulasi', [DepositoController::class, 'simulasi'])
        ->name('simulasi.deposito');

    Route::get('/{slug}', [DepositoController::class, 'show'])
        ->name('deposito.show');

});

/*
|--------------------------------------------------------------------------
| TABUNGAN
|--------------------------------------------------------------------------
*/
Route::get(
    '/tabungan/{slug}',
    [TabunganController::class, 'show']
)->name('tabungan.show');

/*
|--------------------------------------------------------------------------
| PINJAMAN
|--------------------------------------------------------------------------
*/
Route::get(
    '/pinjaman',
    [PinjamanController::class, 'index']
)->name('pinjaman.index');

        // Add this line
    Route::get('/simulasi', [DepositoController::class, 'simulasi'])
        ->name('simulasi.kredit');

Route::get(
    '/pinjaman/{slug}',
    [PinjamanController::class, 'show']
)->name('pinjaman.show');

/*
|--------------------------------------------------------------------------
| UMKM MITRA
|--------------------------------------------------------------------------
*/
Route::get(
    '/umkm-mitra',
    [UmkmController::class, 'index']
)->name('umkm.mitra');

/*
|--------------------------------------------------------------------------
| PENGADUAN (TANPA CONTROLLER)
|--------------------------------------------------------------------------
*/

Route::prefix('pengaduan')->group(function () {

    // Alur Pengaduan Nasabah
    Route::get('/alur', function () {
        // Pastikan nama folder di resources/views adalah 'pengaduan' (bukan pegaduan)
        return view('pages.pengaduan.alur-pengaduan');
    })->name('pengaduan.alur');

    // Whistle Blowing System (Halaman Form)
    Route::get('/whistle-blowing-system', function () {
        // Disarankan menggunakan kebab-case atau snake_case untuk nama file blade
        return view('pages.pengaduan.whistleblowingsystem');
    })->name('pengaduan.wbs');

    // Submit WBS (Proses Pengiriman)
    Route::post('/whistle-blowing-system', function () {
        // Logic simpan data nantinya ditaruh di sini
        return redirect()
            ->route('pengaduan.wbs')
            ->with('success', 'Laporan Anda berhasil dikirim. Terima kasih atas partisipasi Anda.');
    })->name('pengaduan.wbs.store');

});

/*
|--------------------------------------------------------------------------
| PERUSAHAAN – DETAIL
|--------------------------------------------------------------------------
*/
Route::get(
    '/perusahaan/komisaris/{slug}',
    [PerusahaanController::class, 'komisarisDetail']
)->name('perusahaan.komisaris.detail');

Route::get(
    '/perusahaan/direksi/{slug}',
    [PerusahaanController::class, 'direksiDetail']
)->name('perusahaan.direksi.detail');

/*
|--------------------------------------------------------------------------
| PERUSAHAAN – HALAMAN UMUM
|--------------------------------------------------------------------------
*/
Route::get(
    '/perusahaan/{slug}',
    [PerusahaanController::class, 'show']
)->name('perusahaan.show');


// jaringan kantor
Route::get('/jaringan-kantor', [JaringanKantorController::class, 'index'])
    ->name('jaringan.kantor');

    Route::get('/test-navbar', function () {
    return view('users.test-navbar');
});

