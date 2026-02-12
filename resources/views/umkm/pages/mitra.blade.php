@extends('umkm.layouts.app')

@section('title', 'Mitra UMKM Hebat - PT. BPR NTB')

@section('content')
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 bg-[#FDFDFD] overflow-hidden">
        {{-- Decorative Background Elements --}}
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
            <div
                class="absolute top-[-10%] right-[-5%] w-[600px] h-[600px] bg-blue-50 rounded-full blur-[120px] opacity-60 animate-pulse">
            </div>
            <div
                class="absolute bottom-[-10%] left-[-5%] w-[400px] h-[400px] bg-amber-50 rounded-full blur-[100px] opacity-40">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative">
            {{-- Header Section --}}
            <div class="max-w-4xl mx-auto text-center mb-20">
                <div class="inline-flex items-center gap-4 mb-6">
                    <span class="h-[2px] w-8 bg-[#fbbf24] rounded-full"></span>
                    <span class="text-[12px] font-black uppercase tracking-[0.5em] text-[#00326B]">Local Pride &
                        Empowerment</span>
                    <span class="h-[2px] w-8 bg-[#fbbf24] rounded-full"></span>
                </div>
                <h2 class="text-5xl lg:text-7xl font-black text-[#00326B] leading-[1.1] mb-8 tracking-tighter">
                    Mitra UMKM <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-[#fbbf24] to-amber-500">Hebat</span> NTB
                </h2>
                <p class="text-slate-500 text-xl leading-relaxed max-w-2xl mx-auto font-medium italic opacity-80">
                    "Etalase karya pengusaha lokal binaan PT. BPR NTB yang mengedepankan kualitas, kreativitas, dan kearifan
                    budaya Sasak, Samawa, & Mbojo."
                </p>
            </div>

            {{-- Filter Kategori --}}
            <div class="flex flex-wrap justify-center gap-4 mb-16">
                <button
                    class="px-8 py-3 rounded-full bg-[#00326B] text-white text-xs font-black uppercase tracking-widest shadow-xl shadow-blue-900/20 hover:scale-105 transition-all">
                    Semua Produk
                </button>
                <button
                    class="px-8 py-3 rounded-full bg-white border border-slate-100 text-slate-400 text-xs font-black uppercase tracking-widest hover:bg-slate-50 hover:text-[#00326B] transition-all">
                    Kuliner
                </button>
                <button
                    class="px-8 py-3 rounded-full bg-white border border-slate-100 text-slate-400 text-xs font-black uppercase tracking-widest hover:bg-slate-50 hover:text-[#00326B] transition-all">
                    Kerajinan
                </button>
                <button
                    class="px-8 py-3 rounded-full bg-white border border-slate-100 text-slate-400 text-xs font-black uppercase tracking-widest hover:bg-slate-50 hover:text-[#00326B] transition-all">
                    Fashion
                </button>
            </div>

            {{-- Grid UMKM --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse ($umkms as $umkm)
                    <div
                        class="group relative flex flex-col h-full bg-white rounded-[3rem] shadow-2xl shadow-slate-200/60 border border-white overflow-hidden transition-all duration-700 hover:-translate-y-4">

                        {{-- Bagian Gambar --}}
                        <div class="relative aspect-[4/5] overflow-hidden">
                            <img src="{{ asset($umkm['foto']) }}"
                                class="w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-110"
                                alt="{{ $umkm['nama_usaha'] }}"
                                onerror="this.src='https://via.placeholder.com/600x800?text=Karya+Lokal'">

                            {{-- Overlay Gradasi --}}
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-[#00326B]/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>

                            {{-- Badge Verifikasi --}}
                            <div class="absolute top-6 left-6">
                                <div
                                    class="backdrop-blur-xl bg-white/90 px-5 py-2 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] text-[#00326B] shadow-2xl flex items-center gap-2 border border-white/50">
                                    <div class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></div>
                                    Mitra Terverifikasi
                                </div>
                            </div>
                        </div>

                        {{-- Bagian Konten --}}
                        <div class="p-10 flex flex-col flex-grow relative bg-white">
                            {{-- Floating Icon --}}
                            <div
                                class="absolute -top-8 right-10 w-16 h-16 bg-[#fbbf24] rounded-2xl shadow-xl flex items-center justify-center text-[#00326B] group-hover:rotate-12 transition-transform duration-500 border-4 border-white">
                                <i class="bi bi-shop-window text-2xl"></i>
                            </div>

                            <div class="mb-6">
                                <h5
                                    class="text-2xl font-black text-[#00326B] mb-2 tracking-tight group-hover:text-blue-600 transition-colors">
                                    {{ $umkm['nama_usaha'] }}
                                </h5>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="px-3 py-1 bg-blue-50 text-[#00326B] text-[9px] font-black uppercase tracking-widest rounded-md italic">
                                        Owner: {{ $umkm['nama_pemilik'] }}
                                    </span>
                                </div>
                            </div>

                            <div class="space-y-3 mb-8">
                                <div class="flex items-start gap-3 text-slate-400">
                                    <i class="bi bi-geo-alt-fill text-[#fbbf24]"></i>
                                    <span
                                        class="text-xs font-bold uppercase tracking-wider leading-relaxed">{{ $umkm['lokasi'] }}</span>
                                </div>
                                <p class="text-slate-500 text-sm leading-relaxed italic line-clamp-2">
                                    "{{ $umkm['deskripsi'] }}"
                                </p>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="mt-auto flex gap-4 pt-6 border-t border-slate-50">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $umkm['telepon']) }}" target="_blank"
                                    class="flex-1 inline-flex items-center justify-center gap-3 px-6 py-4 rounded-2xl bg-[#25D366] text-white text-[10px] font-black uppercase tracking-[0.2em] transition-all hover:bg-[#128C7E] hover:shadow-xl hover:shadow-green-200 active:scale-95">
                                    <i class="bi bi-whatsapp text-lg"></i> Hubungi
                                </a>
                                <a href="{{ route('umkm.mitra.detail', $umkm['slug']) }}"
                                    class="flex-1 inline-flex items-center justify-center px-6 py-4 rounded-2xl bg-slate-900 text-white text-[10px] font-black uppercase tracking-[0.2em] transition-all hover:bg-[#00326B] hover:shadow-xl active:scale-95">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- State Kosong --}}
                    <div
                        class="col-span-full flex flex-col items-center justify-center py-32 bg-white rounded-[4rem] shadow-inner border border-slate-50">
                        <div
                            class="w-32 h-32 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 mb-8 border-4 border-dashed border-slate-100">
                            <i class="bi bi-inboxes text-5xl"></i>
                        </div>
                        <h3 class="text-2xl font-black text-[#00326B] uppercase tracking-widest">Katalog Kosong</h3>
                        <p class="text-slate-400 italic mt-2">Mohon kembali lagi nanti untuk melihat mitra terbaru kami.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
