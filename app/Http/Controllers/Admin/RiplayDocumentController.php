<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RiplayDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RiplayDocumentController extends Controller
{
    public function index()
    {
        $documents = RiplayDocument::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.main.riplay.index', compact('documents'));
    }

    public function create()
    {
        return view('admin.main.riplay.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'type'        => 'required|string|in:kredit,deposito,tabungan',
            'description' => 'required|string',
            'document'    => 'required|file|mimes:pdf|max:20480',
            'is_active'   => 'sometimes|boolean',
        ]);

        $slug = $this->makeUniqueSlug($validated['title']);

        $path = $request->file('document')
            ->store('riplay', 'public');

        RiplayDocument::create([
            'title'       => $validated['title'],
            'type'        => $validated['type'],
            'description' => $validated['description'],
            'slug'        => $slug,
            'file_path'   => $path,
            'is_active'   => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.riplay.index')
            ->with('success', 'Dokumen Riplay berhasil ditambahkan!');
    }

    public function edit(RiplayDocument $riplay)
    {
        return view('admin.main.riplay.edit', compact('riplay'));
    }

    public function update(Request $request, RiplayDocument $riplay)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'type'        => 'required|string|in:kredit,deposito,tabungan',
            'description' => 'required|string',
            'document'    => 'nullable|file|mimes:pdf|max:20480',
            'is_active'   => 'sometimes|boolean',
        ]);

        $slug = $this->makeUniqueSlug($validated['title'], $riplay->id);

        $payload = [
            'title'       => $validated['title'],
            'type'        => $validated['type'],
            'description' => $validated['description'],
            'slug'        => $slug,
            'is_active'   => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('document')) {
            if ($riplay->file_path && Storage::disk('public')->exists($riplay->file_path)) {
                Storage::disk('public')->delete($riplay->file_path);
            }

            $payload['file_path'] = $request->file('document')
                ->store('riplay', 'public');
        }

        $riplay->update($payload);

        return redirect()->route('admin.riplay.index')
            ->with('success', 'Dokumen Riplay berhasil diperbarui!');
    }

    public function destroy(RiplayDocument $riplay)
    {
        if ($riplay->file_path && Storage::disk('public')->exists($riplay->file_path)) {
            Storage::disk('public')->delete($riplay->file_path);
        }

        $riplay->delete();

        return redirect()->route('admin.riplay.index')
            ->with('success', 'Dokumen Riplay berhasil dihapus!');
    }

    private function makeUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $base = Str::slug($title);
        $base = $base ?: 'dokumen';
        $slug = $base;
        $counter = 0;

        while (RiplayDocument::where('slug', $slug)
            ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
            ->exists()) {
            $counter++;
            $slug = "{$base}-{$counter}";
        }

        return $slug;
    }
}
