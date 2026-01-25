{{-- Menginduk ke layout utama anda --}}
@extends('layouts.app')

@section('content')
    <section class="relative pt-28 pb-16 lg:pt-40 lg:pb-24 bg-white overflow-hidden">
        {{-- Decorative Background Elements --}}
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
            <div class="absolute top-[-10%] right-[-5%] w-[400px] h-[400px] bg-blue-50 rounded-full blur-[100px] opacity-60">
            </div>
            <div
                class="absolute bottom-[-10%] left-[-5%] w-[300px] h-[300px] bg-amber-50 rounded-full blur-[80px] opacity-40">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative">
            {{-- Header Section --}}
            <div class="max-w-3xl mx-auto text-center mb-16">
                <div class="inline-flex items-center gap-3 mb-4">
                    <span class="h-[1px] w-12 bg-[#fbbf24]"></span>
                    <span class="text-[11px] font-black uppercase tracking-[0.4em] text-[#00326B]">Local Empowerment</span>
                    <span class="h-[1px] w-12 bg-[#fbbf24]"></span>
                </div>
                <h2 class="text-4xl lg:text-5xl font-black text-[#00326B] leading-tight mb-6">
                    Mitra UMKM <span class="italic font-light text-[#fbbf24]">Binaan</span>
                </h2>
                <p class="text-slate-500 text-lg leading-relaxed italic">
                    "Mendorong pertumbuhan ekonomi lokal melalui dukungan berkelanjutan bagi pengusaha kreatif di Nusa
                    Tenggara Barat."
                </p>
            </div>

            {{-- Grid UMKM --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($umkms as $umkm)
                    <div
                        class="group relative flex flex-col h-full bg-white rounded-[2.5rem] shadow-xl shadow-blue-900/5 border border-slate-100 overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-blue-900/10 hover:-translate-y-2">

                        {{-- Bagian Gambar --}}
                        <div class="relative aspect-[4/3] overflow-hidden">
                            <img src="{{ asset($umkm['foto']) }}"
                                class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                                alt="{{ $umkm['nama_usaha'] }}"
                                onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">

                            {{-- Badge Verifikasi --}}
                            <div class="absolute top-5 left-5">
                                <span
                                    class="backdrop-blur-md bg-white/80 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest text-[#00326B] shadow-sm border border-white/20 flex items-center gap-2">
                                    <i class="bi bi-patch-check-fill text-blue-500"></i> Mitra Terverifikasi
                                </span>
                            </div>
                        </div>

                        {{-- Bagian Konten --}}
                        <div class="p-8 flex flex-col flex-grow">
                            <h5
                                class="text-xl font-black text-[#00326B] mb-1 text-capitalize leading-tight group-hover:text-blue-600 transition-colors">
                                {{ $umkm['nama_usaha'] }}
                            </h5>
                            <p class="text-[#fbbf24] text-[11px] font-black uppercase tracking-widest mb-4">
                                <i class="bi bi-person-circle me-1"></i> {{ $umkm['nama_pemilik'] }}
                            </p>

                            <div class="space-y-2 mb-6">
                                <div class="flex items-start gap-3 text-slate-500">
                                    <i class="bi bi-geo-alt-fill text-red-500 text-sm"></i>
                                    <span class="text-xs font-medium italic leading-relaxed">{{ $umkm['lokasi'] }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-slate-500">
                                    <i class="bi bi-telephone-fill text-green-500 text-sm"></i>
                                    <span class="text-xs font-medium italic">{{ $umkm['telepon'] }}</span>
                                </div>
                            </div>

                            <p class="text-slate-500 text-sm leading-relaxed italic line-clamp-3 mb-8">
                                "{{ $umkm['deskripsi'] }}"
                            </p>

                            {{-- Action Buttons --}}
                            <div class="mt-auto flex gap-3">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $umkm['telepon']) }}" target="_blank"
                                    class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-green-500 text-white text-xs font-black uppercase tracking-widest transition-all hover:bg-green-600 hover:shadow-lg active:scale-95">
                                    <i class="bi bi-whatsapp"></i> Chat
                                </a>
                                <a href="#"
                                    class="flex-1 inline-flex items-center justify-center px-6 py-3 rounded-2xl bg-slate-50 text-[#00326B] text-xs font-black uppercase tracking-widest transition-all hover:bg-[#00326B] hover:text-white active:scale-95">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- State Kosong --}}
                    <div
                        class="col-span-full flex flex-col items-center justify-center py-20 bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200">
                        <div
                            class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center text-slate-300 shadow-sm mb-6">
                            <i class="bi bi-shop text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-[#00326B]">Belum Ada Data</h3>
                        <p class="text-slate-400 italic">Daftar mitra UMKM binaan belum tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
