<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    SimulasiController,
    TabunganController,
    PinjamanController,
    DepositoController,
    PerusahaanController,
    JaringanKantorController,
    UmkmController,
    RiplayController,
    BeritaController,
    GaleriController,
    LelangController,
    KarirController,
    RecommenderController,
    LaporanController
};
use App\Http\Controllers\WhistleBlowingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PromoPublicController;

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AuctionController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\InterestRateController;
use App\Http\Controllers\Admin\JaringanController;
use App\Http\Controllers\Admin\LaporansController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\PerusahaansController;
use App\Http\Controllers\Admin\JobRecruitController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\PublikasiController;
use App\Http\Controllers\Admin\UmkmsController;




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

    // Listing
    Route::get('/', [UmkmController::class, 'mitra'])
        ->name('mitra');

    // Detail
    Route::get('/{slug}', [UmkmController::class, 'show'])
        ->name('mitra.detail');
});

// Simulasi Pages
Route::name('user.pages.simulasi.')->prefix('simulasi')->group(function () {
    Route::get('/deposito', fn() => view('user.pages.simulasi.deposito'))->name('deposito');
    Route::get('/kredit', fn() => view('user.pages.simulasi.kredit'))->name('kredit');

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

// Rute untuk Halaman Riplay
Route::get('/riplay', [RiplayController::class, 'index'])->name('riplay.index');
// Rute untuk Berita (Index & Detail)
Route::prefix('berita')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/{slug}', [BeritaController::class, 'show'])->name('berita.show');
});

