@extends('umkm.layouts.app')

@section('title', $umkm['nama_usaha'] . ' - Detail Mitra UMKM Hebat')

@section('content')
    <section class="relative pt-28 pb-16 lg:pt-40 lg:pb-24 bg-[#FDFDFD] overflow-hidden">
        {{-- Decorative background --}}
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
            <div class="absolute top-[-10%] right-[-5%] w-[600px] h-[600px] bg-blue-50 rounded-full blur-[120px] opacity-40">
            </div>
            <div
                class="absolute bottom-[-5%] left-[-5%] w-[400px] h-[400px] bg-amber-50 rounded-full blur-[100px] opacity-30">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-4 mb-12 animate-fade-in">
                <a href="{{ route('umkm.mitra') }}"
                    class="group flex items-center gap-3 text-slate-400 hover:text-[#00326B] transition-all">
                    <div
                        class="w-10 h-10 rounded-full border border-slate-200 flex items-center justify-center group-hover:bg-[#00326B] group-hover:border-[#00326B] group-hover:text-white transition-all">
                        <i class="bi bi-arrow-left"></i>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em]">Kembali ke Eksplorasi</span>
                </a>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">

                {{-- KIRI: Visual Showcase & Gallery --}}
                <div class="lg:col-span-7 space-y-6" x-data="{ activeImage: '{{ asset($umkm['foto']) }}' }">
                    <div class="relative group">
                        <div
                            class="absolute -inset-1 bg-gradient-to-tr from-[#00326B] to-[#fbbf24] rounded-[3rem] blur opacity-10 group-hover:opacity-20 transition duration-1000">
                        </div>

                        {{-- Main Image Display --}}
                        <div
                            class="relative aspect-[16/10] rounded-[3rem] overflow-hidden shadow-2xl border-[12px] border-white bg-white">
                            <img :src="activeImage" class="w-full h-full object-cover transition-all duration-500"
                                alt="{{ $umkm['nama_usaha'] }}">

                            {{-- Floating Capacity Badge --}}
                            <div class="absolute bottom-8 right-8">
                                <div
                                    class="backdrop-blur-xl bg-white/90 p-4 rounded-[2rem] shadow-xl border border-white/50 flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 bg-blue-50 rounded-2xl flex items-center justify-center text-[#00326B]">
                                        <i class="bi bi-bar-chart-fill text-xl text-blue-500"></i>
                                    </div>
                                    <div>
                                        <p
                                            class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">
                                            Skala Produksi</p>
                                        <p class="text-xs font-black text-[#00326B] uppercase">
                                            {{ $umkm['skala'] ?? 'Besar' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Gallery Thumbnails --}}
                    @if (isset($umkm['galeri']) && count($umkm['galeri']) > 0)
                        <div class="flex gap-4 overflow-x-auto pb-2 scrollbar-hide">
                            {{-- Main Photo Thumbnail --}}
                            <button @click="activeImage = '{{ asset($umkm['foto']) }}'"
                                class="relative w-24 h-20 shrink-0 rounded-2xl overflow-hidden border-2 transition-all"
                                :class="activeImage === '{{ asset($umkm['foto']) }}' ?
                                    'border-[#fbbf24] ring-4 ring-amber-100' : 'border-transparent opacity-60'">
                                <img src="{{ asset($umkm['foto']) }}" class="w-full h-full object-cover">
                            </button>
                            {{-- Additional Photos --}}
                            @foreach ($umkm['galeri'] as $img)
                                <button @click="activeImage = '{{ asset($img) }}'"
                                    class="relative w-24 h-20 shrink-0 rounded-2xl overflow-hidden border-2 transition-all"
                                    :class="activeImage === '{{ asset($img) }}' ? 'border-[#fbbf24] ring-4 ring-amber-100' :
                                        'border-transparent opacity-60'">
                                    <img src="{{ asset($img) }}" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif

                    {{-- Trust Badges --}}
                    <div class="grid grid-cols-3 gap-4 pt-4">
                        <div
                            class="h-24 rounded-3xl bg-white border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-2">
                            <i class="bi bi-shield-check text-blue-500 text-xl"></i>
                            <p class="text-[9px] font-black uppercase text-slate-400">Terverifikasi</p>
                        </div>
                        <div
                            class="h-24 rounded-3xl bg-white border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-2">
                            <i class="bi bi-globe text-emerald-500 text-xl"></i>
                            <p class="text-[9px] font-black uppercase text-slate-400">{{ $umkm['skala'] ?? 'Lokal' }}</p>
                        </div>
                        <div
                            class="h-24 rounded-3xl bg-white border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-2">
                            <i class="bi bi-award text-amber-500 text-xl"></i>
                            <p class="text-[9px] font-black uppercase text-slate-400">Unggulan</p>
                        </div>
                    </div>
                </div>

                {{-- KANAN: Content Detail --}}
                <div class="lg:col-span-5 space-y-8">
                    <div class="space-y-4">
                        <div class="inline-flex items-center gap-3">
                            <span
                                class="px-4 py-1.5 rounded-full bg-blue-50 text-[#00326B] text-[10px] font-black uppercase tracking-widest border border-blue-100">
                                {{ $umkm['bidang_usaha'] ?? 'Food & Beverage' }}
                            </span>
                            <span class="w-2 h-2 rounded-full bg-[#fbbf24] animate-pulse"></span>
                        </div>
                        <h1 class="text-5xl lg:text-6xl font-black text-[#00326B] leading-[1.1] tracking-tighter">
                            {{ $umkm['nama_usaha'] }}
                        </h1>
                    </div>

                    {{-- Business Story Card --}}
                    <div
                        class="p-8 bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 space-y-6">
                        <div class="space-y-2">
                            <h3
                                class="text-[11px] font-black text-[#00326B] uppercase tracking-[0.3em] flex items-center gap-3">
                                <span class="h-1 w-8 bg-[#fbbf24] rounded-full"></span> Cerita Bisnis
                            </h3>
                            <p class="text-slate-600 leading-relaxed italic text-lg">"{{ $umkm['deskripsi'] }}"</p>
                        </div>

                        {{-- Product List --}}
                        @if (isset($umkm['produk_list']))
                            <div class="pt-6 border-t border-slate-50">
                                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Daftar
                                    Produk:</h4>
                                <div class="grid grid-cols-2 gap-3">
                                    @foreach ($umkm['produk_list'] as $produk)
                                        <div class="flex items-center gap-2 text-xs font-bold text-slate-700">
                                            <i class="bi bi-check2-circle text-amber-500"></i> {{ $produk }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Location & Owner --}}
                        <div class="pt-6 border-t border-slate-50 space-y-4">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                                    <i class="bi bi-geo-alt"></i></div>
                                <div>
                                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">Lokasi
                                        Produksi</p>
                                    <p class="text-sm font-bold text-slate-700">{{ $umkm['lokasi'] }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                                    <i class="bi bi-person"></i></div>
                                <div>
                                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">Pemilik
                                    </p>
                                    <p class="text-sm font-bold text-slate-700 uppercase">{{ $umkm['nama_pemilik'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="space-y-4">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $umkm['telepon']) }}" target="_blank"
                            class="group relative flex items-center justify-center gap-4 px-8 py-6 rounded-[2rem] bg-green-500 text-white shadow-xl shadow-green-200 transition-all hover:bg-green-600 active:scale-95 overflow-hidden w-full">
                            <i class="bi bi-whatsapp text-2xl relative z-10"></i>
                            <span class="text-sm font-black uppercase tracking-[0.2em] relative z-10">Pesan via
                                WhatsApp</span>
                        </a>

                        <div class="flex gap-4">
                            <a href="{{ $umkm['link_instagram'] ?? '#' }}" target="_blank"
                                class="flex-1 flex items-center justify-center gap-3 px-6 py-4 rounded-2xl bg-white border border-slate-200 text-slate-700 hover:border-[#00326B] hover:text-[#00326B] transition-all">
                                <i class="bi bi-instagram"></i>
                                <span class="text-[10px] font-black uppercase tracking-widest">Instagram</span>
                            </a>
                            <button onclick="window.print()"
                                class="w-14 h-14 rounded-2xl bg-slate-50 text-slate-400 hover:bg-slate-100 flex items-center justify-center transition-all">
                                <i class="bi bi-printer text-xl"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer CTA --}}
            <div class="mt-24">
                <div class="bg-[#00326B] rounded-[3.5rem] p-12 lg:p-20 relative overflow-hidden text-center shadow-2xl">
                    <div class="relative z-10 max-w-2xl mx-auto space-y-6">
                        <h2 class="text-3xl lg:text-4xl font-black text-white leading-tight uppercase">
                            Mari Bangga Menggunakan Produk <span class="text-[#fbbf24]">Lokal NTB</span>
                        </h2>
                        <p class="text-blue-200 text-sm font-medium opacity-80 italic">"Dukung UMKM kita untuk terus tumbuh
                            dan menggerakkan ekonomi wilayah."</p>
                        <div class="pt-6">
                            <a href="#"
                                class="inline-flex px-10 py-4 bg-[#fbbf24] text-[#00326B] rounded-full text-xs font-black uppercase tracking-widest hover:bg-white transition-all">
                                Daftarkan UMKM Anda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
