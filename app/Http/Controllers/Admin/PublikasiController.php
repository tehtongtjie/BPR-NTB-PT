<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublikasiController extends Controller
{
    public function index(Request $request)
    {
        // Satukan alur listing publikasi ke endpoint laporan agar filter/search konsisten.
        return redirect()->route('admin.publikasi.laporan.index', $request->query());
    }
}
