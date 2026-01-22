<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhistleBlowingController extends Controller
{
    public function index() 
    {
        return view('pages.pegaduan.WhistleBlowingSystem');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'        => 'nullable|string|max:100',
            'email'       => 'nullable|email|max:100',
            'kategori'    => 'required|string',
            'laporan'     => 'required|string|min:20',
        ]);

        // NANTI BISA:
        // - simpan ke database
        // - kirim email ke internal
        // - log khusus WBS network

        return redirect()
            ->route('pengaduan.wbs')
            ->with('success', 'Laporan Anda berhasil dikirim. Identitas Anda kami lindungi.');
    }
}
