<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PromoController extends Controller
{
    /**
     * TAMPILKAN PROMO DI MAIN ADMIN
     */
    public function index()
    {
        $promos = Promo::orderBy('created_at', 'asc')->paginate(5);

        return view('admin.main.index', compact('promos'));
    }
    /**
     * FORM CREATE PROMO
     */
    public function create()
    {
        return view('admin.main.promo.create');
    }

    /**
     * SIMPAN PROMO BARU
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'      => 'required|string|max:100',
            'short_desc' => 'required|string|max:150',
            'image'      => 'required|image|mimes:jpg,jpeg,png|max:8192',
            'is_active'  => 'required|boolean',
        ]);

        // upload gambar
        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('promo', 'public');
        }

        // generate slug
        $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();

        Promo::create($validated);  

        return redirect()
            ->route('admin.main.index')
            ->with('success', 'Promo berhasil ditambahkan!');
    }

    /**
     * FORM EDIT PROMO
     */
    public function edit(Promo $promo)
    {
        return view('admin.main.promo.edit', compact('promo'));
    }

    /**
     * UPDATE PROMO
     */
    public function update(Request $request, Promo $promo)
    {
        $validated = $request->validate([
            'title'      => 'required|string|max:100',
            'short_desc' => 'required|string|max:150',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:8192',
            'is_active'  => 'required|boolean',
        ]);

        // jika upload gambar baru
        if ($request->hasFile('image')) {
            if ($promo->image && Storage::disk('public')->exists($promo->image)) {
                Storage::disk('public')->delete($promo->image);
            }

            $validated['image'] = $request
                ->file('image')
                ->store('promo', 'public');
        }

        // update slug berdasarkan judul terbaru
        $validated['slug'] = Str::slug($validated['title']);

        $promo->update($validated);

        return redirect()
            ->route('admin.main.index')
            ->with('success', 'Promo berhasil diperbarui!');
    }


    /**
     * HAPUS PROMO
     */
    public function destroy(Promo $promo)
    {
        if ($promo->image && Storage::disk('public')->exists($promo->image)) {
            Storage::disk('public')->delete($promo->image);
        }

        $promo->delete();

        return redirect()
            ->route('admin.main.index')
            ->with('success', 'Promo berhasil dihapus');
    }
}
