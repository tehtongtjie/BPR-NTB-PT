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
    RecommenderController,
    LaporanController
};

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\crypt;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\InterestRateController;
use App\Http\Controllers\Admin\AuctionController;
use App\Http\Controllers\PromoPublicController;
use App\Http\Controllers\Admin\JaringanController;
use App\Http\Controllers\WhistleBlowingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\PerusahaansController;



/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/test-navbar', fn() => view('users.test-navbar'));

/*
|--------------------------------------------------------------------------
| PRODUK & LAYANAN
|--------------------------------------------------------------------------
*/
// Tabungan
Route::get('/tabungan/{slug}', [TabunganController::class, 'show'])->name('tabungan.show');

Route::get('/produk/{slug}', [PromoPublicController::class, 'show'])
    ->name('produk.show');

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

// Simulasi Pages
Route::name('pages.simulasi.')->prefix('simulasi')->group(function () {
    Route::get('/deposito', fn() => view('pages.simulasi.deposito'))->name('deposito');
    Route::get('/kredit', fn() => view('pages.simulasi.kredit'))->name('kredit');

    // Pindahkan permintaan ke dalam group agar namanya konsisten
    Route::get('/{jenis}/permintaan', function ($jenis) {
        if (!in_array($jenis, ['deposito', 'kredit'])) abort(404);
        return view('users.simulasi.permintaan-simulasi', compact('jenis'));
    })->name('permintaan'); // Namanya akan menjadi pages.simulasi.permintaan
});

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
Route::get('/perusahaan/{slug}', [PerusahaanController::class, 'show'])
    ->name('perusahaan.show');

Route::get('/perusahaan/{slug}/{management:slug}', [PerusahaanController::class, 'detail'])
    ->whereIn('slug', ['komisaris', 'direksi'])
    ->name('perusahaan.detail');

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
| PENGADUAN (WBS)
|--------------------------------------------------------------------------
*/
Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
    Route::get('/alur', fn() => view('pages.pengaduan.alur-pengaduan'))
        ->name('alur');

    // Halaman Form
    Route::get('/whistle-blowing-system', [WhistleBlowingController::class, 'index'])
        ->name('wbs');

    // Proses Simpan (PASTIKAN NAMA RUTE ADALAH pengaduan.wbs.store)
    Route::post('/whistle-blowing-system', [WhistleBlowingController::class, 'store'])
        ->name('wbs.store');
});

