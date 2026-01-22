@extends('layouts.app')

@section('content')
    {{-- Utility spacing dari CSS global --}}
    <main class="main-content-spacing bg-white min-h-screen pb-20">

        {{-- Hero Header Section --}}
        <div class="relative bg-blue-900 pt-16 pb-32 overflow-hidden">
            {{-- Elemen Dekoratif Latar Belakang --}}
            <div
                class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-96 h-96 bg-blue-600 rounded-full blur-[120px] opacity-50">
            </div>
            <div
                class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/4 w-72 h-72 bg-cyan-500 rounded-full blur-[100px] opacity-30">
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                {{-- Breadcrumb Putih --}}
                <nav class="flex mb-8 text-blue-200 text-xs md:text-sm font-medium">
                    <ol class="inline-flex items-center space-x-3">
                        <li><a href="/" class="hover:text-white transition-colors">Beranda</a></li>
                        <li><i class="bi bi-chevron-right text-[10px]"></i></li>
                        <li><span class="hover:text-white cursor-pointer">Produk</span></li>
                        <li><i class="bi bi-chevron-right text-[10px]"></i></li>
                        <li class="text-white font-bold">{{ $tabungan['nama'] }}</li>
                    </ol>
                </nav>

                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div class="max-w-2xl">
                        <span
                            class="inline-block px-4 py-1.5 rounded-full bg-blue-600/30 border border-blue-400/30 text-blue-100 text-[10px] font-black uppercase tracking-[0.2em] mb-4">
                            Personal Banking
                        </span>
                        <h1 class="text-4xl md:text-6xl font-black text-white leading-tight mb-4 tracking-tighter">
                            {{ $tabungan['nama'] }}
                        </h1>
                        <p class="text-lg md:text-xl text-blue-100/80 font-medium leading-relaxed">
                            {{ $tabungan['subtitle'] }}
                        </p>
                    </div>

                    {{-- Statistik Ringkas (Badge) --}}
                    <div class="hidden lg:flex gap-4">
                        <div
                            class="bg-white/10 backdrop-blur-md border border-white/10 p-4 rounded-2xl text-center min-w-[120px]">
                            <p class="text-[10px] text-blue-200 uppercase font-bold mb-1">Setoran Awal</p>
                            <p class="text-lg text-white font-black">Ringan</p>
                        </div>
                        <div
                            class="bg-white/10 backdrop-blur-md border border-white/10 p-4 rounded-2xl text-center min-w-[120px]">
                            <p class="text-[10px] text-blue-200 uppercase font-bold mb-1">Admin</p>
                            <p class="text-lg text-white font-black">Gratis*</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20">
            <div class="flex flex-col lg:flex-row gap-8">

                {{-- MAIN CONTENT --}}
                <div class="lg:w-2/3 space-y-8">
                    {{-- Card Visual Utama --}}
                    <div
                        class="bg-white rounded-[2.5rem] shadow-2xl shadow-blue-900/5 overflow-hidden border border-gray-100">
                        <div class="aspect-video relative">
                            <img src="{{ asset($tabungan['gambar']) }}" alt="{{ $tabungan['nama'] }}"
                                class="w-full h-full object-cover">
                        </div>

                        <div class="p-8 md:p-12">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="h-px bg-gray-100 flex-grow"></div>
                                <span class="text-xs font-black text-blue-600 uppercase tracking-widest">Deskripsi
                                    Produk</span>
                                <div class="h-px bg-gray-100 flex-grow"></div>
                            </div>

                            <p class="text-gray-600 text-lg leading-relaxed italic mb-12">
                                "{{ $tabungan['deskripsi'] }}"
                            </p>

                            {{-- Grid Keuntungan dengan Ikon Custom --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach ($tabungan['keuntungan'] as $index => $item)
                                    <div
                                        class="group p-6 bg-gray-50 rounded-3xl border border-transparent hover:border-blue-200 hover:bg-white hover:shadow-xl transition-all duration-500">
                                        <div
                                            class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-blue-600 transition-all">
                                            <i class="bi bi-shield-check text-blue-600 group-hover:text-white text-xl"></i>
                                        </div>
                                        <h4 class="text-gray-900 font-black text-base leading-snug">{{ $item }}</h4>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Accordion Syarat & Ketentuan --}}
                    <div x-data="{ open: true }"
                        class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden transition-all">
                        <button @click="open = !open"
                            class="w-full p-8 flex items-center justify-between hover:bg-gray-50 transition-colors">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                                    <i class="bi bi-file-earmark-text-fill text-xl"></i>
                                </div>
                                <h3 class="text-xl font-black text-gray-900">Syarat & Ketentuan</h3>
                            </div>
                            <i class="bi bi-chevron-down text-gray-400 transition-transform duration-500"
                                :class="open ? 'rotate-180' : ''"></i>
                        </button>

                        <div x-show="open" x-collapse>
                            <div class="p-8 pt-0 grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach (['WNI', 'KTP Aktif', 'Isi Formulir', 'Setoran Awal'] as $s)
                                    <div
                                        class="flex items-center gap-3 p-4 bg-blue-50/50 rounded-2xl border border-blue-100/50">
                                        <i class="bi bi-info-circle-fill text-blue-400 text-sm"></i>
                                        <span class="text-gray-700 font-bold text-sm">{{ $s }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SIDEBAR --}}
                <aside class="lg:w-1/3 space-y-6">
                    <div class="sticky top-32">
                        @include('components.sidebar-produk')

                        {{-- Card CTA Floating --}}
                        <div
                            class="mt-8 bg-gradient-to-br from-blue-600 to-blue-800 rounded-[2.5rem] p-1 shadow-xl shadow-blue-900/20">
                            <div
                                class="bg-white/10 backdrop-blur-xl rounded-[2.4rem] p-8 text-white border border-white/20">
                                <h4 class="text-2xl font-black mb-2">Mulai Menabung?</h4>
                                <p class="text-blue-100/70 text-sm mb-8 leading-relaxed">Proses pembukaan rekening cepat dan
                                    dibantu oleh staf ahli kami.</p>

                                <div class="space-y-3">
                                    <a href="#"
                                        class="flex items-center justify-center gap-3 w-full bg-white text-blue-900 py-4 rounded-2xl font-black hover:bg-blue-50 transition-all active:scale-95 shadow-lg">
                                        <i class="bi bi-chat-dots-fill"></i> Konsultasi WA
                                    </a>
                                    <button onclick="window.print()"
                                        class="flex items-center justify-center gap-3 w-full bg-blue-500/20 text-white border border-white/20 py-4 rounded-2xl font-bold hover:bg-white/10 transition-all">
                                        <i class="bi bi-printer"></i> Cetak Brosur
                                    </button>
                                </div>
                            </div>
                        </div>
                </aside>

            </div>
        </div>
    </main>

    {{-- Script tambahan untuk animasi Alpine.js --}}
    <style>
        .prose blockquote {
            border-left-color: #2563eb;
            font-style: italic;
        }

        @media print {
            .main-content-spacing {
                padding-top: 0 !important;
            }

            aside,
            nav,
            .animate-pulse {
                display: none !important;
            }

            .bg-blue-900 {
                background: white !important;
                color: black !important;
            }
        }
    </style>
@endsection
