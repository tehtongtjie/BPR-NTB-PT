@extends('layouts.app')

@section('title', $lelang['judul'] . ' - BPR NTB')

@section('content')
    <main class="bg-[#F8FAFC] min-h-screen pt-32 lg:pt-40 pb-24 font-sans antialiased">

        {{-- 1. HERO HEADER (Ultra Premium Style) --}}
        <section class="relative mx-4 lg:mx-8 mb-16">
            <div
                class="relative rounded-[3.5rem] bg-[#00326B] overflow-hidden shadow-[0_32px_64px_-16px_rgba(0,50,107,0.3)]">
                {{-- Dynamic Background Shapes --}}
                <div
                    class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-[700px] h-[700px] bg-blue-500 rounded-full blur-[140px] opacity-30 animate-pulse">
                </div>
                <div
                    class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/4 w-96 h-96 bg-[#fbbf24] rounded-full blur-[100px] opacity-10">
                </div>
                <div
                    class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-10">
                </div>

                <div class="max-w-7xl mx-auto px-8 py-20 lg:py-28 relative z-10">
                    {{-- Breadcrumb Modern --}}
                    <nav class="flex mb-12 text-blue-200/50 text-[10px] font-black uppercase tracking-[0.4em]">
                        <ol class="inline-flex items-center space-x-3">
                            <li><a href="/" class="hover:text-white transition-all">Beranda</a></li>
                            <li><i class="bi bi-circle-fill text-[4px]"></i></li>
                            <li><a href="{{ route('lelang.index') }}"
                                    class="hover:text-white transition-all">E-Procurement</a></li>
                            <li><i class="bi bi-circle-fill text-[4px]"></i></li>
                            <li class="text-[#fbbf24]">{{ Str::limit($lelang['judul'], 30) }}</li>
                        </ol>
                    </nav>

                    <div class="max-w-5xl">
                        <div
                            class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-white/10 border border-white/10 mb-8 backdrop-blur-xl">
                            <span class="flex h-2.5 w-2.5 relative">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                            </span>
                            <span class="text-[11px] font-black text-white uppercase tracking-[0.2em]">Tender Status: <span
                                    class="text-emerald-400">{{ $lelang['status'] }}</span></span>
                        </div>
                        <h1
                            class="text-5xl md:text-7xl font-black text-white leading-[0.95] tracking-tighter mb-10 drop-shadow-2xl">
                            {{ $lelang['judul'] }}
                        </h1>
                        <div class="flex flex-wrap gap-6 text-blue-100/60 font-bold text-xs uppercase tracking-widest">
                            <span class="flex items-center gap-2"><i class="bi bi-tag-fill text-[#fbbf24]"></i>
                                {{ $lelang['kategori'] }}</span>
                            <span class="flex items-center gap-2"><i class="bi bi-clock-fill text-[#fbbf24]"></i> Batas:
                                {{ $lelang['deadline'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- 2. CONTENT AREA --}}
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-16">

                {{-- MAIN CONTENT (KIRI) --}}
                <div class="lg:w-2/3 space-y-12">
                    {{-- Visual Card --}}
                    <div
                        class="group relative bg-white rounded-[4rem] p-4 shadow-2xl shadow-blue-900/5 border border-white overflow-hidden transition-all duration-700 hover:shadow-blue-900/10">
                        <div class="aspect-[21/9] relative overflow-hidden rounded-[3rem]">
                            <img src="{{ asset('images/' . $lelang['gambar']) }}"
                                class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                                alt="Lelang Banner">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#00326B]/60 to-transparent"></div>
                        </div>

                        <div class="p-10 lg:p-16">
                            <div class="flex items-center gap-4 mb-10">
                                <span class="h-[2px] w-16 bg-[#fbbf24]"></span>
                                <span class="text-xs font-black text-[#00326B] uppercase tracking-[0.5em]">Spesifikasi
                                    Proyek</span>
                            </div>
                            <div
                                class="prose prose-slate prose-xl max-w-none text-slate-500 leading-relaxed font-medium italic mb-16">
                                "{!! $lelang['deskripsi'] !!}"
                            </div>

                            {{-- Persyaratan Grid --}}
                            <div class="space-y-8">
                                <h3 class="text-2xl font-black text-[#00326B] tracking-tight flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                                        <i class="bi bi-shield-lock-fill"></i>
                                    </div>
                                    Kualifikasi Peserta
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach (['Memiliki SIUP/NIB Aktif', 'Memiliki Pengalaman Serupa', 'Tidak Sedang Dalam Pengawasan Pengadilan', 'Memenuhi Kualifikasi Teknis Sesuai RKS'] as $syarat)
                                        <div
                                            class="flex items-center gap-4 p-6 bg-slate-50 rounded-[2rem] border border-transparent hover:border-blue-100 hover:bg-white transition-all duration-300 group/item">
                                            <div
                                                class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-emerald-500 shadow-sm group-hover/item:bg-emerald-500 group-hover/item:text-white transition-all">
                                                <i class="bi bi-check-lg"></i>
                                            </div>
                                            <span class="text-sm font-bold text-slate-700">{{ $syarat }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SIDEBAR (KANAN) --}}
                <aside class="lg:w-1/3 space-y-8">
                    <div class="sticky top-32">
                        {{-- Premium Action Card --}}
                        <div
                            class="bg-white rounded-[3.5rem] p-10 shadow-2xl shadow-blue-900/10 border border-slate-100 relative overflow-hidden group">
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-10">
                                    <div
                                        class="w-14 h-14 rounded-2xl bg-blue-600 text-white flex items-center justify-center shadow-xl shadow-blue-600/30">
                                        <i class="bi bi-file-earmark-arrow-down text-2xl"></i>
                                    </div>
                                    <span
                                        class="text-[10px] font-black text-red-500 bg-red-50 px-4 py-1.5 rounded-full uppercase tracking-widest border border-red-100">Hot
                                        Tender</span>
                                </div>

                                <h4 class="text-2xl font-black text-[#00326B] mb-4 leading-tight">E-Procurement <br>Download
                                    Center</h4>
                                <p class="text-slate-400 text-sm mb-10 font-medium leading-relaxed italic">"Pastikan Anda
                                    mengunduh Rencana Kerja dan Syarat-syarat (RKS) terbaru sebelum melakukan penawaran."
                                </p>

                                <div class="space-y-4">
                                    <a href="#"
                                        class="group/btn flex items-center justify-between w-full bg-[#00326B] text-white p-6 rounded-[2rem] font-black text-[11px] uppercase tracking-widest hover:bg-[#fbbf24] hover:text-[#00326B] transition-all duration-500 shadow-xl active:scale-95">
                                        <span>Unduh Berkas RKS</span>
                                        <div
                                            class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center group-hover/btn:bg-black/5">
                                            <i class="bi bi-arrow-down-short text-xl"></i>
                                        </div>
                                    </a>
                                    <a href="https://wa.me/your-procurement-wa"
                                        class="flex items-center justify-center gap-3 w-full bg-slate-50 text-[#00326B] p-6 rounded-[2rem] font-black text-[11px] uppercase tracking-widest hover:bg-slate-100 transition-all border border-slate-100">
                                        <i class="bi bi-chat-left-dots-fill"></i> Tanya Panitia
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Alert Card --}}
                        <div
                            class="mt-8 relative rounded-[3rem] p-8 bg-gradient-to-br from-amber-50 to-orange-50 border border-amber-100 overflow-hidden">
                            <div class="absolute -right-4 -bottom-4 text-amber-200/40 text-7xl font-black">
                                <i class="bi bi-exclamation-octagon"></i>
                            </div>
                            <h5
                                class="font-black text-amber-800 text-[10px] uppercase tracking-[0.3em] mb-4 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                Security Alert
                            </h5>
                            <p class="text-xs text-amber-900/60 leading-relaxed font-bold italic relative z-10">
                                Seluruh proses pengadaan di PT. BPR NTB sepenuhnya gratis. Laporkan jika ada oknum yang
                                meminta imbalan.
                            </p>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>

    <style>
        /* Smooth Entrance */
        main {
            animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .tracking-tighter {
            letter-spacing: -0.05em;
        }
    </style>
@endsection
