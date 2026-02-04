<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Lelang;
use App\Models\LelangRequirement;

class LelangSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'title' => 'Pengadaan Jasa Audit Eksternal Tahun Buku 2025',
                'slug' => 'lelang-audit-eksternal-2025',
                'category' => 'Jasa & Konsultan',
                'status' => 'aktif',
                'deadline' => '2026-02-15',
                'banner' => 'images/lelang-pengadaan.png',
                'short_desc' => 'BPR NTB mengundang Kantor Akuntan Publik (KAP) profesional untuk berpartisipasi dalam proses seleksi audit laporan keuangan tahunan.',
                'description' => 'PT. BPR NTB (Perseroda) membuka kesempatan bagi Kantor Akuntan Publik (KAP) untuk mengajukan proposal jasa audit laporan keuangan periode tahun buku 2025. Proses ini dilakukan untuk menjamin transparansi dan akuntabilitas kinerja keuangan bank sesuai regulasi OJK.',
                'requirements' => [
                    'Terdaftar dan berizin OJK',
                    'Memiliki pengalaman audit perbankan minimal 3 tahun',
                    'Memiliki SIUP / NIB aktif',
                ],
            ],
            [
                'title' => 'Renovasi Gedung Kantor Cabang Utama Mataram',
                'slug' => 'lelang-renovasi-kantor-mataram',
                'category' => 'Konstruksi',
                'status' => 'aktif',
                'deadline' => '2026-02-10',
                'banner' => 'images/lelang-pengadaan.png',
                'short_desc' => 'Pekerjaan peningkatan fasilitas gedung kantor untuk meningkatkan kenyamanan layanan bagi nasabah di wilayah Mataram.',
                'description' => 'Proyek renovasi mencakup perbaikan interior lantai 1 dan 2, sistem kelistrikan, serta fasad depan gedung Kantor Cabang Utama Mataram guna standarisasi branding BPR NTB.',
                'requirements' => [
                    'Badan usaha berbadan hukum',
                    'Memiliki pengalaman proyek gedung minimal 2 proyek',
                    'Tenaga ahli bersertifikat',
                ],
            ],
            [
                'title' => 'Pengadaan Sistem Keamanan Jaringan & Server',
                'slug' => 'pengadaan-it-security-system',
                'category' => 'Teknologi',
                'status' => 'selesai',
                'deadline' => '2026-01-20',
                'banner' => 'images/lelang-pengadaan.png',
                'short_desc' => 'Upgrade infrastruktur keamanan data perbankan sesuai dengan standar terbaru regulasi Otoritas Jasa Keuangan.',
                'description' => 'Implementasi sistem keamanan siber terpadu termasuk Firewalls, Intrusion Detection Systems (IDS), dan enkripsi database nasabah.',
                'requirements' => [
                    'Berpengalaman di bidang keamanan siber',
                    'Memiliki sertifikasi ISO 27001',
                    'Tim teknis bersertifikat',
                ],
            ],
        ];

        foreach ($data as $item) {
            $lelang = Lelang::create([
                'title'        => $item['title'],
                'slug'         => $item['slug'],
                'category'     => $item['category'],
                'status'       => $item['status'],
                'deadline'     => Carbon::parse($item['deadline']),
                'banner'       => $item['banner'],
                'short_desc'   => $item['short_desc'],
                'description'  => $item['description'],
                'is_published' => true,
            ]);

            foreach ($item['requirements'] as $req) {
                LelangRequirement::create([
                    'lelang_id' => $lelang->id,
                    'title'     => $req,
                ]);
            }
        }
    }
}
