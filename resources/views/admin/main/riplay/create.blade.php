@extends('admin.layouts.app')

@section('title', 'Tambah Dokumen Riplay')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div>
        <h1 class="text-2xl font-semibold text-slate-800">Tambah Dokumen Riplay</h1>
        <p class="text-sm text-slate-500 mt-1">Upload PDF Riplay agar dapat ditampilkan di halaman publik.</p>
    </div>

    <form action="{{ route('admin.riplay.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-5">
        @csrf
        @include('admin.components.form-errors')

        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Judul Dokumen <span class="text-red-500">*</span></label>
            <input type="text"
                   name="title"
                   value="{{ old('title') }}"
                   required
                   placeholder="Contoh: Laporan Tahunan 2025"
                   class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-slate-700 focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>
        @error('title')
            <p class="text-xs text-red-600">{{ $message }}</p>
        @enderror

        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Tipe Dokumen <span class="text-red-500">*</span></label>
            <select name="type"
                    required
                    class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5 text-slate-700 focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition">
                <option value="" disabled {{ old('type') ? '' : 'selected' }}>-- Pilih Tipe --</option>
                <option value="kredit" {{ old('type') === 'kredit' ? 'selected' : '' }}>Kredit</option>
                <option value="deposito" {{ old('type') === 'deposito' ? 'selected' : '' }}>Deposito</option>
                <option value="tabungan" {{ old('type') === 'tabungan' ? 'selected' : '' }}>Tabungan</option>
            </select>
        </div>
        @error('type')
            <p class="text-xs text-red-600">{{ $message }}</p>
        @enderror

        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Deskripsi <span class="text-red-500">*</span></label>
            <textarea name="description"
                      rows="4"
                      required
                      placeholder="Ringkasan singkat isi dokumen"
                      class="w-full rounded-xl bg-slate-50 border border-slate-200 px-4 py-3 text-slate-700 focus:bg-white focus:border-[#00326B] focus:ring-4 focus:ring-[#00326B]/10 transition resize-none">{{ old('description') }}</textarea>
        </div>
        @error('description')
            <p class="text-xs text-red-600">{{ $message }}</p>
        @enderror

        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">File PDF <span class="text-red-500">*</span></label>
            <input type="file"
                   name="document"
                   accept="application/pdf"
                   required
                   class="block w-full text-sm text-slate-600 file:mr-4 file:rounded-xl file:border-0 file:bg-[#00326B]/10 file:px-4 file:py-2 file:text-sm file:font-medium file:text-[#00326B] hover:file:bg-[#00326B]/20 transition">
            <p class="text-xs text-slate-500">Maksimal 20MB. Format PDF.</p>
        </div>
        @error('document')
            <p class="text-xs text-red-600">{{ $message }}</p>
        @enderror

        <div class="flex items-center gap-2">
            <input type="hidden" name="is_active" value="0">
            <label class="inline-flex items-center gap-2 text-sm font-medium text-slate-600">
                <input type="checkbox"
                       name="is_active"
                       value="1"
                       {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                       class="h-4 w-4 rounded border-slate-300 text-[#00326B] focus:ring-[#00326B]/60">
                Aktifkan dokumen
            </label>
        </div>
        @error('is_active')
            <p class="text-xs text-red-600">{{ $message }}</p>
        @enderror

        <div class="flex items-center gap-3 pt-4">
            <button type="submit"
                    class="inline-flex items-center gap-2 rounded-xl bg-[#00326B] px-6 py-2.5 text-sm font-medium text-white hover:bg-[#002855] focus:ring-4 focus:ring-[#00326B]/20 transition">
                Simpan Dokumen
            </button>
            <a href="{{ route('admin.riplay.index') }}"
               class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
