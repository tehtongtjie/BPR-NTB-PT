<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InterestRatePeriod;
use App\Models\InterestRateTabungan;
use App\Models\InterestRateDeposito;
use App\Models\InterestRateLps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InterestRateController extends Controller
{
    /**
     * DASHBOARD
     */
    public function index()
    {
        $periods = InterestRatePeriod::with(['tabungans','depositos','lps'])
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(5);

        return view('admin.main.index', compact('periods'));
    }

    /**
     * CREATE
     */
    public function create()
    {
        return view('admin.main.interest-rate.create');
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:100',
            'month'     => 'required|integer|min:1|max:12',
            'year'      => 'required|integer|min:2000',
            'is_active' => 'required|boolean',

            'tabungans'         => 'nullable|array',
            'tabungans.*.type' => 'required|string|max:50',
            'tabungans.*.rate' => 'required|numeric|min:0',

            'depositos'         => 'nullable|array',
            'depositos.*.tenor'=> 'required|integer|min:1',
            'depositos.*.rate' => 'required|numeric|min:0',
            'depositos.*.label'=> 'nullable|string|max:50',

            'lps_rate'             => 'required|numeric|min:0',
            'lps_note'             => 'nullable|string|max:255',
            'lps_verification_url' => 'nullable|url',
        ]);

        DB::transaction(function () use ($request) {

            if ($request->is_active) {
                InterestRatePeriod::where('is_active', true)
                    ->update(['is_active' => false]);
            }

            $period = InterestRatePeriod::create([
                'title'     => $request->title,
                'month'     => $request->month,
                'year'      => $request->year,
                'is_active' => $request->is_active,
            ]);

            foreach ($request->tabungans ?? [] as $t) {
                InterestRateTabungan::create([
                    'interest_rate_period_id' => $period->id,
                    'tabungan_type'           => $t['type'],
                    'rate'                    => $t['rate'],
                ]);
            }

            foreach ($request->depositos ?? [] as $d) {
                InterestRateDeposito::create([
                    'interest_rate_period_id' => $period->id,
                    'tenor_month'             => $d['tenor'],
                    'rate'                    => $d['rate'],
                    'label'                   => $d['label'] ?? null,
                ]);
            }

            InterestRateLps::create([
                'interest_rate_period_id' => $period->id,
                'rate'                    => $request->lps_rate,
                'note'                    => $request->lps_note,
                'verification_url'        => $request->lps_verification_url,
            ]);
        });

        return redirect()->route('admin.main.index')
            ->with('success', 'Suku bunga berhasil ditambahkan!');
    }

    /**
     * EDIT
     */
    public function edit(InterestRatePeriod $period)
    {
        $period->load(['tabungans','depositos','lps']);
        return view('admin.main.interest-rate.edit', compact('period'));
    }

    /**
     * UPDATE (FIX AMAN)
     */
    public function update(Request $request, InterestRatePeriod $period)
    {
        $request->validate([
            'title'     => 'required|string|max:100',
            'month'     => 'required|integer|min:1|max:12',
            'year'      => 'required|integer|min:2000',
            'is_active' => 'required|boolean',

            'tabungans'         => 'nullable|array',
            'tabungans.*.type' => 'required|string|max:50',
            'tabungans.*.rate' => 'required|numeric|min:0',

            'depositos'         => 'nullable|array',
            'depositos.*.tenor'=> 'required|integer|min:1',
            'depositos.*.rate' => 'required|numeric|min:0',

            'lps_rate'             => 'required|numeric|min:0',
            'lps_note'             => 'nullable|string|max:255',
            'lps_verification_url' => 'nullable|url',
        ]);

        DB::transaction(function () use ($request, $period) {

            if ($request->is_active) {
                InterestRatePeriod::where('id','!=',$period->id)
                    ->update(['is_active' => false]);
            }

            $period->update([
                'title'     => $request->title,
                'month'     => $request->month,
                'year'      => $request->year,
                'is_active' => $request->is_active,
            ]);

            /**
             * ================= TABUNGAN (AMAN)
             */
            $validTabungans = collect($request->tabungans ?? [])
                ->filter(fn ($t) =>
                    !empty($t['type']) && $t['rate'] !== null
                );

            if ($validTabungans->count() > 0) {
                InterestRateTabungan::where('interest_rate_period_id',$period->id)->delete();

                foreach ($validTabungans as $t) {
                    InterestRateTabungan::create([
                        'interest_rate_period_id' => $period->id,
                        'tabungan_type'           => $t['type'],
                        'rate'                    => $t['rate'],
                    ]);
                }
            }

            /**
             * ================= DEPOSITO
             */
            InterestRateDeposito::where('interest_rate_period_id',$period->id)->delete();

            foreach ($request->depositos ?? [] as $d) {
                InterestRateDeposito::create([
                    'interest_rate_period_id' => $period->id,
                    'tenor_month'             => $d['tenor'],
                    'rate'                    => $d['rate'],
                    'label'                   => $d['label'] ?? null,
                ]);
            }

            /**
             * ================= LPS
             */
            InterestRateLps::updateOrCreate(
                ['interest_rate_period_id' => $period->id],
                [
                    'rate'             => $request->lps_rate,
                    'note'             => $request->lps_note,
                    'verification_url' => $request->lps_verification_url,
                ]
            );
        });

        return redirect()->route('admin.main.index')
            ->with('success', 'Suku bunga berhasil diperbarui!');
    }

    /**
     * DELETE
     */
    public function destroy(InterestRatePeriod $interestRate)
    {
        DB::transaction(fn () => $interestRate->delete());

        return redirect()->route('admin.main.index')
            ->with('success', 'Suku bunga berhasil dihapus!');
    }
}
