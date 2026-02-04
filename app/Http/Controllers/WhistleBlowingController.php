<?php

namespace App\Http\Controllers;

use App\Models\WhistleBlowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Exception;

class WhistleBlowingController extends Controller
{
    /**
     * SISI USER: Menampilkan halaman Form WBS
     */
    public function index()
    {
        return view('pages.pengaduan.WhistleBlowingSystem');
    }

    /**
     * SISI USER: Menyimpan laporan ke Database dengan Enkripsi
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'            => 'nullable|string|max:100',
            'email'           => 'nullable|email|max:100',
            'no_telepon'      => 'nullable|string|max:20',
            'kategori'        => 'required|string',
            'nama_terlapor'   => 'required|string|max:150',
            'lokasi_kejadian' => 'required|string|max:150',
            'waktu_kejadian'  => 'required',
            'laporan'         => 'required|string|min:20',
        ]);

        try {
            // Enkripsi identitas agar IT Admin tidak bisa baca lewat DB
            if ($request->filled('nama')) {
                $validated['nama'] = Crypt::encryptString($request->nama);
            }
            if ($request->filled('email')) {
                $validated['email'] = Crypt::encryptString($request->email);
            }
            if ($request->filled('no_telepon')) {
                $validated['no_telepon'] = Crypt::encryptString($request->no_telepon);
            }

            // Standarisasi format tanggal
            $validated['waktu_kejadian'] = date('Y-m-d H:i:s', strtotime($request->waktu_kejadian));

            WhistleBlowing::create($validated);

            return redirect()
                ->route('pengaduan.wbs')
                ->with('success', 'Laporan berhasil dikirim. Identitas Anda telah dilindungi dengan enkripsi.');
        } catch (Exception $e) {
            Log::error('WBS Store Error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal mengirim laporan. Silakan coba lagi.');
        }
    }

    /**
     * SISI ADMIN: Menampilkan daftar laporan masuk
     */
    public function adminIndex()
    {
        // Mengambil data laporan terbaru
        $reports = WhistleBlowing::orderBy('created_at', 'desc')->get();

        // Pastikan path view sesuai folder: resources/views/admin/wbs/index.blade.php
        return view('admin.wbs.index', compact('reports'));
    }

    /**
     * SISI ADMIN: Menghapus laporan (Opsional)
     */
    public function destroy($id)
    {
        try {
            $report = WhistleBlowing::findOrFail($id);
            $report->delete();
            return back()->with('success', 'Laporan berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menghapus data.');
        }
    }
}
