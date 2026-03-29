@extends('admin.layouts.app')

@section('title', 'Edit Artikel')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-800">Edit Artikel</h1>
            <p class="text-sm text-slate-500 mt-1">
                Perbarui konten, metadata, dan status artikel
            </p>
        </div>

        <a href="{{ route('admin.main.index') }}"
           class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2">
            ← Kembali
        </a>
    </div>

    <form action="{{ route('admin.main.article.update', $article->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
        @csrf
        @method('PUT')

        {{-- ================= THUMBNAIL ================= --}}
        <div class="space-y-3">
            <label class="text-sm font-medium text-slate-600">Thumbnail Saat Ini</label>
            <img src="{{ asset('storage/'.$article->thumbnail) }}"
                 class="h-32 rounded-xl border object-cover">

            <input type="file" name="thumbnail" accept="image/*"
                class="block w-full text-sm text-slate-600
                       file:mr-4 file:rounded-xl file:border-0
                       file:bg-[#00326B]/10 file:px-4 file:py-2
                       file:text-sm file:font-medium file:text-[#00326B]
                       hover:file:bg-[#00326B]/20 transition">
        </div>

        {{-- ================= JUDUL ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Judul Artikel</label>
            <input type="text" name="title"
                   value="{{ old('title', $article->title) }}"
                   class="w-full rounded-xl bg-slate-50 border px-4 py-2.5
                          focus:ring-4 focus:ring-[#00326B]/10">
        </div>

        {{-- ================= KATEGORI ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Kategori</label>

            <select name="category"
                    class="w-full rounded-xl bg-slate-50 border px-4 py-2.5
                        focus:ring-4 focus:ring-[#00326B]/10">

                <option value="" disabled {{ old('category', $article->category) ? '' : 'selected' }}>
                    -- Pilih Kategori --
                </option>

                <option value="EKONOMI" {{ old('category', $article->category) == 'EKONOMI' ? 'selected' : '' }}>
                    EKONOMI
                </option>

                <option value="CSR" {{ old('category', $article->category) == 'CSR' ? 'selected' : '' }}>
                    CSR
                </option>

                <option value="INTERNAL" {{ old('category', $article->category) == 'INTERNAL' ? 'selected' : '' }}>
                    INTERNAL
                </option>

                <option value="PENGHARGAAN" {{ old('category', $article->category) == 'PENGHARGAAN' ? 'selected' : '' }}>
                    PENGHARGAAN
                </option>
            </select>
        </div>


        {{-- ================= PENULIS ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Penulis</label>
            <input type="text" name="author"
                   value="{{ old('author', $article->author) }}"
                   class="w-full rounded-xl bg-slate-50 border px-4 py-2.5
                          focus:ring-4 focus:ring-[#00326B]/10">
        </div>

        {{-- ================= RINGKASAN ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Ringkasan Artikel</label>
            <textarea name="excerpt" rows="3"
                class="w-full rounded-xl bg-slate-50 border px-4 py-3
                       focus:ring-4 focus:ring-[#00326B]/10">{{ old('excerpt', $article->excerpt) }}</textarea>
        </div>

        {{-- ================= KONTEN ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Konten Artikel</label>
            <textarea name="content" id="content" rows="8"
                class="w-full rounded-xl bg-slate-50 border px-4 py-3
                       focus:ring-4 focus:ring-[#00326B]/10">{{ old('content', $article->content) }}</textarea>
        </div>

        {{-- ================= TANGGAL PUBLIKASI ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Tanggal Publikasi</label>
            <input type="date" name="published_at"
                   value="{{ old('published_at', optional($article->published_at)->toDateString()) }}"
                   class="w-full rounded-xl bg-slate-50 border px-4 py-2.5
                          focus:ring-4 focus:ring-[#00326B]/10">
        </div>

        {{-- ================= STATUS ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Status Artikel</label>
            <select name="is_published"
                class="w-full rounded-xl bg-slate-50 border px-4 py-2.5">
                <option value="1" {{ $article->is_published ? 'selected' : '' }}>Publish</option>
                <option value="0" {{ !$article->is_published ? 'selected' : '' }}>Draft</option>
            </select>
        </div>

        {{-- ================= ACTION ================= --}}
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.main.article.index') }}" class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2">
                Batal
            </a>
            <button type="submit"
                class="rounded-xl bg-[#00326B] px-8 py-2.5 text-white">
                Update Artikel
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<!-- TinyMCE CDN -->
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: '#content',
        height: 420,
        menubar: true,

        plugins: [
            'advlist autolink lists link image charmap preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table help wordcount'
        ],

        toolbar:
            'undo redo | blocks | ' +
            'bold italic underline | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | ' +
            'link image | code fullscreen',

        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        },

        content_style: `
            body {
                font-family: Inter, system-ui, -apple-system, sans-serif;
                font-size: 14px;
            }
        `
    });
</script>
@endpush



