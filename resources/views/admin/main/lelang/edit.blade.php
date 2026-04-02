@extends('admin.layouts.app')

@section('title', 'Edit Lelang')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- PAGE HEADER --}}
    <div>
        <h1 class="text-2xl font-semibold text-slate-800">
            Edit Lelang
        </h1>
        <p class="text-sm text-slate-500 mt-1">
            Perbarui informasi lelang yang sedang berjalan
        </p>
    </div>

    {{-- FORM --}}
    <form action="{{ route('admin.main.lelang.update', $lelang->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
        @csrf
        @method('PUT')

        {{-- ================= JUDUL LELANG ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Judul Lelang
            </label>
            <input type="text"
                   name="title"
                   value="{{ old('title', $lelang->title) }}"
                   placeholder="Contoh: Renovasi Gedung Kantor Cabang Utama Mataram"
                   required
                   class="w-full rounded-xl bg-slate-50 border px-4 py-2.5
                          focus:ring-4 focus:ring-[#00326B]/10">
        </div>

        {{-- ================= KATEGORI ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Kategori
            </label>

            <select
                name="category"
                required
                class="w-full rounded-xl bg-slate-50 border px-4 py-2.5
                    focus:ring-4 focus:ring-[#00326B]/10">

                <option value="">-- Pilih Kategori --</option>

                <option value="JASA & KONSULTASI"
                    {{ old('category', $lelang->category) === 'JASA & KONSULTASI' ? 'selected' : '' }}>
                    JASA & KONSULTASI
                </option>

                <option value="KONSTRUKSI"
                    {{ old('category', $lelang->category) === 'KONSTRUKSI' ? 'selected' : '' }}>
                    KONSTRUKSI
                </option>

                <option value="TEKNOLOGI"
                    {{ old('category', $lelang->category) === 'TEKNOLOGI' ? 'selected' : '' }}>
                    TEKNOLOGI
                </option>

                <option value="LOGISTIK"
                    {{ old('category', $lelang->category) === 'LOGISTIK' ? 'selected' : '' }}>
                    LOGISTIK
                </option>
            </select>
        </div>


        {{-- ================= DESKRIPSI SINGKAT ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Deskripsi Singkat
            </label>
            <textarea name="short_desc"
                      rows="3"
                      placeholder="Ringkasan singkat lelang"
                      class="w-full rounded-xl bg-slate-50 border px-4 py-3
                             focus:ring-4 focus:ring-[#00326B]/10">{{ old('short_desc', $lelang->short_desc) }}</textarea>
        </div>

        {{-- ================= SPESIFIKASI PEKERJAAN ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Spesifikasi Pekerjaan
            </label>
            <textarea name="description"
                      rows="5"
                      placeholder="Detail pekerjaan lelang"
                      class="w-full rounded-xl bg-slate-50 border px-4 py-3
                             focus:ring-4 focus:ring-[#00326B]/10">{{ old('description', $lelang->description) }}</textarea>
        </div>

        {{-- ================= KUALIFIKASI PESERTA ================= --}}
        @php
            $requirements = old(
                'requirements',
                $lelang->requirements->pluck('title')->toArray()
            );

            if (count($requirements) === 0) {
                $requirements = [''];
            }
        @endphp

        <div class="space-y-3">
            <label class="text-sm font-medium text-slate-600">
                Kualifikasi Peserta
            </label>

            <div id="requirement-wrapper" class="space-y-3">
                @foreach($requirements as $req)
                    <div class="flex items-center gap-2">
                        <input type="text"
                               name="requirements[]"
                               value="{{ $req }}"
                               placeholder="Contoh: Memiliki SIUP/NIB Aktif"
                               class="flex-1 rounded-xl bg-slate-50 border px-4 py-2.5
                                      focus:ring-4 focus:ring-[#00326B]/10">

                        <button type="button"
                                onclick="removeRequirement(this)"
                                class="rounded-xl bg-red-50 px-3 py-2 text-red-600">
                            ✕
                        </button>
                    </div>
                @endforeach
            </div>

            <button type="button"
                    onclick="addRequirement()"
                    class="inline-flex items-center gap-2 rounded-xl
                           border border-slate-200 bg-slate-50 px-4 py-2
                           text-sm font-medium text-slate-600 hover:bg-slate-100">
                + Tambah Kualifikasi
            </button>
        </div>
        {{-- ================= RKS FILE ================= --}}
        <div class="space-y-3">
            <label class="text-sm font-medium text-slate-600">
                Dokumen RKS
            </label>

            @if($lelang->rks_file)
                <a href="{{ public_image_url('storage/' . $lelang->rks_file) }}"
                target="_blank"
                class="inline-flex items-center gap-2 text-sm text-blue-600 hover:underline">
                    📄 Lihat RKS Saat Ini
                </a>
            @endif

            <input type="file"
                name="rks_file"
                accept="application/pdf"
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
        {{-- ================= BANNER LELANG ================= --}}
        <div class="space-y-2">
            <label class="text-sm font-medium text-slate-600">
                Banner Lelang
            </label>

            @if($lelang->banner)
                <img src="{{ public_image_url('storage/' . $lelang->banner) }}"
                     class="h-32 rounded-xl border object-cover mb-2">
            @endif

            <input type="file"
                   name="banner"
                   accept="image/*"
                   class="block w-full text-sm text-slate-600">
        </div>

        {{-- ================= BATAS AKHIR ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Batas Akhir Pendaftaran
            </label>
            <input type="date"
                   name="deadline"
                   value="{{ old('deadline', $lelang->deadline?->format('Y-m-d')) }}"
                   required
                   class="w-full rounded-xl bg-slate-50 border px-4 py-2.5
                          focus:ring-4 focus:ring-[#00326B]/10">
        </div>

        {{-- ================= STATUS ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Status Lelang
            </label>
            <select name="status"
                class="w-full rounded-xl bg-slate-50 border px-4 py-2.5">
                <option value="aktif" {{ $lelang->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="ditutup" {{ $lelang->status === 'ditutup' ? 'selected' : '' }}>Ditutup</option>
                <option value="selesai" {{ $lelang->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        {{-- ================= ACTION ================= --}}
        <div class="flex items-center gap-3 pt-4">
            <button type="submit"
                    class="inline-flex items-center gap-2 rounded-xl
                           bg-[#00326B] px-6 py-2.5
                           text-sm font-medium text-white hover:bg-[#002855]">
                Update Lelang
            </button>

            <a href="{{ route('admin.main.index') }}"
               class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2">
                Batal
            </a>
        </div>

    </form>
</div>

{{-- ================= JS ================= --}}
<script>
function addRequirement() {
    document.getElementById('requirement-wrapper')
        .insertAdjacentHTML('beforeend', `
        <div class="flex items-center gap-2">
            <input type="text"
                   name="requirements[]"
                   placeholder="Contoh: Memiliki SIUP/NIB Aktif"
                   class="flex-1 rounded-xl bg-slate-50 border px-4 py-2.5
                          focus:ring-4 focus:ring-[#00326B]/10">
            <button type="button"
                    onclick="removeRequirement(this)"
                    class="rounded-xl bg-red-50 px-3 py-2 text-red-600">
                ✕
            </button>
        </div>
    `);
}

function removeRequirement(el) {
    el.parentElement.remove();
}
</script>
@endsection
