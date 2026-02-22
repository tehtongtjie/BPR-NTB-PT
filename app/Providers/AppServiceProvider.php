<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Promo;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        View::share('menus', [
            'Produk & Layanan' => [
                ['label' => 'Tabungan', 'route' => 'tabungan.show', 'param' => 'tabunganku', 'icon' => 'bi-wallet2'],
                ['label' => 'Deposito', 'route' => 'deposito.index', 'icon' => 'bi-piggy-bank'],
                ['label' => 'Pinjaman', 'route' => 'pinjaman.index', 'icon' => 'bi-cash-stack'],
                ['label' => 'Mitra UMKM', 'route' => 'umkm.mitra', 'icon' => 'bi-shop-window'],
                [
                    'label' => 'Simulasi',
                    'icon' => 'bi-calculator',
                    'children' => [
                        ['label' => 'Simulasi Deposito', 'route' => 'user.pages.simulasi.deposito', 'icon' => 'bi-calculator'],
                        ['label' => 'Simulasi Kredit', 'route' => 'user.pages.simulasi.kredit', 'icon' => 'bi-calculator-fill'],
                    ],
                ],
            ],
            'Perusahaan' => [
                ['label' => 'Sejarah', 'route' => 'perusahaan.show', 'param' => 'sejarah', 'icon' => 'bi-clock-history'],
                ['label' => 'Visi & Misi', 'route' => 'perusahaan.show', 'param' => 'visi-misi', 'icon' => 'bi-bullseye'],
                ['label' => 'Budaya Perusahaan', 'route' => 'perusahaan.show', 'param' => 'budaya', 'icon' => 'bi-award'],
                ['label' => 'Dewan Komisaris', 'route' => 'perusahaan.show', 'param' => 'komisaris', 'icon' => 'bi-people'],
                ['label' => 'Dewan Direksi', 'route' => 'perusahaan.show', 'param' => 'direksi', 'icon' => 'bi-person-badge'],
                ['label' => 'Tata Kelola (GCG)', 'route' => 'perusahaan.show', 'param' => 'tata-kelola', 'icon' => 'bi-shield-check'],
            ],
            'Publikasi' => [
                ['label' => 'Berita Terkini', 'route' => 'berita.index', 'icon' => 'bi-newspaper'],
                ['label' => 'Galeri', 'route' => 'galeri.index', 'icon' => 'bi-images'],
                ['label' => 'Riplay', 'route' => 'riplay.index', 'icon' => 'bi-file-earmark-text'],
                ['label' => 'Pengumuman Lelang', 'route' => 'lelang.index', 'icon' => 'bi-megaphone'],
                ['label' => 'Informasi Karier', 'route' => 'karir.index', 'icon' => 'bi-person-lines-fill'],
                [
                    'label' => 'Laporan',
                    'icon' => 'bi-journal-text',
                    'children' => [
                        ['label' => 'Lap. Keuangan', 'route' => 'laporan.index', 'param' => 'keuangan'],
                        ['label' => 'Lap. Tata Kelola', 'route' => 'laporan.index', 'param' => 'tata-kelola'],
                        ['label' => 'Lap. Berkelanjutan', 'route' => 'laporan.index', 'param' => 'berkelanjutan'],
                    ]
                ],
            ],
            'Jaringan' => [
                ['label' => 'Jaringan Kantor', 'route' => 'jaringan.kantor', 'icon' => 'bi-geo-alt']
            ],
            'Pengaduan' => [
                ['label' => 'Alur Pengaduan', 'route' => 'pengaduan.alur', 'icon' => 'bi-diagram-3'],
                ['label' => 'Whistle Blowing System', 'route' => 'pengaduan.wbs', 'icon' => 'bi-shield-lock'],
            ],
        ]);
        View::composer('user.components.sidebar-produk', function ($view) {
            $view->with(
                'sidebarPromos',
                Promo::where('is_active', true)
                    ->orderBy('title')
                    ->get(['title', 'slug'])
            );
        });
    }
}
