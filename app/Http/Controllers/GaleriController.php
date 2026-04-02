<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type', 'foto');
        $types = [
            'foto' => [
                'label' => 'Foto',
                'type' => 'foto',
            ],
            'video' => [
                'label' => 'Video',
                'type' => 'video',
            ],
        ];

        $selected = $types[$type] ?? $types['foto'];

        $query = Galeri::where('is_published', true)
            ->where('type', $selected['type'])
            ->orderBy('published_at', 'desc');

        $albums = $query->paginate(3)->withQueryString();

        $galleryData = $albums->map(function (Galeri $item) {
            return [
                'id' => $item->id,
                'slug' => $item->slug,
                'title' => $item->title,
                'description' => $item->description,
                'cover' => 'storage/' . $item->thumbnail,
                'date' => $item->published_at?->translatedFormat('d M Y'),
                'type' => $item->type,
                'category' => $item->category,
                'video_url' => $item->video_url,
            ];
        });

        return view('user.pages.galeri.index', [
            'albums' => $galleryData,
            'paginator' => $albums,
            'types' => $types,
            'typeKey' => $type,
        ]);
    }

    public function show(string $slug)
    {
        $galeri = Galeri::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('user.pages.galeri.show', compact('galeri'));
    }
}
