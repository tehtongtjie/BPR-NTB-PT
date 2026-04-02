<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lelang;

class LelangController extends Controller
{
    public function index(Request $request)
    {
        $category = (string) $request->query('category', '');

        $query = Lelang::where('is_published', true);

        if ($category !== '' && strtolower($category) !== 'semua lelang') {
            $query->where('category', $category);
        }

        $lelangs = $query->orderBy('deadline', 'asc')->paginate(3)->withQueryString();
        $categories = Lelang::where('is_published', true)
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('user.pages.lelang.index', compact('lelangs', 'categories', 'category'));
    }

    public function show($slug)
    {
        $lelang = Lelang::with('requirements')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('user.pages.lelang.show', compact('lelang'));
    }

}
