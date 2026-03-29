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
           class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2">
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
            <textarea id="profile-editor"
                name="profile"
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
               class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2">
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

@push('scripts')
<!-- TinyMCE CDN -->
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: '#profile-editor',
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

