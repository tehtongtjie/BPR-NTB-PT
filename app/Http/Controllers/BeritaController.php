<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Data Pusat Berita (Dummy)
     * Agar data di Index dan Show selalu sama.
     */
    private function getBeritaData()
    {
        return [
            [
                'id' => 1,
                'slug' => 'rapat-koordinasi-2026',
                'judul' => 'Rapat Koordinasi Tahunan PT. BPR NTB (Perseroda) 2026',
                'kategori' => 'Internal',
                'tanggal' => '20 Jan 2026',
                'gambar' => 'berita.png',
                'ringkasan' => 'Membangun sinergi untuk memperkuat ekonomi daerah NTB melalui inovasi perbankan berkelanjutan dan digitalisasi layanan.',
                'konten' => '<p>PT. BPR NTB (Perseroda) menyelenggarakan Rapat Koordinasi Tahunan (Rakornas) 2026 yang dihadiri oleh seluruh jajaran direksi dan kepala cabang di Mataram. Fokus utama tahun ini adalah percepatan transformasi digital.</p><p>Direktur Utama menyampaikan bahwa sinergi antar lini sangat penting untuk menghadapi tantangan ekonomi global dan memperkuat posisi BPR NTB sebagai mitra UMKM terbaik di NTB.</p>'
            ],
            [
                'id' => 2,
                'slug' => 'penyaluran-kredit-umkm',
                'judul' => 'Penyaluran Kredit Usaha Rakyat untuk UMKM Mataram',
                'kategori' => 'Ekonomi',
                'tanggal' => '18 Jan 2026',
                'gambar' => 'berita.png',
                'ringkasan' => 'BPR NTB terus berkomitmen mendukung pelaku usaha mikro dengan bunga rendah dan proses cepat.',
                'konten' => '<p>BPR NTB secara resmi meningkatkan kuota penyaluran kredit untuk sektor UMKM di wilayah Mataram dan sekitarnya. Program ini bertujuan untuk memberikan napas baru bagi para pengusaha kreatif pasca pemulihan ekonomi.</p>'
            ],
            [
                'id' => 3,
                'slug' => 'literasi-keuangan-siswa',
                'judul' => 'Edukasi Literasi Keuangan Siswa Sekolah Dasar',
                'kategori' => 'CSR',
                'tanggal' => '15 Jan 2026',
                'gambar' => 'berita.png',
                'ringkasan' => 'Mengenalkan pentingnya menabung sejak dini kepada generasi muda di berbagai pelosok daerah.',
                'konten' => '<p>Kegiatan CSR kali ini menyasar sekolah-sekolah dasar di Kabupaten Lombok Barat. Tim BPR NTB memberikan edukasi interaktif mengenai cara mengelola uang saku dan manfaat menabung di bank.</p>'
            ],
            [
                'id' => 4,
                'slug' => 'penghargaan-infobank-2025',
                'judul' => 'BPR NTB Raih Predikat Sangat Bagus versi Infobank',
                'kategori' => 'Penghargaan',
                'tanggal' => '10 Jan 2026',
                'gambar' => 'berita.png',
                'ringkasan' => 'Prestasi membanggakan kembali diraih atas kinerja keuangan yang solid dan transparan.',
                'konten' => '<p>Kinerja keuangan PT. BPR NTB (Perseroda) kembali mendapatkan pengakuan nasional. Penghargaan ini menjadi bukti dedikasi seluruh staf dalam memberikan layanan terbaik bagi nasabah.</p>'
            ]
        ];
    }

    /**
     * Menampilkan Daftar Berita
     */
    public function index()
    {
        $beritas = $this->getBeritaData();
        return view('pages.berita.index', compact('beritas'));
    }

    /**
     * Menampilkan Detail Berita berdasarkan Slug
     */
    public function show($slug)
    {
        $allBerita = $this->getBeritaData();
        
        // Cari berita yang slug-nya cocok
        $berita = collect($allBerita)->firstWhere('slug', $slug);

        // Jika tidak ditemukan, tampilkan halaman 404
        if (!$berita) {
            abort(404);
        }

        return view('pages.berita.show', compact('berita'));
    }
}