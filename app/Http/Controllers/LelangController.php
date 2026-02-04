<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Lelang;

class LelangController extends Controller
{
    public function index()
    {
        $lelangs = Lelang::where('is_published', true)
            ->orderBy('deadline', 'asc')
            ->get();

        return view('pages.lelang.index', compact('lelangs'));
    }

    public function show($slug)
    {
        $lelang = Lelang::with('requirements')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('pages.lelang.show', compact('lelang'));
    }

}