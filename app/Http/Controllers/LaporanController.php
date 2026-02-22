<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request, $tipe)
    {
        // Base query
        $query = Laporan::where('tipe', $tipe);

        // Filter Jenis (khusus keuangan)
        if ($tipe === 'keuangan' && $request->filled('jenis') && $request->jenis !== 'semua') {
            $query->where('jenis', $request->jenis);
        }

        // Filter Tahun
        if ($request->filled('tahun') && $request->tahun !== 'semua') {
            $query->where('tahun', $request->tahun);
        }

        // Ambil data laporan
        $laporans = $query
            ->orderBy('tahun', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil daftar tahun unik (dari DB)
        $years = Laporan::where('tipe', $tipe)
            ->pluck('tahun')
            ->unique()
            ->sortDesc();

        // Judul halaman
        $titles = [
            'keuangan'       => 'Laporan Keuangan',
            'tata-kelola'    => 'Laporan Tata Kelola',
            'berkelanjutan'  => 'Laporan Berkelanjutan',
        ];

        return view('user.pages.laporan.index', [
            'laporans' => $laporans,
            'tipe'     => $tipe,
            'title'    => $titles[$tipe] ?? 'Laporan Publikasi',
            'years'    => $years,
        ]);
    }
}
