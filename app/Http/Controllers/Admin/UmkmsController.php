<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\UmkmImage;
use App\Models\UmkmProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UmkmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Umkm::query()->with('images');

        $skala = $request->query('skala');
        $search = trim((string) $request->query('search', $request->query('q', '')));

        if ($skala && in_array($skala, ['Lokal', 'Nasional', 'Internasional'], true)) {
            $query->where('skala', $skala);
        }

        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder->where('nama_usaha', 'like', '%' . $search . '%')
                    ->orWhere('nama_pemilik', 'like', '%' . $search . '%')
                    ->orWhere('bidang_usaha', 'like', '%' . $search . '%')
                    ->orWhere('lokasi', 'like', '%' . $search . '%');
            });
        }

        $umkms = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.umkms.index', compact('umkms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.umkms.umkm.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_usaha'   => 'required',
            'nama_pemilik' => 'required',
            'bidang_usaha' => 'required',
            'lokasi'       => 'required',
            'telepon'      => 'nullable',
            'deskripsi'    => 'nullable',
            'images.*'     => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // 🔥 AUTO UNIQUE SLUG
        $slug = Str::slug($request->nama_usaha);
        $originalSlug = $slug;
        $counter = 1;

        while (Umkm::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $umkm = Umkm::create([
            'slug'           => $slug,
            'nama_usaha'     => $request->nama_usaha,
            'nama_pemilik'   => $request->nama_pemilik,
            'bidang_usaha'   => $request->bidang_usaha,
            'lokasi'         => $request->lokasi,
            'telepon'        => $request->telepon,
            'link_instagram' => $request->link_instagram,
            'deskripsi'      => $request->deskripsi,
            'unggulan'       => $request->unggulan,
            'skala'          => $request->skala,
            'alamat'         => $request->alamat,
        ]);

        // ===============================
        // Upload Multiple Images
        // ===============================
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('umkm', 'public');

                UmkmImage::create([
                    'umkm_id'      => $umkm->id,
                    'image_path'   => $path,
                    'is_thumbnail' => $index === 0,
                ]);
            }
        }

        // ===============================
        // Simpan Produk (Textarea per baris)
        // ===============================
        if ($request->produk_list) {
            $products = explode("\n", $request->produk_list);

            foreach ($products as $product) {
                if (trim($product) !== '') {
                    UmkmProduct::create([
                        'umkm_id'     => $umkm->id,
                        'nama_produk' => trim($product),
                    ]);
                }
            }
        }

        return redirect()->route('umkms.index')
            ->with('success', 'UMKM berhasil ditambahkan');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Umkm $umkm)
    {
        $umkm->load('images', 'products');

        return view('admin.umkms.umkm.edit', compact('umkm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Umkm $umkm)
    {
        $request->validate([
            'nama_usaha'   => 'required',
            'nama_pemilik' => 'required',
            'bidang_usaha' => 'required',
            'lokasi'       => 'required',
        ]);

        $umkm->update([
            'slug'          => Str::slug($request->nama_usaha),
            'nama_usaha'    => $request->nama_usaha,
            'nama_pemilik'  => $request->nama_pemilik,
            'bidang_usaha'  => $request->bidang_usaha,
            'lokasi'        => $request->lokasi,
            'telepon'       => $request->telepon,
            'link_instagram'=> $request->link_instagram,
            'deskripsi'     => $request->deskripsi,
            'unggulan'      => $request->unggulan,
            'skala'         => $request->skala,
            'alamat'        => $request->alamat,
        ]);

        // Upload Tambahan Gambar
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('umkm', 'public');

                UmkmImage::create([
                    'umkm_id'    => $umkm->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('umkms.index')
            ->with('success', 'UMKM berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Umkm $umkm)
    {
        // Hapus semua gambar dari storage
        foreach ($umkm->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $umkm->delete();

        return redirect()->route('umkms.index')
            ->with('success', 'UMKM berhasil dihapus');
    }
}
