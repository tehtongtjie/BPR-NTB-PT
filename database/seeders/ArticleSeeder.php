<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'slug' => 'rapat-koordinasi-2026',
                'title' => 'Rapat Koordinasi Tahunan PT. BPR NTB (Perseroda) 2026',
                'category' => 'INTERNAL',
                'author' => 'Humas BPR NTB',
                'thumbnail' => 'images/berita.png',
                'excerpt' => 'Membangun sinergi untuk memperkuat ekonomi daerah NTB melalui inovasi perbankan berkelanjutan dan digitalisasi layanan.',
                'content' => '<p>PT. BPR NTB (Perseroda) menyelenggarakan Rapat Koordinasi Tahunan (Rakornas) 2026 yang dihadiri oleh seluruh jajaran direksi dan kepala cabang di Mataram. Fokus utama tahun ini adalah percepatan transformasi digital.</p>
                             <p>Direktur Utama menyampaikan bahwa sinergi antar lini sangat penting untuk menghadapi tantangan ekonomi global dan memperkuat posisi BPR NTB sebagai mitra UMKM terbaik di NTB.</p>',
                'published_at' => '2026-01-20',
                'is_published' => true,
            ],
            [
                'slug' => 'penyaluran-kredit-umkm',
                'title' => 'Penyaluran Kredit Usaha Rakyat untuk UMKM Mataram',
                'category' => 'EKONOMI',
                'author' => 'Humas BPR NTB',
                'thumbnail' => 'images/berita.png',
                'excerpt' => 'BPR NTB terus berkomitmen mendukung pelaku usaha mikro dengan bunga rendah dan proses cepat.',
                'content' => '<p>BPR NTB secara resmi meningkatkan kuota penyaluran kredit untuk sektor UMKM di wilayah Mataram dan sekitarnya. Program ini bertujuan untuk memberikan napas baru bagi para pengusaha kreatif pasca pemulihan ekonomi.</p>',
                'published_at' => '2026-01-18',
                'is_published' => true,
            ],
            [
                'slug' => 'literasi-keuangan-siswa',
                'title' => 'Edukasi Literasi Keuangan Siswa Sekolah Dasar',
                'category' => 'CSR',
                'author' => 'Humas BPR NTB',
                'thumbnail' => 'images/berita.png',
                'excerpt' => 'Mengenalkan pentingnya menabung sejak dini kepada generasi muda di berbagai pelosok daerah.',
                'content' => '<p>Kegiatan CSR kali ini menyasar sekolah-sekolah dasar di Kabupaten Lombok Barat. Tim BPR NTB memberikan edukasi interaktif mengenai cara mengelola uang saku dan manfaat menabung di bank.</p>',
                'published_at' => '2026-01-15',
                'is_published' => true,
            ],
            [
                'slug' => 'penghargaan-infobank-2025',
                'title' => 'BPR NTB Raih Predikat Sangat Bagus versi Infobank',
                'category' => 'PENGHARGAAN',
                'author' => 'Humas BPR NTB',
                'thumbnail' => 'images/berita.png',
                'excerpt' => 'Prestasi membanggakan kembali diraih atas kinerja keuangan yang solid dan transparan.',
                'content' => '<p>Kinerja keuangan PT. BPR NTB (Perseroda) kembali mendapatkan pengakuan nasional. Penghargaan ini menjadi bukti dedikasi seluruh staf dalam memberikan layanan terbaik bagi nasabah.</p>',
                'published_at' => '2026-01-10',
                'is_published' => true,
            ],
        ];

        foreach ($articles as $article) {
            Article::updateOrCreate(
                ['slug' => $article['slug']], // supaya tidak dobel kalau seed ulang
                $article
            );
        }
    }
}
