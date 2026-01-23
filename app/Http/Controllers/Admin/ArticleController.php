<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(5); // maksimal 5 per tabel

        return view('admin.main.index', compact('articles'));
    }
    /**
     * FORM CREATE
     */
    public function create()
    {
        return view('admin.main.article.create');
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:8192',
            'content' => 'required|string',
            'status'  => 'required|in:draft,published',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('articles', 'public');
        }

        Article::create($validated);

        return redirect()
            ->route('admin.main.index')
            ->with('success', 'Artikel berhasil ditambahkan');
    }

    /**
     * FORM EDIT
     */
    public function edit(Article $article)
    {
        return view('admin.main.article.edit', compact('article'));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:8192',
            'content' => 'required|string',
            'status'  => 'required|in:draft,published',
        ]);

        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }

            $validated['image'] = $request->file('image')
                ->store('articles', 'public');
        }

        $article->update($validated);

        return redirect()
            ->route('admin.main.index')
            ->with('success', 'Artikel berhasil diperbarui');
    }

    /**
     * DELETE
     */
    public function destroy(Article $article)
    {
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()
            ->route('admin.main.index')
            ->with('success', 'Artikel berhasil dihapus');
    }
}
