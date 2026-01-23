<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Promo;
use App\Models\Article;
use App\Models\InterestRate;

class MainController extends Controller
{
    public function index()
    {
        $banners  = Banner::orderBy('id', 'asc')->get();
        $promos   = Promo::orderBy('id', 'asc')->paginate(5);
        $articles = Article::orderBy('id', 'asc')->paginate(5);
        $rates = InterestRate::orderBy('id', 'desc')->get();

        return view('admin.main.index', compact(
            'banners',
            'promos',
            'articles',
            'rates'
        ));
    }
}

