@extends('layouts.app')

@section('title', $deposito['nama'] . ' - BPR NTB')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <main class="bg-gray-50/50 min-h-screen pt-20 lg:pt-24 pb-24 font-sans antialiased">

        {{-- Hero Section dengan Mesh Gradient Modern --}}
        <div class="relative bg-[#0A1D37] pt-24 pb-44 overflow-hidden">
            {{-- Efek Cahaya Dekoratif --}}
            <div
                class="absolute top-0 right-0 -translate-y-1/4 translate-x-1/4 w-[500px] h-[500px] bg-blue-600/20 rounded-full blur-[120px]">
            </div>
            <div
                class="absolute bottom-0 left-0 translate-y-1/4 -translate-x-1/4 w-[400px] h-[400px] bg-cyan-500/10 rounded-full blur-[100px]">
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                {{-- Breadcrumb Putih --}}
                <nav class="flex mb-10 text-blue-300/60 text-xs tracking-widest uppercase font-bold">
                    <ol class="inline-flex items-center space-x-3">
                        <li><a href="/" class="hover:text-white transition-colors">Beranda</a></li>
                        <li class="text-blue-300/30">/</li>
                        <li><span class="hover:text-white cursor-pointer">Produk</span></li>
                        <li class="text-blue-300/30">/</li>
                        <li class="text-white">{{ $deposito['nama'] }}</li>
                    </ol>
                </nav>

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-12">
                    <div class="max-w-3xl">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[10px] font-bold uppercase tracking-widest mb-6">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                            </span>
                            Investment Banking
                        </div>
                        <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-[1.1] mb-6 tracking-tighter">
                            {{ $deposito['nama'] }}
                        </h1>
                        <p class="text-xl md:text-2xl text-blue-100/60 font-medium leading-relaxed max-w-xl">
                            {{ $deposito['subtitle'] }}
                        </p>
                    </div>

                    {{-- Quick Info Card --}}
                    <div class="hidden lg:grid grid-cols-2 gap-4">
                        <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-6 rounded-[2rem]">
                            <p class="text-[10px] text-blue-400 uppercase font-black tracking-widest mb-2">Suku Bunga</p>
                            <p class="text-3xl text-white font-bold">Kompetitif</p>
                        </div>
                        <div class="bg-blue-600 p-6 rounded-[2rem] shadow-xl shadow-blue-600/20">
                            <p class="text-[10px] text-blue-100 uppercase font-black tracking-widest mb-2">LPS</p>
                            <p class="text-3xl text-white font-bold">Terjamin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content Area --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-20">
            <div class="flex flex-col lg:flex-row gap-12">

                {{-- Kolom Kiri (Main Content) --}}
                <div class="lg:w-2/3 space-y-12">

                    {{-- Main Visual Card --}}
                    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
                        <div class="aspect-[16/9] relative group overflow-hidden">
                            <img src="{{ asset($deposito['gambar']) }}" alt="{{ $deposito['nama'] }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>

                        <div class="p-10 md:p-16 text-center">
                            <h3 class="text-blue-600 text-sm font-black uppercase tracking-[0.3em] mb-4">Tentang Produk</h3>
                            <p class="text-gray-500 text-2xl leading-relaxed font-medium mb-16 italic px-4">
                                "{{ $deposito['deskripsi'] }}"
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left mt-10">
                                @foreach ($deposito['keuntungan'] as $item)
                                    <div class="flex gap-6 p-2 group">
                                        <div
                                            class="flex-shrink-0 w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-all duration-500 shadow-sm">
                                            <i class="bi bi-patch-check-fill text-2xl"></i>
                                        </div>
                                        <div>
                                            <h4
                                                class="text-gray-900 font-bold text-lg mb-1 leading-tight group-hover:text-blue-600 transition-colors">
                                                {{ $item }}</h4>
                                            <p class="text-gray-400 text-sm leading-relaxed">Keamanan investasi Anda adalah
                                                prioritas utama kami.</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Suku Bunga Section --}}
                    <div class="space-y-6">
                        <h2 class="text-3xl font-black text-gray-900 tracking-tighter px-4">Suku Bunga Unggulan</h2>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach ($deposito['suku_bunga'] as $bulan => $bunga)
                                <div
                                    class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm text-center hover:border-blue-600 transition-all duration-300 group">
                                    <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest mb-2">
                                        {{ $bulan }} Bulan</p>
                                    <p
                                        class="text-3xl font-extrabold text-gray-900 group-hover:text-blue-600 transition-colors">
                                        {{ $bunga }}</p>
                                    <p class="text-[10px] text-blue-600 font-bold mt-2 italic">per tahun</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Tabel Simulasi --}}
                    <div class="bg-white rounded-[3rem] border border-gray-100 shadow-sm overflow-hidden p-8 md:p-12">
                        <h2 class="text-2xl font-black text-gray-900 mb-8 tracking-tighter">Ilustrasi Perolehan Bunga</h2>
                        <div class="overflow-x-auto rounded-3xl border border-gray-50">
                            <table class="w-full text-left">
                                <thead>
                                    <tr
                                        class="bg-gray-50/50 text-gray-400 text-[10px] uppercase font-black tracking-widest">
                                        <th class="px-6 py-5">Nominal Deposito</th>
                                        <th class="px-6 py-5 text-center">1 Bln</th>
                                        <th class="px-6 py-5 text-center">3 Bln</th>
                                        <th class="px-6 py-5 text-center">6 Bln</th>
                                        <th class="px-6 py-5 text-center">12 Bln</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @foreach ($deposito['simulasi_bunga'] as $nominal => $simulasi)
                                        <tr class="hover:bg-blue-50/30 transition-colors">
                                            <td class="px-6 py-5 font-bold text-gray-900">Rp
                                                {{ number_format($nominal, 0, ',', '.') }}</td>
                                            <td class="px-6 py-5 text-center text-blue-600 font-medium">Rp
                                                {{ number_format($simulasi[1], 0, ',', '.') }}</td>
                                            <td class="px-6 py-5 text-center text-blue-600 font-medium">Rp
                                                {{ number_format($simulasi[3], 0, ',', '.') }}</td>
                                            <td class="px-6 py-5 text-center text-blue-600 font-medium">Rp
                                                {{ number_format($simulasi[6], 0, ',', '.') }}</td>
                                            <td class="px-6 py-5 text-center text-blue-600 font-medium">Rp
                                                {{ number_format($simulasi[12], 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Syarat & Ketentuan Modern --}}
                    <div x-data="{ open: false }"
                        class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden group">
                        <button @click="open = !open"
                            class="w-full p-10 flex items-center justify-between text-left outline-none transition-all">
                            <div class="flex items-center gap-6">
                                <div
                                    class="w-14 h-14 bg-gray-50 text-gray-400 rounded-2xl flex items-center justify-center group-hover:bg-blue-50 group-hover:text-blue-600 transition-all">
                                    <i class="bi bi-file-earmark-check text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900 tracking-tighter">Persyaratan Deposito</h3>
                                    <p class="text-gray-400 text-sm">Dokumen yang diperlukan untuk pembukaan bilyet</p>
                                </div>
                            </div>
                            <div :class="open ? 'rotate-180 bg-blue-600 text-white' : 'bg-gray-100 text-gray-400'"
                                class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-500">
                                <i class="bi bi-chevron-down"></i>
                            </div>
                        </button>

                        <div x-show="open" x-collapse>
                            <div class="p-10 pt-0 space-y-8">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div>
                                        <h5 class="text-blue-600 font-black text-xs uppercase tracking-widest mb-4">
                                            Perorangan</h5>
                                        <ul class="space-y-3">
                                            @foreach ($deposito['persyaratan']['perorangan'] as $syarat)
                                                <li class="flex items-center gap-3 text-sm text-gray-600 font-medium">
                                                    <div class="w-1.5 h-1.5 rounded-full bg-blue-500"></div>
                                                    {{ $syarat }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div>
                                        <h5 class="text-blue-600 font-black text-xs uppercase tracking-widest mb-4">Badan
                                            Usaha</h5>
                                        <ul class="space-y-3">
                                            @foreach ($deposito['persyaratan']['badan_usaha'] as $syarat)
                                                <li class="flex items-center gap-3 text-sm text-gray-600 font-medium">
                                                    <div class="w-1.5 h-1.5 rounded-full bg-cyan-500"></div>
                                                    {{ $syarat }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                {{-- Catatan dalam box amber --}}
                                <div class="bg-amber-50/50 border border-amber-100 p-6 rounded-[2rem] flex gap-4">
                                    <i class="bi bi-exclamation-circle text-amber-500 text-xl"></i>
                                    <ul class="text-amber-900/70 text-xs font-bold leading-relaxed">
                                        @foreach ($deposito['catatan'] as $note)
                                            <li>• {{ $note }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan (Sidebar) --}}
                <aside class="lg:w-1/3 space-y-8">
                    <div class="sticky top-28 space-y-8">
                        {{-- Sidebar Produk (Pastikan file ini ada) --}}
                        <div class="bg-white rounded-[2.5rem] p-4 shadow-sm border border-gray-100">
                            @include('components.sidebar-produk')
                        </div>

                        {{-- Premium CTA Card --}}
                        <div
                            class="relative bg-[#0A1D37] rounded-[3rem] p-10 overflow-hidden text-white shadow-2xl shadow-blue-900/40 group">
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-blue-600/20 rounded-full blur-3xl -mr-16 -mt-16 group-hover:bg-blue-600/40 transition-all duration-700">
                            </div>

                            <h4 class="text-3xl font-bold mb-4 tracking-tight relative z-10">Mulai Investasi Cerdas</h4>
                            <p class="text-blue-100/50 mb-10 leading-relaxed relative z-10 text-sm font-medium">
                                Investasikan masa depan Anda dengan bunga kompetitif dan keamanan terjamin LPS.</p>

                            <div class="space-y-4 relative z-10">
                                <a href="{{ route('pages.simulasi.deposito') }}"
                                    class="flex items-center justify-center gap-3 w-full bg-white text-blue-950 py-5 rounded-[1.5rem] font-extrabold hover:bg-blue-50 transition-all active:scale-95 shadow-xl shadow-black/10">
                                    <i class="bi bi-calculator text-xl text-blue-600"></i> Simulasikan Deposito
                                </a>
                                <button onclick="window.print()"
                                    class="flex items-center justify-center gap-3 w-full bg-white/5 border border-white/10 text-white py-5 rounded-[1.5rem] font-bold hover:bg-white/10 transition-all">
                                    <i class="bi bi-printer"></i> Cetak Dokumen PDF
                                </button>
                            </div>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </main>

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Menghaluskan transisi CSS */
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
            [class*="bg-blue-600/20"] {
                display: none !important;
            }

            main {
                padding-bottom: 0 !important;
                margin-top: -50px !important;
            }

            .bg-white {
                border: none !important;
            }
        }
    </style>
@endsection
