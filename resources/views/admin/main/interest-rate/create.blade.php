@extends('admin.layouts.app')

@section('title', 'Tambah Suku Bunga')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div>
        <h1 class="text-2xl font-semibold text-slate-800">Tambah Suku Bunga</h1>
        <p class="text-sm text-slate-500 mt-1">
            Kelola periode suku bunga, tabungan, deposito, dan LPS
        </p>
    </div>

    {{-- FORM --}}
    <form action="{{ route('admin.main.interest-rate.store') }}"
          method="POST"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
        @csrf

        {{-- ================= PERIODE ================= --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="text-sm font-medium text-slate-600">Judul Periode</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="w-full rounded-xl bg-slate-50 border px-4 py-2.5">
            </div>

            <div>
                <label class="text-sm font-medium text-slate-600">Bulan</label>
                <input type="number" name="month" min="1" max="12"
                       value="{{ old('month') }}" required
                       class="w-full rounded-xl bg-slate-50 border px-4 py-2.5">
            </div>

            <div>
                <label class="text-sm font-medium text-slate-600">Tahun</label>
                <input type="number" name="year"
                       value="{{ old('year') }}" required
                       class="w-full rounded-xl bg-slate-50 border px-4 py-2.5">
            </div>
        </div>

        {{-- ================= STATUS ================= --}}
        <div class="flex items-center gap-2">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1"
                   class="rounded border-slate-300">
            <span class="text-sm text-slate-600">Jadikan periode aktif</span>
        </div>

        {{-- ================= TABUNGAN ================= --}}
        <div class="space-y-3">
            <label class="text-sm font-medium text-slate-600">
                Suku Bunga Tabungan
            </label>

            <div id="tabungan-wrapper" class="space-y-2">
                <div class="flex gap-2">
                    <input type="text"
                           name="tabungans[0][type]"
                           placeholder="Jenis Tabungan (SIMBADA)"
                           class="flex-1 rounded-xl bg-slate-50 border px-4 py-2.5">

                    <input type="number" step="0.01"
                           name="tabungans[0][rate]"
                           placeholder="Bunga (%)"
                           class="w-32 rounded-xl bg-slate-50 border px-4 py-2.5">

                    <button type="button" onclick="removeRow(this)"
                            class="hidden rounded-xl bg-red-50 px-3 py-2 text-red-600">
                        ✕
                    </button>
                </div>
            </div>

            <button type="button" onclick="addTabungan()"
                    class="text-sm text-blue-600 hover:underline">
                + Tambah Tabungan
            </button>
        </div>

        {{-- ================= DEPOSITO ================= --}}
        <div class="space-y-3">
            <label class="text-sm font-medium text-slate-600">
                Suku Bunga Deposito
            </label>

            <div id="deposito-wrapper" class="space-y-2">
                <div class="flex gap-2">
                    <input type="number"
                           name="depositos[0][tenor]"
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

                    <button type="button" onclick="removeRow(this)"
                            class="hidden rounded-xl bg-red-50 px-3 py-2 text-red-600">
                        ✕
                    </button>
                </div>
            </div>

            <button type="button" onclick="addDeposito()"
                    class="text-sm text-blue-600 hover:underline">
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
                       name="lps_rate"
                       placeholder="Bunga LPS (%)"
                       required
                       class="rounded-xl bg-slate-50 border px-4 py-2.5">

                <input type="text"
                       name="lps_note"
                       placeholder="Catatan"
                       class="rounded-xl bg-slate-50 border px-4 py-2.5">

                <input type="url"
                       name="lps_verification_url"
                       placeholder="URL Verifikasi"
                       class="rounded-xl bg-slate-50 border px-4 py-2.5">
            </div>
        </div>

        {{-- ================= ACTION ================= --}}
        <div class="flex items-center gap-3 pt-4">
            <button type="submit"
                    class="rounded-xl bg-[#00326B] px-6 py-2.5
                           text-sm font-medium text-white hover:bg-[#002855]">
                Simpan Suku Bunga
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
let tabunganIndex = 1;
let depositoIndex = 1;

function removeRow(el) {
    el.parentElement.remove();
}

function addTabungan() {
    document.getElementById('tabungan-wrapper')
        .insertAdjacentHTML('beforeend', `
        <div class="flex gap-2">
            <input type="text"
                   name="tabungans[${tabunganIndex}][type]"
                   class="flex-1 rounded-xl bg-slate-50 border px-4 py-2.5">
            <input type="number" step="0.01"
                   name="tabungans[${tabunganIndex}][rate]"
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
            <input type="number"
                   name="depositos[${depositoIndex}][tenor]"
                   class="w-32 rounded-xl bg-slate-50 border px-4 py-2.5">
            <input type="number" step="0.01"
                   name="depositos[${depositoIndex}][rate]"
                   class="w-32 rounded-xl bg-slate-50 border px-4 py-2.5">
            <input type="text"
                   name="depositos[${depositoIndex}][label]"
                   class="flex-1 rounded-xl bg-slate-50 border px-4 py-2.5">
            <button type="button" onclick="removeRow(this)"
                    class="rounded-xl bg-red-50 px-3 py-2 text-red-600">✕</button>
        </div>
    `);
    depositoIndex++;
}
</script>
@endsection

