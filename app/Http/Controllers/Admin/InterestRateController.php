<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InterestRate;
use App\Models\InterestRateDetail;
use Illuminate\Http\Request;

class InterestRateController extends Controller
{
    public function index()
    {
        $rates = InterestRate::orderBy('created_at', 'desc')->get();
        return view('admin.main.interest-rate.index', compact('rates'));
    }

    public function create()
    {
        return view('admin.main.interest-rate.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'rate'        => 'required|numeric',
            'description' => 'nullable|string',
            'lps_url'     => 'nullable|url',
            'is_active'   => 'boolean',
        ]);

        InterestRate::create($validated);

        return redirect()
            ->route('admin.main.interest-rate.index')
            ->with('success', 'Suku bunga berhasil ditambahkan');
    }

    public function edit(InterestRate $interestRate)
    {
        $interestRate->load('details');
        return view('admin.main.interest-rate.edit', compact('interestRate'));
    }

    public function update(Request $request, InterestRate $interestRate)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'rate'        => 'required|numeric',
            'description' => 'nullable|string',
            'lps_url'     => 'nullable|url',
            'is_active'   => 'boolean',
        ]);

        $interestRate->update($validated);

        return redirect()
            ->route('admin.main.interest-rate.index')
            ->with('success', 'Suku bunga berhasil diperbarui');
    }

    public function destroy(InterestRate $interestRate)
    {
        $interestRate->delete();

        return back()->with('success', 'Suku bunga berhasil dihapus');
    }

    /* ================= DETAIL ================= */

    public function storeDetail(Request $request, InterestRate $interestRate)
    {
        $validated = $request->validate([
            'category'   => 'required|in:tabungan,deposito',
            'name'       => 'required|string|max:255',
            'rate'       => 'required|string|max:50',
            'sort_order' => 'nullable|integer',
        ]);

        $interestRate->details()->create($validated);

        return back()->with('success', 'Rincian bunga ditambahkan');
    }

    public function destroyDetail(InterestRateDetail $detail)
    {
        $detail->delete();
        return back()->with('success', 'Rincian bunga dihapus');
    }
}
