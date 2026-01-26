@extends('admin.layouts.app')

@section('title', 'Tambah Jaringan Kantor')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- PAGE HEADER --}}
    <div>
        <h1 class="text-2xl font-semibold text-slate-800">
            Tambah Jaringan Kantor
        </h1>
        <p class="text-sm text-slate-500 mt-1">
            Tambahkan data kantor cabang, kas, atau kantor pusat
        </p>
    </div>

    {{-- FORM CARD --}}
    <form action="{{ route('jaringan.store') }}"
          method="POST"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
        @csrf

        {{-- ================= TIPE KANTOR ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Tipe Kantor
            </label>
            <select name="tipe"
                required
                class="w-full rounded-xl
                       bg-slate-50 border border-slate-200
                       px-4 py-2.5 text-slate-700
                       focus:bg-white
                       focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10
                       transition">
                <option value="">-- Pilih Tipe --</option>
                <option value="pusat">Kantor Pusat</option>
                <option value="cabang">Kantor Cabang</option>
                <option value="kas">Kantor Kas</option>
            </select>
        </div>

        {{-- ================= NAMA KANTOR ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Nama Kantor
            </label>
            <input type="text"
                name="nama"
                value="{{ old('nama') }}"
                required
                placeholder="Contoh: Kantor Cabang Selong"
                class="w-full rounded-xl
                       bg-slate-50 border border-slate-200
                       px-4 py-2.5 text-slate-700
                       placeholder:text-slate-400
                       focus:bg-white
                       focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10
                       transition">
        </div>

        {{-- ================= ALAMAT ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Alamat Kantor
            </label>
            <textarea name="alamat"
                rows="3"
                required
                placeholder="Alamat lengkap kantor"
                class="w-full rounded-xl
                       bg-slate-50 border border-slate-200
                       px-4 py-3 text-slate-700
                       placeholder:text-slate-400
                       focus:bg-white
                       focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10
                       transition resize-none">{{ old('alamat') }}</textarea>
        </div>

        {{-- ================= TELEPON ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Nomor Telepon
            </label>
            <input type="text"
                name="telepon"
                value="{{ old('telepon') }}"
                placeholder="Contoh: (0370) 123456"
                class="w-full rounded-xl
                       bg-slate-50 border border-slate-200
                       px-4 py-2.5 text-slate-700
                       placeholder:text-slate-400
                       focus:bg-white
                       focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10
                       transition">
        </div>

        {{-- ================= KOORDINAT ================= --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-600">
                    Latitude
                </label>
                <input type="text"
                    name="latitude"
                    value="{{ old('latitude') }}"
                    placeholder="-8.650106"
                    class="w-full rounded-xl
                           bg-slate-50 border border-slate-200
                           px-4 py-2.5 text-slate-700
                           focus:bg-white
                           focus:border-[#00326B]
                           focus:ring-4 focus:ring-[#00326B]/10
                           transition">
            </div>

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-600">
                    Longitude
                </label>
                <input type="text"
                    name="longitude"
                    value="{{ old('longitude') }}"
                    placeholder="116.535872"
                    class="w-full rounded-xl
                           bg-slate-50 border border-slate-200
                           px-4 py-2.5 text-slate-700
                           focus:bg-white
                           focus:border-[#00326B]
                           focus:ring-4 focus:ring-[#00326B]/10
                           transition">
            </div>

        </div>

        {{-- ================= STATUS ================= --}}
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-slate-600">
                Status Kantor
            </label>
            <select name="is_active"
                class="w-full rounded-xl
                       bg-slate-50 border border-slate-200
                       px-4 py-2.5 text-slate-700
                       focus:bg-white
                       focus:border-[#00326B]
                       focus:ring-4 focus:ring-[#00326B]/10
                       transition">
                <option value="1" selected>Aktif</option>
                <option value="0">Nonaktif</option>
            </select>
        </div>

        {{-- ================= ACTION BUTTON ================= --}}
        <div class="flex items-center gap-3 pt-4">
            <button type="submit"
                class="inline-flex items-center gap-2 rounded-xl
                       bg-[#00326B] px-6 py-2.5
                       text-sm font-medium text-white
                       hover:bg-[#002855]
                       focus:ring-4 focus:ring-[#00326B]/20
                       transition">
                Simpan Kantor
            </button>

            <a href="{{ route('jaringan.index') }}"
               class="text-sm text-slate-500 hover:text-slate-700 transition">
                Batal
            </a>
        </div>

    </form>

</div>
@endsection
