<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LelangController extends Controller
{
    // Kita simpan data di property agar bisa dipanggil oleh index maupun show
    private function getLelangData()
    {
        return [
            [
                'id' => 1,
                'slug' => 'lelang-audit-eksternal-2025',
                'judul' => 'Pengadaan Jasa Audit Eksternal Tahun Buku 2025',
                'kategori' => 'Jasa & Konsultan',
                'status' => 'Aktif',
                'deadline' => '15 Feb 2026',
                'gambar' => 'lelang-pengadaan.png',
                'ringkasan' => 'BPR NTB mengundang Kantor Akuntan Publik (KAP) profesional untuk berpartisipasi dalam proses seleksi audit laporan keuangan tahunan.',
                'deskripsi' => 'PT. BPR NTB (Perseroda) membuka kesempatan bagi Kantor Akuntan Publik (KAP) untuk mengajukan proposal jasa audit laporan keuangan periode tahun buku 2025. Proses ini dilakukan untuk menjamin transparansi dan akuntabilitas kinerja keuangan bank sesuai regulasi OJK.'
            ],
            [
                'id' => 2,
                'slug' => 'lelang-renovasi-kantor-mataram',
                'judul' => 'Renovasi Gedung Kantor Cabang Utama Mataram',
                'kategori' => 'Konstruksi',
                'status' => 'Aktif',
                'deadline' => '10 Feb 2026',
                'gambar' => 'lelang-renovasi.png',
                'ringkasan' => 'Pekerjaan peningkatan fasilitas gedung kantor untuk meningkatkan kenyamanan layanan bagi nasabah di wilayah Mataram.',
                'deskripsi' => 'Proyek renovasi mencakup perbaikan interior lantai 1 dan 2, sistem kelistrikan, serta fasad depan gedung Kantor Cabang Utama Mataram guna standarisasi branding BPR NTB.'
            ],
            [
                'id' => 3,
                'slug' => 'pengadaan-it-security-system',
                'judul' => 'Pengadaan Sistem Keamanan Jaringan & Server',
                'kategori' => 'Teknologi',
                'status' => 'Berakhir',
                'deadline' => '20 Jan 2026',
                'gambar' => 'lelang it.png',
                'ringkasan' => 'Upgrade infrastruktur keamanan data perbankan sesuai dengan standar terbaru regulasi Otoritas Jasa Keuangan.',
                'deskripsi' => 'Implementasi sistem keamanan siber terpadu termasuk Firewalls, Intrusion Detection Systems (IDS), dan enkripsi database nasabah.'
            ],
        ];
    }

    public function index()
    {
        $lelangs = $this->getLelangData();
        return view('pages.lelang.index', compact('lelangs'));
    }

    public function show($slug)
    {
        // Mencari data spesifik berdasarkan slug agar detail yang muncul sesuai dengan yang diklik
        $allLelang = $this->getLelangData();
        
        // Cari data yang slug-nya cocok
        $lelang = collect($allLelang)->firstWhere('slug', $slug);

        // Jika tidak ketemu, lempar ke halaman 404
        if (!$lelang) {
            abort(404);
        }

        return view('pages.lelang.show', compact('lelang'));
    }
}