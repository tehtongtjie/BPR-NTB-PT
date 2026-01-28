<?php

namespace App\Http\Controllers;

use App\Models\Management;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    /**
     * HALAMAN PERUSAHAAN (SEJARAH, VISI MISI, DIREKSI, KOMISARIS)
     */
    public function show(string $slug)
    {
        /**
         * 1. Ambil data statis dari config
         * (sejarah, visi-misi, budaya, tata-kelola, dll)
         */
        $data = config("perusahaan.$slug");

        // kalau slug tidak ada di config & bukan direksi/komisaris
        abort_if(!$data && !in_array($slug, ['direksi', 'komisaris']), 404);

        /**
         * 2. Default managements (WAJIB ADA walau kosong)
         */
        $managements = collect();

        /**
         * 3. Jika slug direksi / komisaris → ambil dari DB
         */
        if (in_array($slug, ['direksi', 'komisaris'])) {
            $managements = Management::where('type', $slug)
                ->where('is_active', 1)
                ->orderBy('order')
                ->get();
        }

        /**
         * 4. Return ke view
         */
        return view('pages.perusahaan.show', [
            'slug'        => $slug,
            'data'        => $data,        // dari config
            'managements' => $managements, // dari database
        ]);
    }

    /**
     * DETAIL DIREKSI / KOMISARIS (PUBLIK)
     * URL: /perusahaan/{direksi|komisaris}/{management:slug}
     */
    public function detail(string $slug, Management $management)
    {
        // Validasi ekstra (opsional tapi aman)
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
