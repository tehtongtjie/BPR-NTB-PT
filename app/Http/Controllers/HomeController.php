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
            ->latest()
            ->take(3) // maksimal 3 card di homepage
            ->get();
        $interestRate = InterestRate::with(['details' => function ($q) {
            $q->orderBy('sort_order');
        }])
        ->where('is_active', 1)
        ->first();
        return view('users.pages.home', compact('banners','promos', 'interestRate'));
        
    }
}

