@extends('admin.layouts.app')

@section('title', 'Edit UMKM')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-800">
                Edit UMKM
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Perbarui data mitra UMKM
            </p>
        </div>

        <a href="{{ route('umkms.index') }}"
           class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2">
            ← Kembali
        </a>
    </div>

    {{-- FORM --}}
    <form action="{{ route('umkms.update', $umkm->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
        @csrf
        @method('PUT')

        {{-- NAMA USAHA --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Nama Usaha</label>
            <input type="text"
                   name="nama_usaha"
                   value="{{ old('nama_usaha', $umkm->nama_usaha) }}"
                   required
                   class="w-full rounded-xl bg-slate-50 border border-slate-200
                          px-4 py-2.5 text-slate-700
                          focus:bg-white focus:border-[#00326B]
                          focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- NAMA PEMILIK --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Nama Pemilik</label>
            <input type="text"
                   name="nama_pemilik"
                   value="{{ old('nama_pemilik', $umkm->nama_pemilik) }}"
                   required
                   class="w-full rounded-xl bg-slate-50 border border-slate-200
                          px-4 py-2.5 text-slate-700
                          focus:bg-white focus:border-[#00326B]
                          focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- BIDANG USAHA --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Bidang Usaha</label>
            <input type="text"
                   name="bidang_usaha"
                   value="{{ old('bidang_usaha', $umkm->bidang_usaha) }}"
                   required
                   class="w-full rounded-xl bg-slate-50 border border-slate-200
                          px-4 py-2.5 text-slate-700
                          focus:bg-white focus:border-[#00326B]
                          focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- LOKASI --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Lokasi</label>
            <input type="text"
                   name="lokasi"
                   value="{{ old('lokasi', $umkm->lokasi) }}"
                   required
                   class="w-full rounded-xl bg-slate-50 border border-slate-200
                          px-4 py-2.5 text-slate-700
                          focus:bg-white focus:border-[#00326B]
                          focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- TELEPON --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Telepon</label>
            <input type="text"
                   name="telepon"
                   value="{{ old('telepon', $umkm->telepon) }}"
                   class="w-full rounded-xl bg-slate-50 border border-slate-200
                          px-4 py-2.5 text-slate-700
                          focus:bg-white focus:border-[#00326B]
                          focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- INSTAGRAM --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Link Instagram</label>
            <input type="url"
                   name="link_instagram"
                   value="{{ old('link_instagram', $umkm->link_instagram) }}"
                   class="w-full rounded-xl bg-slate-50 border border-slate-200
                          px-4 py-2.5 text-slate-700
                          focus:bg-white focus:border-[#00326B]
                          focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- SKALA --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Skala Usaha</label>
            <select name="skala"
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                       px-4 py-2.5 text-slate-700
                       focus:bg-white focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10 transition">

                <option value="Lokal" {{ $umkm->skala === 'Lokal' ? 'selected' : '' }}>Lokal</option>
                <option value="Nasional" {{ $umkm->skala === 'Nasional' ? 'selected' : '' }}>Nasional</option>
                <option value="Internasional" {{ $umkm->skala === 'Internasional' ? 'selected' : '' }}>Internasional</option>
            </select>
        </div>

        {{-- DESKRIPSI --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">Deskripsi</label>
            <textarea id="deskripsi-editor"
                    name="deskripsi"
                    rows="8"
                    class="w-full rounded-xl bg-slate-50 border border-slate-200
                            px-4 py-3 text-slate-700">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
        </div>

        {{-- PRODUK --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Produk (Pisahkan per baris)
            </label>
            <textarea name="produk_list"
                      rows="5"
                      class="w-full rounded-xl bg-slate-50 border border-slate-200
                             px-4 py-2.5 text-slate-700
                             focus:bg-white focus:border-[#00326B]
                             focus:ring-4 focus:ring-[#00326B]/10 transition">@foreach($umkm->products as $product){{ $product->nama_produk }}
@endforeach</textarea>
        </div>

        {{-- FOTO LAMA --}}
        @if($umkm->images->count())
        <div class="space-y-3">
            <label class="text-sm font-medium text-slate-600">
                Foto Saat Ini
            </label>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($umkm->images as $image)
                    <div class="relative group">
                        <img src="{{ public_image_url('storage/' . $image->image_path) }}"
                             class="rounded-xl border border-slate-200 object-cover h-32 w-full">

                        @if($image->is_thumbnail)
                            <span class="absolute top-2 left-2 text-xs bg-emerald-500 text-white px-2 py-1 rounded-md">
                                Thumbnail
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- UPLOAD TAMBAHAN --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Tambah Foto Baru
            </label>

            <input type="file"
                name="images[]"
                multiple
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
                Kosongkan jika tidak ingin menambah foto
            </p>
        </div>

        {{-- ACTION --}}
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('umkms.index') }}"
               class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2">
                Batal
            </a>

            <button type="submit"
                class="rounded-xl bg-[#00326B] px-8 py-2.5 text-white hover:bg-[#002855] transition">
                Update UMKM
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
        selector: '#deskripsi-editor',
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
