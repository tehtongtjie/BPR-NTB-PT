<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laporan;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            // ================= BERKELANJUTAN =================
            [
                'tipe'  => 'berkelanjutan',
                'jenis' => null,
                'tahun' => 2023,
                'judul' => 'Laporan Keuangan Berkelanjutan Tahun Buku 2023',
                'file'  => 'laporan/LAPORAN KEUANGAN BERKELANJUTAN TAHUN BUKU 2023.pdf',
            ],

            // ================= KEUANGAN (PUBLIKASI = KEUANGAN) =================

            // TRI I
            [
                'tipe'  => 'keuangan',
                'jenis' => 'triwulan',
                'tahun' => 2024,
                'judul' => 'Laporan Keuangan Triwulan I 2024',
                'file'  => 'laporan/Laporan Publikasi BPR NTB Triwulan I Thn.2024.pdf',
            ],
            [
                'tipe'  => 'keuangan',
                'jenis' => 'triwulan',
                'tahun' => 2025,
                'judul' => 'Laporan Keuangan Triwulan I 2025',
                'file'  => 'laporan/Laporan Publikasi BPR NTB Triwulan I Thn.2025.pdf',
            ],

            // TRI II
            [
                'tipe'  => 'keuangan',
                'jenis' => 'triwulan',
                'tahun' => 2022,
                'judul' => 'Laporan Keuangan Triwulan II 2022',
                'file'  => 'laporan/Laporan Publikasi BPR NTB Triwulan II Thn.2022.pdf',
            ],
            [
                'tipe'  => 'keuangan',
                'jenis' => 'triwulan',
                'tahun' => 2024,
                'judul' => 'Laporan Keuangan Triwulan II 2024',
                'file'  => 'laporan/Laporan Publikasi BPR NTB Triwulan II Thn.2024.pdf',
            ],
            [
                'tipe'  => 'keuangan',
                'jenis' => 'triwulan',
                'tahun' => 2025,
                'judul' => 'Laporan Keuangan Triwulan II 2025',
                'file'  => 'laporan/Laporan Publikasi BPR NTB Triwulan II Thn.2025.pdf',
            ],

            // TRI III
            [
                'tipe'  => 'keuangan',
                'jenis' => 'triwulan',
                'tahun' => 2022,
                'judul' => 'Laporan Keuangan Triwulan III 2022',
                'file'  => 'laporan/Laporan Publikasi BPR NTB Triwulan III Thn.2022.pdf',
            ],
            [
                'tipe'  => 'keuangan',
                'jenis' => 'triwulan',
                'tahun' => 2024,
                'judul' => 'Laporan Keuangan Triwulan III 2024',
                'file'  => 'laporan/Laporan Publikasi BPR NTB Triwulan III Thn.2024.pdf',
            ],
            [
                'tipe'  => 'keuangan',
                'jenis' => 'triwulan',
                'tahun' => 2025,
                'judul' => 'Laporan Keuangan Triwulan III 2025',
                'file'  => 'laporan/Laporan Publikasi BPR NTB Triwulan III Thn.2025.pdf',
            ],

            // TRI IV
            [
                'tipe'  => 'keuangan',
                'jenis' => 'triwulan',
                'tahun' => 2023,
                'judul' => 'Laporan Keuangan Triwulan IV 2023',
                'file'  => 'laporan/Laporan Publikasi BPR NTB Triwulan IV Thn.2023.pdf',
            ],
            [
                'tipe'  => 'keuangan',
                'jenis' => 'triwulan',
                'tahun' => 2024,
                'judul' => 'Laporan Keuangan Triwulan IV 2024',
                'file'  => 'laporan/Laporan Publikasi BPR NTB Triwulan IV Thn.2024.pdf',
            ],

            // ================= TATA KELOLA =================
            [
                'tipe'  => 'tata-kelola',
                'jenis' => null,
                'tahun' => 2023,
                'judul' => 'Laporan Tata Kelola Tahun Buku 2023',
                'file'  => 'laporan/Laporan Tata Kelola Tahun Buku 2023.pdf',
            ],
            [
                'tipe'  => 'tata-kelola',
                'jenis' => null,
                'tahun' => 2024,
                'judul' => 'Laporan Tata Kelola Tahun Buku 2024',
                'file'  => 'laporan/Laporan Tata Kelola Tahun Buku 2024.pdf',
            ],

        ];

        foreach ($data as $item) {
            Laporan::create($item);
        }
    }
}
