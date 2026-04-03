@extends('admin.layouts.app')

@section('title', 'Edit Banner')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-800">
                Edit Banner
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Perbarui gambar banner homepage
            </p>
        </div>

        <a href="{{ route('admin.main.banner.index') }}"
           class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2">
            ← Kembali
        </a>
    </div>

    {{-- FORM CARD --}}
    <form action="{{ route('admin.main.banner.update', $banner->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm
                 p-6 space-y-6">
        @csrf
        @method('PUT')
        @include('admin.components.form-errors')

        {{-- PREVIEW BANNER --}}
        <div class="space-y-2">
            <label class="text-sm font-medium text-slate-600">
                Gambar Banner Saat Ini
            </label>

            <div class="rounded-xl border border-slate-200
                        overflow-hidden bg-slate-50">
                <img src="{{ public_image_url('storage/' . $banner->image) }}"
                     alt="Banner {{ $banner->id }}"
                     class="w-full max-h-64 object-contain">
            </div>
        </div>

        {{-- GANTI GAMBAR --}}
        <div class="space-y-2">
            <label class="text-sm font-medium text-slate-600">
                Ganti Gambar (Opsional)
            </label>

            <input type="file"
                   name="image"
                   accept="image/jpeg,image/png,image/webp"
                   class="block w-full text-sm text-slate-600
                          file:mr-4
                          file:rounded-xl
                          file:border-0
                          file:bg-[#00326B]/10
                          file:px-4
                          file:py-2
                          file:text-sm
                          file:font-medium
                          file:text-[#00326B]
                          hover:file:bg-[#00326B]/20
                          transition">

            @error('image')
                <p class="text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

            <p class="text-xs text-slate-500">
                Format: JPG / PNG / WEBP • Maksimal 8MB
            </p>
        </div>

        {{-- ACTION --}}
        <div class="flex items-center gap-3 pt-4">
            <button type="submit"
                    class="inline-flex items-center gap-2
                           rounded-xl bg-[#00326B]
                           px-6 py-2.5
                           text-sm font-medium text-white
                           hover:bg-[#002855]
                           focus:ring-4 focus:ring-[#00326B]/20
                           transition">
                Update Banner
            </button>

            <a href="{{ route('admin.main.banner.index') }}"
               class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2">
                Batal
            </a>
        </div>

    </form>
</div>
@endsection
