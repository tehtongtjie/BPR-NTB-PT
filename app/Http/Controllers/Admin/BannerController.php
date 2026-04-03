<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
   
    public function index()
    {
        $banners = Banner::orderBy('id', 'asc')->paginate(5);
        return view('admin.main.banner.index', compact('banners')); // ✅
    }
    
    public function create()
    {
        return view('admin.main.banner.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:8192', // WEBP AKTIF
        ]);

        $validated['image'] = $request->file('image')
            ->store('banners', 'public');

        Banner::create($validated);

        return redirect()
            ->route('admin.main.banner.index')
            ->with('success', 'Banner berhasil ditambahkan');
    }

    public function edit(Banner $banner)
    {
        return view('admin.main.banner.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192', // WEBP AKTIF
        ]);

        if ($request->hasFile('image')) {

            // hapus gambar lama
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }

            $validated['image'] = $request->file('image')
                ->store('banners', 'public');
        }

        $banner->update($validated);

        return redirect()
            ->route('admin.main.banner.index')
            ->with('success', 'Banner berhasil diperbarui');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()
            ->route('admin.main.banner.index')
            ->with('success', 'Banner berhasil dihapus');
    }
}
