<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Article::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->get();

        return view('pages.berita.index', compact('beritas'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('pages.berita.show', compact('article'));
    }
}
 