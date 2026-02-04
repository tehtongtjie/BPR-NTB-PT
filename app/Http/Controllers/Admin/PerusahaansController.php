<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Management;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PerusahaansController extends Controller
{
    /**
     * TAMPILKAN DATA MANAGEMENT
     */
    public function index(Request $request)
    {
        $query = Management::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->q}%")
                  ->orWhere('position', 'like', "%{$request->q}%");
            });
        }

        $managements = $query
            ->orderBy('type')
            ->orderBy('order')
            ->paginate(10)
            ->withQueryString();

        return view('admin.perusahaan.index', compact('managements'));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        return view('admin.perusahaan.management.create');
    }

    /**
     * SIMPAN DATA (CREATE)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:150',
            'type'      => 'required|in:direksi,komisaris',
            'position'  => 'required|string|max:150',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
            'excerpt'   => 'nullable|string|max:255',
            'profile'   => 'nullable|string',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|in:0,1',
        ]);

        // ===== HANDLE IMAGE =====
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('managements', 'public');
        }

        // ===== DATA TAMBAHAN =====
        $data['slug'] = Str::slug($data['name']) . '-' . uniqid();
        $data['order'] = $data['order'] ?? 0;
        $data['is_active'] = $request->input('is_active', 1);

        // ===== SIMPAN KE DATABASE =====
        Management::create($data);

        return redirect()
            ->route('perusahaan.index')
            ->with('success', 'Data manajemen berhasil ditambahkan!');
    }

    /**
     * FORM EDIT
     */
    public function edit(Management $management)
    {
        return view('admin.perusahaan.management.edit', compact('management'));
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, Management $management)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:150',
            'type'      => 'required|in:direksi,komisaris',
            'position'  => 'required|string|max:150',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
            'excerpt'   => 'nullable|string|max:255',
            'profile'   => 'nullable|string',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|in:0,1',
        ]);

        // ===== HANDLE IMAGE BARU =====
        if ($request->hasFile('image')) {

            if ($management->image && Storage::disk('public')->exists($management->image)) {
                Storage::disk('public')->delete($management->image);
            }

            $data['image'] = $request->file('image')
                ->store('management', 'public');
        }

        // ===== DATA TAMBAHAN =====
        $data['slug'] = Str::slug($data['name']);
        $data['order'] = $data['order'] ?? 0;
        $data['is_active'] = $request->input('is_active', 1);

        $management->update($data);

        return redirect()
            ->route('perusahaan.index')
            ->with('success', 'Data manajemen berhasil diperbarui!');
    }

    /**
     * HAPUS DATA
     */
    public function destroy(Management $management)
    {
        if ($management->image && Storage::disk('public')->exists($management->image)) {
            Storage::disk('public')->delete($management->image);
        }

        $management->delete();

        return redirect()
            ->route('perusahaan.index')
            ->with('success', 'Data manajemen berhasil dihapus!');
    }
}
