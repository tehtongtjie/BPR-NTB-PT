@extends('layouts.app')

@section('title', 'Simulasi Deposito - BPR NTB')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <main class="bg-gray-50 min-h-screen pt-32 lg:pt-40 pb-24 font-sans antialiased">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Section --}}
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-blue-900 tracking-tight mb-3">Kalkulator Deposito</h1>
                <p class="text-gray-500 max-w-2xl mx-auto italic">Rencanakan investasi masa depan Anda dengan estimasi bunga
                    deposito yang akurat dan transparan.</p>
            </div>

            <div class="bg-white rounded-[3rem] shadow-2xl shadow-blue-900/10 border border-gray-100 overflow-hidden">
                <div class="flex flex-col lg:flex-row">

                    {{-- LEFT SIDE: INPUT FORM (Identik dengan Kredit) --}}
                    <div class="lg:w-3/5 p-8 md:p-12 border-b lg:border-b-0 lg:border-r border-gray-100">
                        <h3 class="text-xl font-bold text-gray-800 mb-8 flex items-center gap-3">
                            <span
                                class="w-8 h-8 bg-blue-600 text-white rounded-xl flex items-center justify-center text-sm">1</span>
                            Parameter Simpanan
                        </h3>

                        <div class="space-y-6">
                            {{-- Nominal --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700 ml-1">Nominal Deposito (Pokok)</label>
                                <div class="relative group">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-600">
                                        <span class="font-bold">Rp</span>
                                    </div>
                                    <input type="text" id="nominal"
                                        class="block w-full pl-12 pr-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all text-lg font-bold text-gray-900"
                                        placeholder="0">
                                </div>
                                <p id="nominal-error" class="hidden text-xs text-red-500 font-medium ml-1">
                                    <i class="bi bi-exclamation-circle mr-1"></i> Minimal nominal deposito adalah Rp
                                    5.000.000
                                </p>
                            </div>

                            {{-- Row Tenor & Bunga --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-3">
                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-gray-700 ml-1">Tenor (Bulan)</label>
                                    <select id="tenor"
                                        class="block w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all font-semibold text-gray-700 cursor-pointer">
                                        <option value="" selected disabled>Pilih Tenor</option>
                                        <option value="1">1 Bulan</option>
                                        <option value="3">3 Bulan</option>
                                        <option value="6">6 Bulan</option>
                                        <option value="12">12 Bulan</option>
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-gray-700 ml-1">Suku Bunga (% p.a)</label>
                                    <input type="text" id="bunga" value="5.00%" readonly
                                        class="w-full px-5 py-4 bg-blue-50/50 border border-blue-100 text-blue-600 rounded-2xl font-black text-center outline-none">
                                </div>
                            </div>

                            {{-- Info Note --}}
                            <div class="mt-8 p-4 bg-amber-50 rounded-2xl border border-amber-100 flex gap-3">
                                <i class="bi bi-info-circle-fill text-amber-500"></i>
                                <p class="text-[11px] text-amber-800 leading-relaxed font-medium">
                                    <b>Catatan:</b> Suku bunga dapat berubah sewaktu-waktu. Pajak bunga 20% berlaku untuk
                                    nominal di atas Rp 7.500.000 sesuai ketentuan yang berlaku.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT SIDE: RESULTS (Identik dengan Kredit) --}}
                    <div class="lg:w-2/5 p-8 md:p-12 bg-blue-50/30 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-8 flex items-center gap-3">
                                <span
                                    class="w-8 h-8 bg-emerald-500 text-white rounded-xl flex items-center justify-center text-sm">2</span>
                                Hasil Estimasi
                            </h3>

                            <div class="bg-white rounded-[2rem] p-8 shadow-xl shadow-blue-900/5 border border-white">
                                <div class="text-center mb-8">
                                    <label
                                        class="text-[10px] uppercase font-black tracking-[0.2em] text-gray-400 block mb-2">Total
                                        Saat Jatuh Tempo</label>
                                    <h2 id="display_total" class="text-4xl font-black text-blue-900 leading-none">Rp 0</h2>
                                </div>

                                <div class="space-y-4 border-t border-gray-50 pt-8">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm font-medium text-gray-500">Nominal Pokok</span>
                                        <span id="summary_plafond" class="font-bold text-gray-900 italic text-sm">Rp
                                            0</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm font-medium text-gray-500">Est. Bunga Bersih</span>
                                        <span id="display_bunga" class="font-bold text-emerald-600 italic text-sm">Rp
                                            0</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-12 space-y-4">
                            <a href="{{ route('simulasi.permintaan', 'deposito') }}"
                                class="flex items-center justify-center gap-3 w-full bg-[#0A1D37] hover:bg-blue-900 text-white py-5 rounded-[1.5rem] font-bold shadow-xl transition-all active:scale-95 group">
                                <i
                                    class="bi bi-send-fill transition-transform group-hover:translate-x-1 group-hover:-translate-y-1"></i>
                                Ajukan Deposito
                            </a>
                            <p
                                class="text-[10px] text-center text-gray-400 font-bold uppercase tracking-widest leading-relaxed px-4 italic">
                                *Hasil kalkulasi ini merupakan estimasi awal. Keputusan final mengikuti ketentuan Bank saat
                                pembukaan rekening.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <style>
        input::placeholder {
            color: #d1d5db;
            font-weight: 500;
        }

        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 1.25rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            appearance: none;
        }
    </style>
@endsection

@push('scripts')
    @vite(['resources/js/pages/simulasi/deposito.js'])
@endpush
