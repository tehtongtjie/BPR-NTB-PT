@extends('layouts.app')

@section('title', $lelang['judul'] . ' - BPR NTB')

@section('content')
    <main class="bg-[#F8FAFC] min-h-screen pt-32 lg:pt-40 pb-24 font-sans antialiased">

        {{-- 1. HERO HEADER (Identik dengan gaya Detail Produk/Berita) --}}
        <section class="relative mx-4 lg:mx-8 mb-12">
            <div class="relative rounded-[3rem] bg-[#00326B] overflow-hidden shadow-2xl shadow-blue-900/30">
                <div
                    class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-[600px] h-[600px] bg-blue-500 rounded-full blur-[140px] opacity-20 animate-pulse">
                </div>
                <div
                    class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/4 w-96 h-96 bg-[#fbbf24] rounded-full blur-[100px] opacity-10">
                </div>

                <div class="max-w-7xl mx-auto px-8 py-16 lg:py-24 relative z-10">
                    {{-- Breadcrumb --}}
                    <nav class="flex mb-10 text-blue-200/50 text-[10px] font-black uppercase tracking-[0.3em]">
                        <ol class="inline-flex items-center space-x-3">
                            <li><a href="/" class="hover:text-white transition-all">Beranda</a></li>
                            <li><i class="bi bi-circle-fill text-[4px]"></i></li>
                            <li><a href="{{ route('lelang.index') }}" class="hover:text-white transition-all">Lelang</a>
                            </li>
                            <li><i class="bi bi-circle-fill text-[4px]"></i></li>
                            <li class="text-[#fbbf24] line-clamp-1">{{ $lelang['judul'] }}</li>
                        </ol>
                    </nav>

                    <div class="max-w-4xl">
                        <div
                            class="inline-flex items-center gap-3 px-4 py-1.5 rounded-full bg-white/10 border border-white/10 mb-8 backdrop-blur-md">
                            <span class="flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            <span class="text-[10px] font-black text-white uppercase tracking-widest">Tender Status:
                                {{ $lelang['status'] }}</span>
                        </div>
                        <h1 class="text-4xl md:text-6xl font-black text-white leading-[1.1] tracking-tighter mb-8">
                            {{ $lelang['judul'] }}
                        </h1>
                    </div>
                </div>
            </div>
        </section>

        {{-- 2. CONTENT AREA --}}
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12">

                {{-- MAIN CONTENT (KIRI) --}}
                <div class="lg:w-2/3 space-y-10">
                    {{-- Visual & Info Utama --}}
                    <div
                        class="bg-white rounded-[3rem] shadow-xl shadow-blue-900/5 border border-slate-100 overflow-hidden">
                        <div class="aspect-video relative overflow-hidden">
                            <img src="{{ asset('images/' . $lelang['gambar']) }}" class="w-full h-full object-cover"
                                alt="Lelang Banner">
                        </div>
                        <div class="p-10 lg:p-14">
                            <div class="flex items-center gap-4 mb-10">
                                <span class="h-[1px] w-12 bg-[#fbbf24]"></span>
                                <span class="text-[11px] font-black text-[#00326B] uppercase tracking-[0.4em]">Deskripsi
                                    Pekerjaan</span>
                            </div>
                            <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed italic text-lg">
                                "{!! $lelang['deskripsi'] !!}"
                            </div>

                            {{-- Info Detail Box --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-12">
                                <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Kategori
                                        Pengadaan</p>
                                    <p class="text-[#00326B] font-bold">{{ $lelang['kategori'] }}</p>
                                </div>
                                <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Batas
                                        Akhir Pendaftaran</p>
                                    <p class="text-red-600 font-black">{{ $lelang['deadline'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Persyaratan Kualifikasi --}}
                    <div class="bg-white rounded-[3rem] shadow-xl shadow-blue-900/5 border border-slate-100 p-10 lg:p-14">
                        <h3 class="text-2xl font-black text-[#00326B] mb-8 flex items-center gap-4">
                            <i class="bi bi-check2-all text-[#fbbf24]"></i> Persyaratan Kualifikasi
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach (['Memiliki SIUP/NIB Aktif', 'Memiliki Pengalaman Serupa', 'Tidak Sedang Dalam Pengawasan Pengadilan', 'Memenuhi Kualifikasi Teknis Sesuai RKS'] as $syarat)
                                <div class="flex items-start gap-4 p-5 bg-slate-50 rounded-2xl border border-slate-100">
                                    <i class="bi bi-patch-check-fill text-blue-600 mt-1"></i>
                                    <span class="text-sm font-bold text-slate-700 leading-snug">{{ $syarat }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- SIDEBAR (KANAN) --}}
                <aside class="lg:w-1/3 space-y-8">
                    <div class="sticky top-32">
                        {{-- Card Download --}}
                        <div
                            class="bg-[#00326B] rounded-[3rem] p-10 text-white shadow-2xl shadow-blue-900/20 relative overflow-hidden group">
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-[#fbbf24] rounded-full blur-[80px] opacity-10 group-hover:opacity-20 transition-all">
                            </div>

                            <h4 class="text-2xl font-black mb-6 leading-tight">Dokumen Pemilihan</h4>
                            <p class="text-blue-100/60 text-sm mb-10 italic">"Silakan unduh dokumen teknis dan syarat
                                administrasi untuk mengikuti proses tender ini."</p>

                            <div class="space-y-4">
                                <a href="#"
                                    class="flex items-center justify-between gap-4 w-full bg-[#fbbf24] text-[#00326B] px-8 py-5 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-white transition-all active:scale-95 shadow-lg">
                                    <span>Unduh RKS & Dokumen</span>
                                    <i class="bi bi-file-earmark-pdf-fill text-xl"></i>
                                </a>
                                <a href="https://wa.me/your-procurement-wa"
                                    class="flex items-center justify-center gap-3 w-full bg-white/5 border border-white/20 text-white py-5 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-white/10 transition-all">
                                    <i class="bi bi-headset"></i> Hubungi Panitia Lelang
                                </a>
                            </div>
                        </div>

                        {{-- Card Tips --}}
                        <div class="mt-8 p-8 bg-amber-50 rounded-[2.5rem] border border-amber-100">
                            <div class="flex items-center gap-3 mb-4 text-amber-800">
                                <i class="bi bi-exclamation-triangle-fill text-xl"></i>
                                <h5 class="font-black text-sm uppercase tracking-widest">Peringatan</h5>
                            </div>
                            <p class="text-xs text-amber-700 leading-relaxed font-medium">
                                Seluruh proses pengadaan di PT. BPR NTB tidak dipungut biaya apapun. Hati-hati terhadap
                                segala bentuk penipuan yang mengatasnamakan panitia lelang.
                            </p>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </main>
@endsection
