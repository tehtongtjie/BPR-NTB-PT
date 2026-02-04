<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;
use App\Models\Banner;
use App\Models\InterestRate;
use App\Models\Article;
use App\Models\InterestRatePeriod;
use App\Models\Lelang;

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
        $articles = Article::where('is_published', true)
        ->orderBy('published_at', 'desc')
        ->take(4)
        ->get();
        
        $activePeriod = InterestRatePeriod::with(['tabungans','depositos','lps'])
            ->where('is_active', true)
            ->latest('year')
            ->latest('month')
            ->first();

        $lelangs = Lelang::where('is_published', true)
        ->orderBy('deadline', 'asc')
        ->limit(8)
        ->get();

        return view('pages.home', compact(
            'banners',
            'featured',
            'others',
            'articles',
            'activePeriod',
            'lelangs'
        ));
    }
}