Route::post('/kirim-pesan', [MessageController::class, 'store'])
    ->name('messages.store');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL (DASHBOARD + CRUD)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {

    //1. ===== MESSAGE (CONTACT FORM) =====
    Route::prefix('messages')->name('admin.messages.')->group(function () {
        Route::get('/', [MessageController::class, 'adminIndex'])->name('index');
        Route::get('/{id}', [MessageController::class, 'show'])->name('show');
        Route::delete('/{id}', [MessageController::class, 'destroy'])->name('destroy');
    });

    // 2. ===== WHISTLE BLOWING SYSTEM (URL: /admin/wbs) =====
    // Diletakkan di luar grup 'main' agar tidak nested/404
    Route::prefix('wbs')->name('admin.wbs.')->group(function () {
        Route::get('/', [WhistleBlowingController::class, 'adminIndex'])->name('index');
        Route::delete('/{id}', [WhistleBlowingController::class, 'destroy'])->name('destroy');
    });

    // 3. ===== JARINGAN KANTOR =====
    Route::prefix('jaringan')->name('jaringan.')->group(function () {
        Route::get('/', [JaringanController::class, 'index'])->name('index');
        Route::get('/create', [JaringanController::class, 'create'])->name('create');
        Route::post('/', [JaringanController::class, 'store'])->name('store');
        Route::get('/{kantor}/edit', [JaringanController::class, 'edit'])->name('edit');
        Route::put('/{kantor}', [JaringanController::class, 'update'])->name('update');
        Route::delete('/{kantor}', [JaringanController::class, 'destroy'])->name('destroy');
    });


    // 4. ===== MANAGEMENT (DIREKSI & KOMISARIS) =====
    Route::prefix('perusahaan')->name('perusahaan.')->group(function () {
        Route::get('/', [PerusahaansController::class, 'index'])->name('index');
        Route::get('/create', [PerusahaansController::class, 'create'])->name('create');
        Route::post('/', [PerusahaansController::class, 'store'])->name('store');
        Route::get('/{management}/edit', [PerusahaansController::class, 'edit'])->name('edit');
        Route::put('/{management}', [PerusahaansController::class, 'update'])->name('update');
        Route::delete('/{management}', [PerusahaansController::class, 'destroy'])->name('destroy');
    });
    // 5. ===== MAIN DASHBOARD & CONTENT =====
    Route::prefix('main')->name('admin.main.')->group(function () {

        Route::get('/', [MainController::class, 'index'])->name('index');

        // PROMO
        Route::prefix('promo')->name('promo.')->group(function () {
            Route::get('/', [PromoController::class, 'index'])->name('index');
            Route::get('/create', [PromoController::class, 'create'])->name('create');
            Route::post('/', [PromoController::class, 'store'])->name('store');
            Route::get('/{promo}/edit', [PromoController::class, 'edit'])->name('edit');
            Route::put('/{promo}', [PromoController::class, 'update'])->name('update');
            Route::delete('/{promo}', [PromoController::class, 'destroy'])->name('destroy');
        });

        // BANNER
        Route::prefix('banner')->name('banner.')->group(function () {
            Route::get('/', [BannerController::class, 'index'])->name('index');
            Route::get('/create', [BannerController::class, 'create'])->name('create');
            Route::post('/', [BannerController::class, 'store'])->name('store');
            Route::get('/{banner}/edit', [BannerController::class, 'edit'])->name('edit');
            Route::put('/{banner}', [BannerController::class, 'update'])->name('update');
            Route::delete('/{banner}', [BannerController::class, 'destroy'])->name('destroy');
        });

        // ARTICLE
        Route::prefix('article')->name('article.')->group(function () {
            Route::get('/', [ArticleController::class, 'index'])->name('index');
            Route::get('/create', [ArticleController::class, 'create'])->name('create');
            Route::post('/', [ArticleController::class, 'store'])->name('store');
            Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('edit');
            Route::put('/{article}', [ArticleController::class, 'update'])->name('update');
            Route::delete('/{article}', [ArticleController::class, 'destroy'])->name('destroy');
        });

        // LELANG
        Route::prefix('lelang')->name('lelang.')->group(function () {
            Route::get('/', [AuctionController::class, 'index'])->name('index');
            Route::get('/create', [AuctionController::class, 'create'])->name('create');
            Route::post('/', [AuctionController::class, 'store'])->name('store');
            Route::get('/{lelang}/edit', [AuctionController::class, 'edit'])->name('edit');
            Route::put('/{lelang}', [AuctionController::class, 'update'])->name('update');
            Route::delete('/{lelang}', [AuctionController::class, 'destroy'])->name('destroy');
        });

        // INTEREST RATE
        Route::prefix('interest-rate')->name('interest-rate.')->group(function () {
            Route::get('/', [InterestRateController::class, 'index'])->name('index');
            Route::get('/create', [InterestRateController::class, 'create'])->name('create');
            Route::post('/', [InterestRateController::class, 'store'])->name('store');
            Route::get('/{period}/edit', [InterestRateController::class, 'edit'])->name('edit');
            Route::put('/{period}', [InterestRateController::class, 'update'])->name('update');
            Route::delete('/{period}', [InterestRateController::class, 'destroy'])->name('destroy');
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

Route::get('/asisten-cerdas', [RecommenderController::class, 'index'])->name('recommender.index');
