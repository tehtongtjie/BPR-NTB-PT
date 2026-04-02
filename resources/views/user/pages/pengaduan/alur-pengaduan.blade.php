@extends('user.layouts.app')

@section('title', 'Alur Pengaduan Nasabah - BPR NTB')

@vite(['resources/css/app.css'])

@section('content')
    <main class="bg-[#F8FAFC] min-h-screen pt-32 lg:pt-44 pb-24 font-sans antialiased relative overflow-hidden">
        {{-- Decorative Background Elements --}}
        <div class="absolute top-0 left-0 w-full h-[600px] bg-gradient-to-b from-[#00326B]/5 to-transparent -z-10"></div>
        <div class="absolute top-[10%] -right-24 w-[500px] h-[500px] bg-[#fbbf24]/10 rounded-full blur-[120px] -z-10"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div
                class="bg-white rounded-[3rem] lg:rounded-[4rem] shadow-2xl shadow-blue-900/5 border border-gray-100 overflow-hidden relative">
                {{-- Pinstripe Pattern Overlay --}}
                <div class="absolute inset-0 opacity-[0.015] pointer-events-none"
                    style="background-image: url('https://www.transparenttextures.com/patterns/pinstriped-suit.png');">
                </div>

                <div class="p-8 md:p-16 relative z-10">

                    {{-- HEADER --}}
                    <div class="text-center mb-16">
                        <div
                            class="inline-flex items-center gap-3 px-6 py-2 rounded-full bg-blue-50 text-[#00326B] text-[10px] font-black uppercase tracking-[0.4em] mb-6 border border-blue-100">
                            <i class="bi bi-shield-check text-[#fbbf24]"></i> Consumer Protection
                        </div>
                        <h1 class="text-3xl lg:text-5xl font-black text-[#00326B] leading-tight tracking-tight mb-4">
                            Alur Pengaduan Nasabah
                        </h1>
                        <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">PT. BPR NTB (Perseroda)</p>
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="max-w-3xl mx-auto text-center mb-16">
                        <p class="text-slate-600 text-lg lg:text-xl leading-relaxed font-medium italic">
                            "Komitmen kami dalam menjaga kualitas layanan, transparansi, serta perlindungan terhadap hak
                            nasabah melalui prosedur pengaduan yang terstandarisasi."
                        </p>
                    </div>

                    {{-- GAMBAR ALUR --}}
                    <div class="relative group mb-20">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-[#00326B] to-[#fbbf24] rounded-[2.5rem] blur opacity-20 group-hover:opacity-40 transition duration-1000">
                        </div>
                        <div class="relative bg-white p-4 rounded-[2.5rem] border border-gray-100 shadow-xl">
                            <img src="{{ public_image_url('storage/images/alur-pengaduan.png') }}" alt="Alur Pengaduan Nasabah"
                                class="w-full h-auto rounded-[2rem]">
                        </div>
                    </div>

                    {{-- LANGKAH-LANGKAH --}}
                    <div class="space-y-12">
                        <div class="flex items-center gap-6">
                            <h2 class="text-[#00326B] font-black text-xl lg:text-2xl tracking-tighter uppercase">Tahapan
                                Pengaduan</h2>
                            <div class="h-px flex-grow bg-slate-100"></div>
                        </div>

                        <div class="grid gap-6">
                            @php
                                $steps = [
                                    [
                                        'icon' => 'bi-chat-dots-fill',
                                        'text' =>
                                            'Nasabah menyampaikan pengaduan melalui sarana komunikasi resmi PT. BPR NTB (Perseroda).',
                                    ],
                                    [
                                        'icon' => 'bi-shield-check',
                                        'text' =>
                                            'Petugas melakukan verifikasi identitas dan pemeriksaan kesesuaian data nasabah.',
                                    ],
                                    [
                                        'icon' => 'bi-clipboard-check',
                                        'text' =>
                                            'Pengaduan dicatat ke dalam sistem dan diproses sesuai klasifikasi permasalahan.',
                                    ],
                                    [
                                        'icon' => 'bi-receipt',
                                        'text' =>
                                            'Nasabah menerima tanda terima resmi pengaduan sebagai bukti registrasi.',
                                    ],
                                    [
                                        'icon' => 'bi-gear-fill',
                                        'text' =>
                                            'Petugas menindaklanjuti dan memberikan solusi dalam jangka waktu yang ditetapkan.',
                                    ],
                                ];
                            @endphp

                            @foreach ($steps as $index => $step)
                                <div
                                    class="group flex gap-6 lg:gap-8 p-6 lg:p-8 rounded-[2.5rem] bg-[#F8FAFC] border border-gray-100 transition-all hover:bg-white hover:shadow-xl">
                                    <div
                                        class="flex-shrink-0 w-14 h-14 lg:w-16 lg:h-16 bg-[#00326B] text-[#fbbf24] rounded-2xl flex items-center justify-center text-2xl shadow-lg group-hover:scale-110 transition-transform">
                                        <i class="bi {{ $step['icon'] }}"></i>
                                    </div>
                                    <div class="pt-1">
                                        <span
                                            class="text-blue-600 font-black text-[10px] uppercase tracking-widest block mb-1 opacity-50">Step
                                            {{ sprintf('%02d', $index + 1) }}</span>
                                        <p class="text-slate-700 text-base lg:text-lg font-bold leading-snug">
                                            {{ $step['text'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- DOKUMEN --}}
                    <div class="mt-20">
                        <div class="flex items-center gap-6 mb-10">
                            <h2 class="text-[#00326B] font-black text-xl lg:text-2xl tracking-tighter uppercase">Dokumen
                                Pendukung</h2>
                            <div class="h-px flex-grow bg-slate-100"></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div
                                class="p-8 rounded-[2.5rem] bg-white border border-gray-100 shadow-sm hover:shadow-xl transition-all text-center group">
                                <div
                                    class="w-14 h-14 bg-slate-50 text-[#00326B] rounded-2xl flex items-center justify-center text-2xl mx-auto mb-6 group-hover:bg-[#00326B] group-hover:text-[#fbbf24] transition-all">
                                    <i class="bi bi-person-vcard"></i>
                                </div>
                                <h4 class="text-sm font-black text-[#00326B] uppercase tracking-wider leading-tight">
                                    Identitas Diri Nasabah / Perwakilan</h4>
                            </div>

                            <div
                                class="p-8 rounded-[2.5rem] bg-white border border-gray-100 shadow-sm hover:shadow-xl transition-all text-center group">
                                <div
                                    class="w-14 h-14 bg-slate-50 text-[#00326B] rounded-2xl flex items-center justify-center text-2xl mx-auto mb-6 group-hover:bg-[#00326B] group-hover:text-[#fbbf24] transition-all">
                                    <i class="bi bi-bank"></i>
                                </div>
                                <h4 class="text-sm font-black text-[#00326B] uppercase tracking-wider leading-tight">Bukti
                                    Kepemilikan (Buku Tabungan)</h4>
                            </div>

                            <div
                                class="p-8 rounded-[2.5rem] bg-white border border-gray-100 shadow-sm hover:shadow-xl transition-all text-center group">
                                <div
                                    class="w-14 h-14 bg-slate-50 text-[#00326B] rounded-2xl flex items-center justify-center text-2xl mx-auto mb-6 group-hover:bg-[#00326B] group-hover:text-[#fbbf24] transition-all">
                                    <i class="bi bi-file-earmark-text"></i>
                                </div>
                                <h4 class="text-sm font-black text-[#00326B] uppercase tracking-wider leading-tight">Dokumen
                                    Transaksi (Slip/Resi/Bukti)</h4>
                            </div>
                        </div>
                    </div>

                    {{-- JANGKA WAKTU --}}
                    <div
                        class="mt-20 p-10 lg:p-14 bg-[#00326B] rounded-[3.5rem] text-white relative overflow-hidden shadow-2xl">
                        <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-[#fbbf24]/10 rounded-full blur-[100px]"></div>

                        <div class="relative z-10">
                            <h2 class="text-2xl lg:text-3xl font-black tracking-tight mb-10 flex items-center gap-4">
                                <i class="bi bi-clock-history text-[#fbbf24]"></i> Jangka Waktu Penyelesaian
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-16">
                                <div class="border-l-2 border-[#fbbf24]/30 pl-6">
                                    <span
                                        class="text-[#fbbf24] font-black text-[10px] uppercase tracking-[0.3em] block mb-2">Pengaduan
                                        Lisan</span>
                                    <p class="text-xl font-bold">Maksimal 5 Hari Kerja</p>
                                </div>
                                <div class="border-l-2 border-[#fbbf24]/30 pl-6">
                                    <span
                                        class="text-[#fbbf24] font-black text-[10px] uppercase tracking-[0.3em] block mb-2">Pengaduan
                                        Tertulis</span>
                                    <p class="text-xl font-bold">Maksimal 10 Hari Kerja</p>
                                </div>
                            </div>

                            <div class="mt-12 p-6 bg-white/5 rounded-2xl border border-white/10 backdrop-blur-sm">
                                <p class="text-blue-100/70 text-sm italic">
                                    *Apabila belum tercapai kesepakatan dalam jangka waktu tersebut, nasabah dapat
                                    melanjutkan penyelesaian sengketa melalui LAPS atau Pengadilan.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- CTA --}}
                    <div class="mt-20 text-center">
                        <a href="{{ route('pengaduan.wbs') }}"
                            class="inline-flex items-center gap-4 bg-[#fbbf24] text-[#00326B] px-10 py-5 rounded-2xl font-black uppercase text-xs tracking-[0.2em] shadow-xl shadow-yellow-500/20 hover:scale-105 transition-all active:scale-95">
                            <i class="bi bi-megaphone-fill text-xl"></i>
                            Sampaikan Pengaduan Sekarang
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
        }
    </style>
@endsection
