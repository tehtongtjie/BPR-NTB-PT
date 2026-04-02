<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    private const MEDIA_TYPES = ['foto', 'video'];

    public function index(Request $request)
    {
        $type = $request->query('type');
        $category = trim((string) $request->query('category', ''));
        $search = trim((string) $request->query('q', ''));

        $query = Galeri::query();

        if ($type && in_array($type, self::MEDIA_TYPES, true)) {
            $query->where('type', $type);
        }

        if ($category !== '') {
            $query->where('category', 'like', "%{$category}%");
        }

        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $galeris = $query
            ->orderByDesc('published_at')
            ->orderBy('title')
            ->paginate(10)
            ->withQueryString();

        return view('admin.galeri.index', [
            'galeris' => $galeris,
            'type' => $type,
            'category' => $category,
            'search' => $search,
        ]);
    }

    public function create()
    {
        $categories = $this->loadCategories();
        return view('admin.galeri.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:200',
            'category' => 'required|string|max:150',
            'type' => 'required|in:foto,video',
            'description' => 'nullable|string',
            'video_url' => 'nullable|url',
            'published_at' => 'nullable|date',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'is_published' => 'nullable|boolean',
        ]);

        $data['slug'] = Str::slug($data['title']) . '-' . Str::random(6);
        $data['thumbnail'] = $request->file('thumbnail')->store('galeri', 'public');
        $data['is_published'] = $request->boolean('is_published', true);

        Galeri::create($data);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        $categories = $this->loadCategories();
        return view('admin.galeri.edit', compact('galeri', 'categories'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $data = $request->validate([
            'title' => 'required|string|max:200',
            'category' => 'required|string|max:150',
            'type' => 'required|in:foto,video',
            'description' => 'nullable|string',
            'video_url' => 'nullable|url',
            'published_at' => 'nullable|date',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'is_published' => 'nullable|boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($galeri->thumbnail && Storage::disk('public')->exists($galeri->thumbnail)) {
                Storage::disk('public')->delete($galeri->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('galeri', 'public');
        } else {
            unset($data['thumbnail']);
        }

        $data['is_published'] = $request->boolean('is_published', true);

        $galeri->update($data);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->thumbnail && Storage::disk('public')->exists($galeri->thumbnail)) {
            Storage::disk('public')->delete($galeri->thumbnail);
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }

    private function loadCategories()
    {
        return Article::where('is_published', true)
            ->distinct()
            ->orderBy('category')
            ->pluck('category');
    }
}
