@extends('user.layouts.app')

@section('title', $lelang->title . ' - BPR NTB')

@section('content')
<main class="bg-[#F8FAFC] min-h-screen pt-32 lg:pt-40 pb-24 font-sans antialiased">

    {{-- ================= HERO HEADER ================= --}}
    <section class="relative mx-4 lg:mx-8 mb-16">
        <div class="relative rounded-[3.5rem] bg-[#00326B] overflow-hidden shadow-[0_32px_64px_-16px_rgba(0,50,107,0.3)]">

            {{-- Decorative --}}
            <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-[700px] h-[700px] bg-blue-500 rounded-full blur-[140px] opacity-30"></div>
            <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/4 w-96 h-96 bg-[#fbbf24] rounded-full blur-[100px] opacity-10"></div>

            <div class="max-w-7xl mx-auto px-8 py-20 lg:py-28 relative z-10">

                {{-- Breadcrumb --}}
                <nav class="flex mb-12 text-blue-200/50 text-[10px] font-black uppercase tracking-[0.4em]">
                    <ol class="inline-flex items-center space-x-3">
                        <li><a href="/" class="hover:text-white">Beranda</a></li>
                        <li><i class="bi bi-circle-fill text-[4px]"></i></li>
                        <li><a href="{{ route('lelang.index') }}" class="hover:text-white">E-Procurement</a></li>
                        <li><i class="bi bi-circle-fill text-[4px]"></i></li>
                        <li class="text-[#fbbf24]">{{ Str::limit($lelang->title, 30) }}</li>
                    </ol>
                </nav>

                <div class="max-w-5xl">

                    {{-- Status --}}
                    <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-white/10 border border-white/10 mb-8 backdrop-blur-xl">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                        </span>
                        <span class="text-[11px] font-black text-white uppercase tracking-widest">
                            Tender Status:
                            <span class="text-emerald-400">{{ strtoupper($lelang->status) }}</span>
                        </span>
                    </div>

                    {{-- Title --}}
                    <h1 class="text-5xl md:text-7xl font-black text-white leading-[0.95] tracking-tighter mb-10">
                        {{ $lelang->title }}
                    </h1>

                    {{-- Meta --}}
                    <div class="flex flex-wrap gap-6 text-blue-100/60 font-bold text-xs uppercase tracking-widest">
                        <span class="flex items-center gap-2">
                            <i class="bi bi-tag-fill text-[#fbbf24]"></i>
                            {{ $lelang->category }}
                        </span>
                        <span class="flex items-center gap-2">
                            <i class="bi bi-clock-fill text-[#fbbf24]"></i>
                            Batas: {{ $lelang->deadline?->translatedFormat('d F Y') }}
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- ================= CONTENT ================= --}}
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-16">

            {{-- ===== LEFT CONTENT ===== --}}
            <div class="lg:w-2/3 space-y-12">
                <div class="bg-white rounded-[4rem] p-4 shadow-2xl border border-white">

                    {{-- Banner --}}
                    <div class="aspect-[21/9] overflow-hidden rounded-[3rem]">
                        <img
                            src="{{ $lelang->banner ? asset('storage/'.$lelang->banner) : asset('images/lelang-pengadaan.png') }}"
                            class="w-full h-full object-cover">
                    </div>

                    <div class="p-10 lg:p-16">

                        {{-- Description --}}
                        <div class="flex items-center gap-4 mb-10">
                            <span class="h-[2px] w-16 bg-[#fbbf24]"></span>
                            <span class="text-xs font-black text-[#00326B] uppercase tracking-[0.5em]">
                                Spesifikasi Proyek
                            </span>
                        </div>

                        <div class="prose prose-slate prose-xl max-w-none text-slate-500 italic mb-16">
                            {!! nl2br(e($lelang->description)) !!}
                        </div>

                        {{-- Requirements --}}
                        <div class="space-y-8">
                            <h3 class="text-2xl font-black text-[#00326B] flex items-center gap-4">
                                <div class="w-10 h-10 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                                    <i class="bi bi-shield-lock-fill"></i>
                                </div>
                                Kualifikasi Peserta
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @forelse($lelang->requirements as $req)
                                    <div class="flex items-center gap-4 p-6 bg-slate-50 rounded-[2rem]">
                                        <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-emerald-500 shadow-sm">
                                            <i class="bi bi-check-lg"></i>
                                        </div>
                                        <span class="text-sm font-bold text-slate-700">
                                            {{ $req->title }}
                                        </span>
                                    </div>
                                @empty
                                    <p class="text-slate-400 italic">
                                        Tidak ada persyaratan khusus.
                                    </p>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ===== RIGHT SIDEBAR ===== --}}
            <aside class="lg:w-1/3 space-y-8">
                <div class="sticky top-32">

                    {{-- Download RKS --}}
                    <div class="bg-white rounded-[3.5rem] p-10 shadow-2xl border border-slate-100">
                        <h4 class="text-2xl font-black text-[#00326B] mb-4">
                            Download RKS
                        </h4>
                        <p class="text-slate-400 text-sm mb-8 italic">
                            Unduh dokumen resmi sebelum mengikuti lelang.
                        </p>

                        @if($lelang->rks_file)
                            <a href="{{ asset('storage/'.$lelang->rks_file) }}"
                               target="_blank"
                               class="flex items-center justify-between bg-[#00326B] text-white p-6 rounded-[2rem] font-black uppercase tracking-widest text-[11px] hover:bg-[#fbbf24] hover:text-[#00326B]">
                                <span>Unduh RKS</span>
                                <i class="bi bi-arrow-down-short text-xl"></i>
                            </a>
                        @else
                            <div class="text-sm text-slate-400 italic bg-slate-50 p-4 rounded-xl text-center">
                                Dokumen RKS belum tersedia.
                            </div>
                        @endif
                    </div>

                    {{-- Alert --}}
                    <div class="mt-8 rounded-[3rem] p-8 bg-amber-50 border border-amber-100">
                        <h5 class="font-black text-amber-800 text-[10px] uppercase tracking-[0.3em] mb-4">
                            Security Alert
                        </h5>
                        <p class="text-xs text-amber-900/60 italic font-bold">
                            Seluruh proses pengadaan BPR NTB GRATIS.
                            Laporkan jika ada permintaan imbalan.
                        </p>
                    </div>

                </div>
            </aside>
        </div>
    </div>
</main>

<style>
main {
    animation: fadeIn .8s cubic-bezier(.16,1,.3,1);
}
@keyframes fadeIn {
    from { opacity:0; transform:translateY(20px); }
    to { opacity:1; transform:none; }
}
.tracking-tighter { letter-spacing:-.05em }
</style>
@endsection
