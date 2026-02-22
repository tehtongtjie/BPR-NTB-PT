@extends('user.layouts.app')

@section('title', 'Pengumuman Lelang - BPR NTB')

@section('content')
    {{-- Jarak pt-32 mobile, lg:pt-40 desktop agar tidak nabrak navbar --}}
    <main class="bg-[#F8FAFC] min-h-screen pt-32 lg:pt-40 pb-24 font-sans antialiased">

        {{-- 1. HERO SECTION --}}
        <section class="relative mx-4 lg:mx-8 mb-12 mt-6 lg:mt-0">
            <div
                class="relative rounded-[2.5rem] lg:rounded-[3rem] bg-[#00326B] overflow-hidden shadow-2xl shadow-blue-900/30">
                {{-- Decorative Elements --}}
                <div
                    class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-[500px] h-[500px] bg-blue-500 rounded-full blur-[100px] opacity-30 animate-pulse">
                </div>
                <div
                    class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/4 w-72 h-72 bg-[#fbbf24] rounded-full blur-[80px] opacity-10">
                </div>

                <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12 lg:py-24 relative z-10">
                    <nav
                        class="flex mb-8 lg:mb-10 text-blue-200/50 text-[9px] lg:text-[10px] font-black uppercase tracking-[0.3em]">
                        <ol class="inline-flex items-center space-x-2 lg:space-x-3">
                            <li><a href="/" class="hover:text-white transition-all">Beranda</a></li>
                            <li><i class="bi bi-circle-fill text-[3px] lg:text-[4px]"></i></li>
                            <li class="text-[#fbbf24]">Pengumuman Lelang</li>
                        </ol>
                    </nav>

                    <div class="max-w-4xl">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/10 mb-6 lg:mb-8 backdrop-blur-md">
                            <span
                                class="w-1 h-1 lg:w-1.5 lg:h-1.5 rounded-full bg-[#fbbf24] shadow-[0_0_10px_#fbbf24]"></span>
                            <span class="text-[9px] lg:text-[10px] font-black text-white uppercase tracking-widest">Public
                                Procurement Center</span>
                        </div>
                        <h1
                            class="text-4xl md:text-8xl font-black text-white leading-[1.1] lg:leading-[0.9] tracking-tighter mb-6 lg:mb-8 text-nowrap">
                            E-Proc <br class="hidden lg:block"><span class="italic font-light text-[#fbbf24]">Lelang.</span>
                        </h1>
                        <p
                            class="text-lg lg:text-2xl text-blue-100/70 font-medium italic leading-relaxed max-w-2xl border-l-2 border-[#fbbf24]/30 pl-5 lg:pl-6">
                            "Portal resmi pengadaan barang dan jasa PT. BPR NTB (Perseroda) yang transparan, akuntabel, dan
                            kompetitif."
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- 2. CATEGORY & STATUS FILTER --}}
        <div class="sticky top-20 lg:top-28 z-30 mb-12 lg:mb-16 px-4">
            <div
                class="max-w-fit mx-auto bg-white/80 backdrop-blur-xl p-1.5 lg:p-2 rounded-2xl lg:rounded-3xl shadow-xl shadow-blue-900/5 border border-slate-100">
                <div class="flex items-center gap-1.5 lg:gap-2 overflow-x-auto hide-scrollbar px-1">
                    @foreach (['Semua Lelang', 'Jasa & Konsultan', 'Konstruksi', 'Teknologi', 'Logistik'] as $cat)
                        <a href="#"
                            class="whitespace-nowrap px-4 lg:px-6 py-2 lg:py-2.5 rounded-xl lg:rounded-2xl text-[9px] lg:text-[10px] font-black uppercase tracking-widest transition-all {{ $loop->first ? 'bg-[#00326B] text-white shadow-lg' : 'text-slate-400 hover:text-[#00326B] hover:bg-slate-50' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- 3. FEATURED LELANG (LELANG TERBARU) --}}
        <div class="max-w-7xl mx-auto px-6 lg:px-8 mb-16 lg:mb-20">
            @if (count($lelangs) > 0)
                @php $featured = $lelangs->first(); @endphp

                <div class="group relative bg-white rounded-[2.5rem] lg:rounded-[3.5rem]
                            shadow-2xl shadow-blue-900/5 border border-white overflow-hidden">

                    <div class="flex flex-col lg:flex-row min-h-[400px] lg:min-h-[500px]">

                        {{-- Banner --}}
                        <div class="lg:w-3/5 relative overflow-hidden">
                            <img src="{{ $featured->banner
                                    ? asset('storage/'.$featured->banner)
                                    : asset('images/lelang-pengadaan.png') }}"
                                class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">

                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-60"></div>

                            <div class="absolute top-6 left-6">
                                <span class="px-4 py-1.5 rounded-xl text-[9px] font-black uppercase text-white shadow-xl
                                    {{ $featured->status === 'aktif' ? 'bg-emerald-500' : 'bg-red-500' }}">
                                    Status: {{ ucfirst($featured->status) }}
                                </span>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="lg:w-2/5 p-8 lg:p-16 flex flex-col justify-center bg-white">
                            <span
                                class="text-blue-600 text-[9px] font-black uppercase tracking-[0.3em] mb-4">
                                {{ $featured->category }}
                            </span>

                            <h2
                                class="text-2xl lg:text-4xl font-black text-[#00326B] leading-tight mb-6">
                                {{ $featured->title }}
                            </h2>

                            <p
                                class="text-slate-500 text-sm lg:text-lg italic mb-8 border-l-4 border-[#fbbf24]/50 pl-4">
                                "{{ $featured->short_desc }}"
                            </p>
                            
                        <div class="flex justify-between items-center border-t pt-6">
                            <div>
                                <span class="text-[8px] font-black uppercase text-slate-400">
                                    Batas Penawaran
                                </span>
                                <span class="block text-xs font-black text-red-500">
                                    {{ $featured->deadline?->translatedFormat('d F Y') }}
                                </span>
                            </div>

                            <div class="flex items-center gap-3">
                                {{-- Lihat Detail --}}
                                <a href="{{ route('lelang.show', $featured->slug) }}"
                                class="text-[9px] font-black uppercase tracking-widest text-[#00326B] hover:text-[#fbbf24] transition">
                                    Lihat Detail
                                </a>

                                {{-- Download RKS --}}
                                @if($featured->rks_file)
                                    <a href="{{ asset('storage/'.$featured->rks_file) }}"
                                    target="_blank"
                                    class="w-12 h-12 rounded-2xl bg-[#00326B] text-white flex items-center justify-center">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        {{-- 4. LELANG GRID --}}
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center gap-4 mb-8 lg:mb-12">
                <span class="h-[1px] w-10 lg:w-12 bg-[#fbbf24]"></span>
                <span class="text-[10px] lg:text-[11px] font-black text-[#00326B] uppercase tracking-[0.4em]">Daftar Tender
                    Aktif</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">
                @forelse($lelangs->skip(1) as $l)
                    <div class="group flex flex-col bg-white rounded-[3rem]
                                shadow-xl border border-slate-50 overflow-hidden
                                hover:-translate-y-3 transition-all">

                        {{-- Banner --}}
                        <div class="aspect-[4/3] overflow-hidden relative">
                            <img src="{{ $l->banner
                                    ? asset('storage/'.$l->banner)
                                    : asset('images/lelang-pengadaan.png') }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                            <div class="absolute top-4 right-4">
                                <span
                                    class="px-3 py-1 rounded-lg text-[8px] font-black uppercase text-white
                                    {{ $l->status === 'aktif' ? 'bg-emerald-500' : 'bg-red-500' }}">
                                    {{ ucfirst($l->status) }}
                                </span>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-6 flex flex-col flex-grow">
                            <span class="text-blue-600 text-[9px] font-black uppercase tracking-widest mb-3">
                                {{ $l->category }}
                            </span>

                            <h3 class="text-lg font-black text-[#00326B] mb-4 line-clamp-2">
                                {{ $l->title }}
                            </h3>

                            <div class="bg-slate-50 p-4 rounded-2xl mb-6">
                                <div class="flex justify-between text-[9px] font-black uppercase text-slate-400">
                                    <span>Batas Waktu</span>
                                    <span class="text-slate-800">
                                        {{ $l->deadline?->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-auto flex justify-between items-center border-t pt-6">
                                <a href="{{ route('lelang.show', $l->slug) }}"
                                class="text-[9px] font-black uppercase tracking-widest text-[#00326B] hover:text-[#fbbf24]">
                                    Lihat Detail
                                </a>
                                <i class="bi bi-arrow-right-short text-xl text-[#00326B]"></i>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-slate-50 rounded-[3rem]">
                        <p class="text-slate-400 italic">Belum ada lelang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .tracking-tighter {
            letter-spacing: -0.05em;
        }

        .text-nowrap {
            white-space: nowrap;
        }
    </style>
@endsection
