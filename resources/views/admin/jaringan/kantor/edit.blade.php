@extends('admin.layouts.app')

@section('title', 'Edit Jaringan Kantor')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-800">
                Edit Jaringan Kantor
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Perbarui informasi jaringan kantor BPR NTB
            </p>
        </div>

        <a href="{{ route('jaringan.index') }}"
           class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2">
            ← Kembali
        </a>
    </div>

    {{-- FORM --}}
    <form action="{{ route('jaringan.update', $kantor->id) }}"
          method="POST"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
        @csrf
        @method('PUT')

        {{-- ================= TIPE KANTOR ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Tipe Kantor
            </label>
            <select name="tipe"
                class="w-full rounded-xl bg-slate-50 border px-4 py-2.5
                       focus:ring-4 focus:ring-[#00326B]/10">
                <option value="pusat"  {{ old('tipe', $kantor->tipe) === 'pusat' ? 'selected' : '' }}>Kantor Pusat</option>
                <option value="cabang" {{ old('tipe', $kantor->tipe) === 'cabang' ? 'selected' : '' }}>Kantor Cabang</option>
                <option value="kas"    {{ old('tipe', $kantor->tipe) === 'kas' ? 'selected' : '' }}>Kantor Kas</option>
            </select>
        </div>

        {{-- ================= NAMA ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Nama Kantor
            </label>
            <input type="text"
                name="nama"
                value="{{ old('nama', $kantor->nama) }}"
                class="w-full rounded-xl bg-slate-50 border px-4 py-2.5
                       focus:ring-4 focus:ring-[#00326B]/10">
        </div>

        {{-- ================= ALAMAT ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Alamat
            </label>
            <textarea name="alamat" rows="3"
                class="w-full rounded-xl bg-slate-50 border px-4 py-3
                       focus:ring-4 focus:ring-[#00326B]/10">{{ old('alamat', $kantor->alamat) }}</textarea>
        </div>

        {{-- ================= TELEPON ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Nomor Telepon
            </label>
            <input type="text"
                name="telepon"
                value="{{ old('telepon', $kantor->telepon) }}"
                placeholder="Contoh: 0370xxxxxx"
                class="w-full rounded-xl bg-slate-50 border px-4 py-2.5
                       focus:ring-4 focus:ring-[#00326B]/10">
        </div>

        {{-- ================= KOORDINAT ================= --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-600">
                    Latitude
                </label>
                <input type="text"
                    name="latitude"
                    value="{{ old('latitude', $kantor->latitude) }}"
                    class="w-full rounded-xl bg-slate-50 border px-4 py-2.5
                           focus:ring-4 focus:ring-[#00326B]/10">
            </div>

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-600">
                    Longitude
                </label>
                <input type="text"
                    name="longitude"
                    value="{{ old('longitude', $kantor->longitude) }}"
                    class="w-full rounded-xl bg-slate-50 border px-4 py-2.5
                           focus:ring-4 focus:ring-[#00326B]/10">
            </div>
        </div>

        {{-- ================= ACTION ================= --}}
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('jaringan.index') }}"
               class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2">
                Batal
            </a>

            <button type="submit"
                class="rounded-xl bg-[#00326B] px-8 py-2.5 text-white">
                Update Jaringan
            </button>
        </div>
    </form>
</div>
@endsection


