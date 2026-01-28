@extends('admin.layouts.app')

@section('title', 'Tambah Artikel')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- PAGE HEADER --}}
    <div>
        <h1 class="text-2xl font-semibold text-slate-800">
            Tambah Artikel
        </h1>
        <p class="text-sm text-slate-500 mt-1">
            Kelola konten artikel, kategori, dan publikasi dengan rapi
        </p>
    </div>

    {{-- FORM CARD --}}
    <form action="{{ route('admin.main.article.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
        @csrf

        {{-- ================= JUDUL ARTIKEL ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Judul Artikel
            </label>
            <input type="text"
                   name="title"
                   value="{{ old('title') }}"
                   placeholder="Contoh: Rapat Koordinasi Tahunan PT BPR NTB 2026"
                   required
                   class="w-full rounded-xl
                          bg-slate-50 border border-slate-200
                          px-4 py-2.5 text-slate-700
                          placeholder:text-slate-400
                          focus:bg-white
                          focus:border-[#00326B]
                          focus:ring-4 focus:ring-[#00326B]/10
                          transition-all duration-200 ease-out">
        </div>

        {{-- ================= KATEGORI ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Kategori
            </label>
            <select name="category"
                    required
                    class="w-full rounded-xl
                        bg-slate-50 border border-slate-200
                        px-4 py-2.5 text-slate-700
                        focus:bg-white
                        focus:border-[#00326B]
                        focus:ring-4 focus:ring-[#00326B]/10
                        transition">

                <option value="" disabled {{ old('category') ? '' : 'selected' }}>
                    -- Pilih Kategori --
                </option>

                <option value="EKONOMI" {{ old('category') == 'EKONOMI' ? 'selected' : '' }}>EKONOMI</option>
                <option value="CSR" {{ old('category') == 'CSR' ? 'selected' : '' }}>CSR</option>
                <option value="INTERNAL" {{ old('category') == 'INTERNAL' ? 'selected' : '' }}>INTERNAL</option>
                <option value="PENGHARGAAN" {{ old('category') == 'PENGHARGAAN' ? 'selected' : '' }}>PENGHARGAAN</option>
            </select>
        </div>

        {{-- ================= PENULIS ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Penulis
            </label>
            <input type="text"
                name="author"
                value="{{ old('author') }}"
                placeholder="Contoh: Humas BPR NTB"
                required
                class="w-full rounded-xl
                        bg-slate-50 border border-slate-200
                        px-4 py-2.5 text-slate-700
                        placeholder:text-slate-400
                        focus:bg-white
                        focus:border-[#00326B]
                        focus:ring-4 focus:ring-[#00326B]/10
                        transition">
        </div>

        {{-- ================= RINGKASAN ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Ringkasan Artikel
            </label>
            <textarea name="excerpt"
                      rows="3"
                      required
                      placeholder="Ringkasan singkat artikel untuk tampilan awal"
                      class="w-full rounded-xl
                             bg-slate-50 border border-slate-200
                             px-4 py-3 text-slate-700
                             placeholder:text-slate-400
                             focus:bg-white
                             focus:border-[#00326B]
                             focus:ring-4 focus:ring-[#00326B]/10
                             transition resize-none">{{ old('excerpt') }}</textarea>
        </div>

        {{-- ================= KONTEN ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Konten Artikel
            </label>
            <textarea name="content"
                      rows="8"
                      required
                      placeholder="Isi lengkap artikel"
                      class="w-full rounded-xl
                             bg-slate-50 border border-slate-200
                             px-4 py-3 text-slate-700
                             focus:bg-white
                             focus:border-[#00326B]
                             focus:ring-4 focus:ring-[#00326B]/10
                             transition resize-none">{{ old('content') }}</textarea>
        </div>

        {{-- ================= THUMBNAIL ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Thumbnail Artikel
            </label>
            <input type="file"
                   name="thumbnail"
                   accept="image/*"
                   required
                   class="block w-full text-sm text-slate-600
                          file:mr-4 file:rounded-xl
                          file:border-0
                          file:bg-[#00326B]/10
                          file:px-4 file:py-2
                          file:text-sm file:font-medium
                          file:text-[#00326B]
                          hover:file:bg-[#00326B]/20
                          transition">
        </div>

        {{-- ================= TANGGAL PUBLIKASI ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Tanggal Publikasi
            </label>
            <input type="date"
                   name="published_at"
                   value="{{ old('published_at', now()->toDateString()) }}"
                   required
                   class="w-full rounded-xl
                          bg-slate-50 border border-slate-200
                          px-4 py-2.5 text-slate-700
                          focus:bg-white
                          focus:border-[#00326B]
                          focus:ring-4 focus:ring-[#00326B]/10
                          transition">
        </div>

        {{-- ================= STATUS ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Status Artikel
            </label>
            <select name="is_published"
                    class="w-full rounded-xl
                           bg-slate-50 border border-slate-200
                           px-4 py-2.5 text-slate-700
                           focus:bg-white
                           focus:border-[#00326B]
                           focus:ring-4 focus:ring-[#00326B]/10
                           transition">
                <option value="1" selected>Publish</option>
                <option value="0">Draft</option>
            </select>
        </div>

        {{-- ================= ACTION BUTTON ================= --}}
        <div class="flex items-center gap-3 pt-4">
            <button type="submit"
                    class="inline-flex items-center gap-2 rounded-xl
                           bg-[#00326B] px-6 py-2.5
                           text-sm font-medium text-white
                           hover:bg-[#002855]
                           focus:ring-4 focus:ring-[#00326B]/20
                           transition">
                Simpan Artikel
            </button>

            <a href="{{ route('admin.main.article.index') }}"
               class="text-sm text-slate-500 hover:text-slate-700 transition">
                Batal
            </a>
        </div>

    </form>

</div>
@endsection
