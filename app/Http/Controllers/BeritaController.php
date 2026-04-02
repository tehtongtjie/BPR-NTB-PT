<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $category = (string) $request->query('category', '');

        $query = Article::where('is_published', true);

        if ($category !== '' && strtolower($category) !== 'semua berita') {
            $query->where('category', $category);
        }

        $beritas = $query->orderBy('published_at', 'desc')
            ->paginate(4)
            ->withQueryString();

        $categories = Article::where('is_published', true)
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('user.pages.berita.index', compact('beritas', 'categories', 'category'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('user.pages.berita.show', compact('article'));
    }
}
 
