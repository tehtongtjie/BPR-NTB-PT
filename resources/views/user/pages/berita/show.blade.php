@extends('user.layouts.app')

@section('title', $article->title . ' - BPR NTB')

@section('content')
    {{-- Jarak pt-32 mobile, lg:pt-40 desktop agar tidak nabrak navbar --}}
    <main class="bg-[#F8FAFC] min-h-screen pt-32 lg:pt-40 pb-24 font-sans antialiased">

        {{-- 1. BREADCRUMB (Simple & Clean) --}}
        <div class="max-w-7xl mx-auto px-6 lg:px-8 mb-8">
            <nav class="flex text-slate-400 text-[10px] font-black uppercase tracking-[0.3em]">
                <ol class="inline-flex items-center space-x-3">
                    <li><a href="/" class="hover:text-[#00326B] transition-colors">Beranda</a></li>
                    <li><i class="bi bi-circle-fill text-[4px]"></i></li>
                    <li><a href="{{ route('berita.index') }}" class="hover:text-[#00326B] transition-colors">Berita</a></li>
                    <li><i class="bi bi-circle-fill text-[4px]"></i></li>
                    <li class="text-[#00326B] line-clamp-1">{{ $article->title }}</li>
                </ol>
            </nav>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12">

                {{-- 2. MAIN CONTENT (ARTIKEL) --}}
                <article class="lg:w-2/3">
                    {{-- Header Berita --}}
                    <header class="mb-10">
                        <div class="inline-flex items-center gap-3 mb-6">
                            <span
                                class="px-4 py-1.5 rounded-full bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest border border-blue-100">
                                {{ $article->category }}
                            </span>
                            <span class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">
                                <i class="bi bi-calendar3 me-2"></i>
                                {{ \Carbon\Carbon::parse($article->published_at)->translatedFormat('d M Y') }}
                            </span>
                        </div>
                        <h1 class="text-4xl lg:text-6xl font-black text-[#00326B] leading-[1.1] tracking-tighter mb-8">
                            {{ $article->title }}
                        </h1>
                        <div class="flex items-center gap-4 py-6 border-y border-slate-100">
                            <div
                                class="w-10 h-10 rounded-full bg-[#00326B] flex items-center justify-center text-white font-black text-xs">
                                BN
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-[#00326B] uppercase tracking-widest">Diterbitkan Oleh
                                </p>
                                <p class="text-xs text-slate-500 font-medium italic">
                                    {{ $article->author ?? 'Humas BPR NTB' }}
                                </p>
                            </div>
                        </div>
                    </header>

                    {{-- Image Utama --}}
                    <div
                        class="relative rounded-[3rem] overflow-hidden shadow-2xl shadow-blue-900/10 mb-12 border-8 border-white">
                        <img src="{{ public_image_url('storage/' . $article->thumbnail) }}" class="w-full h-full object-cover"
                            alt="{{ $article->title }}">
                    </div>

                    {{-- Konten Berita --}}
                    <div class="prose prose-slate lg:prose-xl max-w-none text-slate-600 leading-relaxed font-medium">
                        <p class="text-2xl font-light italic text-[#00326B] mb-10 leading-relaxed">
                            {{ $article->excerpt }}
                        </p>

                        <div class="article-body">
                            {!! $article->content !!}
                        </div>
                    </div>

                    {{-- Share Section --}}
                    <div
                        class="mt-16 pt-8 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Bagikan Berita Ini:</p>
                        <div class="flex gap-3">
                            <a href="#"
                                class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-[#00326B] hover:text-white transition-all shadow-sm">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#"
                                class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-[#25D366] hover:text-white transition-all shadow-sm">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <a href="#"
                                class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-black hover:text-white transition-all shadow-sm">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                        </div>
                    </div>
                </article>

                {{-- 3. SIDEBAR (BERITA TERKAIT) --}}
                <aside class="lg:w-1/3">
                    <div class="sticky top-32 space-y-8">
                        {{-- Search Box --}}
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-blue-900/5 border border-slate-50">
                            <h4 class="text-sm font-black text-[#00326B] uppercase tracking-widest mb-6">Cari Berita</h4>
                            <div class="relative">
                                <input type="text" placeholder="Kata kunci..."
                                    class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm focus:ring-2 focus:ring-blue-600/20">
                                <button class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400"><i
                                        class="bi bi-search"></i></button>
                            </div>
                        </div>

                        {{-- Berita Terpopuler / Terkait --}}
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-blue-900/5 border border-slate-50">
                            <h4
                                class="text-sm font-black text-[#00326B] uppercase tracking-widest mb-8 flex items-center gap-3">
                                <span class="w-1.5 h-6 bg-[#fbbf24] rounded-full"></span> Terpopuler
                            </h4>
                            <div class="space-y-8">
                                @for ($i = 0; $i < 3; $i++)
                                    <a href="#" class="group flex gap-4">
                                        <div class="w-20 h-20 flex-shrink-0 rounded-2xl overflow-hidden">
                                            <img src="{{ public_image_url('storage/' . $article->thumbnail) }}" 
                                                class="w-full h-full object-cover transition-transform group-hover:scale-110">
                                        </div>
                                        <div>
                                            <span
                                                class="text-[8px] font-black text-blue-600 uppercase tracking-widest mb-1 block">Internal</span>
                                            <h5
                                                class="text-sm font-black text-[#00326B] leading-tight group-hover:text-blue-600 transition-colors line-clamp-2">
                                                Inovasi Layanan Perbankan BPR NTB di 2026</h5>
                                        </div>
                                    </a>
                                @endfor
                            </div>
                        </div>

                        {{-- CTA Card --}}
                        <div
                            class="bg-gradient-to-br from-[#00326B] to-[#001D3D] rounded-[2.5rem] p-10 text-white shadow-2xl relative overflow-hidden group">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-[#fbbf24] rounded-full blur-[80px] opacity-10">
                            </div>
                            <h4 class="text-2xl font-black mb-4 relative z-10">Butuh Bantuan?</h4>
                            <p class="text-blue-100/50 text-xs mb-8 italic relative z-10 leading-relaxed">Hubungi Customer
                                Service kami untuk informasi lebih lanjut mengenai produk dan layanan.</p>
                            <a href="#"
                                class="inline-flex items-center justify-center w-full bg-[#fbbf24] text-[#00326B] py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-white transition-all shadow-lg">
                                Kontak Layanan
                            </a>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </main>

    <style>
        .article-body p {
            margin-bottom: 1.5rem;
        }

        .article-body h2 {
            color: #00326B;
            font-weight: 900;
            font-size: 1.5rem;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .tracking-tighter {
            letter-spacing: -0.05em;
        }
    </style>
@endsection
