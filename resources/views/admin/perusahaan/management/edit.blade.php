@extends('admin.layouts.app')

@section('title', 'Edit Manajemen')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-800">
                Edit Manajemen
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Perbarui data Direksi atau Komisaris perusahaan
            </p>
        </div>

        <a href="{{ route('perusahaan.index') }}"
           class="text-sm text-slate-500 hover:text-slate-700 transition">
            ← Kembali
        </a>
    </div>

    {{-- FORM --}}
    <form action="{{ route('perusahaan.update', $management->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
        @csrf
        @method('PUT')

        {{-- ================= TIPE ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Tipe Manajemen
            </label>
            <select name="type"
                required
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                       px-4 py-2.5 text-slate-700
                       focus:bg-white focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10 transition">
                <option value="direksi" {{ old('type', $management->type) === 'direksi' ? 'selected' : '' }}>
                    Direksi
                </option>
                <option value="komisaris" {{ old('type', $management->type) === 'komisaris' ? 'selected' : '' }}>
                    Komisaris
                </option>
            </select>
        </div>

        {{-- ================= NAMA ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Nama Lengkap
            </label>
            <input type="text"
                name="name"
                value="{{ old('name', $management->name) }}"
                required
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                       px-4 py-2.5 text-slate-700
                       focus:bg-white focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- ================= JABATAN ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Jabatan
            </label>
            <input type="text"
                name="position"
                value="{{ old('position', $management->position) }}"
                required
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                       px-4 py-2.5 text-slate-700
                       focus:bg-white focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- ================= FOTO ================= --}}
        <div class="space-y-2">
            <label class="text-sm font-medium text-slate-600">
                Foto Manajemen
            </label>

            {{-- FOTO LAMA --}}
            @if ($management->image)
                <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/' . $management->image) }}"
                         class="h-24 w-24 rounded-xl object-cover border border-slate-200">
                    <span class="text-xs text-slate-500">
                        Foto saat ini
                    </span>
                </div>
            @endif

            {{-- UPLOAD BARU --}}
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
                Kosongkan jika tidak ingin mengganti foto
            </p>
        </div>

        {{-- ================= RINGKASAN ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Ringkasan
            </label>
            <textarea name="excerpt"
                rows="2"
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                       px-4 py-3 text-slate-700
                       focus:bg-white focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10 transition resize-none">{{ old('excerpt', $management->excerpt) }}</textarea>
        </div>

        {{-- ================= PROFIL ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Profil Lengkap
            </label>
            <textarea name="profile"
                rows="6"
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                       px-4 py-3 text-slate-700
                       focus:bg-white focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10 transition resize-none">{{ old('profile', $management->profile) }}</textarea>
        </div>

        {{-- ================= URUTAN & STATUS ================= --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-600">
                    Urutan Tampil
                </label>
                <input type="number"
                    name="order"
                    value="{{ old('order', $management->order) }}"
                    class="w-full rounded-xl bg-slate-50 border border-slate-200
                           px-4 py-2.5 text-slate-700
                           focus:bg-white focus:border-[#00326B]
                           focus:ring-4 focus:ring-[#00326B]/10 transition">
            </div>

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-600">
                    Status
                </label>
                <select name="is_active"
                    class="w-full rounded-xl bg-slate-50 border border-slate-200
                           px-4 py-2.5 text-slate-700
                           focus:bg-white focus:border-[#00326B]
                           focus:ring-4 focus:ring-[#00326B]/10 transition">
                    <option value="1" {{ old('is_active', $management->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_active', $management->is_active) == 0 ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

        </div>

        {{-- ================= ACTION ================= --}}
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('perusahaan.index') }}"
               class="text-sm text-slate-500 hover:text-slate-700 transition">
                Batal
            </a>

            <button type="submit"
                class="rounded-xl bg-[#00326B] px-8 py-2.5 text-white">
                Update Manajemen
            </button>
        </div>

    </form>
</div>
@endsection
