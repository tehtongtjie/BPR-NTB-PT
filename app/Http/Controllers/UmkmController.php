<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index()
    {
        $umkms = config('umkm.mitra');
        abort_if(!$umkms, 404);

        return view('pages.umkm.mitra', compact('umkms'));
    }

    public function show($slug)
    {
        // Mengambil semua data dari config
        $all_umkms = config('umkm.mitra');

        // Mencari mitra spesifik berdasarkan slug
        $umkm = collect($all_umkms)->firstWhere('slug', $slug);

        // Jika tidak ketemu, munculkan 404
        abort_if(!$umkm, 404);

        return view('pages.umkm.show', compact('umkm'));
    }
}
