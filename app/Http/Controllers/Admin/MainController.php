<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Promo;
use App\Models\Article;
use App\Models\Lelang;
use App\Models\InterestRatePeriod;

class MainController extends Controller
{
    public function index()
    {
        $banners  = Banner::orderBy('id', 'asc')->get();
        $promos   = Promo::orderBy('id', 'asc')->paginate(5);
        $articles = Article::orderBy('id', 'asc')->paginate(5);
        $lelangs  = Lelang::orderBy('id', 'asc')->paginate(5);

        // ✅ TAMBAHAN WAJIB
        $periods = InterestRatePeriod::with([
                'tabungans',
                'depositos',
                'lps'
            ])
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(5);

        return view('admin.main.index', compact(
            'banners',
            'promos',
            'articles',
            'lelangs',
            'periods' // ✅ INI YANG HILANG
        ));
    }
}
