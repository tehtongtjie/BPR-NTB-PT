<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TabunganController extends Controller
{
    public function show(string $slug)
    {
        $tabungan = config("tabungan.$slug");

        if (!$tabungan) {
            abort(404);
        }

        return view('pages.tabungan.show', compact('tabungan'));
    }
}
