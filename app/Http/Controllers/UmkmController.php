<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function mitra()
    {
        $umkms = Umkm::with(['images', 'products'])
            ->latest()
            ->paginate(9);

        return view('umkm.pages.mitra', compact('umkms'));
    }

    public function show($slug)
    {
        $umkm = Umkm::with(['images', 'products'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('umkm.pages.show', compact('umkm'));
    }
}
