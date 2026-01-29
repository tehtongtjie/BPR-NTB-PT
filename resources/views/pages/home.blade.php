@extends('layouts.app')

@section('title', 'Beranda - BPR NTB')

@section('content')

    {{-- 1. HERO SECTION --}}
    <section
    x-data="{
        activeSlide: 0,
        slides: {{ $banners->count() }},
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
            this.activeSlide = (this.activeSlide + 1) % this.slides;
        },
        prev() {
            this.activeSlide = (this.activeSlide - 1 + this.slides) % this.slides;
        }
    }"
    x-init="startAutoPlay()" @mouseenter="stopAutoPlay()" @mouseleave="startAutoPlay()"
        class="relative w-full overflow-hidden pt-[120px] bg-white">

        {{-- Aspect Ratio Container --}}
        {{-- Menggunakan grid agar semua slide bertumpuk di titik yang sama tanpa merusak layout flow --}}
            <div class="relative w-full grid grid-cols-1">
                @foreach ($banners as $index => $banner)
                    <div
                        x-show="activeSlide === {{ $index }}"
                        x-transition:enter="transition opacity duration-1000 ease-in-out"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition opacity duration-1000 ease-in-out"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="col-start-1 row-start-1 w-full"
                        x-cloak
                    >   
                        <img
                            src="{{ asset('storage/' .$banner->image) }}"
                            class="w-full h-auto block"
                            alt="Banner {{ $index + 1 }}"
                            loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                        >
                    </div>
                @endforeach
            </div>

            {{-- INDICATORS --}}
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 md:bottom-10 left-1/2 space-x-3">
                <template x-for="index in slides" :key="index">
                    <button
                        @click="activeSlide = index - 1"
                        class="h-1 md:h-1.5 transition-all duration-300 rounded-full"
                        :class="activeSlide === index - 1
                            ? 'w-8 bg-[#fbbf24]'
                            : 'w-2 bg-white/50 hover:bg-white'"
                    ></button>
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

