@extends('user.layouts.app')

@section('title', 'Perusahaan - ' . ucfirst(str_replace('-', ' ', $slug)))

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <style>
        :root {
            --color-bpr-blue: #00326B;
            --color-bpr-gold: #fbbf24;
            --color-bpr-light: #F8FAFC;
        }

        .text-bpr-blue {
            color: var(--color-bpr-blue);
        }

        .bg-bpr-blue {
            background-color: var(--color-bpr-blue);
        }

        .bg-bpr-gold {
            background-color: var(--color-bpr-gold);
        }

        .glass-premium {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>

    <main class="bg-[#F8FAFC] min-h-screen pt-28 lg:pt-44 pb-24 font-sans antialiased relative overflow-hidden">
        {{-- Decorative Background --}}
        <div class="absolute top-0 left-0 w-full h-[600px] bg-gradient-to-b from-[#00326B]/5 to-transparent -z-10"></div>
        <div class="absolute top-[10%] -right-24 w-[500px] h-[500px] bg-[#fbbf24]/10 rounded-full blur-[120px] -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="flex flex-col lg:flex-row gap-12">

                {{-- ================= SIDEBAR (Order 2 on Mobile) ================= --}}
                <aside class="w-full lg:w-1/4 order-2 lg:order-1">
                    <div class="lg:sticky lg:top-36 space-y-8">
                        <div class="bg-white rounded-[2.5rem] p-2 shadow-xl shadow-blue-900/5 border border-gray-100">
                            @include('user.components.sidebar-perusahaan')
                        </div>

                        {{-- Support Card --}}
                        <div class="relative overflow-hidden bg-bpr-blue rounded-[2.5rem] p-8 text-white shadow-2xl group">
                            <div
                                class="absolute -top-10 -right-10 w-32 h-32 bg-bpr-gold/20 rounded-full blur-2xl transition-transform group-hover:scale-150">
                            </div>
                            <div class="relative z-10">
                                <h4 class="font-bold text-xl mb-2 tracking-tight">Butuh Bantuan?</h4>
                                <p class="text-blue-100/70 text-[10px] mb-8 uppercase tracking-[0.2em] font-black">Layanan
                                    Informasi Korporasi</p>
                                <a href="{{ url('/') }}#kontak"
                                    class="inline-flex h-12 w-12 items-center justify-center bg-bpr-gold text-bpr-blue rounded-xl shadow-lg hover:scale-110 transition-transform">
                                    <i class="bi bi-chat-left-dots-fill text-xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </aside>

                {{-- ================= CONTENT AREA (Order 1 on Mobile) ================= --}}
                <div class="w-full lg:w-3/4 order-1 lg:order-2">
                    <div
                        class="bg-white rounded-[3rem] lg:rounded-[4rem] shadow-2xl shadow-blue-900/5 border border-gray-100 overflow-hidden relative">
                        <div class="absolute inset-0 opacity-[0.015] pointer-events-none"
                            style="background-image: url('https://www.transparenttextures.com/patterns/pinstriped-suit.png');">
                        </div>

                        <div class="p-8 md:p-16 relative z-10">

                            @php
                                $headerImageUrl = null;
                                if (!empty($data['image'])) {
                                    $image = (string) $data['image'];
                                    if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
                                        $headerImageUrl = $image;
                                    } elseif (str_starts_with($image, 'storage/')) {
                                        $headerImageUrl = Storage::url($image);
                                    } else {
                                        $headerImageUrl = asset($image);
                                    }
                                }
                            @endphp

                            {{-- Header Condition --}}
                            @if ($headerImageUrl)
                                <div
                                    class="relative rounded-[2.5rem] lg:rounded-[3.5rem] overflow-hidden mb-12 group shadow-2xl border-4 border-white">
                                    <img src="{{ $headerImageUrl }}"
                                        class="w-full h-72 lg:h-[500px] object-cover transition-transform duration-1000 group-hover:scale-105"
                                        alt="Header">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-bpr-blue/80 via-transparent to-transparent">
                                    </div>
                                    <div class="absolute bottom-8 left-8">
                                        <div
                                            class="glass-premium px-6 py-3 rounded-2xl text-bpr-blue flex items-center gap-3">
                                            <span class="flex h-2 w-2 relative">
                                                <span
                                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                                <span
                                                    class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                            </span>
                                            <span class="text-[10px] font-black uppercase tracking-[0.3em]">Company
                                                Insights</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-12">
                                    <div class="flex items-center gap-4 mb-6">
                                        <span class="h-[3px] w-12 bg-bpr-gold rounded-full"></span>
                                        <span
                                            class="text-bpr-blue font-black uppercase tracking-[0.4em] text-[11px]">{{ $data['subtitle'] ?? 'BPR NTB' }}</span>
                                    </div>
                                    <h1 class="text-4xl lg:text-6xl font-black text-bpr-blue leading-[1.1] tracking-tight">
                                        {{ $data['title'] ?? '' }}</h1>
                                </div>
                            @else
                                <div class="text-center mb-16">
                                    <div
                                        class="inline-flex items-center gap-3 px-6 py-2 rounded-full bg-blue-50 text-bpr-blue text-[10px] font-black uppercase tracking-[0.4em] mb-6 border border-blue-100">
                                        <i class="bi bi-diagram-3-fill text-bpr-gold"></i> Structure
                                    </div>
                                    <h1 class="text-4xl lg:text-7xl font-black text-bpr-blue tracking-tight mb-6">
                                        {{ $slug === 'komisaris' ? 'Dewan Komisaris' : ($slug === 'direksi' ? 'Dewan Direksi' : ($slug === 'tata-kelola' ? 'Tata Kelola' : 'Budaya')) }}
                                    </h1>
                                    <div class="flex justify-center items-center gap-3">
                                        <span class="w-16 h-[4px] bg-bpr-gold rounded-full"></span>
                                        <span class="w-2 h-2 bg-bpr-blue/20 rounded-full"></span>
                                    </div>
                                </div>
                            @endif

                            {{-- CONTENT LOGIC --}}
                            <div class="text-slate-600 text-lg lg:text-xl leading-[1.8] font-medium space-y-10">

                                {{-- 1. UMUM (Sejarah, dll) --}}
                                @if (isset($data['content']) && is_array($data['content']))
                                    @foreach ($data['content'] as $paragraph)
                                        <p
                                            class="first-letter:text-6xl lg:first-letter:text-7xl first-letter:font-black first-letter:text-bpr-blue first-letter:mr-4 first-letter:float-left text-justify">
                                            {{ $paragraph }}</p>
                                    @endforeach

                                    @if (isset($data['shareholders']))
                                        <div
                                            class="mt-16 bg-slate-50 rounded-[3rem] p-2 border border-slate-100 shadow-inner">
                                            <div class="bg-white rounded-[2.8rem] p-10 lg:p-14 shadow-sm">
                                                <h5
                                                    class="flex items-center gap-4 text-bpr-blue font-black text-[11px] uppercase tracking-widest mb-8">
                                                    <span
                                                        class="w-12 h-12 bg-bpr-blue text-bpr-gold rounded-2xl flex items-center justify-center text-xl shadow-lg"><i
                                                            class="bi bi-pie-chart-fill"></i></span>
                                                    Structure of Ownership
                                                </h5>
                                                <p
                                                    class="text-bpr-blue text-xl lg:text-2xl font-bold leading-snug border-l-4 border-bpr-gold pl-8 py-2 italic">
                                                    {{ $data['shareholders'] }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- 2. VISI & MISI --}}
                                @elseif ($slug === 'visi-misi')
                                    <div class="space-y-20">
                                        <div
                                            class="relative p-12 lg:p-20 rounded-[3.5rem] bg-bpr-blue text-white overflow-hidden shadow-2xl">
                                            <div
                                                class="absolute -top-24 -right-24 w-80 h-80 bg-bpr-gold/10 rounded-full blur-[100px]">
                                            </div>
                                            <div class="relative z-10 text-center">
                                                <span
                                                    class="text-bpr-gold font-black uppercase tracking-[0.5em] text-[11px] mb-8 block text-center">Vision
                                                    Statement</span>
                                                <blockquote
                                                    class="text-2xl lg:text-4xl font-bold leading-relaxed italic max-w-4xl mx-auto">
                                                    "{{ $data['visi'] }}"</blockquote>
                                            </div>
                                        </div>
                                        <div class="grid gap-10">
                                            <div class="flex items-center gap-6">
                                                <h5
                                                    class="text-bpr-blue font-black text-xs uppercase tracking-[0.4em] whitespace-nowrap">
                                                    Strategic Missions</h5>
                                                <div class="h-px w-full bg-slate-200"></div>
                                            </div>
                                            <div class="grid lg:grid-cols-2 gap-6">
                                                @foreach ($data['misi'] as $index => $item)
                                                    <div
                                                        class="group p-10 rounded-[2.5rem] bg-slate-50 border border-slate-100 transition-all hover:bg-white hover:shadow-xl hover:border-bpr-gold/30">
                                                        <div
                                                            class="text-4xl font-black text-bpr-blue/10 mb-4 group-hover:text-bpr-gold transition-colors">
                                                            {{ sprintf('%02d', $index + 1) }}</div>
                                                        <p class="text-slate-700 text-lg font-bold leading-relaxed">
                                                            {{ $item }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    {{-- 3. BUDAYA PERUSAHAAN --}}
                                @elseif ($slug === 'budaya')
                                    <div class="space-y-12">
                                        <div class="prose prose-blue max-w-none text-slate-600 text-lg leading-relaxed">
                                            @foreach ($data['intro'] as $paragraph)
                                                <p class="mb-6">{{ $paragraph }}</p>
                                            @endforeach
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
                                            @foreach ($data['values'] as $item)
                                                <div
                                                    class="group relative p-10 rounded-[3rem] bg-white border border-slate-100 shadow-sm transition-all duration-500 hover:shadow-2xl hover:-translate-y-3">
                                                    <div
                                                        class="mb-8 w-16 h-16 bg-bpr-blue text-bpr-gold rounded-2xl flex items-center justify-center text-3xl shadow-xl transition-transform duration-700 group-hover:rotate-[360deg]">
                                                        <i class="bi bi-shield-check"></i>
                                                    </div>
                                                    <h4
                                                        class="text-2xl font-black text-bpr-blue uppercase tracking-tighter mb-4">
                                                        {{ $item['key'] }}</h4>
                                                    <p
                                                        class="text-slate-400 text-sm leading-relaxed font-bold uppercase tracking-wider">
                                                        {{ $item['description'] }}</p>
                                                    <div
                                                        class="absolute bottom-0 left-10 right-10 h-1.5 bg-bpr-gold rounded-t-full scale-x-0 group-hover:scale-x-100 transition-transform duration-500">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- 4. TATA KELOLA (GCG) --}}
                                    {{-- 4. TATA KELOLA (GCG) --}}
                                    {{-- 4. TATA KELOLA (GCG) --}}
                                    @elseif ($slug === 'tata-kelola')
                                        <div class="space-y-16">

                                            {{-- Intro Box --}}
                                            <div class="relative overflow-hidden bg-blue-50/50 rounded-[3rem] p-10 lg:p-14 border-l-[12px] border-blue-900 shadow-inner group">
                                                <div class="absolute -right-10 -top-10 w-40 h-40 bg-blue-900/5 rounded-full blur-3xl group-hover:bg-blue-900/10 transition-colors duration-700"></div>
                                                <div class="relative z-10">
                                                    <i class="bi bi-quote text-5xl text-blue-900/20 block mb-4"></i>
                                                    <div class="font-bold text-blue-900 italic text-xl lg:text-2xl leading-relaxed">
                                                        @foreach ($data['intro'] as $paragraph)
                                                            <p>{{ $paragraph }}</p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Principles List --}}
                                            <div class="grid gap-6">
                                                @php $gcg_icons = ['bi-eye', 'bi-person-check', 'bi-briefcase', 'bi-journal-check', 'bi-balance-scale']; @endphp
                                                @foreach ($data['principles'] as $index => $item)
                                                    <div class="group flex flex-col md:flex-row items-center gap-6 md:gap-10 p-6 md:p-8 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-blue-900/10 hover:-translate-y-1 transition-all duration-500">

                                                        {{-- Icon Wrapper - Fixed Symmetric Size --}}
                                                        <div class="flex-shrink-0 w-24 h-24 bg-slate-50 rounded-[2rem] flex items-center justify-center text-4xl shadow-inner
                                                                    group-hover:bg-blue-900 group-hover:rotate-[10deg] transition-all duration-500">

                                                            {{-- PAKSA WARNA DI SINI: Biru saat normal, Kuning saat hover --}}
                                                            <i class="bi {{ $gcg_icons[$index] ?? 'bi-check2-circle' }}
                                                                      text-blue-900 group-hover:text-amber-400
                                                                      transition-colors duration-500"></i>
                                                        </div>

                                                        {{-- Text Content --}}
                                                        <div class="flex-1 text-center md:text-left">
                                                            <div class="flex flex-col">
                                                                <span class="text-blue-900 font-black text-[10px] uppercase tracking-[0.3em] mb-2 opacity-40 group-hover:opacity-100 transition-opacity">
                                                                    GCG Principle {{ sprintf('%02d', $index + 1) }}
                                                                </span>
                                                                <h4 class="text-2xl md:text-3xl font-black text-blue-900 uppercase tracking-tighter group-hover:text-blue-700 transition-colors">
                                                                    {{ $item }}
                                                                </h4>
                                                            </div>
                                                        </div>

                                                        {{-- Decorative Arrow --}}
                                                        <div class="hidden md:flex w-12 h-12 items-center justify-center rounded-full bg-slate-50 text-slate-300 group-hover:bg-amber-400 group-hover:text-blue-900 transition-all duration-500">
                                                            <i class="bi bi-arrow-right"></i>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            {{-- Report Download Section --}}
                                            <div class="group relative bg-blue-900 rounded-[3rem] p-10 lg:p-14 text-white overflow-hidden shadow-2xl transition-all duration-500">
                                                <div class="absolute top-0 right-0 w-96 h-96 bg-amber-400/10 rounded-full blur-[100px] -mr-48 -mt-48 transition-transform duration-1000 group-hover:scale-125"></div>

                                                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-10">
                                                    <div class="flex flex-col md:flex-row items-center gap-8">
                                                        <div class="w-24 h-24 bg-white/10 rounded-[2rem] flex items-center justify-center text-5xl text-amber-400 border border-white/20 shadow-2xl transition-transform duration-500 group-hover:scale-110 group-hover:rotate-6">
                                                            <i class="bi bi-file-earmark-pdf-fill"></i>
                                                        </div>
                                                        <div class="text-center md:text-left">
                                                            <h5 class="text-3xl font-black mb-2 tracking-tight">Laporan GCG Tahunan</h5>
                                                            <p class="text-blue-200/60 text-xs font-bold uppercase tracking-[0.3em]">
                                                                Corporate Transparency & Accountability
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <a href="#" class="inline-flex items-center gap-3 px-12 py-6 bg-amber-400 text-blue-900 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-white transition-all duration-300 shadow-xl active:scale-95">
                                                        <span>Download PDF</span>
                                                        <i class="bi bi-download text-lg"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
