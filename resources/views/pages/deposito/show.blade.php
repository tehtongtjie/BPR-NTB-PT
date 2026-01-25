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

        {{-- Content Area (Full Width) --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-20">
            <div class="space-y-12"> {{-- Container Vertikal Tanpa Kolom Sidebar --}}

                {{-- Main Visual & Deskripsi Card --}}
                <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="aspect-[21/9] relative group overflow-hidden hidden md:block">
                        <img src="{{ asset($deposito['gambar']) }}" alt="{{ $deposito['nama'] }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>

                    <div class="p-10 md:p-16 text-center">
                        <h3 class="text-blue-600 text-sm font-black uppercase tracking-[0.3em] mb-4">Tentang Produk</h3>
                        <p
                            class="text-gray-500 text-2xl lg:text-3xl leading-relaxed font-medium mb-16 italic max-w-5xl mx-auto">
                            "{{ $deposito['deskripsi'] }}"
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-left mt-10">
                            @foreach ($deposito['keuntungan'] as $item)
                                <div
                                    class="flex flex-col gap-4 p-6 bg-gray-50/50 rounded-3xl group hover:bg-blue-600 transition-all duration-500">
                                    <div
                                        class="w-12 h-12 bg-white text-blue-600 rounded-2xl flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                        <i class="bi bi-patch-check-fill text-xl"></i>
                                    </div>
                                    <h4
                                        class="text-gray-900 font-bold text-lg leading-tight group-hover:text-white transition-colors">
                                        {{ $item }}
                                    </h4>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Suku Bunga Section --}}
                <div class="space-y-6">
                    <div class="flex items-center justify-between px-4">
                        <h2 class="text-3xl font-black text-gray-900 tracking-tighter">Suku Bunga Unggulan</h2>
                        <span
                            class="px-4 py-1 bg-amber-100 text-amber-700 rounded-full text-[10px] font-black uppercase tracking-widest">Update
                            2026</span>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach ($deposito['suku_bunga'] as $bulan => $bunga)
                            <div
                                class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm text-center hover:border-blue-600 hover:shadow-xl transition-all duration-300 group">
                                <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest mb-2">
                                    {{ $bulan }} Bulan</p>
                                <p
                                    class="text-4xl font-extrabold text-gray-900 group-hover:text-blue-600 transition-colors">
                                    {{ $bunga }}</p>
                                <p class="text-[10px] text-blue-600 font-bold mt-2 italic">per tahun</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Tabel Simulasi & Persyaratan --}}
                <div class="grid grid-cols-1 lg:grid-cols-1 gap-12">
                    {{-- Tabel Simulasi --}}
                    <div class="bg-white rounded-[3rem] border border-gray-100 shadow-sm overflow-hidden p-8 md:p-12">
                        <h2 class="text-2xl font-black text-gray-900 mb-8 tracking-tighter flex items-center gap-3">
                            <i class="bi bi-calculator text-blue-600"></i> Ilustrasi Perolehan Bunga
                        </h2>
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
                                            @foreach ([1, 3, 6, 12] as $tenor)
                                                <td
                                                    class="px-6 py-5 text-center text-blue-600 font-medium font-mono text-sm">
                                                    Rp {{ number_format($simulasi[$tenor], 0, ',', '.') }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Persyaratan --}}
                    <div x-data="{ open: false }"
                        class="bg-white rounded-[3rem] border border-gray-100 shadow-sm overflow-hidden group">
                        <button @click="open = !open"
                            class="w-full p-10 flex items-center justify-between text-left outline-none transition-all">
                            <div class="flex items-center gap-6">
                                <div
                                    class="w-14 h-14 bg-gray-50 text-gray-400 rounded-2xl flex items-center justify-center group-hover:bg-blue-50 group-hover:text-blue-600 transition-all">
                                    <i class="bi bi-file-earmark-check text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900 tracking-tighter">Persyaratan Deposito</h3>
                                    <p class="text-gray-400 text-sm">Lengkapi dokumen berikut untuk pembukaan bilyet</p>
                                </div>
                            </div>
                            <div :class="open ? 'rotate-180 bg-blue-600 text-white' : 'bg-gray-100 text-gray-400'"
                                class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-500">
                                <i class="bi bi-chevron-down"></i>
                            </div>
                        </button>

                        <div x-show="open" x-collapse x-cloak>
                            <div class="p-10 pt-0 space-y-8">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                                    <div class="space-y-4">
                                        <h5
                                            class="text-blue-600 font-black text-xs uppercase tracking-widest flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full bg-blue-600"></span> Perorangan
                                        </h5>
                                        <ul class="space-y-3">
                                            @foreach ($deposito['persyaratan']['perorangan'] as $syarat)
                                                <li class="flex items-start gap-3 text-sm text-gray-600 font-medium italic">
                                                    <i class="bi bi-check2 text-blue-500 font-bold"></i>
                                                    {{ $syarat }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="space-y-4">
                                        <h5
                                            class="text-cyan-600 font-black text-xs uppercase tracking-widest flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full bg-cyan-500"></span> Badan Usaha
                                        </h5>
                                        <ul class="space-y-3">
                                            @foreach ($deposito['persyaratan']['badan_usaha'] as $syarat)
                                                <li class="flex items-start gap-3 text-sm text-gray-600 font-medium italic">
                                                    <i class="bi bi-check2 text-cyan-500 font-bold"></i>
                                                    {{ $syarat }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div
                                    class="bg-amber-50/50 border border-amber-100 p-8 rounded-[2.5rem] flex flex-col md:flex-row gap-6">
                                    <div
                                        class="w-12 h-12 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <i class="bi bi-info-circle-fill text-xl"></i>
                                    </div>
                                    <ul
                                        class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2 text-amber-900/70 text-xs font-bold leading-relaxed">
                                        @foreach ($deposito['catatan'] as $note)
                                            <li>• {{ $note }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CTA Section --}}
                <div class="bg-[#0A1D37] rounded-[3.5rem] p-12 lg:p-20 text-center relative overflow-hidden">
                    <div
                        class="absolute top-0 left-0 w-64 h-64 bg-blue-600/20 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2">
                    </div>
                    <div class="relative z-10 max-w-2xl mx-auto">
                        <h2 class="text-3xl lg:text-5xl font-black text-white mb-6 tracking-tighter">Mulai Investasi Cerdas
                            <br>Hari Ini.</h2>
                        <p class="text-blue-100/60 mb-10 font-medium">Tim marketing kami siap membantu Anda menghitung
                            potensi keuntungan maksimal untuk masa depan Anda.</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="https://wa.me/..."
                                class="px-10 py-5 bg-blue-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-500 transition-all shadow-xl shadow-blue-600/20">Hubungi
                                WhatsApp</a>
                            <a href="/jaringan/kantor"
                                class="px-10 py-5 bg-white/10 text-white border border-white/20 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-white/20 transition-all backdrop-blur-md">Cari
                                Kantor Terdekat</a>
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

        .tracking-tighter {
            letter-spacing: -0.05em;
        }
    </style>
@endsection