{{-- ================= PRODUK UNGGULAN (DINAMIS, MAX 3) ================= --}}
<section class="relative py-12 bg-[#F8FAFC] overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-3">
                    <span class="h-[1px] w-12 bg-blue-600"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.4em] text-[#00326B]">
                        Smart Financial Solutions
                    </span>
                </div>
                <h2 class="text-4xl lg:text-5xl font-black text-[#00326B]">
                    Produk <span class="text-blue-600 italic font-light">Unggulan</span>
                </h2>
            </div>
            <div class="hidden md:block">
                <p class="text-slate-500 max-w-xs text-right italic font-medium">
                    Pilih solusi perbankan yang dirancang khusus untuk masa depan Anda.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- ================= FEATURED (KIRI) ================= --}}
            @if($featured)
            <div class="lg:col-span-7 group relative">
                <a href="{{ route('tabungan.show', $featured->slug) }}">
                    <div
                        class="relative z-10 h-full min-h-[500px] overflow-hidden rounded-[3rem]
                               shadow-2xl border border-white">

                        <img
                            src="{{ asset('storage/'.$featured->image) }}"
                            class="absolute inset-0 w-full h-full object-cover
                                   transition-transform duration-1000 group-hover:scale-110"
                            alt="{{ $featured->title }}">

                        <div class="absolute inset-0 bg-gradient-to-t
                                    from-[#00326B] via-[#00326B]/30 to-transparent"></div>

                        <div class="absolute bottom-0 left-0 p-10 lg:p-12 text-white z-10">
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="px-4 py-1.5 rounded-full bg-[#fbbf24]
                                           text-[#00326B] text-[10px] font-black uppercase tracking-widest">
                                    Most Popular
                                </span>
                                <i class="bi bi-trophy-fill text-[#fbbf24]"></i>
                            </div>

                            <h3 class="text-3xl lg:text-4xl font-black mb-4">
                                {{ $featured->title }}
                            </h3>

                            <p class="text-white/80 text-sm lg:text-base italic max-w-md mb-8 leading-relaxed">
                                {{ $featured->short_desc }}
                            </p>

                            <div
                                class="inline-flex items-center gap-4 text-xs font-black uppercase tracking-widest">
                                <span>Buka Tabungan</span>
                                <div
                                    class="w-10 h-10 rounded-full bg-white/10
                                           flex items-center justify-center">
                                    <i class="bi bi-arrow-up-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endif

            {{-- ================= PROMO LAINNYA (KANAN) ================= --}}
            <div class="lg:col-span-5 flex flex-col gap-6">
                @foreach($others as $promo)
                    <a href="{{ route('tabungan.show', $promo->slug) }}"
                       class="group relative bg-white rounded-[2.5rem] p-6
                              border border-slate-100 shadow-sm
                              transition-all duration-500 hover:shadow-xl hover:-translate-y-1">

                        <div class="flex items-center gap-6">
                            <div
                                class="w-28 h-28 shrink-0 rounded-2xl overflow-hidden
                                       bg-slate-50 border border-slate-100 shadow-inner">
                                <img
                                    src="{{ asset('storage/'.$promo->image) }}"
                                    class="w-full h-full object-contain p-2
                                           group-hover:scale-110 transition-transform duration-500">
                            </div>

                            <div class="space-y-2">
                                <h4
                                    class="text-xl font-black text-[#00326B]
                                           group-hover:text-blue-600 transition-colors leading-tight">
                                    {{ $promo->title }}
                                </h4>

                                <p class="text-slate-500 text-xs italic line-clamp-2">
                                    {{ $promo->short_desc }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach

                {{-- CTA --}}
                <a href="#"
                   class="group relative bg-[#00326B] rounded-[2.5rem] p-6
                          transition-all duration-500 hover:shadow-2xl hover:-translate-y-1">
                    <div class="flex items-center gap-6">
                        <div
                            class="w-28 h-28 shrink-0 rounded-2xl bg-white/10
                                   flex items-center justify-center text-[#fbbf24]">
                            <i class="bi bi-grid-fill text-3xl"></i>
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-xl font-black text-white">Produk Lainnya</h4>
                            <p class="text-white/60 text-xs italic">
                                Lihat seluruh tabungan BPR NTB.
                            </p>
                        </div>
                    </div>
                </a>

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
                    <span class="text-[10px] font-black uppercase tracking-[0.4em] text-[#00326B]">
                        Interest Rates Update
                    </span>
                </div>
                <h2 class="text-4xl lg:text-5xl font-black text-[#00326B]">
                    Informasi <span class="text-blue-600 italic font-light">Suku Bunga</span>
                </h2>
            </div>
        </div>

        @if($activePeriod)
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">

            {{-- LEFT PANEL: LPS --}}
            <div class="lg:col-span-5 group relative">
                <div
                    class="relative z-10 h-full min-h-[400px] p-10 flex flex-col justify-between overflow-hidden
                           rounded-[3rem] bg-gradient-to-br from-blue-700 via-blue-800 to-[#00326B]
                           shadow-2xl transition-all duration-500">

                    <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>

                    <div class="relative z-20">
                        <div
                            class="inline-flex items-center space-x-2 bg-white/10 px-4 py-1.5 rounded-full
                                   border border-white/10 mb-8">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full
                                           bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                            </span>
                            <span class="text-[10px] font-black tracking-widest uppercase text-white">
                                {{ $activePeriod->title }}
                            </span>
                        </div>

                        <p class="text-blue-100 text-[11px] font-black uppercase tracking-widest mb-2 opacity-80">
                            Tingkat Bunga Penjaminan LPS
                        </p>

                        <h2 class="text-7xl lg:text-8xl font-black text-white tracking-tighter mb-6">
                            {{ number_format(optional($activePeriod->lps)->rate, 2) }}
                            <span class="text-3xl text-blue-300">%</span>
                        </h2>

                        <div
                            class="inline-flex items-center gap-3 px-5 py-3 bg-white/5 rounded-2xl
                                   backdrop-blur-md border border-white/10">
                            <i class="bi bi-shield-check text-[#fbbf24] text-xl"></i>
                            <p class="text-xs text-blue-50 font-medium leading-tight">
                                Dijamin LPS hingga
                                <span
                                    class="font-black text-white underline decoration-[#fbbf24]
                                           decoration-2 underline-offset-4">
                                    Rp 2 Miliar
                                </span>
                            </p>
                        </div>
                    </div>

                    @if(optional($activePeriod->lps)->verification_url)
                    <div class="mt-8">
                        <a href="{{ $activePeriod->lps->verification_url }}" target="_blank"
                           class="flex items-center justify-center gap-3 bg-white text-[#00326B]
                                  py-4 rounded-2xl font-black text-xs uppercase tracking-widest
                                  transition-all hover:bg-[#fbbf24]">
                            <span>Verifikasi LPS Rate</span>
                            <i class="bi bi-box-arrow-up-right"></i>
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            {{-- RIGHT PANEL --}}
            <div class="lg:col-span-7 flex flex-col gap-6">

                {{-- TABUNGAN --}}
                <div
                    class="bg-slate-50 rounded-[2.5rem] p-8 border border-slate-100
                           transition-all duration-500 hover:bg-white hover:shadow-xl">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-2xl bg-blue-600 text-white
                                       flex items-center justify-center font-black">01</div>
                            <h3 class="text-xl lg:text-2xl font-black text-[#00326B]">
                                Suku Bunga Tabungan
                            </h3>
                        </div>
                        <i class="bi bi-piggy-bank text-3xl text-blue-200"></i>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($activePeriod->tabungans as $tabungan)
                        <div
                            class="bg-white p-5 rounded-3xl border border-slate-100
                                   flex justify-between items-center transition-colors">
                            <span class="text-sm font-bold text-slate-500 uppercase tracking-wider">
                                {{ $tabungan->tabungan_type }}
                            </span>
                            <span class="text-xl font-black text-blue-600">
                                {{ number_format($tabungan->rate, 2) }}%
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- DEPOSITO --}}
                <div
                    class="bg-slate-50 rounded-[2.5rem] p-8 border border-slate-100
                           transition-all duration-500 hover:bg-white hover:shadow-xl">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-2xl bg-[#fbbf24] text-[#00326B]
                                       flex items-center justify-center font-black">02</div>
                            <h3 class="text-xl lg:text-2xl font-black text-[#00326B]">
                                Suku Bunga Deposito
                            </h3>
                        </div>
                        <i class="bi bi-safe2 text-3xl text-amber-200"></i>
                    </div>

                    @foreach($activePeriod->depositos as $dep)
                    <div
                        class="bg-white p-6 rounded-3xl border border-[#fbbf24]/20
                               flex justify-between items-center relative overflow-hidden mb-4">
                        <div class="absolute left-0 top-0 h-full w-1 bg-[#fbbf24]"></div>
                        <div class="space-y-1">
                            <span class="text-xs font-black text-[#fbbf24] uppercase tracking-widest">
                                {{ $dep->label ?? 'Deposito' }}
                            </span>
                            <h4 class="text-lg font-bold text-slate-800">
                                Tenor {{ $dep->tenor_month }} Bulan
                            </h4>
                        </div>
                        <span class="text-3xl font-black text-[#00326B]">
                            {{ number_format($dep->rate, 2) }}%
                        </span>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
        @else
            <p class="text-center text-slate-500">
                Data suku bunga belum tersedia.
            </p>
        @endif
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
            <a href="{{ route('berita.index') }}"
                class="hidden md:inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest text-blue-600 hover:text-[#00326B] transition-colors">
                Semua Berita <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- FEATURED NEWS (Besar di Kiri) --}}
            @if(isset($articles[0]))
            <div class="lg:col-span-7 group relative">
                <div
                    class="relative z-10 h-full min-h-[450px] overflow-hidden rounded-[3rem] shadow-2xl transition-all duration-700">
                    <img src="{{ asset('storage/' . $articles[0]->thumbnail) }}"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                        alt="{{ $articles[0]->title }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#00326B] via-[#00326B]/20 to-transparent">
                    </div>

                    <div class="absolute bottom-0 left-0 p-10 lg:p-12 text-white z-10">
                        <span
                            class="inline-block px-4 py-1.5 rounded-full bg-blue-600 text-white text-[10px] font-black uppercase tracking-widest mb-4 shadow-xl">
                            {{ $articles[0]->category ?? 'Utama' }}
                        </span>
                        <h3 class="text-2xl lg:text-4xl font-black leading-tight mb-4">
                            {{ $articles[0]->title }}
                        </h3>
                        <p class="text-white/80 text-sm lg:text-base font-medium italic max-w-md mb-6 leading-relaxed">
                            "{{ $articles[0]->excerpt }}"
                        </p>
                        <a href="{{ route('berita.show', $articles[0]->slug) }}"
                            class="inline-flex items-center gap-3 text-[10px] font-black uppercase tracking-widest hover:text-blue-300 transition-colors">
                            Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            {{-- SIDE NEWS LIST (Kecil di Kanan) --}}
            <div class="lg:col-span-5 flex flex-col gap-6">

                @foreach($articles->slice(1,2) as $a)
                <div
                    class="group relative bg-slate-50 rounded-[2.5rem] p-6 border border-slate-100 transition-all duration-500 hover:bg-white hover:shadow-xl hover:-translate-y-1">
                    <div class="flex items-center gap-6">
                        <div class="w-24 h-24 shrink-0 rounded-2xl overflow-hidden shadow-sm">
                            <img src="{{ asset('storage/' . $a->thumbnail) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="space-y-2">
                            <span
                                class="text-[9px] font-black uppercase tracking-[0.2em] text-blue-600">
                                {{ $a->category }}
                            </span>
                            <h4
                                class="text-base font-black text-[#00326B] leading-tight group-hover:text-blue-600 transition-colors">
                                {{ $a->title }}
                            </h4>
                            <p class="text-slate-500 text-[11px] leading-relaxed italic line-clamp-1">
                                {{ $a->excerpt }}
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('berita.show', $a->slug) }}" class="absolute inset-0"></a>
                </div>
                @endforeach

                {{-- Berita 4 (Link ke semua berita) --}}
                <div
                    class="group relative bg-[#00326B] rounded-[2.5rem] p-6 transition-all duration-500 hover:shadow-2xl hover:shadow-blue-900/40 hover:-translate-y-1">
                    <div class="flex items-center gap-6">
                        <div
                            class="w-24 h-24 shrink-0 rounded-2xl bg-white/10 flex items-center justify-center text-white italic font-black text-xs">
                            More
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-base font-black text-white">Lihat Berita Lainnya</h4>
                            <p class="text-white/60 text-[11px] italic">Temukan informasi kegiatan BPR NTB
                                selengkapnya.</p>
                        </div>
                    </div>
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

        {{-- Header --}}
        <div class="flex items-end justify-between mb-10">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-3 mb-3">
                    <span class="h-[1px] w-10 bg-[#fbbf24]"></span>
                    <span
                        class="text-[10px] font-black uppercase tracking-[0.3em] text-[#00326B]">
                        Public Procurement
                    </span>
                </div>

                <h2 class="text-3xl lg:text-5xl font-black text-[#00326B] leading-tight">
                    Kesempatan Lelang <br>
                    <span class="italic font-light text-[#fbbf24]">Bersama BPR NTB</span>
                </h2>
            </div>

            <div
                class="lg:hidden flex items-center gap-2 text-slate-400 text-[10px] font-bold uppercase tracking-widest mb-2">
                <span>Swipe</span> <i class="bi bi-arrow-right"></i>
            </div>
        </div>

        {{-- Cards --}}
        <div
            class="flex lg:grid lg:grid-cols-4 gap-6 overflow-x-auto lg:overflow-visible
                   snap-x snap-mandatory hide-scrollbar -mx-6 px-6 lg:mx-0 lg:px-0 pb-4">

            @forelse ($lelangs as $lelang)
                <div class="flex-none w-[82%] sm:w-[48%] lg:w-auto snap-center group">
                    <div
                        class="relative flex flex-col h-full bg-white rounded-[2.5rem]
                               shadow-lg border border-slate-100 overflow-hidden
                               transition-all duration-500
                               lg:hover:shadow-2xl lg:hover:shadow-blue-900/10
                               lg:hover:-translate-y-2">

                        {{-- Banner --}}
                        <div class="aspect-[4/3] overflow-hidden">
                            <img
                                src="{{ $lelang->banner
                                        ? asset('storage/'.$lelang->banner)
                                        : asset('images/lelang-pengadaan.png') }}"
                                alt="{{ $lelang->title }}"
                                class="w-full h-full object-cover
                                       transition-transform duration-700
                                       group-hover:scale-110">
                        </div>

                        {{-- Content --}}
                        <div class="p-7 lg:p-8 flex flex-col flex-grow space-y-3">

                            {{-- Category --}}
                            <span
                                class="text-[9px] font-black uppercase tracking-widest
                                       text-[#00326B]">
                                {{ $lelang->category ?? 'LELANG' }}
                            </span>

                            {{-- Title --}}
                            <h3
                                class="text-lg lg:text-xl font-black text-[#00326B]
                                       leading-tight min-h-[3rem]">
                                {{ $lelang->title }}
                            </h3>

                            {{-- Short Desc --}}
                            <p
                                class="text-slate-500 text-xs lg:text-sm italic
                                       line-clamp-2 leading-relaxed">
                                "{{ $lelang->short_desc }}"
                            </p>

                            {{-- Deadline --}}
                            @if ($lelang->deadline)
                                <p class="text-[10px] text-slate-400 font-semibold">
                                    Batas Akhir:
                                    {{ $lelang->deadline->translatedFormat('d F Y') }}
                                </p>
                            @endif

                            {{-- CTA --}}
                            <div class="pt-4 mt-auto">
                                <a href="{{ route('lelang.show', $lelang->slug) }}"
                                   class="inline-flex items-center gap-2
                                          text-[10px] font-black uppercase
                                          tracking-[0.2em] text-[#00326B]
                                          group-hover:text-[#fbbf24]
                                          transition-colors">
                                    Lihat Detail
                                    <i
                                        class="bi bi-arrow-right
                                               transition-transform
                                               group-hover:translate-x-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-slate-500 text-sm">
                    Belum ada lelang yang tersedia saat ini.
                </p>
            @endforelse

        </div>

        {{-- Footer --}}
        <div class="text-center mt-12">
            <a href="{{ route('lelang.index') }}"
               class="inline-flex items-center justify-center
                      px-10 py-4 rounded-2xl
                      bg-[#00326B] text-white
                      text-xs font-black uppercase tracking-[0.2em]
                      shadow-xl transition-all duration-300
                      hover:bg-[#fbbf24] hover:text-[#00326B]
                      active:scale-95">
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

                        <form action="{{ route('messages.store') }}" method="POST" class="space-y-5">
                            @csrf

                            {{-- ALERT SUCCESS --}}
                            @if (session('success'))
                                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-bold">
                                    <i class="bi bi-check-circle-fill mr-2"></i>
                                    {{ session('success') }}
                                </div>
                            @endif

                            {{-- NAMA --}}
                            <div class="relative group/input">
                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Nama Lengkap"
                                    required
                                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-none
                                        focus:ring-2 focus:ring-blue-600 transition-all outline-none
                                        text-slate-800 font-medium placeholder:text-slate-400 placeholder:italic">
                                @error('name')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- EMAIL & TELEPON --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <input
                                        type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="Alamat Email"
                                        required
                                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-none
                                            focus:ring-2 focus:ring-blue-600 transition-all outline-none
                                            text-slate-800 font-medium placeholder:text-slate-400 placeholder:italic">
                                    @error('email')
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <input
                                        type="tel"
                                        name="phone"
                                        value="{{ old('phone') }}"
                                        placeholder="Nomor Telepon"
                                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-none
                                            focus:ring-2 focus:ring-blue-600 transition-all outline-none
                                            text-slate-800 font-medium placeholder:text-slate-400 placeholder:italic">
                                    @error('phone')
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- PESAN --}}
                            <div>
                                <textarea
                                    name="message"
                                    rows="4"
                                    required
                                    placeholder="Apa yang bisa kami bantu?"
                                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-none
                                        focus:ring-2 focus:ring-blue-600 transition-all outline-none
                                        text-slate-800 font-medium placeholder:text-slate-400 placeholder:italic resize-none">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- SUBMIT --}}
                            <button type="submit"
                                class="group/btn w-full bg-[#00326B] text-white font-black py-5 rounded-2xl
                                    shadow-xl shadow-blue-900/20 transition-all hover:bg-blue-700
                                    active:scale-[0.98] flex items-center justify-center gap-3
                                    uppercase tracking-[0.2em] text-xs">
                                <span>Kirim Sekarang</span>
                                <i class="bi bi-send-fill transition-transform
                                        group-hover/btn:translate-x-2 group-hover/btn:-translate-y-1"></i>
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
