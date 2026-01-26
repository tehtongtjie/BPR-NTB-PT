<?php

namespace App\Http\Controllers;

use App\Models\Kantor;
use Illuminate\Http\Request;

class JaringanKantorController extends Controller
{
    public function index(Request $request)
    {
        $query = Kantor::query();

        // =====================
        // 🔍 SEARCH GLOBAL (NAMA + ALAMAT)
        // =====================

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->q . '%')
                ->orWhere('alamat', 'like', '%' . $request->q . '%')
                ->orWhere('telepon', 'like', '%' . $request->q . '%');
            });
        }

        // =====================
        // 📌 FILTER TIPE (OPTIONAL)
        // =====================
        if ($request->filled('tipe') && $request->tipe !== 'all') {
            $query->where('tipe', $request->tipe);
        }

        // =====================
        // 📄 PAGINATION (SETELAH SEARCH)
        // =====================
        $kantor = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString(); // 🔥 biar q= tetap kebawa

        // =====================
        // 📊 STATS
        // =====================
        $stats = [
            'total'  => Kantor::count(),
            'cabang' => Kantor::where('tipe', 'cabang')->count(),
            'kas'    => Kantor::where('tipe', 'kas')->count(),
        ];

        return view('pages.jaringan-kantor.index', [
            'kantor'  => $kantor,
            'kantors' => $kantor,
            'stats'   => $stats,
        ]);
    }
}
