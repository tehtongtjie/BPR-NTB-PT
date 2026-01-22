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

    {{-- 2. PRODUK UNGGULAN --}}
    <section class="pt-24 pb-12 bg-[#F8FAFC] overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div class="max-w-2xl">
                    <span
                        class="inline-block px-4 py-1.5 mb-4 text-xs font-bold tracking-[0.2em] uppercase text-blue-600 bg-blue-50 rounded-lg">
                        Pilihan Cerdas
                    </span>
                    <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 leading-tight">
                        Solusi Simpanan <br class="hidden md:block"> <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">Masa Depan
                            Anda</span>
                    </h2>
                </div>
                <div class="hidden md:block">
                    <p class="text-slate-500 max-w-xs text-right italic">Pilih produk yang sesuai dengan kebutuhan finansial
                        keluarga Anda.</p>
                </div>
            </div>

            {{-- Container Swipe --}}
            <div
                class="flex overflow-x-auto pb-10 -mx-4 px-4 hide-scrollbar snap-x snap-mandatory md:grid md:grid-cols-3 md:gap-8 md:overflow-visible">
                @php
                    $products = [
                        [
                            'name' => 'TabunganKU',
                            'img' => 'tabunganku.png',
                            'desc' => 'Setoran awal sangat ringan, tanpa biaya administrasi bulanan yang membebani.',
                            'route' => 'tabunganku',
                            'featured' => false,
                            'tag' => 'Pilihan Hemat',
                            'icon' => 'bi-wallet2',
                        ],
                        [
                            'name' => 'SIMBADA',
                            'img' => 'simbada-card.png',
                            'desc' =>
                                'Simpanan Berhadiah Anda dengan peluang memenangkan undian menarik setiap periode.',
                            'route' => 'simbada',
                            'featured' => true,
                            'tag' => 'Paling Populer',
                            'icon' => 'bi-trophy',
                        ],
                        [
                            'name' => 'Tabungan Sukses',
                            'img' => 'tabungan-sukses.png',
                            'desc' => 'Investasi masa depan yang aman dengan suku bunga kompetitif dan terpercaya.',
                            'route' => 'tabungan-sukses',
                            'featured' => false,
                            'tag' => 'Investasi',
                            'icon' => 'bi-graph-up-arrow',
                        ],
                    ];
                @endphp

                @foreach ($products as $product)
                    <div class="flex-none w-[88%] mr-5 snap-center md:w-auto md:mr-0 group">
                        <div
                            class="relative h-full flex flex-col bg-white rounded-[2rem] overflow-hidden transition-all duration-500 hover:shadow-[0_20px_50px_rgba(8,_112,_184,_0.15)] border border-slate-100 {{ $product['featured'] ? 'ring-2 ring-blue-500/20' : '' }}">

                            {{-- Image Area --}}
                            <div class="relative h-56 md:h-64 overflow-hidden">
                                {{-- Overlay Gradien agar teks tag lebih terbaca --}}
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                </div>

                                <img src="{{ asset('images/' . $product['img']) }}" alt="{{ $product['name'] }}"
                                    class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">

                                {{-- Tag Badge - Glassmorphism style --}}
                                <div class="absolute top-5 left-5 z-20">
                                    <span
                                        class="backdrop-blur-md bg-white/80 px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest text-slate-800 shadow-sm border border-white/20">
                                        {{ $product['tag'] }}
                                    </span>
                                </div>

                                @if ($product['featured'])
                                    <div class="absolute top-5 right-5 z-20">
                                        <div class="bg-blue-600 text-white p-2 rounded-lg shadow-lg">
                                            <i class="bi {{ $product['icon'] }} text-lg"></i>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Content Area --}}
                            <div class="p-8 flex flex-col flex-grow">
                                <h3
                                    class="text-2xl font-bold text-slate-900 mb-3 group-hover:text-blue-600 transition-colors">
                                    {{ $product['name'] }}
                                </h3>
                                <p class="text-slate-500 text-sm md:text-base leading-relaxed flex-grow">
                                    {{ $product['desc'] }}
                                </p>

                                <div class="mt-8">
                                    <a href="{{ route('tabungan.show', $product['route']) }}"
                                        class="group/btn relative inline-flex items-center justify-center w-full px-6 py-4 overflow-hidden font-bold transition-all duration-300 rounded-2xl {{ $product['featured'] ? 'bg-blue-600 text-white' : 'bg-slate-50 text-blue-600 hover:bg-blue-600 hover:text-white' }}">
                                        <span class="relative flex items-center">
                                            Lihat Detail
                                            <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-hover/btn:translate-x-1"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 3. SUKU BUNGA --}}
    <section class="pt-10 pb-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="flex flex-col lg:flex-row shadow-2xl rounded-[1.5rem] md:rounded-[2.5rem] overflow-hidden border border-gray-100">

                {{-- LEFT PANEL: LPS --}}
                {{-- Mengurangi padding mobile dari p-12 ke p-8 --}}
                <div
                    class="lg:w-2/5 p-8 md:p-12 bg-gradient-to-br from-blue-700 via-blue-800 to-blue-900 text-white relative overflow-hidden">
                    <div class="absolute -top-20 -left-20 w-64 h-64 bg-white/10 rounded-full blur-3xl hidden md:block">
                    </div>

                    <div class="relative z-10 h-full flex flex-col justify-between">
                        <div>
                            <div
                                class="inline-flex items-center space-x-2 bg-blue-600/30 px-3 py-1 rounded-full border border-blue-400/30 mb-4 md:mb-6">
                                <span class="relative flex h-2 w-2">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                </span>
                                <span class="text-[9px] md:text-[10px] font-bold tracking-widest uppercase">Update Januari
                                    2026</span>
                            </div>

                            <p class="text-blue-100 text-[11px] md:text-sm font-medium tracking-wide uppercase">Tingkat
                                Bunga Penjaminan (LPS)</p>
                            {{-- Ukuran font responsif: text-5xl di mobile, text-7xl di desktop --}}
                            <h2 class="text-5xl md:text-7xl font-black mt-1 mb-3 md:mb-4 tracking-tighter">6.00<span
                                    class="text-2xl md:text-4xl text-blue-300">%</span></h2>

                            <div
                                class="flex items-start space-x-3 bg-white/10 p-3 md:p-4 rounded-xl backdrop-blur-md border border-white/10">
                                <svg class="w-5 h-5 text-blue-300 mt-1 shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                                <p class="text-[12px] md:text-sm leading-snug text-blue-50">
                                    Dijamin LPS hingga <span
                                        class="font-bold text-white underline decoration-blue-400 underline-offset-4">Rp 2
                                        Miliar</span>.
                                </p>
                            </div>
                        </div>

                        <div class="mt-6 md:mt-12">
                            <a href="https://apps.lps.go.id/BankPesertaLPSRate" target="_blank" rel="noopener"
                                class="group flex items-center justify-center space-x-3 bg-white text-blue-800 py-3 md:py-4 rounded-xl font-bold hover:bg-blue-50 transition-all text-sm shadow-lg shadow-blue-900/20">
                                <span>Cek LPS Rate</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- RIGHT PANEL: RINCIAN --}}
                {{-- Mengurangi p-12 ke p-6 di mobile --}}
                <div class="lg:w-3/5 p-6 md:p-12 bg-white flex flex-col justify-center" x-data="{ selected: 1 }">
                    <div class="mb-6 md:mb-10 text-center md:text-left">
                        <h3 class="text-xl md:text-3xl font-extrabold text-gray-900">Rincian Suku Bunga</h3>
                    </div>

                    <div class="space-y-4 md:y-6">
                        {{-- TABUNGAN --}}
                        <div class="border-b border-gray-100 pb-3">
                            <button @click="selected !== 1 ? selected = 1 : selected = null"
                                class="flex justify-between items-center w-full py-1 text-left focus:outline-none group">
                                <span class="text-md md:text-lg font-bold text-gray-800 flex items-center">
                                    <span
                                        class="w-6 h-6 md:w-8 md:h-8 bg-blue-50 text-blue-600 rounded flex items-center justify-center mr-2 md:mr-3 text-[10px] md:text-sm">01</span>
                                    Suku Bunga Tabungan
                                </span>
                                <svg class="w-4 h-4 text-gray-400 transition-transform duration-300"
                                    :class="selected === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>

                            <div x-show="selected === 1" x-collapse>
                                <div class="pt-3 pb-1 space-y-2">
                                    <div
                                        class="flex justify-between items-center bg-gray-50 p-3 rounded-lg text-sm md:text-base">
                                        <span class="text-gray-600">Simbada</span>
                                        <span class="font-black text-blue-600">5.00%</span>
                                    </div>
                                    <div
                                        class="flex justify-between items-center bg-gray-50 p-3 rounded-lg text-sm md:text-base">
                                        <span class="text-gray-600">TabunganKU</span>
                                        <span class="font-black text-blue-600">3.00%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- DEPOSITO --}}
                        <div class="border-b border-gray-100 pb-3">
                            <button @click="selected !== 2 ? selected = 2 : selected = null"
                                class="flex justify-between items-center w-full py-1 text-left focus:outline-none group">
                                <span class="text-md md:text-lg font-bold text-gray-800 flex items-center">
                                    <span
                                        class="w-6 h-6 md:w-8 md:h-8 bg-blue-50 text-blue-600 rounded flex items-center justify-center mr-2 md:mr-3 text-[10px] md:text-sm">02</span>
                                    Suku Bunga Deposito
                                </span>
                                <svg class="w-4 h-4 text-gray-400 transition-transform duration-300"
                                    :class="selected === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>

                            <div x-show="selected === 2" x-collapse>
                                <div class="pt-3 pb-1 space-y-2">
                                    <div
                                        class="flex justify-between items-center bg-blue-50/50 p-3 rounded-lg text-sm md:text-base">
                                        <span class="text-gray-700 font-bold">Tenor 12 Bulan</span>
                                        <span class="font-black text-blue-700">6.00%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. BERITA TERKINI --}}
    <section class="py-16 bg-white text-gray-800 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header dengan link responsif --}}
            <div class="flex justify-between items-end mb-8 md:mb-10">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold">Berita Terkini</h2>
                    <div class="w-12 h-1 bg-blue-600 mt-2 rounded-full"></div>
                </div>
                <a href="#" class="text-blue-600 font-bold hover:underline text-sm md:text-base">Berita Lainnya
                    →</a>
            </div>

            {{-- Container Swipe --}}
            {{-- md:grid-cols-3 aktif di layar sedang ke atas, flex & overflow-x di mobile --}}
            <div
                class="flex overflow-x-auto pb-8 hide-scrollbar snap-x snap-mandatory md:grid md:grid-cols-3 md:gap-6 md:overflow-visible">

                @php
                    // Contoh data berita (bisa diganti dengan data dari controller)
                    $news = [
                        [
                            'title' => 'Rapat Koordinasi Tahunan PT. BPR NTB (Perseroda)',
                            'desc' =>
                                'Membangun sinergi untuk memperkuat ekonomi daerah NTB melalui inovasi perbankan.',
                        ],
                        [
                            'title' => 'Penyaluran Kredit Usaha Rakyat untuk UMKM Mataram',
                            'desc' => 'Dukungan nyata BPR NTB bagi pelaku usaha kecil di kota Mataram.',
                        ],
                        [
                            'title' => 'Edukasi Literasi Keuangan Siswa Sekolah Dasar',
                            'desc' => 'Mengenalkan pentingnya menabung sejak dini kepada generasi muda.',
                        ],
                    ];
                @endphp

                @foreach ($news as $item)
                    {{-- min-w-[80%] memberikan celah agar berita selanjutnya terlihat sedikit (peek effect) --}}
                    <div class="flex-none w-[82%] mr-5 snap-center md:w-auto md:mr-0">
                        <div
                            class="relative group h-72 md:h-80 rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                            <img src="{{ asset('images/berita.png') }}"
                                class="w-full h-full object-cover transition duration-700 group-hover:scale-110"
                                alt="Berita BPR NTB">

                            {{-- Gradient Overlay --}}
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent flex flex-col justify-end p-5 md:p-6">
                                {{-- Tag/Kategori (Opsional) --}}
                                <span
                                    class="text-[10px] text-blue-400 font-bold uppercase tracking-widest mb-2">Kegiatan</span>

                                <h5
                                    class="text-white font-bold text-base md:text-lg leading-tight group-hover:text-blue-300 transition duration-300">
                                    {{ $item['title'] }}
                                </h5>

                                {{-- Deskripsi muncul halus di desktop, tetap terbaca di mobile jika diperlukan --}}
                                <p
                                    class="text-gray-300 text-xs md:text-sm mt-3 line-clamp-2 md:opacity-0 md:group-hover:opacity-100 md:group-hover:translate-y-0 md:translate-y-4 transition-all duration-300">
                                    {{ $item['desc'] }}
                                </p>
                            </div>

                            {{-- Link overlay agar satu card bisa diklik --}}
                            <a href="#" class="absolute inset-0 z-10"></a>
                        </div>
                    </div>
                @endforeach
            </div>
    </section>

    {{-- Pastikan class hide-scrollbar sudah ada di CSS global Anda --}}

    {{-- 5. KONTAK & TESTIMONI --}}
    <section class="py-20 bg-gray-50" id="kontak">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="bg-blue-600 rounded-3xl p-10 text-white shadow-xl">
                    <h2 class="text-2xl font-bold mb-6">Testimoni Nasabah</h2>
                    <p class="text-lg italic opacity-90 leading-relaxed">
                        "Proses lelangnya sangat transparan dan cepat. Timnya profesional,
                        hasilnya melebihi ekspektasi saya. Terima kasih banyak!"
                    </p>
                    <div class="flex items-center mt-8">
                        <div
                            class="w-12 h-12 bg-white text-blue-600 rounded-full flex items-center justify-center font-bold text-lg">
                            NS</div>
                        <div class="ml-4">
                            <div class="font-bold">Ni Made Sari</div>
                            <div class="text-sm opacity-75">Pengusaha UMKM - Bali</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-10 shadow-lg border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Hubungi Kami</h2>
                    <form action="#" class="space-y-4">
                        <input type="text" placeholder="Nama Lengkap"
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                        <div class="grid grid-cols-2 gap-4">
                            <input type="email" placeholder="Email"
                                class="px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                            <input type="tel" placeholder="Telepon"
                                class="px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                        </div>
                        <textarea rows="4" placeholder="Pesan Anda..."
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none transition"></textarea>
                        <button type="submit"
                            class="w-full bg-blue-600 text-white font-bold py-4 rounded-xl hover:bg-blue-700 transition-transform active:scale-95 shadow-lg">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
