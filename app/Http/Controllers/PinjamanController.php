<?php

namespace App\Http\Controllers;

class PinjamanController extends Controller
{
    public function index()
    {
        return redirect()->route(
            'pinjaman.show',
            'kredit-modal-kerja'
        );
    }

    public function show($slug)
    {
        $pinjaman = config("pinjaman.$slug");

        if (!$pinjaman) {
            abort(404);
        }

        return view('pages.pinjaman.show', compact('pinjaman'));
    }
}
