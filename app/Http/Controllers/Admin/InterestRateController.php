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
     * TAMPILKAN SUKU BUNGA (DASHBOARD)
     */
    public function index()
    {
        $periods = InterestRatePeriod::with([
                'tabungans',
                'depositos',
                'lps'
            ])
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(5);

        return view('admin.main.index', compact('periods'));
    }

    /**
     * FORM CREATE SUKU BUNGA
     */
    public function create()
    {
        return view('admin.main.interest-rate.create');
    }

    /**
     * SIMPAN PERIOD + TABUNGAN + DEPOSITO + LPS
     */
    public function store(Request $request)
    {
        $request->validate([
            // ===== PERIOD =====
            'title'     => 'required|string|max:100',
            'month'     => 'required|integer|min:1|max:12',
            'year'      => 'required|integer|min:2000',
            'is_active' => 'required|boolean',

            // ===== TABUNGAN =====
            'tabungans'               => 'nullable|array',
            'tabungans.*.type'        => 'required|string|max:50',
            'tabungans.*.rate'        => 'required|numeric|min:0',

            // ===== DEPOSITO =====
            'depositos'               => 'nullable|array',
            'depositos.*.tenor'       => 'required|integer|min:1',
            'depositos.*.rate'        => 'required|numeric|min:0',
            'depositos.*.is_best'     => 'nullable|boolean',
            'depositos.*.label'       => 'nullable|string|max:50',

            // ===== LPS =====
            'lps_rate'               => 'required|numeric|min:0',
            'lps_note'               => 'nullable|string|max:255',
            'lps_verification_url'   => 'nullable|url',
        ]);

        DB::transaction(function () use ($request) {

            // =====================
            // SIMPAN PERIOD
            // =====================
            if ($request->is_active) {
                InterestRatePeriod::where('is_active', true)->update(['is_active' => false]);
            }

            $period = InterestRatePeriod::create([
                'title'     => $request->title,
                'month'     => $request->month,
                'year'      => $request->year,
                'is_active' => $request->is_active,
            ]);

            // =====================
            // SIMPAN TABUNGAN
            // =====================
            if ($request->filled('tabungans')) {
                foreach ($request->tabungans as $tabungan) {
                    InterestRateTabungan::create([
                        'interest_rate_period_id' => $period->id,
                        'tabungan_type'           => $tabungan['type'],
                        'rate'                    => $tabungan['rate'],
                    ]);
                }
            }

            // =====================
            // SIMPAN DEPOSITO
            // =====================
            if ($request->filled('depositos')) {
                foreach ($request->depositos as $deposito) {
                    InterestRateDeposito::create([
                        'interest_rate_period_id' => $period->id,
                        'tenor_month'             => $deposito['tenor'],
                        'rate'                    => $deposito['rate'],
                        'is_best'                 => $deposito['is_best'] ?? false,
                        'label'                   => $deposito['label'] ?? null,
                    ]);
                }
            }

            // =====================
            // SIMPAN LPS
            // =====================
            InterestRateLps::create([
                'interest_rate_period_id' => $period->id,
                'rate'                    => $request->lps_rate,
                'note'                    => $request->lps_note,
                'verification_url'        => $request->lps_verification_url,
            ]);
        });

        return redirect()
            ->route('admin.main.index')
            ->with('success', 'Suku bunga berhasil ditambahkan!');
    }

    /**
     * FORM EDIT SUKU BUNGA
     */
    public function edit(InterestRatePeriod $period)
    {
        $period->load([
            'tabungans',
            'depositos',
            'lps',
        ]);

        return view('admin.main.interest-rate.edit', compact('period'));
    }


    /**
     * UPDATE PERIOD + DETAIL
     */
    public function update(Request $request, InterestRatePeriod $interestRate)
    {
        $request->validate([
            'title'     => 'required|string|max:100',
            'month'     => 'required|integer|min:1|max:12',
            'year'      => 'required|integer|min:2000',
            'is_active' => 'required|boolean',

            'tabungans'               => 'nullable|array',
            'tabungans.*.type'        => 'required|string|max:50',
            'tabungans.*.rate'        => 'required|numeric|min:0',

            'depositos'               => 'nullable|array',
            'depositos.*.tenor'       => 'required|integer|min:1',
            'depositos.*.rate'        => 'required|numeric|min:0',
            'depositos.*.is_best'     => 'nullable|boolean',
            'depositos.*.label'       => 'nullable|string|max:50',

            'lps_rate'               => 'required|numeric|min:0',
            'lps_note'               => 'nullable|string|max:255',
            'lps_verification_url'   => 'nullable|url',
        ]);

        DB::transaction(function () use ($request, $interestRate) {

            if ($request->is_active) {
                InterestRatePeriod::where('id', '!=', $interestRate->id)
                    ->update(['is_active' => false]);
            }

            // =====================
            // UPDATE PERIOD
            // =====================
            $interestRate->update([
                'title'     => $request->title,
                'month'     => $request->month,
                'year'      => $request->year,
                'is_active' => $request->is_active,
            ]);

            // =====================
            // RESET TABUNGAN
            // =====================
            InterestRateTabungan::where('interest_rate_period_id', $interestRate->id)->delete();
            if ($request->filled('tabungans')) {
                foreach ($request->tabungans as $tabungan) {
                    InterestRateTabungan::create([
                        'interest_rate_period_id' => $interestRate->id,
                        'tabungan_type'           => $tabungan['type'],
                        'rate'                    => $tabungan['rate'],
                    ]);
                }
            }

            // =====================
            // RESET DEPOSITO
            // =====================
            InterestRateDeposito::where('interest_rate_period_id', $interestRate->id)->delete();
            if ($request->filled('depositos')) {
                foreach ($request->depositos as $deposito) {
                    InterestRateDeposito::create([
                        'interest_rate_period_id' => $interestRate->id,
                        'tenor_month'             => $deposito['tenor'],
                        'rate'                    => $deposito['rate'],
                        'is_best'                 => $deposito['is_best'] ?? false,
                        'label'                   => $deposito['label'] ?? null,
                    ]);
                }
            }

            // =====================
            // UPDATE LPS
            // =====================
            InterestRateLps::updateOrCreate(
                ['interest_rate_period_id' => $interestRate->id],
                [
                    'rate'             => $request->lps_rate,
                    'note'             => $request->lps_note,
                    'verification_url' => $request->lps_verification_url,
                ]
            );
        });

        return redirect()
            ->route('admin.main.index')
            ->with('success', 'Suku bunga berhasil diperbarui!');
    }

    /**
     * HAPUS PERIOD + SEMUA DETAIL
     */
    public function destroy(InterestRatePeriod $interestRate)
    {
        DB::transaction(function () use ($interestRate) {
            $interestRate->delete();
        });

        return redirect()
            ->route('admin.main.index')
            ->with('success', 'Suku bunga berhasil dihapus!');
    }
}
