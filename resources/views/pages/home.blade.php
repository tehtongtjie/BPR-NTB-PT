@extends('layouts.app')

@section('title', 'Beranda - BPR NTB')

@section('content')

    {{-- 1. HERO SECTION --}}
    <section x-data="{
        activeSlide: 0,
        slides: [0, 1],
        timer: null,
        startAutoPlay() {
            this.timer = setInterval(() => {
                this.next();
            }, 5000);
        },
        stopAutoPlay() {
            if (this.timer) clearInterval(this.timer);
        },
        next() {
            this.activeSlide = (this.activeSlide + 1) % this.slides.length;
        },
        prev() {
            this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length;
        }
    }" x-init="startAutoPlay()" @mouseenter="stopAutoPlay()" @mouseleave="startAutoPlay()"
        class="relative w-full overflow-hidden pt-[120px] bg-white">

        {{-- Aspect Ratio Container --}}
        {{-- Menggunakan grid agar semua slide bertumpuk di titik yang sama tanpa merusak layout flow --}}
        <div class="relative w-full grid grid-cols-1">

            {{-- SLIDE 1 --}}
            <div x-show="activeSlide === 0" x-transition:enter="transition opacity duration-1000 ease-in-out"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition opacity duration-1000 ease-in-out" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="col-start-1 row-start-1 w-full">
                <img src="{{ asset('images/SimbadaHero.png') }}" class="w-full h-auto block" alt="Simbada Hero"
                    loading="eager">
            </div>

            {{-- SLIDE 2 --}}
            <div x-show="activeSlide === 1" x-transition:enter="transition opacity duration-1000 ease-in-out"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition opacity duration-1000 ease-in-out" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="col-start-1 row-start-1 w-full" x-cloak>
                <img src="{{ asset('images/tabungan-hero.png') }}" class="w-full h-auto block" alt="Tabungan Hero">
            </div>

            {{-- INDICATORS --}}
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 md:bottom-10 left-1/2 space-x-3">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="activeSlide = index" class="h-1 md:h-1.5 transition-all duration-300 rounded-full"
                        :class="activeSlide === index ? 'w-8 bg-[#fbbf24]' : 'w-2 bg-white/50 hover:bg-white'">
                    </button>
                </template>
            </div>

            {{-- NAVIGATION BUTTONS --}}
            <button @click="prev()"
                class="absolute top-1/2 -translate-y-1/2 left-0 z-30 flex items-center justify-center px-4 group focus:outline-none">
                <span
                    class="inline-flex items-center justify-center w-8 h-8 md:w-12 md:h-12 rounded-full bg-black/10 group-hover:bg-[#00326B] transition-all">
                    <i class="bi bi-chevron-left text-white text-lg md:text-xl"></i>
                </span>
            </button>

            <button @click="next()"
                class="absolute top-1/2 -translate-y-1/2 right-0 z-30 flex items-center justify-center px-4 group focus:outline-none">
                <span
                    class="inline-flex items-center justify-center w-8 h-8 md:w-12 md:h-12 rounded-full bg-black/10 group-hover:bg-[#00326B] transition-all">
                    <i class="bi bi-chevron-right text-white text-lg md:text-xl"></i>
                </span>
            </button>
        </div>
    </section>

    {{-- ================= PRODUK UNGGULAN (PREMIUM BENTO STYLE) ================= --}}
    <section class="relative py-12 bg-[#F8FAFC] overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div class="space-y-3">
                    <div class="inline-flex items-center gap-3">
                        <span class="h-[1px] w-12 bg-blue-600"></span>
                        <span class="text-[10px] font-black uppercase tracking-[0.4em] text-[#00326B]">Smart Financial
                            Solutions</span>
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-black text-[#00326B]">Produk <span
                            class="text-blue-600 italic font-light">Unggulan</span></h2>
                </div>
                <div class="hidden md:block">
                    <p class="text-slate-500 max-w-xs text-right italic font-medium">Pilih solusi perbankan yang dirancang
                        khusus untuk mewujudkan rencana masa depan Anda.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- FEATURED PRODUCT: SIMBADA (Besar di Kiri) --}}
                <div class="lg:col-span-7 group relative">
                    <div
                        class="relative z-10 h-full min-h-[500px] overflow-hidden rounded-[3rem] shadow-2xl transition-all duration-700 border border-white">
                        <img src="{{ asset('images/simbada-card.png') }}"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                            alt="SIMBADA">

                        {{-- Deep Blue Gradient Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-[#00326B] via-[#00326B]/20 to-transparent"></div>

                        <div class="absolute bottom-0 left-0 p-10 lg:p-12 text-white z-10">
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="px-4 py-1.5 rounded-full bg-[#fbbf24] text-[#00326B] text-[10px] font-black uppercase tracking-widest shadow-xl">Most
                                    Popular</span>
                                <i class="bi bi-trophy-fill text-[#fbbf24]"></i>
                            </div>
                            <h3 class="text-3xl lg:text-4xl font-black leading-tight mb-4">SIMBADA</h3>
                            <p class="text-white/80 text-sm lg:text-base font-medium italic max-w-md mb-8 leading-relaxed">
                                "Simpanan Berhadiah Anda dengan peluang memenangkan undian menarik dan beragam hadiah
                                spektakuler setiap periode."
                            </p>
                            <a href="{{ route('tabungan.show', 'simbada') }}"
                                class="group/btn inline-flex items-center gap-4 text-xs font-black uppercase tracking-widest">
                                <span>Buka Tabungan</span>
                                <div
                                    class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-md flex items-center justify-center group-hover/btn:bg-[#fbbf24] group-hover/btn:text-[#00326B] transition-all">
                                    <i class="bi bi-arrow-up-right"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- OTHER PRODUCTS LIST (Di Kanan) --}}
                <div class="lg:col-span-5 flex flex-col gap-6">

                    {{-- TabunganKU --}}
                    <div
                        class="group relative bg-white rounded-[2.5rem] p-6 border border-slate-100 shadow-sm transition-all duration-500 hover:shadow-xl hover:-translate-y-1">
                        <div class="flex items-center gap-6">
                            <div
                                class="w-28 h-28 shrink-0 rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 shadow-inner">
                                <img src="{{ asset('images/tabunganku.png') }}"
                                    class="w-full h-full object-contain p-2 group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="space-y-2">
                                <span class="text-[9px] font-black uppercase tracking-[0.2em] text-emerald-600">Pilihan
                                    Hemat</span>
                                <h4
                                    class="text-xl font-black text-[#00326B] group-hover:text-blue-600 transition-colors leading-tight">
                                    TabunganKU</h4>
                                <p class="text-slate-500 text-xs leading-relaxed italic line-clamp-2">Tanpa biaya
                                    administrasi bulanan, setoran awal sangat ringan.</p>
                            </div>
                        </div>
                        <a href="{{ route('tabungan.show', 'tabunganku') }}" class="absolute inset-0"></a>
                    </div>

                    {{-- Tabungan Sukses --}}
                    <div
                        class="group relative bg-white rounded-[2.5rem] p-6 border border-slate-100 shadow-sm transition-all duration-500 hover:shadow-xl hover:-translate-y-1">
                        <div class="flex items-center gap-6">
                            <div
                                class="w-28 h-28 shrink-0 rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 shadow-inner">
                                <img src="{{ asset('images/tabungan-sukses.png') }}"
                                    class="w-full h-full object-contain p-2 group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="space-y-2">
                                <span
                                    class="text-[9px] font-black uppercase tracking-[0.2em] text-blue-500">Investasi</span>
                                <h4
                                    class="text-xl font-black text-[#00326B] group-hover:text-blue-600 transition-colors leading-tight">
                                    Tabungan Sukses</h4>
                                <p class="text-slate-500 text-xs leading-relaxed italic line-clamp-2">Investasi aman dengan
                                    suku bunga kompetitif untuk rencana Anda.</p>
                            </div>
                        </div>
                        <a href="{{ route('tabungan.show', 'tabungan-sukses') }}" class="absolute inset-0"></a>
                    </div>

                    {{-- CTA More Products --}}
                    <div
                        class="group relative bg-[#00326B] rounded-[2.5rem] p-6 transition-all duration-500 hover:shadow-2xl hover:shadow-blue-900/30 hover:-translate-y-1">
                        <div class="flex items-center gap-6">
                            <div
                                class="w-28 h-28 shrink-0 rounded-2xl bg-white/10 flex items-center justify-center text-[#fbbf24]">
                                <i class="bi bi-grid-fill text-3xl"></i>
                            </div>
                            <div class="space-y-1">
                                <h4 class="text-xl font-black text-white">Produk Lainnya</h4>
                                <p class="text-white/60 text-xs italic">Lihat beragam solusi finansial lengkap kami.</p>
                            </div>
                        </div>
                        <a href="#" class="absolute inset-0"></a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- ================= SUKU BUNGA SECTION (PREMIUM BENTO STYLE) ================= --}}
    <section class="relative py-12 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                <div class="space-y-3">
                    <div class="inline-flex items-center gap-3">
                        <span class="h-[1px] w-12 bg-blue-600"></span>
                        <span class="text-[10px] font-black uppercase tracking-[0.4em] text-[#00326B]">Interest Rates
                            Update</span>
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-black text-[#00326B]">Informasi <span
                            class="text-blue-600 italic font-light">Suku Bunga</span></h2>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">

                {{-- LEFT PANEL: LPS RATE (FEATURED) --}}
                <div class="lg:col-span-5 group relative">
                    <div
                        class="relative z-10 h-full min-h-[400px] p-10 flex flex-col justify-between overflow-hidden rounded-[3rem] bg-gradient-to-br from-blue-700 via-blue-800 to-[#00326B] shadow-2xl transition-all duration-500 hover:shadow-blue-900/20">

                        {{-- Decorative Light Effect --}}
                        <div
                            class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl transition-transform duration-1000 group-hover:scale-150">
                        </div>

                        <div class="relative z-20">
                            <div
                                class="inline-flex items-center space-x-2 bg-white/10 px-4 py-1.5 rounded-full border border-white/10 mb-8">
                                <span class="relative flex h-2 w-2">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                </span>
                                <span class="text-[10px] font-black tracking-widest uppercase text-white">Update Jan
                                    2026</span>
                            </div>

                            <p class="text-blue-100 text-[11px] font-black uppercase tracking-widest mb-2 opacity-80">
                                Tingkat Bunga Penjaminan LPS</p>
                            <h2 class="text-7xl lg:text-8xl font-black text-white tracking-tighter mb-6">6.00<span
                                    class="text-3xl text-blue-300">%</span></h2>

                            <div
                                class="inline-flex items-center gap-3 px-5 py-3 bg-white/5 rounded-2xl backdrop-blur-md border border-white/10 transition-all group-hover:bg-white/10">
                                <i class="bi bi-shield-check text-[#fbbf24] text-xl"></i>
                                <p class="text-xs text-blue-50 font-medium leading-tight">
                                    Dijamin LPS hingga <span
                                        class="font-black text-white underline decoration-[#fbbf24] decoration-2 underline-offset-4">Rp
                                        2 Miliar</span>
                                </p>
                            </div>
                        </div>

                        <div class="mt-8">
                            <a href="https://apps.lps.go.id/BankPesertaLPSRate" target="_blank"
                                class="flex items-center justify-center gap-3 bg-white text-[#00326B] py-4 rounded-2xl font-black text-xs uppercase tracking-widest transition-all hover:bg-[#fbbf24] hover:shadow-xl active:scale-95">
                                <span>Verifikasi LPS Rate</span>
                                <i class="bi bi-box-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- RIGHT PANEL: RINCIAN TABEL (BENTO CARDS) --}}
                <div class="lg:col-span-7 flex flex-col gap-6" x-data="{ selected: 1 }">

                    {{-- Card 1: Tabungan --}}
                    <div
                        class="bg-slate-50 rounded-[2.5rem] p-8 border border-slate-100 transition-all duration-500 hover:bg-white hover:shadow-xl">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center font-black">
                                    01</div>
                                <h3 class="text-xl lg:text-2xl font-black text-[#00326B]">Suku Bunga Tabungan</h3>
                            </div>
                            <i class="bi bi-piggy-bank text-3xl text-blue-200"></i>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div
                                class="bg-white p-5 rounded-3xl border border-slate-100 flex justify-between items-center group/item hover:border-blue-200 transition-colors">
                                <span class="text-sm font-bold text-slate-500 uppercase tracking-wider">Simbada</span>
                                <span
                                    class="text-xl font-black text-blue-600 group-hover/item:scale-110 transition-transform">5.00%</span>
                            </div>
                            <div
                                class="bg-white p-5 rounded-3xl border border-slate-100 flex justify-between items-center group/item hover:border-blue-200 transition-colors">
                                <span class="text-sm font-bold text-slate-500 uppercase tracking-wider">TabunganKU</span>
                                <span
                                    class="text-xl font-black text-blue-600 group-hover/item:scale-110 transition-transform">3.00%</span>
                            </div>
                        </div>
                    </div>

                    {{-- Card 2: Deposito --}}
                    <div
                        class="bg-slate-50 rounded-[2.5rem] p-8 border border-slate-100 transition-all duration-500 hover:bg-white hover:shadow-xl">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-[#fbbf24] text-[#00326B] flex items-center justify-center font-black">
                                    02</div>
                                <h3 class="text-xl lg:text-2xl font-black text-[#00326B]">Suku Bunga Deposito</h3>
                            </div>
                            <i class="bi bi-safe2 text-3xl text-amber-200"></i>
                        </div>

                        <div
                            class="bg-white p-6 rounded-3xl border border-[#fbbf24]/20 flex justify-between items-center group/item relative overflow-hidden">
                            <div class="absolute left-0 top-0 h-full w-1 bg-[#fbbf24]"></div>
                            <div class="space-y-1">
                                <span class="text-xs font-black text-[#fbbf24] uppercase tracking-widest">Penempatan
                                    Terbaik</span>
                                <h4 class="text-lg font-bold text-slate-800">Deposito Tenor 12 Bulan</h4>
                            </div>
                            <span class="text-3xl font-black text-[#00326B]">6.00%</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    {{-- ================= BERITA TERKINI (PREMIUM BENTO STYLE) ================= --}}
    <section class="relative py-12 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex items-end justify-between mb-12">
                <div class="space-y-3">
                    <div class="inline-flex items-center gap-3">
                        <span class="h-[1px] w-12 bg-blue-600"></span>
                        <span class="text-[10px] font-black uppercase tracking-[0.4em] text-[#00326B]">Latest
                            Updates</span>
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-black text-[#00326B]">Berita <span
                            class="text-blue-600 italic font-light">Terkini</span></h2>
                </div>
                {{-- Link ke Index Berita --}}
                <a href="{{ route('berita.index') }}"
                    class="hidden md:inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest text-blue-600 hover:text-[#00326B] transition-colors">
                    Semua Berita <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- FEATURED NEWS (Besar di Kiri) --}}
                <div class="lg:col-span-7 group relative">
                    <div
                        class="relative z-10 h-full min-h-[450px] overflow-hidden rounded-[3rem] shadow-2xl transition-all duration-700">
                        <img src="{{ asset('images/berita.png') }}"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                            alt="Berita Utama">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#00326B] via-[#00326B]/20 to-transparent">
                        </div>

                        <div class="absolute bottom-0 left-0 p-10 lg:p-12 text-white z-10">
                            <span
                                class="inline-block px-4 py-1.5 rounded-full bg-blue-600 text-white text-[10px] font-black uppercase tracking-widest mb-4 shadow-xl">Utama</span>
                            <h3 class="text-2xl lg:text-4xl font-black leading-tight mb-4">Rapat Koordinasi Tahunan PT. BPR
                                NTB (Perseroda)</h3>
                            <p class="text-white/80 text-sm lg:text-base font-medium italic max-w-md mb-6 leading-relaxed">
                                "Membangun sinergi untuk memperkuat ekonomi daerah NTB melalui inovasi perbankan
                                berkelanjutan."
                            </p>
                            {{-- Link ke Detail Berita Utama (Slug: rapat-koordinasi-tahunan) --}}
                            <a href="{{ route('berita.show', 'rapat-koordinasi-2026') }}"
                                class="inline-flex items-center gap-3 text-[10px] font-black uppercase tracking-widest hover:text-blue-300 transition-colors">
                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- SIDE NEWS LIST (Kecil di Kanan) --}}
                <div class="lg:col-span-5 flex flex-col gap-6">

                    {{-- Berita 2 --}}
                    <div
                        class="group relative bg-slate-50 rounded-[2.5rem] p-6 border border-slate-100 transition-all duration-500 hover:bg-white hover:shadow-xl hover:-translate-y-1">
                        <div class="flex items-center gap-6">
                            <div class="w-24 h-24 shrink-0 rounded-2xl overflow-hidden shadow-sm">
                                <img src="{{ asset('images/berita.png') }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="space-y-2">
                                <span class="text-[9px] font-black uppercase tracking-[0.2em] text-blue-600">UMKM &
                                    Ekonomi</span>
                                <h4
                                    class="text-base font-black text-[#00326B] leading-tight group-hover:text-blue-600 transition-colors">
                                    Penyaluran Kredit Usaha Rakyat untuk UMKM Mataram</h4>
                                <p class="text-slate-500 text-[11px] leading-relaxed italic line-clamp-1">Dukungan nyata
                                    bagi pelaku usaha kecil.</p>
                            </div>
                        </div>
                        {{-- Link ke Detail Berita 2 --}}
                        <a href="{{ route('berita.show', 'penyaluran-kredit-usaha-rakyat') }}"
                            class="absolute inset-0"></a>
                    </div>

                    {{-- Berita 3 --}}
                    <div
                        class="group relative bg-slate-50 rounded-[2.5rem] p-6 border border-slate-100 transition-all duration-500 hover:bg-white hover:shadow-xl hover:-translate-y-1">
                        <div class="flex items-center gap-6">
                            <div class="w-24 h-24 shrink-0 rounded-2xl overflow-hidden shadow-sm">
                                <img src="{{ asset('images/berita.png') }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="space-y-2">
                                <span class="text-[9px] font-black uppercase tracking-[0.2em] text-blue-600">Literasi
                                    Keuangan</span>
                                <h4
                                    class="text-base font-black text-[#00326B] leading-tight group-hover:text-blue-600 transition-colors">
                                    Edukasi Literasi Keuangan Siswa Sekolah Dasar</h4>
                                <p class="text-slate-500 text-[11px] leading-relaxed italic line-clamp-1">Mengenalkan
                                    pentingnya menabung sejak dini.</p>
                            </div>
                        </div>
                        {{-- Link ke Detail Berita 3 --}}
                        <a href="{{ route('berita.show', 'edukasi-literasi-keuangan-siswa') }}"
                            class="absolute inset-0"></a>
                    </div>

                    {{-- Tombol Lihat Berita Lainnya --}}
                    <div
                        class="group relative bg-[#00326B] rounded-[2.5rem] p-6 transition-all duration-500 hover:shadow-2xl hover:shadow-blue-900/40 hover:-translate-y-1">
                        <div class="flex items-center gap-6">
                            <div
                                class="w-24 h-24 shrink-0 rounded-2xl bg-white/10 flex items-center justify-center text-white italic font-black text-xs">
                                More</div>
                            <div class="space-y-1">
                                <h4 class="text-base font-black text-white">Lihat Berita Lainnya</h4>
                                <p class="text-white/60 text-[11px] italic">Temukan informasi kegiatan BPR NTB
                                    selengkapnya.</p>
                            </div>
                        </div>
                        {{-- Link ke Index Berita --}}
                        <a href="{{ route('berita.index') }}" class="absolute inset-0"></a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- ================= PRESTASI SECTION (GRID TO SWIPE) ================= --}}
    {{-- py-20/py-28 dikurangi menjadi py-12 agar jarak dengan section Berita lebih rapat --}}
    <section class="relative py-12 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- Header --}}
            {{-- mb-12 dikurangi menjadi mb-8 --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
                <div class="space-y-3">
                    <div class="inline-flex items-center gap-3">
                        <span class="h-[1px] w-12 bg-[#fbbf24]"></span>
                        <span class="text-[10px] font-black uppercase tracking-[0.4em] text-[#00326B]">National
                            Recognition</span>
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-black text-[#00326B]">Prestasi <span
                            class="text-[#fbbf24] italic font-light">Kami</span></h2>
                </div>
                <div
                    class="lg:hidden flex items-center gap-2 text-slate-400 text-[10px] font-bold uppercase tracking-widest">
                    <span>Swipe</span> <i class="bi bi-arrow-right"></i>
                </div>
            </div>

            {{-- Container: Swipe di Mobile, Grid di Desktop --}}
            <div
                class="flex lg:grid lg:grid-cols-4 gap-6 overflow-x-auto lg:overflow-visible snap-x snap-mandatory hide-scrollbar -mx-6 px-6 lg:mx-0 lg:px-0">
                @php
                    $prestasi = [
                        [
                            'tag' => 'Infobank 2025',
                            'title' => 'Predikat "Sangat Bagus"',
                            'img' => 'penghargaan-infobank.png',
                        ],
                        ['tag' => 'Top Business', 'title' => 'TOP BPR Bintang 5', 'img' => 'penghargaan-top-bpr.png'],
                        [
                            'tag' => 'Innovation',
                            'title' => 'Digital Banking Excellence',
                            'img' => 'digital-innovation.png',
                        ],
                        ['tag' => 'Social Impact', 'title' => 'Bakti NTB Terpuji', 'img' => 'csr-awards.png'],
                    ];
                @endphp

                @foreach ($prestasi as $p)
                    <div class="min-w-[85%] sm:min-w-[45%] lg:min-w-0 snap-center group">
                        <div
                            class="relative h-[400px] lg:h-[420px] overflow-hidden rounded-[2.5rem] shadow-xl transition-all duration-500 group-hover:shadow-blue-900/10">
                            <img src="{{ asset('images/' . $p['img']) }}"
                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                alt="{{ $p['title'] }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#00326B] via-[#00326B]/20 to-transparent">
                            </div>
                            <div class="absolute bottom-0 left-0 p-8 text-white">
                                <span
                                    class="text-[9px] font-black uppercase tracking-widest text-[#fbbf24] mb-2 block">{{ $p['tag'] }}</span>
                                <h3 class="text-xl font-black leading-tight">{{ $p['title'] }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= LELANG SECTION (OPTIMIZED GRID TO SWIPE) ================= --}}
    <section class="relative py-12 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- Header Section --}}
            <div class="flex items-end justify-between mb-10">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-3 mb-3">
                        <span class="h-[1px] w-10 bg-[#fbbf24]"></span>
                        <span class="text-[10px] font-black uppercase tracking-[0.3em] text-[#00326B]">Public
                            Procurement</span>
                    </div>
                    <h2 class="text-3xl lg:text-5xl font-black text-[#00326B] leading-tight">
                        Kesempatan Lelang <br><span class="italic font-light text-[#fbbf24]">Bersama BPR NTB</span>
                    </h2>
                </div>

                {{-- Hint Swipe Mobile (Hanya muncul di HP) --}}
                <div
                    class="lg:hidden flex items-center gap-2 text-slate-400 text-[10px] font-bold uppercase tracking-widest mb-2">
                    <span>Swipe</span> <i class="bi bi-arrow-right"></i>
                </div>
            </div>

            {{-- Container: Mobile Flex-Scroll | Desktop Grid --}}
            <div
                class="flex lg:grid lg:grid-cols-4 gap-6 overflow-x-auto lg:overflow-visible snap-x snap-mandatory hide-scrollbar -mx-6 px-6 lg:mx-0 lg:px-0 pb-4">

                {{-- Template Card (Ulangi untuk Item 1-4) --}}
                @php
                    $lelangItems = [
                        [
                            'tag' => 'Jasa & Konsultan',
                            'color' => 'blue-600',
                            'title' => 'Pengadaan Jasa Audit Tahun Buku 2025',
                            'desc' => 'Mengundang KAP profesional untuk audit laporan keuangan.',
                            'img' => asset('images/lelang-pengadaan.png'),
                        ],
                        [
                            'tag' => 'Konstruksi',
                            'color' => 'emerald-600',
                            'title' => 'Renovasi Kantor Cabang Utama Mataram',
                            'desc' => 'Peluang bagi kontraktor untuk peningkatan fasilitas.',
                            'img' => 'https://img.daisyui.com/images/stock/photo-1606761506140-59756b6c167b.webp',
                        ],
                        [
                            'tag' => 'Teknologi',
                            'color' => 'purple-600',
                            'title' => 'Pengadaan Sistem Keamanan Jaringan',
                            'desc' => 'Mencari vendor terkemuka untuk upgrade infrastruktur IT.',
                            'img' => 'https://img.daisyui.com/images/stock/photo-1579547621113-e4d0263f90e5.webp',
                        ],
                        [
                            'tag' => 'Logistik',
                            'color' => 'orange-600',
                            'title' => 'Pengadaan Armada Kendaraan Operasional',
                            'desc' => 'Tender untuk penyedia kendaraan dinas baru BPR NTB.',
                            'img' => 'https://img.daisyui.com/images/stock/photo-1560761005-59b48c77174e.webp',
                        ],
                    ];
                @endphp

                @foreach ($lelangItems as $item)
                    <div class="flex-none w-[82%] sm:w-[48%] lg:w-auto snap-center group">
                        <div
                            class="relative flex flex-col h-full bg-white rounded-[2.5rem] shadow-lg border border-slate-100 overflow-hidden transition-all duration-500 lg:hover:shadow-2xl lg:hover:shadow-blue-900/10 lg:hover:-translate-y-2">

                            {{-- Image Wrapper dengan Aspect Ratio Tetap --}}
                            <div class="aspect-[4/3] overflow-hidden">
                                <img src="{{ $item['img'] }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                    alt="{{ $item['title'] }}">
                            </div>

                            {{-- Content --}}
                            <div class="p-7 lg:p-8 flex flex-col flex-grow space-y-3">
                                <span class="text-[9px] font-black uppercase tracking-widest text-{{ $item['color'] }}">
                                    {{ $item['tag'] }}
                                </span>
                                <h3 class="text-lg lg:text-xl font-black text-[#00326B] leading-tight min-h-[3rem]">
                                    {{ $item['title'] }}
                                </h3>
                                <p class="text-slate-500 text-xs lg:text-sm italic line-clamp-2 leading-relaxed">
                                    "{{ $item['desc'] }}"
                                </p>

                                <div class="pt-4 mt-auto">
                                    <a href="{{ route('lelang.show', 'lelang-renovasi-kantor-mataram') }}"
                                        class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-[#00326B] group-hover:text-[#fbbf24] transition-colors">
                                        Lihat Detail <i
                                            class="bi bi-arrow-right transition-transform group-hover:translate-x-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            {{-- Footer Action --}}
            <div class="text-center mt-12">
                <a href="#"
                    class="inline-flex items-center justify-center px-10 py-4 rounded-2xl bg-[#00326B] text-white text-xs font-black uppercase tracking-[0.2em] shadow-xl transition-all duration-300 hover:bg-[#fbbf24] hover:text-[#00326B] active:scale-95">
                    Lihat Semua Lelang <i class="bi bi-arrow-right ml-3"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ================= KONTAK & TESTIMONI (PREMIUM BENTO STYLE) ================= --}}
    <section class="relative py-12 lg:py-20 bg-slate-50 overflow-hidden" id="kontak">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative">

            {{-- Decorative Background Glow --}}
            <div
                class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-100 rounded-full blur-[100px] opacity-50 pointer-events-none">
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-stretch">

                {{-- LEFT PANEL: TESTIMONI (Featured Card Style) --}}
                <div class="lg:col-span-5 group relative">
                    <div
                        class="relative z-10 h-full min-h-[350px] p-8 lg:p-12 flex flex-col justify-between overflow-hidden rounded-[3rem] bg-gradient-to-br from-blue-700 via-blue-800 to-[#00326B] shadow-2xl transition-all duration-500 hover:shadow-blue-900/30">

                        {{-- Icon Quote Dekoratif --}}
                        <div
                            class="absolute top-10 right-10 text-white/10 text-8xl lg:text-9xl font-black pointer-events-none">
                            <i class="bi bi-chat-quote-fill"></i>
                        </div>

                        <div class="relative z-20">
                            <div
                                class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/10 mb-8">
                                <i class="bi bi-star-fill text-[#fbbf24] text-[10px]"></i>
                                <span class="text-[10px] font-black tracking-widest uppercase text-white">Nasabah
                                    Story</span>
                            </div>

                            <p class="text-lg lg:text-2xl font-light italic leading-relaxed text-blue-50 mb-10">
                                "Proses lelangnya sangat transparan dan cepat. Timnya profesional, hasilnya melebihi
                                ekspektasi saya. Terima kasih banyak BPR NTB!"
                            </p>
                        </div>

                        {{-- Profil Nasabah --}}
                        <div
                            class="relative z-20 flex items-center gap-4 p-4 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-sm transition-all group-hover:bg-white/10">
                            <div
                                class="w-14 h-14 rounded-2xl bg-[#fbbf24] flex items-center justify-center text-[#00326B] font-black text-xl shadow-lg">
                                NS
                            </div>
                            <div>
                                <h4 class="font-black text-white text-base">Ni Made Sari</h4>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-blue-300/80">Pengusaha UMKM
                                    - Bali</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT PANEL: HUBUNGI KAMI (Clean Bento Form) --}}
                <div class="lg:col-span-7 group relative">
                    <div
                        class="h-full p-8 lg:p-12 bg-white rounded-[3rem] shadow-xl border border-slate-100 transition-all duration-500 hover:shadow-2xl hover:shadow-blue-900/5">
                        <div class="mb-8 space-y-2">
                            <div class="flex items-center gap-3">
                                <span class="h-[1px] w-8 bg-blue-600"></span>
                                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-[#00326B]">Connect With
                                    Us</span>
                            </div>
                            <h2 class="text-3xl lg:text-4xl font-black text-[#00326B]">Kirim <span
                                    class="text-blue-600 italic font-light">Pesan</span></h2>
                        </div>

                        <form action="#" class="space-y-5">
                            <div class="relative group/input">
                                <input type="text" placeholder="Nama Lengkap"
                                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-blue-600 transition-all outline-none text-slate-800 font-medium placeholder:text-slate-400 placeholder:italic">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <input type="email" placeholder="Alamat Email"
                                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-blue-600 transition-all outline-none text-slate-800 font-medium placeholder:text-slate-400 placeholder:italic">
                                <input type="tel" placeholder="Nomor Telepon"
                                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-blue-600 transition-all outline-none text-slate-800 font-medium placeholder:text-slate-400 placeholder:italic">
                            </div>

                            <textarea rows="4" placeholder="Apa yang bisa kami bantu?"
                                class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-blue-600 transition-all outline-none text-slate-800 font-medium placeholder:text-slate-400 placeholder:italic resize-none"></textarea>

                            <button type="submit"
                                class="group/btn w-full bg-[#00326B] text-white font-black py-5 rounded-2xl shadow-xl shadow-blue-900/20 transition-all hover:bg-blue-700 active:scale-[0.98] flex items-center justify-center gap-3 uppercase tracking-[0.2em] text-xs">
                                <span>Kirim Sekarang</span>
                                <i
                                    class="bi bi-send-fill transition-transform group-hover/btn:translate-x-2 group-hover/btn:-translate-y-1"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
