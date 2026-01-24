<?php

namespace App\Http\Controllers;

class PerusahaanController extends Controller
{
    public function show($slug)
    {
        if ($slug === 'komisaris') {
            $data = [
                'members' => config('komisaris'),
            ];
        }
        elseif ($slug === 'direksi') {
            $data = [
                'members' => config('direksi'),
            ];
        }
        else {
            $data = config("perusahaan.$slug");
        }

        if (!$data) {
            abort(404);
        }

        return view('pages.perusahaan.show', compact('data', 'slug'));
    }

    public function komisarisDetail($slug)
    {
        $data = collect(config('komisaris'))
            ->firstWhere('slug', $slug);

        if (!$data) {
            abort(404);
        }

        return view('pages.perusahaan.komisaris-detail', compact('data'));
    }

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
