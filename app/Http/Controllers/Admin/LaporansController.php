<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporansController extends Controller
{
    public function index()
    {
        $laporans = Laporan::orderBy('tahun', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.publikasi.index', compact('laporans'));
    }

    public function create()
    {
        return view('admin.publikasi.laporan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipe'  => 'required|in:keuangan,tata-kelola,berkelanjutan',
            'jenis' => 'nullable|in:triwulan,semester,tahunan',
            'tahun' => 'required|digits:4',
            'judul' => 'required|string|max:255',
            'file'  => 'required|mimes:pdf|max:10240', // 10MB
        ]);

        $filePath = $request->file('file')->store('laporan', 'public');

        Laporan::create([
            'tipe'  => $request->tipe,
            'jenis' => $request->jenis,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'file'  => $filePath,
        ]);

        return redirect()
            ->route('admin.publikasi.index')
            ->with('success', 'Laporan berhasil ditambahkan');
    }

    public function edit(Laporan $laporan)
    {
        return view('admin.publikasi.laporan.edit', compact('laporan'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        $request->validate([
            'tipe'  => 'required|in:keuangan,tata-kelola,berkelanjutan',
            'jenis' => 'nullable|in:triwulan,semester,tahunan',
            'tahun' => 'required|digits:4',
            'judul' => 'required|string|max:255',
            'file'  => 'nullable|mimes:pdf|max:10240',
        ]);

        $data = $request->only([
            'tipe',
            'jenis',
            'tahun',
            'judul',
        ]);

        // Jika upload file baru
        if ($request->hasFile('file')) {

            if ($laporan->file && Storage::disk('public')->exists($laporan->file)) {
                Storage::disk('public')->delete($laporan->file);
            }

            $data['file'] = $request->file('file')->store('laporan', 'public');
        }

        $laporan->update($data);

        return redirect()
            ->route('admin.publikasi.index')
            ->with('success', 'Laporan berhasil diperbarui');
    }

    public function destroy(Laporan $laporan)
    {
        if ($laporan->file && Storage::disk('public')->exists($laporan->file)) {
            Storage::disk('public')->delete($laporan->file);
        }

        $laporan->delete();

        return redirect()
            ->route('admin.publikasi.index')
            ->with('success', 'Laporan berhasil dihapus');
    }
}