@extends('user.layouts.app')

@section('title', $promo->title . ' - BPR NTB')

@section('content')
    <main class="bg-gray-50/50 min-h-screen pt-20 lg:pt-24 pb-24 font-sans antialiased">

        {{-- 1. HERO SECTION --}}
        <div class="relative bg-[#0A1D37] pt-16 pb-40 overflow-hidden">
            <div
                class="absolute top-0 right-0 -translate-y-1/4 translate-x-1/4 w-[500px] h-[500px] bg-blue-600/20 rounded-full blur-[120px]">
            </div>
            <div
                class="absolute bottom-0 left-0 translate-y-1/4 -translate-x-1/4 w-[400px] h-[400px] bg-[#fbbf24]/10 rounded-full blur-[100px]">
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                {{-- BREADCRUMB --}}
                <nav class="flex mb-10 text-blue-300/60 text-xs tracking-widest uppercase font-bold">
                    <ol class="inline-flex items-center space-x-3">
                        <li>
                            <a href="{{ url('/') }}" class="hover:text-white transition-colors text-blue-200">
                                Beranda
                            </a>
                        </li>
                        <li class="text-blue-300/30">/</li>
                        <li>
                            <span class="hover:text-white cursor-pointer text-blue-200">
                                Produk
                            </span>
                        </li>
                        <li class="text-blue-300/30">/</li>
                        <li>
                            {{-- slug dipakai di URL --}}
                            <a href="{{ route('tabungan.show', $promo->slug) }}"
                               class="text-white hover:text-blue-200 transition">
                                {{ $promo->title }}
                            </a>
                        </li>
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
                            Personal Banking & Savings
                        </div>

                        <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-[1.1] mb-6 tracking-tighter">
                            {{ $promo->title }}
                        </h1>

                        <p class="text-xl md:text-2xl text-blue-100/60 font-medium leading-relaxed max-w-xl italic">
                            "{{ $promo->subtitle }}"
                        </p>
                    </div>

                    {{-- Quick Info Cards --}}
                    <div class="hidden lg:flex gap-4">
                        <div
                            class="bg-white/5 backdrop-blur-xl border border-white/10 p-6 rounded-[2rem] text-center min-w-[150px] transition-all hover:-translate-y-2 hover:bg-white/10">
                            <p class="text-[10px] text-blue-400 uppercase font-black tracking-widest mb-2">Setoran</p>
                            <p class="text-3xl text-white font-bold">Ringan</p>
                        </div>
                        <div
                            class="bg-blue-600 p-6 rounded-[2rem] shadow-xl shadow-blue-600/20 text-center min-w-[150px] transition-all hover:-translate-y-2">
                            <p class="text-[10px] text-blue-100 uppercase font-black tracking-widest mb-2">Admin</p>
                            <p class="text-3xl text-white font-bold">Gratis*</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. CONTENT AREA --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20">
            <div class="flex flex-col lg:flex-row gap-12">

                {{-- SIDEBAR --}}
                <aside class="lg:w-1/3 order-2 lg:order-1">
                    <div class="sticky top-32 space-y-8">
                        <div class="bg-white rounded-[2.5rem] p-6 shadow-sm border border-gray-100">
                            @include('user.components.sidebar-produk')
                        </div>
                    </div>
                </aside>

                {{-- MAIN CONTENT --}}
                <div class="lg:w-2/3 order-1 lg:order-2 space-y-12">
                    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">

                        {{-- IMAGE --}}
                        <div class="aspect-[21/9] relative group overflow-hidden">
                            <img src="{{ public_image_url('storage/' . $promo->image) }}"
                                 alt="{{ $promo->title }}"
                                 class="w- h-130 object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                        </div>

                        <div class="p-8 md:p-14">

                            {{-- DESKRIPSI --}}
                            <div class="mb-14 text-center">
                                <h3 class="text-blue-600 text-sm font-black uppercase tracking-[0.3em] mb-6">
                                    Informasi Produk
                                </h3>
                                <p class="text-gray-500 text-2xl leading-relaxed font-medium italic px-4">
                                    "{{ $promo->description }}"
                                </p>
                            </div>

                            {{-- KEUNTUNGAN --}}
                            <div class="space-y-8">
                                <h4 class="text-2xl font-extrabold text-gray-900 tracking-tight flex items-center gap-3">
                                    <span class="w-1.5 h-8 bg-blue-600 rounded-full"></span>
                                    Keuntungan & Fasilitas
                                </h4>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @foreach ($promo->benefits as $benefit)
                                        <div
                                            class="flex gap-5 p-5 bg-gray-50 rounded-[2rem] hover:bg-blue-50 transition-all duration-300 border border-transparent hover:border-blue-100 group">
                                            <div
                                                class="flex-shrink-0 w-12 h-12 bg-white text-blue-600 rounded-2xl flex items-center justify-center shadow-sm group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                                                <i class="bi bi-shield-check text-xl"></i>
                                            </div>
                                            <span class="text-gray-700 font-bold text-base self-center">
                                                {{ $benefit->title }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- SYARAT --}}
                            <div x-data="{ open: true }"
                                 class="mt-16 bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
                                <button @click="open = !open"
                                        class="w-full p-8 flex items-center justify-between hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 bg-[#fbbf24]/10 text-[#fbbf24] rounded-2xl flex items-center justify-center">
                                            <i class="bi bi-file-earmark-text-fill text-xl"></i>
                                        </div>
                                        <h3 class="text-xl font-black text-gray-900 tracking-tight">
                                            Syarat & Ketentuan
                                        </h3>
                                    </div>
                                    <i class="bi bi-chevron-down text-gray-400 transition-transform duration-500"
                                       :class="open ? 'rotate-180' : ''"></i>
                                </button>

                                <div x-show="open" x-collapse>
                                    <div class="p-8 pt-0 grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @foreach ($promo->requirements as $req)
                                            <div
                                                class="flex items-center gap-3 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                                <i class="bi bi-info-circle-fill text-[#fbbf24] text-sm"></i>
                                                <span class="text-gray-700 font-bold text-sm">
                                                    {{ $req->title }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- FOOTER --}}
                    <div class="bg-gray-100/50 p-8 rounded-[2.5rem] border border-dashed border-gray-300">
                        <p class="text-xs text-gray-400 font-medium leading-relaxed uppercase tracking-widest text-center">
                            BPR NTB Berizin dan Diawasi oleh OJK serta merupakan peserta penjaminan LPS.
                        </p>
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
            .animate-ping {
                display: none !important;
            }

            main {
                padding-top: 0 !important;
            }
        }
    </style>
@endsection
