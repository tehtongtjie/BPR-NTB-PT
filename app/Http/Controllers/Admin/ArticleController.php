<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * TAMPILKAN LIST ARTIKEL
     */
    public function index()
    {
        $articles = Article::orderBy('published_at', 'desc')
            ->paginate(10);

        return view('admin.main.article.index', compact('articles'));
    }

    /**
     * FORM CREATE ARTIKEL
     */
    public function create()
    {
        return view('admin.main.article.create');
    }

    /**
     * SIMPAN ARTIKEL
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'category'      => 'required|string|max:50',
            'author'        => 'required|string|max:100',
            'excerpt'       => 'required|string|max:300',
            'content'       => 'required|string',
            'thumbnail'     => 'required|image|mimes:jpg,jpeg,png,webp|max:8192',
            'published_at'  => 'required|date',
            'is_published'  => 'required|boolean',
        ]);

        DB::transaction(function () use ($request) {

            // =====================
            // UPLOAD THUMBNAIL
            // =====================
            $thumbnailPath = $request->file('thumbnail')
                ->store('articles', 'public');

            // =====================
            // SIMPAN ARTIKEL
            // =====================
            Article::create([
                'title'        => $request->title,
                'slug'         => Str::slug($request->title) . '-' . uniqid(),
                'category'     => $request->category,
                'author'       => $request->author,
                'excerpt'      => $request->excerpt,
                'content'      => $request->content,
                'thumbnail'    => $thumbnailPath,
                'published_at' => $request->published_at,
                'is_published' => $request->is_published,
            ]);
        });

        return redirect()
            ->route('admin.main.article.index')
            ->with('success', 'Artikel berhasil ditambahkan!');
    }

    /**
     * FORM EDIT ARTIKEL
     */
    public function edit(Article $article)
    {
        return view('admin.main.article.edit', compact('article'));
    }

    /**
     * UPDATE ARTIKEL
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'category'      => 'required|string|max:50',
            'author'        => 'required|string|max:100',
            'excerpt'       => 'required|string|max:300',
            'content'       => 'required|string',
            'thumbnail'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
            'published_at'  => 'required|date',
            'is_published'  => 'required|boolean',
        ]);

        DB::transaction(function () use ($request, $article) {

            // =====================
            // UPDATE THUMBNAIL
            // =====================
            if ($request->hasFile('thumbnail')) {
                if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
                    Storage::disk('public')->delete($article->thumbnail);
                }

                $article->thumbnail = $request->file('thumbnail')
                    ->store('articles', 'public');
            }

            // =====================
            // UPDATE DATA ARTIKEL
            // =====================
            $article->update([
                'title'        => $request->title,
                // 'slug'         => Str::slug($request->title),
                'category'     => $request->category,
                'author'       => $request->author,
                'excerpt'      => $request->excerpt,
                'content'      => $request->content,
                'published_at' => $request->published_at,
                'is_published' => $request->is_published,
            ]);
        });

        return redirect()
            ->route('admin.main.article.index')
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * HAPUS ARTIKEL
     */
    public function destroy(Article $article)
    {
        DB::transaction(function () use ($article) {

            if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
                Storage::disk('public')->delete($article->thumbnail);
            }

            $article->delete();
        });

        return redirect()
            ->route('admin.main.article.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }
}
