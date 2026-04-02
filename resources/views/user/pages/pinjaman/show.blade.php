@extends('user.layouts.app')

@section('title', $pinjaman['nama'] . ' - BPR NTB')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

@section('content')
    <main class="bg-gray-50/50 min-h-screen pt-20 lg:pt-24 pb-24 font-sans antialiased">

        {{-- Hero Section dengan Mesh Gradient --}}
        <div class="relative bg-[#0A1D37] pt-16 pb-40 overflow-hidden">
            {{-- Elemen Dekoratif --}}
            <div
                class="absolute top-0 right-0 -translate-y-1/4 translate-x-1/4 w-[500px] h-[500px] bg-blue-600/20 rounded-full blur-[120px]">
            </div>
            <div
                class="absolute bottom-0 left-0 translate-y-1/4 -translate-x-1/4 w-[400px] h-[400px] bg-emerald-500/10 rounded-full blur-[100px]">
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                {{-- Breadcrumb --}}
                <nav class="flex mb-10 text-blue-300/60 text-xs tracking-widest uppercase font-bold">
                    <ol class="inline-flex items-center space-x-3">
                        <li><a href="/" class="hover:text-white transition-colors">Beranda</a></li>
                        <li class="text-blue-300/30">/</li>
                        <li><span class="hover:text-white cursor-pointer">Produk</span></li>
                        <li class="text-blue-300/30">/</li>
                        <li class="text-white">{{ $pinjaman['nama'] }}</li>
                    </ol>
                </nav>

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-12">
                    <div class="max-w-3xl">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-[10px] font-bold uppercase tracking-widest mb-6">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            Credit & Financing
                        </div>
                        <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-[1.1] mb-6 tracking-tighter">
                            {{ $pinjaman['nama'] }}
                        </h1>
                        <p class="text-xl md:text-2xl text-blue-100/60 font-medium leading-relaxed max-w-xl">
                            {{ $pinjaman['subtitle'] }}
                        </p>
                    </div>

                    {{-- Quick Info Card --}}
                    <div class="hidden lg:grid grid-cols-2 gap-4">
                        <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-6 rounded-[2rem]">
                            <p class="text-[10px] text-emerald-400 uppercase font-black tracking-widest mb-2">Proses</p>
                            <p class="text-3xl text-white font-bold">Cepat</p>
                        </div>
                        <div class="bg-blue-600 p-6 rounded-[2rem] shadow-xl shadow-blue-600/20">
                            <p class="text-[10px] text-blue-100 uppercase font-black tracking-widest mb-2">Bunga</p>
                            <p class="text-3xl text-white font-bold">Ringan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content Area --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20">
            <div class="flex flex-col lg:flex-row gap-12">

                {{-- Sidebar Kiri --}}
                <aside class="lg:w-1/3 order-2 lg:order-1">
                    <div class="sticky top-32 space-y-8">
                        {{-- Sidebar Component --}}
                        <div class="bg-white rounded-[2.5rem] p-6 shadow-sm border border-gray-100">
                            @include('user.components.sidebar-pinjaman')
                        </div>

                        {{-- CTA Simulasikan --}}
                        <div
                            class="relative bg-[#0A1D37] rounded-[3rem] p-10 overflow-hidden text-white shadow-2xl shadow-blue-900/40 group">
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-emerald-600/20 rounded-full blur-3xl -mr-16 -mt-16 group-hover:bg-emerald-600/40 transition-all duration-700">
                            </div>

                            <h4 class="text-2xl font-bold mb-4 tracking-tight relative z-10 text-center">Butuh Modal Usaha?
                            </h4>
                            <p class="text-blue-100/50 mb-8 text-center text-sm relative z-10 leading-relaxed">Gunakan
                                kalkulator kredit kami untuk menghitung estimasi angsuran bulanan Anda.</p>

                            <div class="space-y-4 relative z-10">
                                <a href="{{ route('user.pages.simulasi.kredit') }}"
                                    class="flex items-center justify-center gap-3 w-full bg-blue-600 text-white py-5 rounded-[1.5rem] font-bold hover:bg-blue-700 transition-all active:scale-95 shadow-xl shadow-blue-600/20">
                                    <i class="bi bi-calculator text-xl"></i> Mulai Simulasi
                                </a>
                                <a href="https://wa.me/your-number"
                                    class="flex items-center justify-center gap-3 w-full bg-white/5 border border-white/10 text-white py-5 rounded-[1.5rem] font-bold hover:bg-white/10 transition-all">
                                    <i class="bi bi-whatsapp text-green-400"></i> Tanya CS Kami
                                </a>
                            </div>
                        </div>
                    </div>
                </aside>

                {{-- Main Content Kanan --}}
                <div class="lg:w-2/3 order-1 lg:order-2 space-y-12">
                    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
                        {{-- Image Banner --}}
                        @php
                            $pinjamanImage = str_replace('\\', '/', $pinjaman['gambar']);
                        @endphp
                        <div class="aspect-[21/9] relative group overflow-hidden">
                            <img src="{{ asset($pinjamanImage) }}" alt="{{ $pinjaman['nama'] }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                        </div>

                        <div class="p-8 md:p-14">
                            {{-- Deskripsi --}}
                            <div class="mb-14 text-center">
                                <h3 class="text-blue-600 text-sm font-black uppercase tracking-[0.3em] mb-6">Tentang
                                    Pinjaman</h3>
                                <p class="text-gray-500 text-2xl leading-relaxed font-medium italic px-4">
                                    "{{ $pinjaman['deskripsi'] }}"
                                </p>
                            </div>

                            {{-- Keuntungan Grid --}}
                            <div class="space-y-8">
                                <h4 class="text-2xl font-extrabold text-gray-900 tracking-tight flex items-center gap-3">
                                    <span class="w-1.5 h-8 bg-blue-600 rounded-full"></span>
                                    Mengapa Memilih {{ $pinjaman['nama'] }}?
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @foreach ($pinjaman['keuntungan'] as $item)
                                        <div
                                            class="flex gap-5 p-5 bg-gray-50 rounded-[2rem] hover:bg-blue-50 transition-all duration-300 border border-transparent hover:border-blue-100 group">
                                            <div
                                                class="flex-shrink-0 w-12 h-12 bg-white text-blue-600 rounded-2xl flex items-center justify-center shadow-sm group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                                                <i class="bi bi-check-lg text-xl"></i>
                                            </div>
                                            <span
                                                class="text-gray-700 font-bold text-base self-center">{{ $item }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Jenis Pinjaman --}}
                            @if (!empty($pinjaman['jenis']))
                                <div class="mt-16 space-y-8">
                                    <h4
                                        class="text-2xl font-extrabold text-gray-900 tracking-tight flex items-center gap-3">
                                        <span class="w-1.5 h-8 bg-emerald-500 rounded-full"></span>
                                        Varian Produk
                                    </h4>
                                    <div class="grid grid-cols-1 gap-4">
                                        @foreach ($pinjaman['jenis'] as $jenis)
                                            <div
                                                class="flex items-center gap-4 p-6 bg-emerald-50/50 rounded-3xl border border-emerald-100 hover:bg-emerald-50 transition-all">
                                                <div
                                                    class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]">
                                                </div>
                                                <span
                                                    class="text-gray-800 font-bold tracking-tight">{{ $jenis }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Catatan OJK Info --}}
                    <div class="bg-gray-100/50 p-8 rounded-[2.5rem] border border-dashed border-gray-300">
                        <div class="flex flex-col md:flex-row items-center gap-6 text-center md:text-left">
                            <p class="text-xs text-gray-400 font-medium leading-relaxed uppercase tracking-widest">
                                BPR NTB Berizin dan Diawasi oleh Otoritas Jasa Keuangan (OJK) serta merupakan peserta
                                penjaminan Lembaga Penjamin Simpanan (LPS).
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <style>
        [x-cloak] {
            display: none !important;
        }

        .transition-all {
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media print {
            .bg-[#0A1D37] {
                background: white !important;
                color: black !important;
            }

            aside,
            nav,
            button,
            [class*="/20"] {
                display: none !important;
            }

            main {
                padding-top: 0 !important;
            }
        }
    </style>
@endsection
