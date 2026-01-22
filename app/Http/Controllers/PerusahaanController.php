<?php

namespace App\Http\Controllers;

class PerusahaanController extends Controller
{
    // ================= HALAMAN PERUSAHAAN =================
    public function show($slug)
    {
        // LIST DEWAN KOMISARIS
        if ($slug === 'komisaris') {
            $data = [
                'members' => config('komisaris'),
            ];
        }
        // LIST DEWAN DIREKSI
        elseif ($slug === 'direksi') {
            $data = [
                'members' => config('direksi'),
            ];
        }
        // HALAMAN PERUSAHAAN LAIN (SEJARAH, VISI MISI, DLL)
        else {
            $data = config("perusahaan.$slug");
        }

        if (!$data) {
            abort(404);
        }

        return view('pages.perusahaan.show', compact('data', 'slug'));
    }

    // ================= DETAIL KOMISARIS =================
    public function komisarisDetail($slug)
    {
        $data = collect(config('komisaris'))
            ->firstWhere('slug', $slug);

        if (!$data) {
            abort(404);
        }

        return view('pages.perusahaan.komisaris-detail', compact('data'));
    }

    // ================= DETAIL DIREKSI =================
    public function direksiDetail($slug)
    {
        $data = collect(config('direksi'))
            ->firstWhere('slug', $slug);

        if (!$data) {
            abort(404);
        }

        return view('pages.perusahaan.direksi-detail', compact('data'));
    }
}
