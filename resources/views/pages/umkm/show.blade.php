@extends('layouts.app')

@section('content')
    <section class="relative pt-28 pb-16 lg:pt-40 lg:pb-24 bg-[#FDFDFD] overflow-hidden">
        {{-- Decorative background yang lebih halus --}}
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
            <div class="absolute top-[-10%] right-[-5%] w-[600px] h-[600px] bg-blue-50 rounded-full blur-[120px] opacity-40">
            </div>
            <div
                class="absolute bottom-[-5%] left-[-5%] w-[400px] h-[400px] bg-amber-50 rounded-full blur-[100px] opacity-30">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative">
            {{-- Breadcrumb & Back Navigation --}}
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

                {{-- KIRI: Visual Showcase --}}
                <div class="lg:col-span-7 space-y-6">
                    <div class="relative group">
                        {{-- Efek Glow di belakang foto --}}
                        <div
                            class="absolute -inset-1 bg-gradient-to-tr from-[#00326B] to-[#fbbf24] rounded-[3rem] blur opacity-10 group-hover:opacity-20 transition duration-1000">
                        </div>

                        <div
                            class="relative aspect-[16/10] rounded-[3rem] overflow-hidden shadow-2xl border-[12px] border-white bg-white">
                            <img src="{{ asset($umkm['foto']) }}"
                                class="w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-110"
                                alt="{{ $umkm['nama_usaha'] }}"
                                onerror="this.src='https://via.placeholder.com/800x500?text=Produk+UMKM'">

                            {{-- Floating Badge --}}
                            <div class="absolute bottom-8 right-8">
                                <div
                                    class="backdrop-blur-xl bg-white/90 p-4 rounded-[2rem] shadow-xl border border-white/50 flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-[#00326B]">
                                        <i class="bi bi-award-fill text-2xl"></i>
                                    </div>
                                    <div>
                                        <p
                                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">
                                            Status Mitra</p>
                                        <p class="text-xs font-black text-[#00326B] uppercase leading-none">Terverifikasi
                                            BPR NTB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Mini Gallery / Trust Badges --}}
                    <div class="grid grid-cols-3 gap-4">
                        <div
                            class="h-24 rounded-2xl bg-white border border-slate-100 shadow-sm flex items-center justify-center p-4 text-center">
                            <div class="space-y-1">
                                <i class="bi bi-shield-check text-blue-500"></i>
                                <p class="text-[8px] font-black uppercase text-slate-400">Produk Aman</p>
                            </div>
                        </div>
                        <div
                            class="h-24 rounded-2xl bg-white border border-slate-100 shadow-sm flex items-center justify-center p-4 text-center">
                            <div class="space-y-1">
                                <i class="bi bi-heart-fill text-red-500"></i>
                                <p class="text-[8px] font-black uppercase text-slate-400">Kualitas Lokal</p>
                            </div>
                        </div>
                        <div
                            class="h-24 rounded-2xl bg-white border border-slate-100 shadow-sm flex items-center justify-center p-4 text-center">
                            <div class="space-y-1">
                                <i class="bi bi-truck text-amber-500"></i>
                                <p class="text-[8px] font-black uppercase text-slate-400">Siap Antar</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KANAN: Detail & Kontrak --}}
                <div class="lg:col-span-5 space-y-10">
                    <div class="space-y-4">
                        <div class="inline-flex items-center gap-3">
                            <span
                                class="px-4 py-1.5 rounded-full bg-blue-50 text-[#00326B] text-[10px] font-black uppercase tracking-widest border border-blue-100">
                                {{ $umkm['bidang_usaha'] ?? 'UMKM Unggulan' }}
                            </span>
                            <span class="w-2 h-2 rounded-full bg-[#fbbf24] animate-pulse"></span>
                        </div>
                        <h1 class="text-5xl lg:text-6xl font-black text-[#00326B] leading-[1.1] tracking-tighter">
                            {{ $umkm['nama_usaha'] }}
                        </h1>
                        <div class="flex items-center gap-3 py-2">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-tr from-slate-100 to-white border border-slate-200 flex items-center justify-center text-slate-400">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <p
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">
                                    Pemilik Usaha</p>
                                <p class="text-sm font-bold text-slate-700 uppercase leading-none">
                                    {{ $umkm['nama_pemilik'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="p-8 bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50">
                            <h3
                                class="text-[11px] font-black text-[#00326B] uppercase tracking-[0.3em] mb-6 flex items-center gap-3">
                                <span class="h-1 w-8 bg-[#fbbf24] rounded-full"></span>
                                Cerita Bisnis
                            </h3>
                            <p class="text-slate-600 leading-relaxed italic text-lg mb-8">
                                "{{ $umkm['deskripsi'] }}"
                            </p>

                            <div class="grid grid-cols-1 gap-6 pt-6 border-t border-slate-50">
                                <div class="flex items-start gap-4 group">
                                    <div
                                        class="w-12 h-12 shrink-0 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center group-hover:bg-red-500 group-hover:text-white transition-all">
                                        <i class="bi bi-geo-alt-fill text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">
                                            Workshop & Lokasi</p>
                                        <p class="text-sm font-bold text-slate-700">{{ $umkm['lokasi'] }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4 group">
                                    <div
                                        class="w-12 h-12 shrink-0 bg-green-50 text-green-500 rounded-2xl flex items-center justify-center group-hover:bg-green-500 group-hover:text-white transition-all">
                                        <i class="bi bi-whatsapp text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">
                                            Saluran Komunikasi</p>
                                        <p class="text-sm font-bold text-slate-700">{{ $umkm['telepon'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- CTA Section --}}
                    <div class="flex flex-col gap-4">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $umkm['telepon']) }}" target="_blank"
                            class="group relative flex items-center justify-center gap-4 px-8 py-6 rounded-[2rem] bg-green-500 text-white shadow-xl shadow-green-200 transition-all hover:bg-green-600 active:scale-95 overflow-hidden">
                            <div
                                class="absolute inset-0 bg-white/10 translate-y-full group-hover:translate-y-0 transition-transform duration-500">
                            </div>
                            <i class="bi bi-whatsapp text-2xl relative z-10"></i>
                            <span class="text-sm font-black uppercase tracking-[0.2em] relative z-10">Pesan Sekarang via
                                WhatsApp</span>
                        </a>

                        <div class="flex gap-4">
                            <a href="{{ $umkm['link_instagram'] ?? '#' }}"
                                class="flex-1 flex items-center justify-center gap-3 px-6 py-4 rounded-2xl bg-white border border-slate-200 text-slate-700 hover:border-[#00326B] hover:text-[#00326B] transition-all">
                                <i class="bi bi-instagram"></i>
                                <span class="text-[10px] font-black uppercase tracking-widest">Instagram</span>
                            </a>
                            <button onclick="window.print()"
                                class="w-14 h-14 rounded-2xl bg-slate-50 text-slate-400 hover:bg-slate-100 transition-all">
                                <i class="bi bi-printer"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Rekomendasi / Footer CTA --}}
            <div class="mt-24">
                <div
                    class="bg-[#00326B] rounded-[3.5rem] p-12 lg:p-20 relative overflow-hidden text-center shadow-[0_30px_60px_-15px_rgba(0,50,107,0.4)]">
                    {{-- Decorative pattern --}}
                    <div class="absolute inset-0 opacity-10"
                        style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 30px 30px;">
                    </div>

                    <div class="relative z-10 max-w-2xl mx-auto space-y-6">
                        <div
                            class="inline-block px-4 py-1 rounded-full bg-white/10 text-amber-400 text-[10px] font-black uppercase tracking-[0.3em] mb-4">
                            Dukung Ekonomi Lokal
                        </div>
                        <h2 class="text-3xl lg:text-4xl font-black text-white leading-tight uppercase">
                            Mari Bangga Menggunakan Produk <span class="text-[#fbbf24]">Lokal NTB</span>
                        </h2>
                        <p class="text-blue-200 text-sm font-medium leading-relaxed opacity-80 italic">
                            "Setiap transaksi Anda adalah energi baru bagi UMKM untuk terus berinovasi dan membuka lapangan
                            kerja di wilayah kita."
                        </p>
                        <div class="pt-6">
                            <a href="/kontak"
                                class="inline-flex px-10 py-4 bg-[#fbbf24] text-[#00326B] rounded-full text-xs font-black uppercase tracking-widest hover:bg-white hover:scale-105 transition-all">
                                Daftarkan UMKM Anda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .animate-fade-in {
            animation: fadeIn 1s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
