<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    private function getAllReports()
    {
        return [
            ['id' => 1, 'tipe' => 'keuangan', 'jenis' => 'triwulan', 'tahun' => '2025', 'judul' => 'Lap. Keuangan Triwulan I 2025', 'file' => 'keu-t1-2025.pdf'],
            ['id' => 2, 'tipe' => 'keuangan', 'jenis' => 'semester', 'tahun' => '2024', 'judul' => 'Lap. Keuangan Semester II 2024', 'file' => 'keu-s2-2024.pdf'],
            ['id' => 3, 'tipe' => 'keuangan', 'jenis' => 'tahunan', 'tahun' => '2024', 'judul' => 'Lap. Keuangan Tahunan 2024', 'file' => 'keu-th-2024.pdf'],
            ['id' => 4, 'tipe' => 'tata-kelola', 'jenis' => 'tahunan', 'tahun' => '2025', 'judul' => 'Lap. Tata Kelola (GCG) 2025', 'file' => 'gcg-2025.pdf'],
            ['id' => 5, 'tipe' => 'berkelanjutan', 'jenis' => 'tahunan', 'tahun' => '2025', 'judul' => 'Lap. Berkelanjutan 2025', 'file' => 'sr-2025.pdf'],
        ];
    }

    public function index(Request $request, $tipe)
    {
        $query = collect($this->getAllReports())->where('tipe', $tipe);

        // Filter berdasarkan Jenis (Triwulan/Semester/Tahunan) - Khusus Keuangan
        if ($request->has('jenis') && $request->jenis != 'semua') {
            $query = $query->where('jenis', $request->jenis);
        }

        // Filter berdasarkan Tahun
        if ($request->has('tahun') && $request->tahun != 'semua') {
            $query = $query->where('tahun', $request->tahun);
        }

        $laporans = $query->values();
        $years = collect($this->getAllReports())->pluck('tahun')->unique()->sortDesc();

        $titles = [
            'keuangan' => 'Laporan Keuangan',
            'tata-kelola' => 'Laporan Tata Kelola',
            'berkelanjutan' => 'Laporan Berkelanjutan'
        ];

        return view('pages.laporan.index', [
            'laporans' => $laporans,
            'tipe' => $tipe,
            'title' => $titles[$tipe] ?? 'Laporan Publikasi',
            'years' => $years
        ]);
    }
}
