<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KarirController extends Controller
{
    public function index()
    {
        // Data Dummy Lowongan
        $jobs = [
            [
                'id' => 1,
                'slug' => 'account-officer-2026',
                'posisi' => 'Account Officer',
                'divisi' => 'Pemasaran',
                'lokasi' => 'Mataram',
                'tipe' => 'Full-time',
                'deadline' => '28 Feb 2026',
                'deskripsi' => 'Mencari individu dinamis untuk mengelola portofolio kredit dan membangun hubungan baik dengan nasabah UMKM.'
            ],
            [
                'id' => 2,
                'slug' => 'it-support-specialist',
                'posisi' => 'IT Support Specialist',
                'divisi' => 'Teknologi Informasi',
                'lokasi' => 'Kantor Pusat',
                'tipe' => 'Full-time',
                'deadline' => '15 Feb 2026',
                'deskripsi' => 'Bertanggung jawab atas pemeliharaan infrastruktur jaringan dan memberikan dukungan teknis operasional perbankan.'
            ],
            [
                'id' => 3,
                'slug' => 'teller-layanan-nasabah',
                'posisi' => 'Customer Service / Teller',
                'divisi' => 'Operasional',
                'lokasi' => 'Selong, Lombok Timur',
                'tipe' => 'Full-time',
                'deadline' => '10 Feb 2026',
                'deskripsi' => 'Garda terdepan layanan BPR NTB yang bertugas memberikan solusi keuangan terbaik bagi nasabah.'
            ],
        ];

        return view('pages.karir.index', compact('jobs'));
    }
}