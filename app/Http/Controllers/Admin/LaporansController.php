<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporansController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::query();

        $tipe = $request->query('tipe');
        $jenis = $request->query('jenis');
        $tahun = $request->query('tahun');

        if ($tipe && in_array($tipe, ['keuangan', 'tata-kelola', 'berkelanjutan'], true)) {
            $query->where('tipe', $tipe);
        }

        if ($jenis && in_array($jenis, ['triwulan', 'semester', 'tahunan'], true)) {
            $query->where('jenis', $jenis);
        }

        if ($tahun && ctype_digit((string) $tahun)) {
            $query->where('tahun', (int) $tahun);
        }

        $laporans = $query
            ->orderBy('tahun', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.publikasi.index', compact('laporans'));
    }

    public function create()
    {
        return view('admin.publikasi.laporan.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'tipe'  => 'required|in:keuangan,tata-kelola,berkelanjutan',
            'jenis' => 'nullable|in:triwulan,semester,tahunan',
            'tahun' => 'required|digits:4',
            'judul' => 'required|string|max:255',
            'file'  => 'required|mimes:pdf|max:10240', // 10MB
        ];

        if ($request->tipe === 'keuangan') {
            $rules['jenis'] = 'required|in:triwulan,semester,tahunan';
        }

        $validated = $request->validate($rules);

        $filePath = $request->file('file')->store('laporan', 'public');

        Laporan::create([
            'tipe'  => $validated['tipe'],
            'jenis' => $validated['tipe'] === 'keuangan' ? $validated['jenis'] : null,
            'tahun' => $validated['tahun'],
            'judul' => $validated['judul'],
            'file'  => $filePath,
        ]);

        return redirect()
            ->route('admin.publikasi.laporan.index')
            ->with('success', 'Laporan berhasil ditambahkan');
    }

    public function edit(Laporan $laporan)
    {
        return view('admin.publikasi.laporan.edit', compact('laporan'));
    }

public function update(Request $request, Laporan $laporan)
{
    // ================= BASE RULES =================
    $rules = [
        'tipe'  => 'required|in:keuangan,tata-kelola,berkelanjutan',
        'tahun' => 'required|digits:4',
        'judul' => 'required|string|max:255',
        'file'  => 'nullable|mimes:pdf|max:10240',
    ];

    // ================= TAMBAHAN RULE JIKA KEUANGAN =================
    if ($request->tipe === 'keuangan') {
        $rules['jenis'] = 'required|in:triwulan,semester,tahunan';
    }

    $validated = $request->validate($rules);

    // ================= DATA YANG DIUPDATE =================
    $data = [
        'tipe'  => $validated['tipe'],
        'tahun' => $validated['tahun'],
        'judul' => $validated['judul'],
        'jenis' => $request->tipe === 'keuangan' ? $request->jenis : null,
    ];

    // ================= JIKA UPLOAD FILE BARU =================
    if ($request->hasFile('file')) {

        if ($laporan->file && Storage::disk('public')->exists($laporan->file)) {
            Storage::disk('public')->delete($laporan->file);
        }

        $data['file'] = $request->file('file')->store('laporan', 'public');
    }

    $laporan->update($data);

    return redirect()
        ->route('admin.publikasi.laporan.index')
        ->with('success', 'Laporan berhasil diperbarui');
}


    public function destroy(Laporan $laporan)
    {
        if ($laporan->file && Storage::disk('public')->exists($laporan->file)) {
            Storage::disk('public')->delete($laporan->file);
        }

        $laporan->delete();

        return redirect()
            ->route('admin.publikasi.laporan.index')
            ->with('success', 'Laporan berhasil dihapus');
    }
}
