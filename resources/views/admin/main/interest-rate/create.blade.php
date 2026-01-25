@extends('admin.layouts.app')

@section('title', 'Tambah Suku Bunga')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- PAGE HEADER --}}
    <div>
        <h1 class="text-2xl font-semibold text-slate-800">
            Tambah Suku Bunga
        </h1>
        <p class="text-sm text-slate-500 mt-1">
            Kelola periode suku bunga, tabungan, deposito, dan LPS
        </p>
    </div>

    {{-- FORM CARD --}}
    <form action="{{ route('admin.main.interest-rate.store') }}"
          method="POST"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
        @csrf

        {{-- ================= PERIODE ================= --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-600">Judul Periode</label>
                <input type="text"
                       name="title"
                       value="{{ old('title') }}"
                       placeholder="Contoh: Update Jan 2026"
                       required
                       class="w-full rounded-xl bg-slate-50 border px-4 py-2.5
                              focus:ring-4 focus:ring-[#00326B]/10">
            </div>

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-600">Bulan</label>
                <input type="number"
                       name="month"
                       min="1" max="12"
                       value="{{ old('month') }}"
                       required
                       class="w-full rounded-xl bg-slate-50 border px-4 py-2.5
                              focus:ring-4 focus:ring-[#00326B]/10">
            </div>

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-600">Tahun</label>
                <input type="number"
                       name="year"
                       value="{{ old('year') }}"
                       required
                       class="w-full rounded-xl bg-slate-50 border px-4 py-2.5
                              focus:ring-4 focus:ring-[#00326B]/10">
            </div>
        </div>

        {{-- ================= TABUNGAN ================= --}}
        <div class="space-y-3">
            <label class="text-sm font-medium text-slate-600">
                Suku Bunga Tabungan
            </label>

            <div id="tabungan-wrapper" class="space-y-3">
                <div class="flex gap-2">
                    <input type="text"
                           name="tabungans[0][tabungan_type]"
                           placeholder="Jenis Tabungan (SIMBADA)"
                           class="flex-1 rounded-xl bg-slate-50 border px-4 py-2.5">

                    <input type="number" step="0.01"
                           name="tabungans[0][rate]"
                           placeholder="Bunga (%)"
                           class="w-32 rounded-xl bg-slate-50 border px-4 py-2.5">

                    <button type="button"
                            onclick="removeRow(this)"
                            class="hidden rounded-xl bg-red-50 px-3 py-2 text-red-600">
                        ✕
                    </button>
                </div>
            </div>

            <button type="button"
                    onclick="addTabungan()"
                    class="inline-flex items-center gap-2 rounded-xl
                           border border-slate-200 bg-slate-50 px-4 py-2
                           text-sm text-slate-600 hover:bg-slate-100">
                + Tambah Tabungan
            </button>
        </div>

        {{-- ================= DEPOSITO ================= --}}
        <div class="space-y-3">
            <label class="text-sm font-medium text-slate-600">
                Suku Bunga Deposito
            </label>

            <div id="deposito-wrapper" class="space-y-3">
                <div class="flex gap-2">
                    <input type="number"
                           name="depositos[0][tenor_month]"
                           placeholder="Tenor (bulan)"
                           class="w-32 rounded-xl bg-slate-50 border px-4 py-2.5">

                    <input type="number" step="0.01"
                           name="depositos[0][rate]"
                           placeholder="Bunga (%)"
                           class="w-32 rounded-xl bg-slate-50 border px-4 py-2.5">

                    <input type="text"
                           name="depositos[0][label]"
                           placeholder="Label (opsional)"
                           class="flex-1 rounded-xl bg-slate-50 border px-4 py-2.5">

                    <button type="button"
                            onclick="removeRow(this)"
                            class="hidden rounded-xl bg-red-50 px-3 py-2 text-red-600">
                        ✕
                    </button>
                </div>
            </div>

            <button type="button"
                    onclick="addDeposito()"
                    class="inline-flex items-center gap-2 rounded-xl
                           border border-slate-200 bg-slate-50 px-4 py-2
                           text-sm text-slate-600 hover:bg-slate-100">
                + Tambah Deposito
            </button>
        </div>

        {{-- ================= LPS ================= --}}
        <div class="space-y-3">
            <label class="text-sm font-medium text-slate-600">
                Suku Bunga LPS
            </label>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <input type="number" step="0.01"
                       name="lps[rate]"
                       placeholder="Bunga LPS (%)"
                       class="rounded-xl bg-slate-50 border px-4 py-2.5">

                <input type="text"
                       name="lps[note]"
                       placeholder="Catatan"
                       class="rounded-xl bg-slate-50 border px-4 py-2.5">

                <input type="url"
                       name="lps[verification_url]"
                       placeholder="URL Verifikasi"
                       class="rounded-xl bg-slate-50 border px-4 py-2.5">
            </div>
        </div>

        {{-- ================= ACTION ================= --}}
        <div class="flex items-center gap-3 pt-4">
            <button type="submit"
                    class="inline-flex items-center gap-2 rounded-xl
                           bg-[#00326B] px-6 py-2.5
                           text-sm font-medium text-white hover:bg-[#002855]">
                Simpan Suku Bunga
            </button>

            <a href="{{ route('admin.main.index') }}"
               class="text-sm text-slate-500 hover:text-slate-700">
                Batal
            </a>
        </div>

    </form>
</div>

{{-- ================= JS ================= --}}
<script>
let tabunganIndex = 1;
let depositoIndex = 1;

function removeRow(el) {
    el.parentElement.remove();
}

function addTabungan() {
    document.getElementById('tabungan-wrapper')
        .insertAdjacentHTML('beforeend', `
        <div class="flex gap-2">
            <input type="text" name="tabungans[${tabunganIndex}][tabungan_type]"
                class="flex-1 rounded-xl bg-slate-50 border px-4 py-2.5">
            <input type="number" step="0.01" name="tabungans[${tabunganIndex}][rate]"
                class="w-32 rounded-xl bg-slate-50 border px-4 py-2.5">
            <button type="button" onclick="removeRow(this)"
                class="rounded-xl bg-red-50 px-3 py-2 text-red-600">✕</button>
        </div>
    `);
    tabunganIndex++;
}

function addDeposito() {
    document.getElementById('deposito-wrapper')
        .insertAdjacentHTML('beforeend', `
        <div class="flex gap-2">
            <input type="number" name="depositos[${depositoIndex}][tenor_month]"
                class="w-32 rounded-xl bg-slate-50 border px-4 py-2.5">
            <input type="number" step="0.01" name="depositos[${depositoIndex}][rate]"
                class="w-32 rounded-xl bg-slate-50 border px-4 py-2.5">
            <input type="text" name="depositos[${depositoIndex}][label]"
                class="flex-1 rounded-xl bg-slate-50 border px-4 py-2.5">
            <button type="button" onclick="removeRow(this)"
                class="rounded-xl bg-red-50 px-3 py-2 text-red-600">✕</button>
        </div>
    `);
    depositoIndex++;
}
</script>
@endsection