// 3. DAFTAR GALERI
Route::prefix('galeri')->name('galeri.')->group(function () {
    Route::get('/', [GaleriController::class, 'index'])->name('index');
    Route::get('/{slug}', [GaleriController::class, 'show'])->name('show');
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

// Ubah 'umkm-mitra' menjadi 'umkm' agar URL lebih pendek
Route::prefix('umkm')->name('umkm.')->group(function () {
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
    // Menampilkan halaman Alur
    Route::get('/alur', fn() => view('user.pages.pengaduan.alur-pengaduan'))->name('alur');

    // Menampilkan halaman Form WBS (Menggunakan Controller agar lebih rapi)
    Route::get('/whistle-blowing-system', [WhistleBlowingController::class, 'index'])->name('wbs');

    // Memproses pengiriman data (Mengarah ke fungsi store di Controller)
    Route::post('/whistle-blowing-system', [WhistleBlowingController::class, 'store'])->name('wbs.store');

    // Tambahkan middleware throttle:3,1 di sini
    Route::post('/whistle-blowing-system', [WhistleBlowingController::class, 'store'])
        ->middleware('throttle:3,1')
        ->name('wbs.store');
});

Route::post('/kirim-pesan', [MessageController::class, 'store'])
    ->name('messages.store');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL (DASHBOARD + CRUD)
|--------------------------------------------------------------------------
*/
// Route::prefix('admin')->group(function () {

//     //1. ===== MESSAGE (CONTACT FORM) =====
//     Route::prefix('messages')->name('admin.messages.')->group(function () {
//         Route::get('/', [MessageController::class, 'adminIndex'])->name('index');
//         Route::get('/{id}', [MessageController::class, 'show'])->name('show');
//         Route::delete('/{id}', [MessageController::class, 'destroy'])->name('destroy');
//     });

//     // 2. ===== JARINGAN KANTOR =====
//     Route::prefix('jaringan')->name('jaringan.')->group(function () {
//         Route::get('/', [JaringanController::class, 'index'])->name('index');
//         Route::get('/create', [JaringanController::class, 'create'])->name('create');
//         Route::post('/', [JaringanController::class, 'store'])->name('store');
//         Route::get('/{kantor}/edit', [JaringanController::class, 'edit'])->name('edit');
//         Route::put('/{kantor}', [JaringanController::class, 'update'])->name('update');
//         Route::delete('/{kantor}', [JaringanController::class, 'destroy'])->name('destroy');
//     });


//     // 3. ===== MANAGEMENT (DIREKSI & KOMISARIS) =====
//     Route::prefix('perusahaan')->name('perusahaan.')->group(function () {
//         Route::get('/', [PerusahaansController::class, 'index'])->name('index');
//         Route::get('/create', [PerusahaansController::class, 'create'])->name('create');
//         Route::post('/', [PerusahaansController::class, 'store'])->name('store');
//         Route::get('/{management}/edit', [PerusahaansController::class, 'edit'])->name('edit');
//         Route::put('/{management}', [PerusahaansController::class, 'update'])->name('update');
//         Route::delete('/{management}', [PerusahaansController::class, 'destroy'])->name('destroy');
//     });

//     Route::prefix('publikasi')->name('admin.publikasi.')->group(function () {

//         Route::get('/', [PublikasiController::class, 'index'])->name('index');

//         // LAPORAN
//         Route::prefix('laporan')->name('laporan.')->group(function () {
//             Route::get('/', [LaporansController::class, 'index'])->name('index');
//             Route::get('/create', [LaporansController::class, 'create'])->name('create');
//             Route::post('/', [LaporansController::class, 'store'])->name('store');
//             Route::get('/{laporan}/edit', [LaporansController::class, 'edit'])->name('edit');
//             Route::put('/{laporan}', [LaporansController::class, 'update'])->name('update');
//             Route::delete('/{laporan}', [LaporansController::class, 'destroy'])->name('destroy');
//         });
//     });


//     // 5. ===== MAIN DASHBOARD & CONTENT =====
// Route::prefix('main')->name('admin.main.')->group(function () {

//     Route::get('/', [MainController::class, 'index'])->name('index');

//     // PROMO
//     Route::prefix('promo')->name('promo.')->group(function () {
//         Route::get('/', [PromoController::class, 'index'])->name('index');
//         Route::get('/create', [PromoController::class, 'create'])->name('create');
//         Route::post('/', [PromoController::class, 'store'])->name('store');
//         Route::get('/{promo}/edit', [PromoController::class, 'edit'])->name('edit');
//         Route::put('/{promo}', [PromoController::class, 'update'])->name('update');
//         Route::delete('/{promo}', [PromoController::class, 'destroy'])->name('destroy');
//     });

//     // BANNER
//     Route::prefix('banner')->name('banner.')->group(function () {
//         Route::get('/', [BannerController::class, 'index'])->name('index');
//         Route::get('/create', [BannerController::class, 'create'])->name('create');
//         Route::post('/', [BannerController::class, 'store'])->name('store');
//         Route::get('/{banner}/edit', [BannerController::class, 'edit'])->name('edit');
//         Route::put('/{banner}', [BannerController::class, 'update'])->name('update');
//         Route::delete('/{banner}', [BannerController::class, 'destroy'])->name('destroy');
//     });

//     // ARTICLE
//     Route::prefix('article')->name('article.')->group(function () {
//         Route::get('/', [ArticleController::class, 'index'])->name('index');
//         Route::get('/create', [ArticleController::class, 'create'])->name('create');
//         Route::post('/', [ArticleController::class, 'store'])->name('store');
//         Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('edit');
//         Route::put('/{article}', [ArticleController::class, 'update'])->name('update');
//         Route::delete('/{article}', [ArticleController::class, 'destroy'])->name('destroy');
//     });

//     // LELANG
//     Route::prefix('lelang')->name('lelang.')->group(function () {
//         Route::get('/', [AuctionController::class, 'index'])->name('index');
//         Route::get('/create', [AuctionController::class, 'create'])->name('create');
//         Route::post('/', [AuctionController::class, 'store'])->name('store');
//         Route::get('/{lelang}/edit', [AuctionController::class, 'edit'])->name('edit');
//         Route::put('/{lelang}', [AuctionController::class, 'update'])->name('update');
//         Route::delete('/{lelang}', [AuctionController::class, 'destroy'])->name('destroy');
//     });

//     // INTEREST RATE
//     Route::prefix('interest-rate')->name('interest-rate.')->group(function () {
//         Route::get('/', [InterestRateController::class, 'index'])->name('index');
//         Route::get('/create', [InterestRateController::class, 'create'])->name('create');
//         Route::post('/', [InterestRateController::class, 'store'])->name('store');
//         Route::get('/{period}/edit', [InterestRateController::class, 'edit'])->name('edit');
//         Route::put('/{period}', [InterestRateController::class, 'update'])->name('update');
//         Route::delete('/{period}', [InterestRateController::class, 'destroy'])->name('destroy');
//     });
// });
//     // 6. ===== UMKM =====

//     Route::prefix('umkms')->name('umkms.')->group(function () {

//         Route::get('/', [UmkmsController::class, 'index'])->name('index');
//         Route::get('/create', [UmkmsController::class, 'create'])->name('create');
//         Route::post('/', [UmkmsController::class, 'store'])->name('store');
//         Route::get('/{umkm}/edit', [UmkmsController::class, 'edit'])->name('edit');
//         Route::put('/{umkm}', [UmkmsController::class, 'update'])->name('update');
//         Route::delete('/{umkm}', [UmkmsController::class, 'destroy'])->name('destroy');
//     });
// });


/*
|--------------------------------------------------------------------------
| ADMIN PANEL (DASHBOARD + CRUD)
|--------------------------------------------------------------------------
*/

// Gerbang login admin: hanya token yang valid yang boleh membuka halaman login.
Route::get('/admin', function (Request $request) {
    $token = (string) $request->query('token', '');

    if (!hash_equals('abcd', $token)) {
        abort(404);
    }

    return redirect()->to('/login?token=' . urlencode(Crypt::encryptString('abcd')));
})->name('admin.gate');

Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/', function () {
        $user = Auth::user();
        $role = $user ? $user->role : 'guest';
        return match ($role) {
            'it', 'sekper' => redirect()->to('/admin/main'),
            'bisnis'       => redirect()->to('/admin/umkms'),
            default        => redirect()->to('/admin/main'),
        };
    });

    // 1. ===== AKSES DASHBOARD & KONTEN (IT & SEKPER) =====
    // Grup ini untuk role yang diperbolehkan melihat statistik utama & data perusahaan
    Route::middleware(['can:admin-sekper'])->group(function () {

        // DASHBOARD UTAMA
        Route::get('/main', [MainController::class, 'index'])->name('admin.main.index');

        // JARINGAN KANTOR
        Route::prefix('jaringan')->name('jaringan.')->group(function () {
            Route::get('/', [JaringanController::class, 'index'])->name('index');
            Route::get('/create', [JaringanController::class, 'create'])->name('create');
            Route::post('/', [JaringanController::class, 'store'])->name('store');
            Route::get('/{kantor}/edit', [JaringanController::class, 'edit'])->name('edit');
            Route::put('/{kantor}', [JaringanController::class, 'update'])->name('update');
            Route::delete('/{kantor}', [JaringanController::class, 'destroy'])->name('destroy');
        });

        // MANAGEMENT (DIREKSI & KOMISARIS)
        Route::prefix('perusahaan')->name('perusahaan.')->group(function () {
            Route::get('/', [PerusahaansController::class, 'index'])->name('index');
            Route::get('/create', [PerusahaansController::class, 'create'])->name('create');
            Route::post('/', [PerusahaansController::class, 'store'])->name('store');
            Route::get('/{management}/edit', [PerusahaansController::class, 'edit'])->name('edit');
            Route::put('/{management}', [PerusahaansController::class, 'update'])->name('update');
            Route::delete('/{management}', [PerusahaansController::class, 'destroy'])->name('destroy');
        });

        // PUBLIKASI & LAPORAN
        Route::prefix('publikasi')->name('admin.publikasi.')->group(function () {
            Route::get('/', [PublikasiController::class, 'index'])->name('index');
            Route::prefix('laporan')->name('laporan.')->group(function () {
                Route::get('/', [LaporansController::class, 'index'])->name('index');
                Route::get('/create', [LaporansController::class, 'create'])->name('create');
                Route::post('/', [LaporansController::class, 'store'])->name('store');
                Route::get('/{laporan}/edit', [LaporansController::class, 'edit'])->name('edit');
                Route::put('/{laporan}', [LaporansController::class, 'update'])->name('update');
                Route::delete('/{laporan}', [LaporansController::class, 'destroy'])->name('destroy');
            });
        });

        // MAIN CONTENT (PROMO, BANNER, ARTICLE, LELANG, INTEREST RATE)
        Route::name('admin.main.')->group(function () {
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

        Route::prefix('galeri')->name('admin.galeri.')->group(function () {
            Route::get('/', [AdminGaleriController::class, 'index'])->name('index');
            Route::get('/create', [AdminGaleriController::class, 'create'])->name('create');
            Route::post('/', [AdminGaleriController::class, 'store'])->name('store');
            Route::get('/{galeri}/edit', [AdminGaleriController::class, 'edit'])->name('edit');
            Route::put('/{galeri}', [AdminGaleriController::class, 'update'])->name('update');
            Route::delete('/{galeri}', [AdminGaleriController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('job-recruits')->name('admin.jobs.')->group(function () {
            Route::get('/', [JobRecruitController::class, 'index'])->name('index');
            Route::get('/create', [JobRecruitController::class, 'create'])->name('create');
            Route::post('/', [JobRecruitController::class, 'store'])->name('store');
            Route::get('/{jobRecruit}/edit', [JobRecruitController::class, 'edit'])->name('edit');
            Route::put('/{jobRecruit}', [JobRecruitController::class, 'update'])->name('update');
            Route::delete('/{jobRecruit}', [JobRecruitController::class, 'destroy'])->name('destroy');
        });
    });

    // 2. ===== KHUSUS IT ONLY (TEKNIS) =====   
    // Hanya IT yang bisa mengelola pesan masuk, banner utama, dan suku bunga
        Route::middleware(['can:admin-it'])->group(function () {
            // MESSAGES
            Route::prefix('messages')->name('admin.messages.')->group(function () {
                Route::post('/bulk-story', [MessageController::class, 'bulkStory'])->name('bulkStory');
                Route::get('/', [MessageController::class, 'adminIndex'])->name('index');
                Route::get('/{id}', [MessageController::class, 'show'])->name('show');
                Route::delete('/{id}', [MessageController::class, 'destroy'])->name('destroy');
            });
        Route::prefix('umkms')->name('umkms.')->group(function () {
            Route::get('/', [UmkmsController::class, 'index'])->name('index');
            Route::get('/create', [UmkmsController::class, 'create'])->name('create');
            Route::post('/', [UmkmsController::class, 'store'])->name('store');
            Route::get('/{umkm}/edit', [UmkmsController::class, 'edit'])->name('edit');
            Route::put('/{umkm}', [UmkmsController::class, 'update'])->name('update');
            Route::delete('/{umkm}', [UmkmsController::class, 'destroy'])->name('destroy');
        });
    });

    // 3. ===== AKSES BISNIS & IT =====
    // Bisnis hanya fokus pada UMKM dan Promo
    Route::middleware(['can:admin-bisnis'])->group(function () {
        Route::prefix('umkms')->name('umkms.')->group(function () {
            Route::get('/', [UmkmsController::class, 'index'])->name('index');
            Route::get('/create', [UmkmsController::class, 'create'])->name('create');
            Route::post('/', [UmkmsController::class, 'store'])->name('store');
            Route::get('/{umkm}/edit', [UmkmsController::class, 'edit'])->name('edit');
            Route::put('/{umkm}', [UmkmsController::class, 'update'])->name('update');
            Route::delete('/{umkm}', [UmkmsController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('main/promo')->name('admin.main.promo.')->group(function () {
            Route::get('/', [PromoController::class, 'index'])->name('index');
            Route::get('/create', [PromoController::class, 'create'])->name('create');
            Route::post('/', [PromoController::class, 'store'])->name('store');
            Route::get('/{promo}/edit', [PromoController::class, 'edit'])->name('edit');
            Route::put('/{promo}', [PromoController::class, 'update'])->name('update');
            Route::delete('/{promo}', [PromoController::class, 'destroy'])->name('destroy');
        });
    });
});

// login admin (POST)
Route::post('/admin/{token}', [AdminAuthController::class, 'login'])
    ->name('admin.auth.login');

Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout(); // Pastikan guardnya sama dengan saat login
    return redirect()->to('/login?token=' . urlencode(Crypt::encryptString('abcd')));
})->name('logout');

Route::get('/asisten-cerdas', [RecommenderController::class, 'index'])->name('recommender.index');
