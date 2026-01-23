@extends('admin.layouts.app')

@section('title', 'Tambah Promo')

@section('content')
<div class="max-w-3xl space-y-6">

    {{-- HEADER --}}
    <div>
        <h1 class="text-xl font-semibold text-slate-800">
            Tambah Promo
        </h1>
        <p class="text-sm text-slate-500">
            Tambahkan promo yang akan ditampilkan di homepage
        </p>
    </div>

    {{-- CARD --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

        <form action="{{ route('admin.main.promo.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-5">
            @csrf

            {{-- JUDUL --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Judul Promo
                </label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-2
                           text-sm text-slate-700
                           focus:border-[#00326B] focus:ring-[#00326B] focus:outline-none"
                    placeholder="Contoh: TABUNGANKU"
                >
            </div>

            {{-- DESKRIPSI --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Deskripsi Singkat
                </label>
                <textarea
                    name="short_desc"
                    rows="4"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-2
                           text-sm text-slate-700
                           focus:border-[#00326B] focus:ring-[#00326B] focus:outline-none"
                    placeholder="Tuliskan deskripsi singkat promo..."
                >{{ old('short_desc') }}</textarea>
            </div>

            {{-- GAMBAR --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Gambar Promo
                </label>
                <input
                    type="file"
                    name="image"
                    accept="image/*"
                    required
                    class="block w-full text-sm text-slate-600
                           file:mr-4 file:rounded-lg file:border-0
                           file:bg-slate-100 file:px-4 file:py-2
                           file:text-sm file:font-medium file:text-slate-700
                           hover:file:bg-slate-200"
                >
                <p class="mt-1 text-xs text-slate-500">
                    Format: JPG, PNG, WEBP
                </p>
            </div>

            {{-- STATUS --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Status
                </label>
                <select
                    name="is_active"
                    class="w-full rounded-xl border border-slate-300 px-4 py-2
                           text-sm text-slate-700
                           focus:border-[#00326B] focus:ring-[#00326B] focus:outline-none"
                >
                    <option value="1" selected>Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            {{-- ACTION --}}
            <div class="flex items-center gap-3 pt-4">

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded-xl
                           bg-[#00326B] px-5 py-2
                           text-sm font-medium text-white
                           hover:bg-[#002855] transition"
                >
                    Simpan Promo
                </button>

                <a
                    href="{{ route('admin.main.index') }}"
                    class="inline-flex items-center rounded-xl
                           border border-slate-300 px-5 py-2
                           text-sm font-medium text-slate-600
                           hover:bg-slate-100 transition"
                >
                    Kembali
                </a>

            </div>

        </form>

    </div>
</div>
@endsection
