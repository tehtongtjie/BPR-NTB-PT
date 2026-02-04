@extends('layouts.app')

@section('title', 'Whistle Blowing System - BPR NTB')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <main class="bg-[#F8FAFC] min-h-screen pt-32 lg:pt-44 pb-24 font-sans antialiased relative overflow-hidden">
        {{-- Elemen Dekoratif Latar Belakang --}}
        <div class="absolute top-0 left-0 w-full h-[600px] bg-gradient-to-b from-[#00326B]/5 to-transparent -z-10"></div>
        <div class="absolute top-[10%] -right-24 w-[500px] h-[500px] bg-[#fbbf24]/10 rounded-full blur-[120px] -z-10"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative">

            {{-- BAGIAN NOTIFIKASI (WAJIB ADA) --}}
            @if ($errors->any())
                <div class="mb-6 p-6 bg-red-50 border border-red-200 rounded-[2rem] animate-fade-in">
                    <div class="flex items-center gap-3 text-red-800 mb-2">
                        <i class="bi bi-exclamation-octagon-fill text-xl"></i>
                        <span class="font-black uppercase tracking-widest text-xs">Mohon Periksa Kembali:</span>
                    </div>
                    <ul class="list-disc list-inside text-sm text-red-600 font-semibold space-y-1 ml-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div
                    class="mb-6 p-6 bg-emerald-50 border border-emerald-100 rounded-[2rem] flex items-center gap-4 text-emerald-800 animate-fade-in shadow-lg shadow-emerald-900/5">
                    <i class="bi bi-check-circle-fill text-2xl"></i>
                    <p class="font-bold text-sm">{{ session('success') }}</p>
                </div>
            @endif

            <div
                class="bg-white rounded-[3rem] lg:rounded-[4rem] shadow-2xl shadow-blue-900/5 border border-gray-100 overflow-hidden relative">

                {{-- Pattern Overlay --}}
                <div class="absolute inset-0 opacity-[0.015] pointer-events-none"
                    style="background-image: url('https://www.transparenttextures.com/patterns/pinstriped-suit.png');">
                </div>

                <div class="p-8 md:p-16 relative z-10">
                    {{-- HEADER --}}
                    <div class="text-center mb-12">
                        <div
                            class="inline-flex items-center gap-3 px-6 py-2 rounded-full bg-red-50 text-red-700 text-[10px] font-black uppercase tracking-[0.4em] mb-6 border border-red-100">
                            <i class="bi bi-shield-lock-fill"></i> Secure & Confidential
                        </div>
                        <h1 class="text-3xl lg:text-5xl font-black text-[#00326B] leading-tight tracking-tight mb-4">
                            Whistle Blowing System
                        </h1>
                        <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">
                            Saluran Pelaporan Pelanggaran PT. BPR NTB (Perseroda)
                        </p>
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="bg-slate-50 rounded-[2.5rem] p-8 mb-12 border border-slate-100">
                        <p class="text-slate-600 text-base lg:text-lg leading-relaxed font-medium">
                            <strong class="text-[#00326B]">Whistle Blowing System (WBS)</strong> adalah sarana resmi untuk
                            melaporkan dugaan pelanggaran hukum, etika, atau kecurangan (fraud) di lingkungan bank.
                            Kami menjamin <span
                                class="text-red-600 font-bold italic text-sm underline decoration-2 underline-offset-4">kerahasiaan
                                penuh</span> atas identitas Anda.
                        </p>
                    </div>

                    {{-- FORM --}}
                    <form method="POST" action="{{ route('pengaduan.wbs.store') }}" class="space-y-8">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-black text-[#00326B] ml-1 uppercase tracking-wider">Nama Pelapor
                                    <span class="text-slate-400 font-medium">(Opsional)</span></label>
                                <input type="text" name="nama" value="{{ old('nama') }}" class="form-custom-input"
                                    placeholder="Anonim">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-black text-[#00326B] ml-1 uppercase tracking-wider">Email
                                    Korespondensi <span class="text-slate-400 font-medium">(Opsional)</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-custom-input"
                                    placeholder="email@anda.com">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-black text-[#00326B] ml-1 uppercase tracking-wider">No. Telepon
                                    <span class="text-slate-400 font-medium">(Opsional)</span></label>
                                <input type="tel" name="no_telepon" value="{{ old('no_telepon') }}"
                                    class="form-custom-input" placeholder="+62 ...">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-black text-[#00326B] ml-1 uppercase tracking-wider">Kategori
                                    Pelanggaran <span class="text-red-500">*</span></label>
                                <select name="kategori" class="form-custom-input cursor-pointer" required>
                                    <option value="" disabled selected>-- Pilih Kategori --</option>
                                    <option value="fraud" {{ old('kategori') == 'fraud' ? 'selected' : '' }}>Fraud /
                                        Kecurangan</option>
                                    <option value="korupsi" {{ old('kategori') == 'korupsi' ? 'selected' : '' }}>Korupsi /
                                        Gratifikasi</option>
                                    <option value="pelanggaran_etika"
                                        {{ old('kategori') == 'pelanggaran_etika' ? 'selected' : '' }}>Pelanggaran Kode Etik
                                    </option>
                                    <option value="penyalahgunaan_wewenang"
                                        {{ old('kategori') == 'penyalahgunaan_wewenang' ? 'selected' : '' }}>Penyalahgunaan
                                        Wewenang</option>
                                    <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-black text-[#00326B] ml-1 uppercase tracking-wider">Nama Terlapor
                                    <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_terlapor" value="{{ old('nama_terlapor') }}"
                                    class="form-custom-input" placeholder="Siapa yang dilaporkan?" required>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-black text-[#00326B] ml-1 uppercase tracking-wider">Lokasi
                                    Kejadian <span class="text-red-500">*</span></label>
                                <input type="text" name="lokasi_kejadian" value="{{ old('lokasi_kejadian') }}"
                                    class="form-custom-input" placeholder="Cabang / Unit Kerja" required>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-black text-[#00326B] ml-1 uppercase tracking-wider">Waktu Kejadian
                                <span class="text-red-500">*</span></label>
                            <input type="datetime-local" name="waktu_kejadian" value="{{ old('waktu_kejadian') }}"
                                class="form-custom-input" required>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-black text-[#00326B] ml-1 uppercase tracking-wider">Uraian Laporan
                                <span class="text-red-500">*</span></label>
                            <textarea name="laporan" rows="6"
                                class="block w-full px-6 py-4 bg-[#F8FAFC] border-none rounded-[2rem] focus:ring-2 focus:ring-[#fbbf24] focus:bg-white transition-all font-medium text-slate-700"
                                placeholder="Ceritakan secara kronologis kejadian yang Anda ketahui..." required>{{ old('laporan') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                            <div class="p-6 bg-amber-50 rounded-[2rem] border border-amber-100 flex gap-4">
                                <div
                                    class="flex-shrink-0 w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                </div>
                                <p
                                    class="text-[10px] text-amber-900/70 font-black leading-relaxed uppercase tracking-tight">
                                    Pastikan laporan Anda didasari dengan niat baik dan fakta. Laporan palsu dapat
                                    berimplikasi pada sanksi hukum.
                                </p>
                            </div>

                            <button type="submit"
                                class="flex items-center justify-center gap-4 w-full bg-[#00326B] text-white py-5 rounded-2xl font-black uppercase text-xs tracking-[0.3em] shadow-xl shadow-blue-900/20 hover:bg-[#fbbf24] hover:text-[#00326B] transition-all transform active:scale-95 group">
                                <i
                                    class="bi bi-send-fill transition-transform group-hover:translate-x-1 group-hover:-translate-y-1"></i>
                                Kirim Laporan Rahasia
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-12 text-center">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em]">
                    Sistem ini diawasi secara independen oleh Satuan Kerja Audit Internal PT. BPR NTB (Perseroda)
                </p>
            </div>
        </div>
    </main>

    <style>
        .form-custom-input {
            display: block;
            width: 100%;
            padding: 1rem 1.5rem;
            background-color: #F8FAFC;
            border: none;
            border-radius: 1rem;
            font-weight: 600;
            color: #334155;
            transition: all 0.3s ease;
        }

        .form-custom-input:focus {
            outline: none;
            ring: 2px;
            ring-color: #fbbf24;
            background-color: white;
        }

        input[type="datetime-local"]::-webkit-calendar-picker-indicator {
            filter: invert(16%) sepia(89%) saturate(1900%) hue-rotate(195deg) brightness(96%) contrast(101%);
            cursor: pointer;
        }

        input::placeholder,
        textarea::placeholder {
            color: #94a3b8;
            font-weight: 500;
            font-style: italic;
        }
    </style>
@endsection
