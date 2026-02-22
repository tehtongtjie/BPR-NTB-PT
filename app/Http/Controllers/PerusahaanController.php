<?php

namespace App\Http\Controllers;

use App\Models\Management;

class PerusahaanController extends Controller
{
    /**
     * HALAMAN PERUSAHAAN
     */
    public function show(string $slug)
    {
        // ===============================
        // DEFAULT
        // ===============================
        $data = null;
        $managements = collect();

        // ===============================
        // DIREKSI / KOMISARIS → DATABASE ONLY
        // (TANPA HEADER CONFIG)
        // ===============================
        if (in_array($slug, ['direksi', 'komisaris'])) {

            $managements = Management::where('type', $slug)
                ->where('is_active', 1)
                ->orderBy('order')
                ->get();

            return view('pages.perusahaan.show', [
                'slug'        => $slug,
                'data'        => null,        // ⛔ tidak ada header
                'managements' => $managements,
            ]);
        }

        // ===============================
        // HALAMAN LAIN → CONFIG
        // ===============================
        $data = config("perusahaan.$slug");

        abort_if(!$data, 404);

        return view('pages.perusahaan.show', [
            'slug'        => $slug,
            'data'        => $data,         // ✅ ada header
            'managements' => collect(),     // kosong
        ]);
    }

    /**
     * DETAIL DIREKSI / KOMISARIS
     */
    public function detail(string $slug, Management $management)
    {
        abort_if(
            !in_array($slug, ['direksi', 'komisaris']) ||
            $management->type !== $slug,
            404
        );

        return view('pages.perusahaan.direksi-detail', [
            'slug'       => $slug,
            'management' => $management,
        ]);
    }
}
