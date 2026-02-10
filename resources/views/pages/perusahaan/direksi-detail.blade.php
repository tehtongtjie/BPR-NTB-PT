@extends('layouts.app')

@section('title', $data['name'])

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <main class="bg-[#F8FAFC] min-h-screen pt-32 lg:pt-44 pb-24 font-sans antialiased relative overflow-hidden">
        {{-- Elemen Dekoratif Latar Belakang --}}
        <div class="absolute top-0 left-0 w-full h-[600px] bg-gradient-to-b from-[#00326B]/5 to-transparent -z-10"></div>
        <div class="absolute top-[10%] -right-24 w-[500px] h-[500px] bg-[#fbbf24]/10 rounded-full blur-[120px] -z-10"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative">

            {{-- Tombol Kembali --}}
            <div class="mb-10">
                <a href="javascript:void(0)" onclick="history.back()"
                    class="inline-flex items-center gap-2 text-[#00326B] font-black uppercase text-[10px] tracking-[0.2em] hover:gap-4 transition-all group">
                    <i class="bi bi-arrow-left text-xl text-[#fbbf24] transition-transform group-hover:-translate-x-1"></i>
                    Kembali
                </a>
            </div>

            {{-- Card Utama --}}
            <div
                class="bg-white rounded-[3rem] lg:rounded-[4rem] shadow-2xl shadow-blue-900/5 border border-gray-100 overflow-hidden relative">
                {{-- Pattern halus --}}
                <div class="absolute inset-0 opacity-[0.015] pointer-events-none"
                    style="background-image: url('https://www.transparenttextures.com/patterns/pinstriped-suit.png');">
                </div>

                <div class="relative z-10 p-8 lg:p-16">
                    <div class="flex flex-col lg:flex-row gap-12 items-start">

                        {{-- SISI KIRI: ICON PLACEHOLDER (Menggantikan Foto) --}}
                        <div class="w-full lg:w-1/3 flex-shrink-0">
                            <div class="relative group">
                                {{-- Kontainer Ikon Pengganti Foto --}}
                                <div
                                    class="relative rounded-[3rem] overflow-hidden shadow-2xl aspect-[3/4] max-w-[280px] mx-auto lg:mx-0 bg-gradient-to-br from-[#00326B] to-[#001D3D] flex flex-col items-center justify-center border-8 border-white group-hover:rotate-1 transition-transform duration-700">

                                    {{-- Decorative Pattern Overlay --}}
                                    <div class="absolute inset-0 opacity-10"
                                        style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 20px 20px;">
                                    </div>

                                    {{-- Icon Section --}}
                                    <div class="relative z-10 text-center">
                                        <div
                                            class="w-24 h-24 bg-white/10 backdrop-blur-xl rounded-[2rem] flex items-center justify-center mx-auto mb-6 border border-white/20 shadow-inner group-hover:scale-110 transition-transform duration-500">
                                            <i class="bi bi-person-vcard text-5xl text-white opacity-90"></i>
                                        </div>

                                        {{-- Inisial Nama --}}
                                        <span
                                            class="block text-4xl font-black text-white/20 uppercase tracking-[0.3em] mb-2">
                                            {{ collect(explode(' ', $data['name']))->map(fn($n) => $n[0])->take(2)->implode('') }}
                                        </span>
                                    </div>

                                    {{-- Floating Verified Badge --}}
                                    <div class="absolute bottom-6 right-6">
                                        <div
                                            class="backdrop-blur-md bg-white/10 border border-white/20 px-3 py-2 rounded-2xl flex items-center gap-2 shadow-xl">
                                            <i class="bi bi-patch-check-fill text-[#fbbf24] text-sm"></i>
                                            <span
                                                class="text-[8px] font-black text-white uppercase tracking-widest">Verified
                                                Leader</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Ornamen di belakang --}}
                                <div
                                    class="absolute -bottom-6 -right-6 w-32 h-32 bg-[#fbbf24]/20 rounded-full blur-3xl -z-10 group-hover:bg-[#fbbf24]/30 transition-colors">
                                </div>
                            </div>

                            {{-- Info Singkat di bawah --}}
                            <div class="mt-10 text-center lg:text-left space-y-5">
                                <div
                                    class="inline-flex items-center gap-3 px-5 py-2.5 rounded-2xl bg-slate-50 text-[#00326B] text-[10px] font-black uppercase tracking-widest border border-slate-100 shadow-sm">
                                    <i class="bi bi-briefcase-fill text-[#fbbf24]"></i>
                                    {{ $data['position'] }}
                                </div>

                                <div class="flex justify-center lg:justify-start items-center gap-4">
                                    <a href="#"
                                        class="w-12 h-12 rounded-2xl bg-white border border-slate-100 flex items-center justify-center text-xl text-slate-400 hover:bg-[#00326B] hover:text-white hover:border-[#00326B] transition-all shadow-sm">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                    <div class="h-[1px] w-8 bg-slate-200"></div>
                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Executive
                                        Network</span>
                                </div>
                            </div>
                        </div>

                        {{-- SISI KANAN: BIO & CONTENT --}}
                        <div class="w-full lg:w-2/3">
                            <div class="mb-10">
                                <div class="flex items-center gap-3 mb-4">
                                    <span class="h-[2px] w-10 bg-[#fbbf24] rounded-full"></span>
                                    <span
                                        class="text-[#00326B] font-black uppercase tracking-[0.4em] text-[10px] lg:text-[11px]">Executive
                                        Biography</span>
                                </div>
                                <h1 class="text-4xl lg:text-5xl font-black text-[#00326B] leading-tight tracking-tight">
                                    {{ $data['name'] }}
                                </h1>
                            </div>

                            {{-- Isi Profil --}}
                            <div class="text-slate-600 text-lg leading-[1.8] font-medium">
                                <div
                                    class="prose prose-slate max-w-none prose-p:mb-6 first-letter:text-6xl first-letter:font-black first-letter:text-[#00326B] first-letter:mr-4 first-letter:float-left first-letter:leading-[0.8] text-justify">
                                    {!! nl2br(e($data['profile'])) !!}
                                </div>
                            </div>

                            {{-- Verified Badge --}}
                            <div class="mt-12 pt-8 border-t border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600">
                                        <i class="bi bi-patch-check-fill"></i>
                                    </div>
                                    <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">Official
                                        Leadership Document — BPR NTB</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Banner Visi Singkat --}}
            <div
                class="mt-12 p-10 bg-[#00326B] rounded-[3rem] text-center text-white relative overflow-hidden shadow-2xl group">
                <div class="absolute inset-0 opacity-10 transition-opacity group-hover:opacity-20"
                    style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 24px 24px;">
                </div>
                <p
                    class="relative z-10 text-blue-100 font-bold italic text-lg lg:text-xl leading-relaxed max-w-3xl mx-auto">
                    "Dedikasi untuk memberikan layanan perbankan terbaik bagi seluruh lapisan masyarakat di Nusa Tenggara
                    Barat."
                </p>
            </div>
        </div>
    </main>

    <style>
        /* Typography Enhancement */
        .prose p {
            text-align: justify;
            hyphens: auto;
            color: #475569;
            /* slate-600 */
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
@endsection
