<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Banner;
use App\Models\InterestRatePeriod;
use App\Models\Lelang;
use App\Models\Promo;
use App\Models\RiplayDocument;

class MainController extends Controller
{
    public function index()
    {
        $banners        = Banner::orderBy('id', 'asc')->paginate(4);
        $promos         = Promo::orderBy('id', 'asc')->paginate(4);
        $articles       = Article::orderBy('id', 'asc')->paginate(4);
        $lelangs        = Lelang::orderBy('id', 'asc')->paginate(4);
        $riplayDocuments = RiplayDocument::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        $periods = InterestRatePeriod::with([
                'tabungans',
                'depositos',
                'lps'
            ])
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(4);

        return view('admin.main.index', compact(
            'banners',
            'promos',
            'articles',
            'lelangs',
            'periods',
            'riplayDocuments'
        ));
    }
}
