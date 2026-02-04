<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;

class PublikasiController extends Controller
{
    public function index()
    {
        $laporans = Laporan::orderBy('tahun', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.publikasi.index', compact('laporans'));
    }
}
