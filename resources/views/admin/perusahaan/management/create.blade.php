@extends('admin.layouts.app')

@section('title', 'Tambah Manajemen')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- PAGE HEADER --}}
    <div>
        <h1 class="text-2xl font-semibold text-slate-800">
            Tambah Manajemen
        </h1>
        <p class="text-sm text-slate-500 mt-1">
            Tambahkan data Direksi atau Komisaris perusahaan
        </p>
    </div>

    {{-- FORM CARD --}}
    <form action="{{ route('perusahaan.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
        @csrf

        {{-- TIPE MANAGEMENT --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Tipe Manajemen
            </label>
            <select name="type" required
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                       px-4 py-2.5 text-slate-700
                       focus:bg-white focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10 transition">
                <option value="">-- Pilih Tipe --</option>
                <option value="direksi" {{ old('type') === 'direksi' ? 'selected' : '' }}>
                    Direksi
                </option>
                <option value="komisaris" {{ old('type') === 'komisaris' ? 'selected' : '' }}>
                    Komisaris
                </option>
            </select>
        </div>

        {{-- NAMA --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Nama Lengkap
            </label>
            <input type="text" name="name" required
                value="{{ old('name') }}"
                placeholder="Contoh: Hj. Denda Sucihartiani, SE"
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                       px-4 py-2.5 text-slate-700
                       focus:bg-white focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- JABATAN --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Jabatan
            </label>
            <input type="text" name="position" required
                value="{{ old('position') }}"
                placeholder="Direktur Bisnis / Komisaris Independen"
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                       px-4 py-2.5 text-slate-700
                       focus:bg-white focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- FOTO --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Foto Manajemen
            </label>

            <input type="file"
                name="image"
                accept="image/*"
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                    px-4 py-2.5 text-slate-700
                    file:mr-4 file:rounded-lg
                    file:border-0 file:bg-[#00326B]
                    file:px-4 file:py-2
                    file:text-sm file:text-white
                    hover:file:bg-[#002855]
                    focus:ring-4 focus:ring-[#00326B]/10 transition">

            <p class="text-xs text-slate-500">
                Format: JPG, PNG, WEBP • Maks 2MB
            </p>
        </div>

        {{-- RINGKASAN --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Ringkasan
            </label>
            <textarea name="excerpt" rows="2"
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                       px-4 py-3 text-slate-700
                       focus:bg-white focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10 transition resize-none">{{ old('excerpt') }}</textarea>
        </div>

        {{-- PROFIL --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Profil Lengkap
            </label>
            <textarea name="profile" rows="6"
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                       px-4 py-3 text-slate-700
                       focus:bg-white focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10 transition resize-none">{{ old('profile') }}</textarea>
        </div>

        {{-- URUTAN & STATUS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm font-medium text-slate-600">
                    Urutan Tampil
                </label>
                <input type="number" name="order"
                    value="{{ old('order', 0) }}"
                    class="w-full rounded-xl bg-slate-50 border border-slate-200
                           px-4 py-2.5 text-slate-700">
            </div>

            <div>
                <label class="text-sm font-medium text-slate-600">
                    Status
                </label>
                <select name="is_active"
                    class="w-full rounded-xl bg-slate-50 border border-slate-200
                           px-4 py-2.5 text-slate-700">
                    <option value="1" selected>Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>
        </div>

        {{-- ACTION --}}
        <div class="flex gap-3 pt-4">
            <button type="submit"
                class="rounded-xl bg-[#00326B] px-6 py-2.5
                       text-sm font-medium text-white hover:bg-[#002855] transition">
                Simpan Manajemen
            </button>

            <a href="{{ route('perusahaan.index') }}"
               class="text-sm text-slate-500 hover:text-slate-700">
                Batal
            </a>
        </div>

    </form>
</div>
@endsection
