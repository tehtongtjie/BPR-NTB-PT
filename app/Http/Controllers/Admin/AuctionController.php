<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lelang;
use App\Models\LelangRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AuctionController extends Controller
{
    /**
     * LIST LELANG (UNTUK DASHBOARD / ADMIN)
     */
    public function index()
    {
        $lelangs = Lelang::with('requirements')
            ->latest()
            ->paginate(5);

        // ditampilkan di dashboard (include admin.main.lelang.index)
        return view('admin.main.lelang.index', compact('lelangs'));
    }

    /**
     * FORM CREATE LELANG
     */
    public function create()
    {
        return view('admin.main.lelang.create');
    }

    /**
     * SIMPAN DATA LELANG
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'category'     => 'required|string|max:100',
            'deadline'     => 'required|date',
            'status'       => 'required|in:aktif,ditutup,selesai',
            'short_desc'   => 'nullable|string|max:255',
            'description' => 'nullable|string',

            'banner'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
            'rks_file' => 'nullable|file|mimes:pdf|max:10240',

            'requirements'   => 'nullable|array',
            'requirements.*' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {

            // =====================
            // UPLOAD FILE
            // =====================
            $bannerPath = null;
            if ($request->hasFile('banner')) {
                $bannerPath = $request->file('banner')
                    ->store('lelang/banner', 'public');
            }

            $rksPath = null;
            if ($request->hasFile('rks_file')) {
                $rksPath = $request->file('rks_file')
                    ->store('lelang/rks', 'public');
            }

            // =====================
            // SIMPAN LELANG
            // =====================
            $lelang = Lelang::create([
                'title'        => $request->title,
                'slug'         => Str::slug($request->title) . '-' . uniqid(),
                'category'     => $request->category,
                'status'       => $request->status,
                'deadline'     => $request->deadline,
                'short_desc'   => $request->short_desc,
                'description'  => $request->description,
                'banner'       => $bannerPath,
                'rks_file'     => $rksPath,
                'is_published' => true,
            ]);

            // =====================
            // SIMPAN KUALIFIKASI
            // =====================
            if ($request->filled('requirements')) {
                foreach ($request->requirements as $req) {
                    if ($req) {
                        LelangRequirement::create([
                            'lelang_id' => $lelang->id,
                            'title'     => $req,
                        ]);
                    }
                }
            }
        });

        return redirect()
            ->route('admin.main.lelang.index')
            ->with('success', 'Lelang berhasil ditambahkan!');
    }

    /**
     * FORM EDIT LELANG
     */
    public function edit(Lelang $lelang)
    {
        $lelang->load('requirements');

        return view('admin.main.lelang.edit', compact('lelang'));
    }

    /**
     * UPDATE DATA LELANG
     */
    public function update(Request $request, Lelang $lelang)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'category'     => 'required|string|max:100',
            'deadline'     => 'required|date',
            'status'       => 'required|in:aktif,ditutup,selesai',
            'short_desc'   => 'nullable|string|max:255',
            'description' => 'nullable|string',

            'banner'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
            'rks_file' => 'nullable|file|mimes:pdf|max:10240',

            'requirements'   => 'nullable|array',
            'requirements.*' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $lelang) {

            // =====================
            // UPDATE BANNER
            // =====================
            if ($request->hasFile('banner')) {
                if ($lelang->banner && Storage::disk('public')->exists($lelang->banner)) {
                    Storage::disk('public')->delete($lelang->banner);
                }

                $lelang->banner = $request->file('banner')
                    ->store('lelang/banner', 'public');
            }

            // =====================
            // UPDATE RKS
            // =====================
            if ($request->hasFile('rks_file')) {
                if ($lelang->rks_file && Storage::disk('public')->exists($lelang->rks_file)) {
                    Storage::disk('public')->delete($lelang->rks_file);
                }

                $lelang->rks_file = $request->file('rks_file')
                    ->store('lelang/rks', 'public');
            }

            // =====================
            // UPDATE DATA UTAMA
            // =====================
            $lelang->update([
                'title'       => $request->title,
                'category'    => $request->category,
                'status'      => $request->status,
                'deadline'    => $request->deadline,
                'short_desc'  => $request->short_desc,
                'description' => $request->description,
            ]);

            // =====================
            // RESET & SIMPAN KUALIFIKASI
            // =====================
            LelangRequirement::where('lelang_id', $lelang->id)->delete();

            if ($request->filled('requirements')) {
                foreach ($request->requirements as $req) {
                    if ($req) {
                        LelangRequirement::create([
                            'lelang_id' => $lelang->id,
                            'title'     => $req,
                        ]);
                    }
                }
            }
        });

        return redirect()
            ->route('admin.main.lelang.index')
            ->with('success', 'Lelang berhasil diperbarui!');
    }

    /**
     * HAPUS LELANG
     */
    public function destroy(Lelang $lelang)
    {
        DB::transaction(function () use ($lelang) {

            LelangRequirement::where('lelang_id', $lelang->id)->delete();

            if ($lelang->banner && Storage::disk('public')->exists($lelang->banner)) {
                Storage::disk('public')->delete($lelang->banner);
            }

            if ($lelang->rks_file && Storage::disk('public')->exists($lelang->rks_file)) {
                Storage::disk('public')->delete($lelang->rks_file);
            }

            $lelang->delete();
        });

        return redirect()
            ->route('admin.main.lelang.index')
            ->with('success', 'Lelang berhasil dihapus!');
    }
}
