@extends('admin.layouts.app')

@section('title', 'Tambah UMKM')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    {{-- PAGE HEADER --}}
    <div>
        <h1 class="text-2xl font-semibold text-slate-800">
            Tambah UMKM
        </h1>
        <p class="text-sm text-slate-500 mt-1">
            Tambahkan data mitra UMKM baru
        </p>
    </div>

    {{-- FORM CARD --}}
    <form action="{{ route('umkms.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
        @csrf

        {{-- NAMA USAHA --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Nama Usaha
            </label>
            <input type="text"
                   name="nama_usaha"
                   required
                   value="{{ old('nama_usaha') }}"
                   placeholder="Contoh: Pawon Pengsong"
                   class="w-full rounded-xl bg-slate-50 border border-slate-200
                          px-4 py-2.5 text-slate-700
                          focus:bg-white focus:border-[#00326B]
                          focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- NAMA PEMILIK --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Nama Pemilik
            </label>
            <input type="text"
                   name="nama_pemilik"
                   required
                   value="{{ old('nama_pemilik') }}"
                   placeholder="Contoh: Ibu Nur Aida"
                   class="w-full rounded-xl bg-slate-50 border border-slate-200
                          px-4 py-2.5 text-slate-700
                          focus:bg-white focus:border-[#00326B]
                          focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- BIDANG USAHA --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Bidang Usaha
            </label>
            <input type="text"
                   name="bidang_usaha"
                   required
                   value="{{ old('bidang_usaha') }}"
                   placeholder="Contoh: Makanan & Minuman"
                   class="w-full rounded-xl bg-slate-50 border border-slate-200
                          px-4 py-2.5 text-slate-700
                          focus:bg-white focus:border-[#00326B]
                          focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- LOKASI --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Lokasi
            </label>
            <input type="text"
                   name="lokasi"
                   required
                   value="{{ old('lokasi') }}"
                   placeholder="Contoh: Lombok Barat, NTB"
                   class="w-full rounded-xl bg-slate-50 border border-slate-200
                          px-4 py-2.5 text-slate-700
                          focus:bg-white focus:border-[#00326B]
                          focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- TELEPON --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Telepon
            </label>
            <input type="text"
                   name="telepon"
                   value="{{ old('telepon') }}"
                   placeholder="08xxxxxxxxxx"
                   class="w-full rounded-xl bg-slate-50 border border-slate-200
                          px-4 py-2.5 text-slate-700
                          focus:bg-white focus:border-[#00326B]
                          focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- INSTAGRAM --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Link Instagram
            </label>
            <input type="url"
                   name="link_instagram"
                   value="{{ old('link_instagram') }}"
                   placeholder="https://instagram.com/username"
                   class="w-full rounded-xl bg-slate-50 border border-slate-200
                          px-4 py-2.5 text-slate-700
                          focus:bg-white focus:border-[#00326B]
                          focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- SKALA --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Skala Usaha
            </label>

            <select name="skala"
                    class="w-full rounded-xl bg-slate-50 border border-slate-200
                           px-4 py-2.5 text-slate-700
                           focus:bg-white focus:border-[#00326B]
                           focus:ring-4 focus:ring-[#00326B]/10 transition">

                <option value="">-- Pilih Skala --</option>
                <option value="Lokal" {{ old('skala') === 'Lokal' ? 'selected' : '' }}>Lokal</option>
                <option value="Nasional" {{ old('skala') === 'Nasional' ? 'selected' : '' }}>Nasional</option>
                <option value="Internasional" {{ old('skala') === 'Internasional' ? 'selected' : '' }}>Internasional</option>
            </select>
        </div>
        
        {{-- DESKRIPSI UMKM --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Deskripsi UMKM
            </label>
            <textarea id="deskripsi-editor"
                    name="deskripsi"
                    rows="8"
                    class="w-full rounded-xl bg-slate-50 border border-slate-200
                            px-4 py-3 text-slate-700">{{ old('deskripsi') }}</textarea>
        </div>

        {{-- PRODUK LIST --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Produk (Pisahkan per baris)
            </label>
            <textarea name="produk_list"
                      rows="5"
                      placeholder="Keripik Pisang&#10;Keripik Singkong&#10;Dodol Nangka"
                      class="w-full rounded-xl bg-slate-50 border border-slate-200
                             px-4 py-2.5 text-slate-700
                             focus:bg-white focus:border-[#00326B]
                             focus:ring-4 focus:ring-[#00326B]/10 transition">{{ old('produk_list') }}</textarea>
        </div>

        {{-- FOTO MULTIPLE --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Upload Foto (Bisa lebih dari satu)
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
                Gambar pertama akan otomatis menjadi thumbnail
            </p>
        </div>

        {{-- ACTION --}}
        <div class="flex gap-3 pt-4">
            <button type="submit"
                class="rounded-xl bg-[#00326B] px-6 py-2.5
                       text-sm font-medium text-white hover:bg-[#002855] transition">
                Simpan UMKM
            </button>

            <a href="{{ route('umkms.index') }}"
               class="text-sm text-slate-500 hover:text-slate-700">
                Batal
            </a>
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