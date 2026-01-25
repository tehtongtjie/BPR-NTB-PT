<?php

namespace App\Http\Controllers;

use App\Models\Promo;

class PromoPublicController extends Controller
{
    public function show(string $slug)
    {
        $promo = Promo::with(['benefits', 'requirements'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.tabungan-detail', compact('promo'));
    }
}
