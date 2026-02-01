@extends('admin.layouts.app')

@section('title', 'Edit Laporan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-800">
                Edit Laporan
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Perbarui data laporan publikasi perusahaan
            </p>
        </div>

        <a href="{{ route('admin.publikasi.index') }}"
           class="text-sm text-slate-500 hover:text-slate-700 transition">
            ← Kembali
        </a>
    </div>

    {{-- FORM --}}
    <form action="{{ route('admin.publikasi.laporan.update', $laporan->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
        @csrf
        @method('PUT')

        {{-- ================= TIPE LAPORAN ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Tipe Laporan
            </label>
            <select name="tipe" required
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                       px-4 py-2.5 text-slate-700
                       focus:bg-white focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10 transition">
                <option value="keuangan" {{ old('tipe', $laporan->tipe) === 'keuangan' ? 'selected' : '' }}>
                    Keuangan
                </option>
                <option value="tata-kelola" {{ old('tipe', $laporan->tipe) === 'tata-kelola' ? 'selected' : '' }}>
                    Tata Kelola
                </option>
                <option value="berkelanjutan" {{ old('tipe', $laporan->tipe) === 'berkelanjutan' ? 'selected' : '' }}>
                    Berkelanjutan
                </option>
            </select>
        </div>

        {{-- ================= JENIS ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Jenis Laporan
            </label>
            <select name="jenis"
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                       px-4 py-2.5 text-slate-700
                       focus:bg-white focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10 transition">
                <option value="">-- Pilih Jenis --</option>
                <option value="triwulan" {{ old('jenis', $laporan->jenis) === 'triwulan' ? 'selected' : '' }}>
                    Triwulan
                </option>
                <option value="semester" {{ old('jenis', $laporan->jenis) === 'semester' ? 'selected' : '' }}>
                    Semester
                </option>
                <option value="tahunan" {{ old('jenis', $laporan->jenis) === 'tahunan' ? 'selected' : '' }}>
                    Tahunan
                </option>
            </select>
            <p class="text-xs text-slate-500">
                Kosongkan jika tidak relevan (non-keuangan)
            </p>
        </div>

        {{-- ================= TAHUN ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Tahun
            </label>
            <input type="number"
                name="tahun"
                value="{{ old('tahun', $laporan->tahun) }}"
                required
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                       px-4 py-2.5 text-slate-700
                       focus:bg-white focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- ================= JUDUL ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Judul Laporan
            </label>
            <input type="text"
                name="judul"
                value="{{ old('judul', $laporan->judul) }}"
                required
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                       px-4 py-2.5 text-slate-700
                       focus:bg-white focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- ================= FILE PDF ================= --}}
        <div class="space-y-2">
            <label class="text-sm font-medium text-slate-600">
                File Laporan (PDF)
            </label>

            {{-- FILE LAMA --}}
            @if ($laporan->file)
                <div class="flex items-center gap-4">
                    <a href="{{ asset('storage/' . $laporan->file) }}"
                       target="_blank"
                       class="inline-flex items-center gap-2
                              rounded-lg border border-slate-200
                              bg-slate-50 px-4 py-2 text-sm text-slate-700
                              hover:bg-slate-100 transition">
                        Lihat File Saat Ini
                    </a>
                    <span class="text-xs text-slate-500">
                        File PDF yang sedang digunakan
                    </span>
                </div>
            @endif

            {{-- UPLOAD BARU --}}
            <input type="file"
                name="file"
                accept="application/pdf"
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                       px-4 py-2.5 text-slate-700
                       file:mr-4 file:rounded-lg
                       file:border-0 file:bg-[#00326B]
                       file:px-4 file:py-2
                       file:text-sm file:text-white
                       hover:file:bg-[#002855]
                       focus:ring-4 focus:ring-[#00326B]/10 transition">

            <p class="text-xs text-slate-500">
                Kosongkan jika tidak ingin mengganti file
            </p>
        </div>

        {{-- ================= ACTION ================= --}}
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.publikasi.index') }}"
               class="text-sm text-slate-500 hover:text-slate-700 transition">
                Batal
            </a>

            <button type="submit"
                class="rounded-xl bg-[#00326B] px-8 py-2.5 text-white">
                Update Laporan
            </button>
        </div>

    </form>
</div>
@endsection
