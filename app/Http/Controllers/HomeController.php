<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;
use App\Models\Banner;
use App\Models\InterestRate;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('id', 'asc')->get();
        $promos = Promo::where('is_active', true)
            ->orderBy('created_at', 'asc')
            ->limit(3) // 🔴 BATAS 3
            ->get();

        $featured = $promos->first();      // 1 besar kiri
        $others   = $promos->skip(1);       // max 2 kanan

        return view('pages.home', compact(
            'banners',
            'featured',
            'others'
        ));
    }
}

