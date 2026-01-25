@extends('admin.layouts.app')

@section('title', 'Edit Suku Bunga')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-800">
                Edit Suku Bunga
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Perbarui periode, tabungan, deposito, dan LPS
            </p>
        </div>

        <a href="{{ route('admin.main.index') }}"
           class="text-sm text-slate-500 hover:text-slate-700 transition">
            ← Kembali
        </a>
    </div>

    <form action="{{ route('admin.main.interest-rate.update', $period->id) }}"
          method="POST"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
        @csrf
        @method('PUT')

        {{-- ================= PERIODE ================= --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-600">
                    Judul Periode
                </label>
                <input type="text" name="title"
                       value="{{ old('title', $period->title) }}"
                       class="w-full rounded-xl bg-slate-50 border px-4 py-2.5
                              focus:ring-4 focus:ring-[#00326B]/10">
            </div>

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-600">Bulan</label>
                <input type="number" name="month"
                       value="{{ old('month', $period->month) }}"
                       class="w-full rounded-xl bg-slate-50 border px-4 py-2.5">
            </div>

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-600">Tahun</label>
                <input type="number" name="year"
                       value="{{ old('year', $period->year) }}"
                       class="w-full rounded-xl bg-slate-50 border px-4 py-2.5">
            </div>
        </div>

        {{-- ================= TABUNGAN ================= --}}
        @php
            $tabungans = old(
                'tabungans',
                $period->tabungans->toArray()
            );

            if (count($tabungans) === 0) {
                $tabungans = [['tabungan_type' => '', 'rate' => '']];
            }
        @endphp

        <div class="space-y-3">
            <label class="text-sm font-medium text-slate-600">
                Suku Bunga Tabungan
            </label>

            <div id="tabungan-wrapper" class="space-y-3">
                @foreach($tabungans as $i => $tabungan)
                    <div class="flex gap-2">
                        <input type="text"
                               name="tabungans[{{ $i }}][tabungan_type]"
                               value="{{ $tabungan['tabungan_type'] ?? '' }}"
                               class="flex-1 rounded-xl bg-slate-50 border px-4 py-2.5">

                        <input type="number" step="0.01"
                               namename="tabungans[{{ $i }}][rate]"
                               value="{{ $tabungan['rate'] ?? '' }}"
                               class="w-32 rounded-xl bg-slate-50 border px-4 py-2.5">

                        <button type="button" onclick="removeRow(this)"
                            class="rounded-xl bg-red-50 px-3 py-2 text-red-600">✕</button>
                    </div>
                @endforeach
            </div>

            <button type="button" onclick="addTabungan()"
                class="text-sm font-medium text-[#00326B] hover:underline">
                + Tambah Tabungan
            </button>
        </div>

        {{-- ================= DEPOSITO ================= --}}
        @php
            $depositos = old(
                'depositos',
                $period->depositos->toArray()
            );

            if (count($depositos) === 0) {
                $depositos = [['tenor_month'=>'','rate'=>'','label'=>'']];
            }
        @endphp

        <div class="space-y-3">
            <label class="text-sm font-medium text-slate-600">
                Suku Bunga Deposito
            </label>

            <div id="deposito-wrapper" class="space-y-3">
                @foreach($depositos as $i => $dep)
                    <div class="flex gap-2">
                        <input type="number"
                               name="depositos[{{ $i }}][tenor_month]"
                               value="{{ $dep['tenor_month'] ?? '' }}"
                               class="w-32 rounded-xl bg-slate-50 border px-4 py-2.5">

                        <input type="number" step="0.01"
                               name="depositos[{{ $i }}][rate]"
                               value="{{ $dep['rate'] ?? '' }}"
                               class="w-32 rounded-xl bg-slate-50 border px-4 py-2.5">

                        <input type="text"
                               name="depositos[{{ $i }}][label]"
                               value="{{ $dep['label'] ?? '' }}"
                               class="flex-1 rounded-xl bg-slate-50 border px-4 py-2.5">

                        <button type="button" onclick="removeRow(this)"
                            class="rounded-xl bg-red-50 px-3 py-2 text-red-600">✕</button>
                    </div>
                @endforeach
            </div>

            <button type="button" onclick="addDeposito()"
                class="text-sm font-medium text-[#00326B] hover:underline">
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
                       value="{{ old('lps.rate', optional($period->lps)->rate) }}"
                       class="rounded-xl bg-slate-50 border px-4 py-2.5">

                <input type="text"
                       name="lps[note]"
                       value="{{ old('lps.note', optional($period->lps)->note) }}"
                       class="rounded-xl bg-slate-50 border px-4 py-2.5">

                <input type="url"
                       name="lps[verification_url]"
                       value="{{ old('lps.verification_url', optional($period->lps)->verification_url) }}"
                       class="rounded-xl bg-slate-50 border px-4 py-2.5">
            </div>
        </div>

        {{-- ================= ACTION ================= --}}
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.main.index') }}"
               class="text-sm text-slate-500">
                Batal
            </a>

            <button type="submit"
                class="rounded-xl bg-[#00326B] px-8 py-2.5 text-white">
                Update Suku Bunga
            </button>
        </div>
    </form>
</div>

{{-- ================= JS ================= --}}
<script>
let tabunganIndex = {{ count($tabungans) }};
let depositoIndex = {{ count($depositos) }};

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
