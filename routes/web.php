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
use Illuminate\Support\Facades\crypt;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\InterestRateController;
use App\Http\Controllers\Admin\AuctionController;




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




/*
|--------------------------------------------------------------------------
| ADMIN PANEL (DASHBOARD + CRUD)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {

    // ===== MAIN DASHBOARD =====
    Route::prefix('main')->name('admin.main.')->group(function () {

        Route::get('/', [MainController::class, 'index'])
            ->name('index');

        // ===== PROMO (SUDAH BENAR) =====
        Route::prefix('promo')->name('promo.')->group(function () {

            Route::get('/', [PromoController::class, 'index'])->name('index');
            Route::get('/create', [PromoController::class, 'create'])->name('create');
            Route::post('/', [PromoController::class, 'store'])->name('store');
            Route::get('/{promo}/edit', [PromoController::class, 'edit'])->name('edit');
            Route::put('/{promo}', [PromoController::class, 'update'])->name('update');
            Route::delete('/{promo}', [PromoController::class, 'destroy'])->name('destroy');
        });

        // ===== BANNER (FIX TOTAL) =====
        Route::prefix('banner')->name('banner.')->group(function () {

            Route::get('/', [BannerController::class, 'index'])->name('index');
            Route::get('/create', [BannerController::class, 'create'])->name('create');
            Route::post('/', [BannerController::class, 'store'])->name('store');
            Route::get('/{banner}/edit', [BannerController::class, 'edit'])->name('edit');
            Route::put('/{banner}', [BannerController::class, 'update'])->name('update');
            Route::delete('/{banner}', [BannerController::class, 'destroy'])->name('destroy');
        });

        // ===== ARTICLE =====
        Route::prefix('article')->name('article.')->group(function () {

            Route::get('/', [ArticleController::class, 'index'])->name('index');
            Route::get('/create', [ArticleController::class, 'create'])->name('create');
            Route::post('/', [ArticleController::class, 'store'])->name('store');
            Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('edit');
            Route::put('/{article}', [ArticleController::class, 'update'])->name('update');
            Route::delete('/{article}', [ArticleController::class, 'destroy'])->name('destroy');
        });
        // ===== LELANG =====
        Route::prefix('lelang')->name('lelang.')->group(function () {
            Route::get('/', [AuctionController::class, 'index'])->name('index');
            Route::get('/create', [AuctionController::class, 'create'])->name('create');
            Route::post('/', [AuctionController::class, 'store'])->name('store');
            Route::get('/{lelang}/edit', [AuctionController::class, 'edit'])->name('edit');
            Route::put('/{lelang}', [AuctionController::class, 'update'])->name('update');
            Route::delete('/{lelang}', [AuctionController::class, 'destroy'])->name('destroy');
        });
            // ===== INTEREST RATE (SUKU BUNGA) =====
        Route::prefix('interest-rate')->name('interest-rate.')->group(function () {

            Route::get('/', [InterestRateController::class, 'index'])->name('index');
            Route::get('/create', [InterestRateController::class, 'create'])->name('create');
            Route::post('/', [InterestRateController::class, 'store'])->name('store');
            Route::get('/{interestRate}/edit', [InterestRateController::class, 'edit'])->name('edit');
            Route::put('/{interestRate}', [InterestRateController::class, 'update'])->name('update');
            Route::delete('/{interestRate}', [InterestRateController::class, 'destroy'])->name('destroy');

            // ===== DETAIL SUKU BUNGA =====
            Route::post('/{interestRate}/detail',
                [InterestRateController::class, 'storeDetail']
            )->name('detail.store');

            Route::delete('/detail/{detail}',
                [InterestRateController::class, 'destroyDetail']
            )->name('detail.destroy');
        });
    });
});


// login admin (POST)
Route::post('/admin/{token}', [AdminAuthController::class, 'login'])
    ->name('admin.auth.login');



// Path admin secured access
Route::get('/admin/{pathToken?}', function (Request $request, $pathToken = null) {

    if ($request->query('token')) {

        $plainToken = $request->query('token');

        if ($plainToken !== 'abcd') {
            abort(404);
        }
        $encodedToken = Crypt::encryptString($plainToken);

        return redirect('/admin/' . urlencode($encodedToken));
    }

    if ($pathToken) {
        try {
            $decoded = Crypt::decryptString($pathToken);

            if ($decoded !== 'abcd') {
                abort(404);
            }
        } catch (\Exception $e) {
            abort(404);
        }

        // dibagian return view ini ganti jadi admin dashboard
        return view('admin.auth.login');
    }

    abort(404);
});
