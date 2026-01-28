@extends('admin.layouts.app')

@section('title', 'Tambah Lelang')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- PAGE HEADER --}}
    <div>
        <h1 class="text-2xl font-semibold text-slate-800">
            Tambah Lelang
        </h1>
        <p class="text-sm text-slate-500 mt-1">
            Kelola informasi lelang, spesifikasi, kualifikasi, dan jadwal
        </p>
    </div>

    {{-- FORM CARD --}}
    <form action="{{ route('admin.main.lelang.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
        @csrf

        {{-- ================= JUDUL LELANG ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Judul Lelang
            </label>
            <input type="text"
                   name="title"
                   value="{{ old('title') }}"
                   placeholder="Contoh: Renovasi Gedung Kantor Cabang Utama Mataram"
                   required
                   class="w-full rounded-xl bg-slate-50 border border-slate-200
                          px-4 py-2.5 text-slate-700
                          focus:bg-white focus:border-[#00326B]
                          focus:ring-4 focus:ring-[#00326B]/10 transition">
        </div>

        {{-- ================= KATEGORI ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Kategori
            </label>

            <select
                name="category"
                class="w-full rounded-xl bg-slate-50 border border-slate-200
                    px-4 py-2.5 focus:ring-4 focus:ring-[#00326B]/10">

                <option value="">-- Pilih Kategori --</option>

                <option value="JASA & KONSULTASI"
                    {{ old('category') === 'JASA & KONSULTASI' ? 'selected' : '' }}>
                    JASA & KONSULTASI
                </option>

                <option value="KONSTRUKSI"
                    {{ old('category') === 'KONSTRUKSI' ? 'selected' : '' }}>
                    KONSTRUKSI
                </option>

                <option value="TEKNOLOGI"
                    {{ old('category') === 'TEKNOLOGI' ? 'selected' : '' }}>
                    TEKNOLOGI
                </option>

                <option value="LOGISTIK"
                    {{ old('category') === 'LOGISTIK' ? 'selected' : '' }}>
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
                      class="w-full rounded-xl bg-slate-50 border border-slate-200
                             px-4 py-3 focus:ring-4 focus:ring-[#00326B]/10 resize-none">{{ old('short_desc') }}</textarea>
        </div>

        {{-- ================= SPESIFIKASI PEKERJAAN ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Spesifikasi Pekerjaan
            </label>
            <textarea name="description"
                      rows="5"
                      placeholder="Detail pekerjaan lelang"
                      class="w-full rounded-xl bg-slate-50 border border-slate-200
                             px-4 py-3 focus:ring-4 focus:ring-[#00326B]/10 resize-none">{{ old('description') }}</textarea>
        </div>

        {{-- ================= KUALIFIKASI PESERTA ================= --}}
        <div class="space-y-3">
            <label class="text-sm font-medium text-slate-600">
                Kualifikasi Peserta
            </label>

            <div id="qualification-wrapper" class="space-y-3">
                <div class="flex items-center gap-2">
                    <input type="text"
                           name="requirements[]"
                           placeholder="Contoh: Memiliki SIUP/NIB Aktif"
                           class="flex-1 rounded-xl bg-slate-50 border border-slate-200
                                  px-4 py-2.5 focus:ring-4 focus:ring-[#00326B]/10">

                    <button type="button"
                            onclick="removeQualification(this)"
                            class="hidden rounded-xl bg-red-50 px-3 py-2 text-red-600">
                        ✕
                    </button>
                </div>
            </div>

            <button type="button"
                    onclick="addQualification()"
                    class="inline-flex items-center gap-2 rounded-xl
                           border border-slate-200 bg-slate-50 px-4 py-2
                           text-sm text-slate-600 hover:bg-slate-100 transition">
                + Tambah Kualifikasi
            </button>
        </div>
    
        {{-- ================= BANNER LELANG ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Banner Lelang
            </label>
            <input type="file"
                   name="banner"
                   accept="image/*"
                   required
                   class="block w-full text-sm text-slate-600
                          file:mr-4 file:rounded-xl file:border-0
                          file:bg-[#00326B]/10 file:px-4 file:py-2
                          file:text-sm file:font-medium file:text-[#00326B]
                          hover:file:bg-[#00326B]/20 transition">
        </div>

        {{-- ================= RKS FILE ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Dokumen RKS (PDF)
            </label>

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
        
        {{-- ================= DEADLINE ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Batas Akhir Pendaftaran
            </label>
            <input type="date"
                   name="deadline"
                   value="{{ old('deadline') }}"
                   class="w-full rounded-xl bg-slate-50 border border-slate-200
                          px-4 py-2.5 focus:ring-4 focus:ring-[#00326B]/10">
        </div>

        {{-- ================= STATUS ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Status Lelang
            </label>
            <select name="status"
                    class="w-full rounded-xl bg-slate-50 border border-slate-200
                           px-4 py-2.5 focus:ring-4 focus:ring-[#00326B]/10">
                <option value="aktif">Aktif</option>
                <option value="ditutup">Ditutup</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>

        {{-- ================= ACTION ================= --}}
        <div class="flex items-center gap-3 pt-4">
            <button type="submit"
                    class="inline-flex items-center gap-2 rounded-xl
                           bg-[#00326B] px-6 py-2.5 text-sm font-medium
                           text-white hover:bg-[#002855] transition">
                Simpan Lelang
            </button>

            <a href="{{ route('admin.main.index') }}"
               class="text-sm text-slate-500 hover:text-slate-700 transition">
                Batal
            </a>
        </div>

    </form>

</div>

{{-- ================= JS ================= --}}
<script>
function addQualification() {
    const wrapper = document.getElementById('qualification-wrapper');

    wrapper.insertAdjacentHTML('beforeend', `
        <div class="flex items-center gap-2">
            <input type="text"
                   name="requirements[]"
                   class="flex-1 rounded-xl bg-slate-50 border border-slate-200
                          px-4 py-2.5 focus:ring-4 focus:ring-[#00326B]/10">
            <button type="button"
                    onclick="removeQualification(this)"
                    class="rounded-xl bg-red-50 px-3 py-2 text-red-600">
                ✕
            </button>
        </div>
    `);
}

function removeQualification(el) {
    el.parentElement.remove();
}
</script>
@endsection
