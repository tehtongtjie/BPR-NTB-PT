@extends('admin.layouts.app')

@section('title', 'Tambah Laporan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- PAGE HEADER --}}
    <div>
        <h1 class="text-2xl font-semibold text-slate-800">
            Tambah Laporan
        </h1>
        <p class="text-sm text-slate-500 mt-1">
            Tambahkan laporan publikasi perusahaan
        </p>
    </div>

    {{-- FORM CARD --}}
    <form action="{{ route('admin.publikasi.laporan.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
        @csrf

        {{-- TIPE LAPORAN --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Tipe Laporan
            </label>
            <select name="tipe" required
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                       px-4 py-2.5 text-slate-700
                       focus:bg-white focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10 transition">
                <option value="">-- Pilih Tipe --</option>
                <option value="keuangan" {{ old('tipe') === 'keuangan' ? 'selected' : '' }}>
                    Keuangan
                </option>
                <option value="tata-kelola" {{ old('tipe') === 'tata-kelola' ? 'selected' : '' }}>
                    Tata Kelola
                </option>
                <option value="berkelanjutan" {{ old('tipe') === 'berkelanjutan' ? 'selected' : '' }}>
                    Berkelanjutan
                </option>
            </select>
        </div>

        {{-- JENIS LAPORAN --}}
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
                <option value="triwulan" {{ old('jenis') === 'triwulan' ? 'selected' : '' }}>
                    Triwulan
                </option>
                <option value="semester" {{ old('jenis') === 'semester' ? 'selected' : '' }}>
                    Semester
                </option>
                <option value="tahunan" {{ old('jenis') === 'tahunan' ? 'selected' : '' }}>
                    Tahunan
                </option>
            </select>
            <p class="text-xs text-slate-500">
                * Untuk non-keuangan boleh dikosongkan atau pilih Tahunan
            </p>
        </div>

        {{-- TAHUN --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Tahun
            </label>
            <input type="number" name="tahun" required
                value="{{ old('tahun') }}"
                placeholder="Contoh: 2025"
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                       px-4 py-2.5 text-slate-700
                       focus:bg-white focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- JUDUL LAPORAN --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Judul Laporan
            </label>
            <input type="text" name="judul" required
                value="{{ old('judul') }}"
                placeholder="Lap. Keuangan Triwulan I 2025"
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                       px-4 py-2.5 text-slate-700
                       focus:bg-white focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- FILE PDF --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                File Laporan (PDF)
            </label>

            <input type="file"
                name="file"
                accept="application/pdf"
                required
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                    px-4 py-2.5 text-slate-700
                    file:mr-4 file:rounded-lg
                    file:border-0 file:bg-[#00326B]
                    file:px-4 file:py-2
                    file:text-sm file:text-white
                    hover:file:bg-[#002855]
                    focus:ring-4 focus:ring-[#00326B]/10 transition">

            <p class="text-xs text-slate-500">
                Format: PDF • Maksimal 10MB
            </p>
        </div>

        {{-- ACTION --}}
        <div class="flex gap-3 pt-4">
            <button type="submit"
                class="rounded-xl bg-[#00326B] px-6 py-2.5
                       text-sm font-medium text-white hover:bg-[#002855] transition">
                Simpan Laporan
            </button>

            <a href="{{ route('admin.publikasi.index') }}"
               class="text-sm text-slate-500 hover:text-slate-700">
                Batal
            </a>
        </div>

    </form>
</div>
@endsection
