<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GaleriController extends Controller
{
    /**
     * Data Pusat Galeri (Dummy)
     * Mengelompokkan foto dalam album/kategori
     */
    private function getGaleriData()
    {
        return [
            [
                'id' => 1,
                'album' => 'Kegiatan CSR 2026',
                'kategori' => 'CSR',
                'tanggal' => '15 Jan 2026',
                'cover' => 'berita.png',
                'jumlah_foto' => 12,
                'deskripsi' => 'Dokumentasi penyaluran bantuan pendidikan untuk siswa berprestasi di Lombok Barat.'
            ],
            [
                'id' => 2,
                'album' => 'Peresmian Kantor Cabang',
                'kategori' => 'Event',
                'tanggal' => '10 Jan 2026',
                'cover' => 'berita.png',
                'jumlah_foto' => 8,
                'deskripsi' => 'Momen peresmian wajah baru Kantor Cabang Utama Mataram dengan fasilitas digital.'
            ],
            [
                'id' => 3,
                'album' => 'Layanan Mobil Kas Keliling',
                'kategori' => 'Layanan',
                'tanggal' => '05 Jan 2026',
                'cover' => 'berita.png',
                'jumlah_foto' => 15,
                'deskripsi' => 'Aktivitas tim BPR NTB menjangkau pasar-pasar tradisional dengan layanan perbankan mobile.'
            ],
            [
                'id' => 4,
                'album' => 'Rapat Koordinasi Tahunan',
                'kategori' => 'Internal',
                'tanggal' => '02 Jan 2026',
                'cover' => 'berita.png',
                'jumlah_foto' => 20,
                'deskripsi' => 'Kilas balik sinergi jajaran direksi dan staf dalam Rakor tahunan 2026.'
            ],
        ];
    }

    public function index()
    {
        $albums = $this->getGaleriData();
        
        // Ambil kategori unik untuk filter di halaman view
        $categories = collect($albums)->pluck('kategori')->unique();

        return view('user.pages.galeri.index', compact('albums', 'categories'));
    }

    /**
     * Opsional: Jika Anda ingin melihat foto di dalam album tertentu
     */
    public function show($id)
    {
        $album = collect($this->getGaleriData())->firstWhere('id', $id);

        if (!$album) {
            abort(404);
        }

        // Dummy list foto di dalam album tersebut
        $photos = [
            ['url' => 'berita.png', 'caption' => 'Suasana pembukaan acara'],
            ['url' => 'berita.png', 'caption' => 'Penyerahan simbolis bantuan'],
            ['url' => 'berita.png', 'caption' => 'Foto bersama jajaran direksi'],
        ];

        return view('user.pages.galeri.show', compact('album', 'photos'));
    }
}