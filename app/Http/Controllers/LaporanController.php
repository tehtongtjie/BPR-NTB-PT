<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request, $tipe)
    {
        $allowedTipes = ['keuangan', 'tata-kelola', 'berkelanjutan'];
        if (!in_array($tipe, $allowedTipes, true)) {
            abort(404);
        }

        $query = Laporan::query()->where('tipe', $tipe);

        $jenis = $request->query('jenis');
        $tahun = $request->query('tahun');
        $search = trim((string) ($request->query('search', $request->query('q', ''))));

        // Filter Jenis (khusus keuangan)
        if ($tipe === 'keuangan' && $jenis && $jenis !== 'semua') {
            $allowedJenis = ['triwulan', 'semester', 'tahunan'];
            if (in_array($jenis, $allowedJenis, true)) {
                $query->where('jenis', $jenis);
            }
        }

        // Filter Tahun
        if ($tahun && $tahun !== 'semua' && ctype_digit((string) $tahun)) {
            $query->where('tahun', (int) $tahun);
        }

        // Search judul laporan
        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('tahun', 'like', '%' . $search . '%')
                    ->orWhere('jenis', 'like', '%' . $search . '%');
            });
        }

        // Ambil data laporan
        $laporans = $query
            ->orderBy('tahun', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil daftar tahun unik (dari DB)
        $years = Laporan::where('tipe', $tipe)
            ->orderBy('tahun', 'desc')
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
