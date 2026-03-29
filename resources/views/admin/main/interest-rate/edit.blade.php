@extends('admin.layouts.app')

@section('title', 'Edit Suku Bunga')
@php
    use App\Models\InterestRatePeriod;
    $totalPeriods = InterestRatePeriod::count();
    $activePeriods = InterestRatePeriod::where('is_active', true)->count();
@endphp
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
           class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2">
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
            <input type="text" name="title"
                value="{{ old('title', $period->title) }}"
                placeholder="Judul Periode"
                class="rounded-xl bg-slate-50 border px-4 py-2.5">

            <input type="number" name="month"
                value="{{ old('month', $period->month) }}"
                placeholder="Bulan"
                class="rounded-xl bg-slate-50 border px-4 py-2.5">

            <input type="number" name="year"
                value="{{ old('year', $period->year) }}"
                placeholder="Tahun"
                class="rounded-xl bg-slate-50 border px-4 py-2.5">
        </div>

        {{-- ================= TABUNGAN ================= --}}
        @php
            $tabungans = old('tabungans', $period->tabungans->toArray());
            if (count($tabungans) === 0) {
                $tabungans = [['tabungan_type'=>'','rate'=>'']];
            }
        @endphp

        <div class="space-y-3">
            <label class="text-sm font-medium text-slate-600">
                Suku Bunga Tabungan
            </label>

            <div id="tabungan-wrapper" class="space-y-3">
                @foreach($tabungans as $i => $tabungan)
                <div class="flex gap-2">
                    <input
                        type="text"
                        name="tabungans[{{ $i }}][type]"
                        value="{{ $tabungan['tabungan_type'] ?? '' }}"
                        placeholder="Jenis Tabungan"
                        class="flex-1 rounded-xl bg-slate-50 border px-4 py-2.5"
                    >

                    <input
                        type="number"
                        step="0.01"
                        name="tabungans[{{ $i }}][rate]"
                        value="{{ $tabungan['rate'] ?? '' }}"
                        placeholder="Bunga (%)"
                        class="w-32 rounded-xl bg-slate-50 border px-4 py-2.5"
                    >

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
            $depositos = old('depositos', $period->depositos->toArray());
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
                        name="depositos[{{ $i }}][tenor]"
                        value="{{ $dep['tenor_month'] ?? '' }}"
                        placeholder="Tenor (bulan)"
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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="number" step="0.01"
                name="lps_rate"
                value="{{ old('lps_rate', optional($period->lps)->rate) }}"
                placeholder="Bunga LPS (%)"
                class="rounded-xl bg-slate-50 border px-4 py-2.5">

            <input type="text"
                name="lps_note"
                value="{{ old('lps_note', optional($period->lps)->note) }}"
                placeholder="Catatan LPS"
                class="rounded-xl bg-slate-50 border px-4 py-2.5">

            <input type="url"
                name="lps_verification_url"
                value="{{ old('lps_verification_url', optional($period->lps)->verification_url) }}"
                placeholder="URL Verifikasi LPS"
                class="rounded-xl bg-slate-50 border px-4 py-2.5">
        </div>
        
        {{-- ================= STATUS AKTIF ================= --}}
        <div class="flex items-center gap-3">
            <input
                type="checkbox"
                name="is_active"
                value="1"
                id="is_active"
                class="rounded border-slate-300 text-[#00326B] focus:ring-[#00326B]"
                {{ old('is_active', $period->is_active) ? 'checked' : '' }}
                data-active-count="{{ $activePeriods }}"
                data-is-current-active="{{ $period->is_active ? 1 : 0 }}"
            >

            <label for="is_active" class="text-sm text-slate-600">
                Jadikan periode aktif
            </label>
        </div>

        <p id="active-warning"
        class="hidden text-sm text-red-600 mt-1">
        ⚠️ Minimal harus ada satu periode yang aktif.
        </p>
        @if($totalPeriods === 1)
            {{-- hidden input supaya tetap terkirim --}}
            <input type="hidden" name="is_active" value="1">
        @endif

        {{-- ACTION --}}
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.main.index') }}"
               class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2">
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
            <input type="text"
                name="tabungans[${tabunganIndex}][type]"
                placeholder="Jenis Tabungan"
                class="flex-1 rounded-xl bg-slate-50 border px-4 py-2.5">

            <input type="number" step="0.01"
                name="tabungans[${tabunganIndex}][rate]"
                placeholder="Bunga (%)"
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
                placeholder="Tenor (bulan)"
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
const activeCheckbox = document.getElementById('is_active');
const warning = document.getElementById('active-warning');

if (activeCheckbox) {
    activeCheckbox.addEventListener('change', function () {

        const activeCount = Number(this.dataset.activeCount);
        const isCurrentActive = Number(this.dataset.isCurrentActive);

        // Jika ini periode aktif terakhir & mau dimatikan
        if (activeCount === 1 && isCurrentActive === 1 && !this.checked) {
            this.checked = true;
            warning.classList.remove('hidden');
        } else {
            warning.classList.add('hidden');
        }
    });
}
</script>
@endsection


