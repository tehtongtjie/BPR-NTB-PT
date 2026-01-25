<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;

class TabunganController extends Controller
{
    public function show($slug)
    {
        $promo = Promo::with(['benefits', 'requirements'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.tabungan.show', compact('promo'));
    }
}
