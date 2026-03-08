<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Management;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PerusahaansController extends Controller
{
    /**
     * TAMPILKAN DATA MANAGEMENT
     */
    public function index(Request $request)
    {
        $query = Management::query();
        $type = $request->query('type');
        $search = trim((string) $request->query('q', $request->query('search', '')));

        if ($type && in_array($type, ['direksi', 'komisaris'], true)) {
            $query->where('type', $type);
        }

        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', "%{$search}%")
                  ->orWhere('position', 'like', "%{$search}%");
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
            'excerpt'   => 'nullable|string|max:255',
            'profile'   => 'nullable|string',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|in:0,1',
        ]);

        // ===== DATA TAMBAHAN =====
        $data['slug'] = Str::slug($data['name']) . '-' . uniqid();
        $data['order'] = $data['order'] ?? 0;
        $data['is_active'] = $request->input('is_active', 1);

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
            'excerpt'   => 'nullable|string|max:255',
            'profile'   => 'nullable|string',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|in:0,1',
        ]);

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
        $management->delete();

        return redirect()
            ->route('perusahaan.index')
            ->with('success', 'Data manajemen berhasil dihapus!');
    }
}
