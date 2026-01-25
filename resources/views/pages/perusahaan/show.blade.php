@extends('layouts.app')

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
                            @include('components.sidebar-perusahaan')
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
                                <a href="#"
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

                            {{-- Header Condition --}}
                            @if (isset($data['image']))
                                <div
                                    class="relative rounded-[2.5rem] lg:rounded-[3.5rem] overflow-hidden mb-12 group shadow-2xl border-4 border-white">
                                    <img src="{{ asset($data['image']) }}"
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
                                @elseif ($slug === 'tata-kelola')
                                    <div class="space-y-12">
                                        <div
                                            class="bg-blue-50/50 rounded-[3rem] p-10 border-l-8 border-bpr-blue shadow-inner font-bold text-bpr-blue italic text-2xl leading-relaxed">
                                            @foreach ($data['intro'] as $paragraph)
                                                <p>{{ $paragraph }}</p>
                                            @endforeach
                                        </div>
                                        <div class="grid gap-6">
                                            @php $gcg_icons = ['bi-eye', 'bi-person-check', 'bi-briefcase', 'bi-journal-check', 'bi-balance-scale']; @endphp
                                            @foreach ($data['principles'] as $index => $item)
                                                <div
                                                    class="flex items-center gap-8 p-8 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
                                                    <div
                                                        class="w-20 h-20 bg-slate-50 text-bpr-blue rounded-[1.8rem] flex items-center justify-center text-3xl shadow-inner group-hover:bg-bpr-blue group-hover:text-bpr-gold transition-all">
                                                        <i class="bi {{ $gcg_icons[$index] ?? 'bi-check2-circle' }}"></i>
                                                    </div>
                                                    <div>
                                                        <span
                                                            class="text-bpr-blue font-black text-[10px] uppercase tracking-widest block mb-1 opacity-50">Principle
                                                            {{ sprintf('%02d', $index + 1) }}</span>
                                                        <h4
                                                            class="text-2xl font-black text-bpr-blue uppercase tracking-tighter">
                                                            {{ $item }}</h4>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        {{-- Report Download --}}
                                        <div
                                            class="bg-bpr-blue rounded-[3rem] p-12 text-white flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden shadow-2xl">
                                            <div
                                                class="absolute top-0 right-0 w-64 h-64 bg-bpr-gold/10 rounded-full blur-3xl -mr-32 -mt-32">
                                            </div>
                                            <div class="flex items-center gap-8 relative z-10">
                                                <div
                                                    class="w-20 h-20 bg-white/10 rounded-3xl flex items-center justify-center text-4xl text-bpr-gold border border-white/10">
                                                    <i class="bi bi-file-earmark-pdf"></i>
                                                </div>
                                                <div>
                                                    <h5 class="text-2xl font-black mb-1">Laporan GCG Tahunan</h5>
                                                    <p class="text-blue-200/50 text-xs font-bold uppercase tracking-widest">
                                                        Public Transparency Document</p>
                                                </div>
                                            </div>
                                            <a href="#"
                                                class="px-10 py-5 bg-bpr-gold text-bpr-blue rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-white transition-all shadow-xl">Download
                                                PDF</a>
                                        </div>
                                    </div>

                                    {{-- 5. KOMISARIS & DIREKSI --}}
                                @elseif ($slug === 'komisaris' || $slug === 'direksi')
                                    <div class="grid grid-cols-1 gap-12">
                                        @foreach ($data['members'] as $member)
                                            <div
                                                class="group bg-white rounded-[3rem] p-6 lg:p-10 border border-slate-100 hover:shadow-2xl transition-all duration-500">
                                                <div class="flex flex-col lg:flex-row gap-12 items-center">
                                                    <div
                                                        class="w-full lg:w-72 flex-shrink-0 relative overflow-hidden rounded-[2.5rem] aspect-[3/4] shadow-xl">
                                                        {{-- Grayscale dihapus, gambar sekarang berwarna normal --}}
                                                        <img src="{{ asset($member['photo'] ?? $member['image']) }}"
                                                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

                                                        {{-- Overlay gradient opsional, bisa dihapus jika ingin benar-benar polos --}}
                                                        <div
                                                            class="absolute inset-0 bg-gradient-to-t from-bpr-blue/20 to-transparent">
                                                        </div>
                                                    </div>

                                                    <div class="flex-1 text-center lg:text-left">
                                                        <div class="mb-6">
                                                            <h3 class="text-3xl lg:text-4xl font-black text-bpr-blue mb-2">
                                                                {{ $member['name'] }}
                                                            </h3>
                                                            <span
                                                                class="inline-block px-5 py-2 rounded-xl bg-bpr-gold text-bpr-blue text-[10px] font-black uppercase tracking-widest shadow-md">
                                                                {{ $member['position'] }}
                                                            </span>
                                                        </div>

                                                        <p
                                                            class="text-slate-500 text-lg mb-8 line-clamp-3 italic font-medium leading-relaxed">
                                                            {{ $member['summary'] ?? $member['excerpt'] }}
                                                        </p>

                                                        <a href="{{ url('/perusahaan/' . $slug . '/' . $member['slug']) }}"
                                                            class="inline-flex items-center gap-3 text-bpr-blue font-black uppercase text-[11px] tracking-widest hover:gap-6 transition-all">
                                                            Detailed Bio
                                                            <i class="bi bi-arrow-right text-bpr-gold text-xl"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
