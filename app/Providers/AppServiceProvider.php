<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share data $menus ke semua views
        View::share('menus', [
            'Produk & Layanan' => [
                ['label' => 'Tabungan', 'route' => 'tabungan.show', 'param' => 'tabunganku', 'icon' => 'bi-wallet2'],
                ['label' => 'Deposito', 'route' => 'deposito.index', 'icon' => 'bi-piggy-bank'],
                ['label' => 'Pinjaman', 'route' => 'pinjaman.index', 'icon' => 'bi-cash-stack'],
                ['label' => 'UMKM Mitra', 'route' => 'umkm.mitra', 'icon' => 'bi-shop'],
                [
                    'label' => 'Simulasi',
                    'icon' => 'bi-calculator',
                    'children' => [
                        ['label' => 'Simulasi Deposito', 'route' => 'pages.simulasi.deposito', 'icon' => 'bi-calculator'],
                        ['label' => 'Simulasi Kredit', 'route' => 'pages.simulasi.kredit', 'icon' => 'bi-calculator-fill'],
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
                ['label' => 'Pengumuman Lelang', 'route' => 'lelang.index', 'icon' => 'bi-megaphone'],
                ['label' => 'Informasi Karier', 'route' => 'karir.index', 'icon' => 'bi-person-lines-fill'],
                [
                    'label' => 'Laporan',
                    'icon' => 'bi-file-earmark-bar-graph',
                    'children' => [
                        ['label' => 'Laporan Tahunan', 'route' => 'laporan.tahunan', 'icon' => 'bi-file-earmark-pdf'],
                        ['label' => 'Laporan Keuangan', 'route' => 'laporan.keuangan', 'icon' => 'bi-cash-coin'],
                        ['label' => 'Laporan GCG', 'route' => 'laporan.gcg', 'icon' => 'bi-shield-check'],
                    ],
                ],
                ['label' => 'E-Procurement', 'route' => 'eproc.index', 'icon' => 'bi-cart-check'],
            ],
            'Jaringan' => [
                ['label' => 'Jaringan Kantor', 'route' => 'jaringan.kantor', 'icon' => 'bi-geo-alt']
            ],
            'Pengaduan' => [
                ['label' => 'Alur Pengaduan', 'route' => 'pengaduan.alur', 'icon' => 'bi-diagram-3'],
                ['label' => 'Whistle Blowing System', 'route' => 'pengaduan.wbs', 'icon' => 'bi-shield-lock'],
            ],
        ]);
    }
}