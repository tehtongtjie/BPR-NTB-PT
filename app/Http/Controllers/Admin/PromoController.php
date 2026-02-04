<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use App\Models\PromoBenefit;
use App\Models\PromoRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PromoController extends Controller
{
    /**
     * TAMPILKAN PROMO (MAIN DASHBOARD)
     */
    public function index()
    {
        $promos = Promo::with(['benefits', 'requirements'])
            ->orderBy('created_at', 'asc')
            ->paginate(5);

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
     * SIMPAN PROMO + BENEFIT + REQUIREMENT
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:100',
            'subtitle'     => 'nullable|string|max:150',
            'short_desc'   => 'required|string|max:150',
            'description' => 'nullable|string',
            'image'        => 'required|image|mimes:jpg,jpeg,png,webp|max:8192',
            'is_active'    => 'required|boolean',

            'benefits'       => 'nullable|array',
            'benefits.*'     => 'required|string',

            'requirements'   => 'nullable|array',
            'requirements.*' => 'required|string',
        ]);

        DB::transaction(function () use ($request) {

            // =====================
            // UPLOAD GAMBAR
            // =====================
            $imagePath = $request->file('image')
                ->store('promo', 'public');

            // =====================
            // SIMPAN PROMO
            // =====================
            $promo = Promo::create([
                'title'       => $request->title,
                'subtitle'    => $request->subtitle,
                'slug'        => Str::slug($request->title) . '-' . uniqid(),
                'image'       => $imagePath,
                'short_desc'  => $request->short_desc,
                'description' => $request->description,
                'is_active'   => $request->is_active,
            ]);

            // =====================
            // SIMPAN BENEFITS
            // =====================
            if ($request->filled('benefits')) {
                foreach ($request->benefits as $benefit) {
                    PromoBenefit::create([
                        'promo_id' => $promo->id,
                        'title'    => $benefit,
                    ]);
                }
            }

            // =====================
            // SIMPAN REQUIREMENTS
            // =====================
            if ($request->filled('requirements')) {
                foreach ($request->requirements as $requirement) {
                    PromoRequirement::create([
                        'promo_id' => $promo->id,
                        'title'    => $requirement,
                    ]);
                }
            }
        });

        return redirect()
            ->route('admin.main.index')
            ->with('success', 'Promo berhasil ditambahkan!');
    }

    /**
     * FORM EDIT PROMO
     */
    public function edit(Promo $promo)
    {
        $promo->load(['benefits', 'requirements']);

        return view('admin.main.promo.edit', compact('promo'));
    }

    /**
     * UPDATE PROMO + DETAIL
     */
    public function update(Request $request, Promo $promo)
    {
        $request->validate([
            'title'        => 'required|string|max:100',
            'subtitle'     => 'nullable|string|max:150',
            'short_desc'   => 'required|string|max:150',
            'description' => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
            'is_active'    => 'required|boolean',

            'benefits'       => 'nullable|array',
            'benefits.*'     => 'required|string',

            'requirements'   => 'nullable|array',
            'requirements.*' => 'required|string',
        ]);

        DB::transaction(function () use ($request, $promo) {

            // =====================
            // UPDATE GAMBAR
            // =====================
            if ($request->hasFile('image')) {
                if ($promo->image && Storage::disk('public')->exists($promo->image)) {
                    Storage::disk('public')->delete($promo->image);
                }

                $promo->image = $request->file('image')
                    ->store('promo', 'public');
            }

            // =====================
            // UPDATE PROMO
            // =====================
            $promo->update([
                'title'       => $request->title,
                'subtitle'    => $request->subtitle,    
                'short_desc'  => $request->short_desc,
                'description' => $request->description,
                'is_active'   => $request->is_active,
            ]);

            // =====================
            // RESET & INSERT BENEFITS
            // =====================
            PromoBenefit::where('promo_id', $promo->id)->delete();
            if ($request->filled('benefits')) {
                foreach ($request->benefits as $benefit) {
                    PromoBenefit::create([
                        'promo_id' => $promo->id,
                        'title'    => $benefit,
                    ]);
                }
            }

            // =====================
            // RESET & INSERT REQUIREMENTS
            // =====================
            PromoRequirement::where('promo_id', $promo->id)->delete();
            if ($request->filled('requirements')) {
                foreach ($request->requirements as $requirement) {
                    PromoRequirement::create([
                        'promo_id' => $promo->id,
                        'title'    => $requirement,
                    ]);
                }
            }
        });

        return redirect()
            ->route('admin.main.index')
            ->with('success', 'Promo berhasil diperbarui!');
    }

    /**
     * HAPUS PROMO + DETAIL
     */
    public function destroy(Promo $promo)
    {
        DB::transaction(function () use ($promo) {

            PromoBenefit::where('promo_id', $promo->id)->delete();
            PromoRequirement::where('promo_id', $promo->id)->delete();

            if ($promo->image && Storage::disk('public')->exists($promo->image)) {
                Storage::disk('public')->delete($promo->image);
            }

            $promo->delete();
        });

        return redirect()
            ->route('admin.main.index')
            ->with('success', 'Promo berhasil dihapus');
    }
}
