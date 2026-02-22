@extends('user.layouts.app')

@section('title', 'Simulasi Kredit - BPR NTB')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <main class="bg-gray-50 min-h-screen pt-32 lg:pt-40 pb-24 font-sans antialiased">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Section --}}
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-blue-900 tracking-tight mb-3">Kalkulator Kredit</h1>
                <p class="text-gray-500 max-w-2xl mx-auto">Rencanakan keuangan Anda dengan menghitung estimasi angsuran
                    bulanan secara akurat sesuai jenis kredit yang Anda butuhkan.</p>
            </div>

            <div class="bg-white rounded-[3rem] shadow-2xl shadow-blue-900/10 border border-gray-100 overflow-hidden">
                <div class="flex flex-col lg:flex-row">

                    {{-- LEFT SIDE: INPUT FORM --}}
                    <div class="lg:w-3/5 p-8 md:p-12 border-b lg:border-b-0 lg:border-r border-gray-100">
                        <h3 class="text-xl font-bold text-gray-800 mb-8 flex items-center gap-3">
                            <span
                                class="w-8 h-8 bg-blue-600 text-white rounded-xl flex items-center justify-center text-sm">1</span>
                            Parameter Pinjaman
                        </h3>

                        <div class="space-y-6">
                            {{-- Plafond --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700 ml-1">Jumlah Pinjaman (Plafond)</label>
                                <div class="relative group">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-600">
                                        <span class="font-bold">Rp</span>
                                    </div>
                                    <input type="text" id="pinjaman"
                                        class="block w-full pl-12 pr-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all text-lg font-bold text-gray-900"
                                        placeholder="0">
                                </div>
                                <p id="pinjaman-error" class="hidden text-xs text-red-500 font-medium ml-1">
                                    <i class="bi bi-exclamation-circle mr-1"></i> <span id="error-msg"></span>
                                </p>
                            </div>

                            {{-- Jenis Kredit --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700 ml-1">Jenis Kredit</label>
                                <select id="jenis_kredit"
                                    class="block w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all font-semibold text-gray-700 cursor-pointer">
                                    <option value="" selected disabled>Pilih Jenis Kredit</option>
                                    <option value="konsumtif">Kredit Konsumtif</option>
                                    <option value="agunan">Modal Kerja - Dengan Agunan</option>
                                    <option value="tanpa_agunan">Modal Kerja - Tanpa Agunan</option>
                                </select>
                            </div>

                            {{-- Metode Angsuran --}}
                            <div class="space-y-2" id="sistem-bunga-wrapper">
                                <label class="text-sm font-bold text-gray-700 ml-1">Metode Angsuran</label>
                                <select id="sistem_bunga"
                                    class="block w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all font-semibold text-gray-700 cursor-pointer">
                                    <option value="" selected disabled>Pilih Sistem Bunga</option>
                                    <option value="flat">Bunga Flat (Tetap)</option>
                                    <option value="anuitas">Bunga Anuitas (Efektif)</option>
                                </select>
                            </div>

                            {{-- Row Tenor & Bunga --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-gray-700 ml-1">Tenor (Bulan)</label>
                                    <select id="tenor"
                                        class="block w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all font-semibold text-gray-700 cursor-pointer">
                                        <option value="" selected disabled>Pilih Tenor</option>
                                        @foreach ([6, 12, 18, 24, 36, 48, 60, 72, 84, 96, 108, 120, 132, 144] as $t)
                                            <option value="{{ $t }}">{{ $t }} Bulan</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-gray-700 ml-1">Suku Bunga</label>
                                    <div id="bunga-info"
                                        class="w-full px-5 py-4 bg-blue-50/50 border border-blue-100 text-blue-600 rounded-2xl font-black text-center">
                                        Suku Bunga (%)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT SIDE: RESULTS --}}
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
                                        class="text-[10px] uppercase font-black tracking-[0.2em] text-gray-400 block mb-2">Angsuran
                                        per Bulan</label>
                                    <h2 id="display_angsuran" class="text-4xl font-black text-blue-900 leading-none">Rp 0
                                    </h2>
                                    <input type="hidden" id="angsuran">
                                </div>

                                <div class="space-y-4 border-t border-gray-50 pt-8">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm font-medium text-gray-500">Plafond Pinjaman</span>
                                        <span id="summary_plafond" class="font-bold text-gray-900 italic">Rp 0</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm font-medium text-gray-500">Total Est. Bunga</span>
                                        <span id="summary_bunga" class="font-bold text-emerald-600 italic">Rp 0</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Info Note --}}
                            <div id="anuitas-info"
                                class="hidden mt-6 p-4 bg-amber-50 rounded-2xl border border-amber-100 flex gap-3">
                                <i class="bi bi-info-circle-fill text-amber-500"></i>
                                <p class="text-xs text-amber-800 leading-relaxed font-medium">
                                    <b>Sistem Anuitas:</b> Porsi bunga besar di awal dan mengecil setiap bulan seiring
                                    berkurangnya sisa pokok.
                                </p>
                            </div>
                        </div>

                        <div class="mt-12 space-y-4">
                            <a href="{{ url('/simulasi/kredit/permintaan') }}"
                                class="flex items-center justify-center gap-3 w-full bg-[#0A1D37] hover:bg-blue-900 text-white py-5 rounded-[1.5rem] font-bold shadow-xl transition-all active:scale-95 group">
                                <i
                                    class="bi bi-send-fill transition-transform group-hover:translate-x-1 group-hover:-translate-y-1"></i>
                                Ajukan Deposito
                            </a>
                            <p
                                class="text-[10px] text-center text-gray-400 font-bold uppercase tracking-widest leading-relaxed px-4">
                                *Hasil kalkulasi ini merupakan estimasi awal. Keputusan final mengikuti hasil survey dan
                                analis bank.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <style>
        /* Styling khusus untuk input agar terlihat lebih premium */
        input::placeholder {
            color: #d1d5db;
            font-weight: 500;
        }

        /* Menghapus arrow default select di beberapa browser */
        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 1.25rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            appearance: none;
        }
    </style>
@endsection
