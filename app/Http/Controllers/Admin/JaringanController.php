<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kantor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JaringanController extends Controller
{
    /**
     * TAMPILKAN JARINGAN KANTOR
     */
    public function index(Request $request)
    {
        $query = Kantor::query();

        // SEARCH
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->q . '%')
                  ->orWhere('alamat', 'like', '%' . $request->q . '%')
                  ->orWhere('telepon', 'like', '%' . $request->q . '%');
            });
        }

        $kantors = $query
            ->orderBy('created_at', 'desc') // TERBARU DI ATAS
            ->paginate(10)
            ->withQueryString();

        // VIEW PAGE UTAMA
        return view('admin.jaringan.index', compact('kantors'));
    }

    /**
     * FORM CREATE JARINGAN
     */
    public function create()
    {
        return view('admin.jaringan.kantor.create');
    }

    /**
     * SIMPAN DATA JARINGAN
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipe'      => 'required|in:pusat,cabang,kas',
            'nama'      => 'required|string|max:150',
            'alamat'    => 'required|string',
            'telepon'   => 'nullable|string|max:30',
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        DB::transaction(function () use ($request) {
            Kantor::create([
                'tipe'      => $request->tipe,
                'nama'      => $request->nama,
                'alamat'    => $request->alamat,
                'telepon'   => $request->telepon,
                'latitude'  => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        });

        // 🔥 INI YANG PALING PENTING
        return redirect()
            ->route('jaringan.index')
            ->with('success', 'Data jaringan kantor berhasil ditambahkan!');
    }

    /**
     * FORM EDIT JARINGAN
     */
    public function edit(Kantor $kantor)
    {
        return view('admin.jaringan.kantor.edit', compact('kantor'));
    }

    /**
     * UPDATE DATA JARINGAN
     */
    public function update(Request $request, Kantor $kantor)
    {
        $request->validate([
            'tipe'      => 'required|in:pusat,cabang,kas',
            'nama'      => 'required|string|max:150',
            'alamat'    => 'required|string',
            'telepon'   => 'nullable|string|max:30',
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        DB::transaction(function () use ($request, $kantor) {
            $kantor->update([
                'tipe'      => $request->tipe,
                'nama'      => $request->nama,
                'alamat'    => $request->alamat,
                'telepon'   => $request->telepon,
                'latitude'  => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        });

        return redirect()
            ->route('jaringan.index')
            ->with('success', 'Data jaringan kantor berhasil diperbarui!');
    }

    /**
     * HAPUS DATA JARINGAN
     */
    public function destroy(Kantor $kantor)
    {
        $kantor->delete();

        return redirect()
            ->route('jaringan.index')
            ->with('success', 'Data jaringan kantor berhasil dihapus!');
    }
}
