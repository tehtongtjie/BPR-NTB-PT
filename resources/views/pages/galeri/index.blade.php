@extends('layouts.app')

@section('title', 'Galeri Kegiatan - BPR NTB')

@section('content')
    {{-- Padding top disesuaikan agar tidak nabrak navbar --}}
    <main class="bg-[#F8FAFC] min-h-screen pt-32 lg:pt-40 pb-24 font-sans antialiased">

        {{-- 1. HERO SECTION (Premium Bento Header) --}}
        <section class="relative mx-4 lg:mx-8 mb-16">
            <div class="relative rounded-[3rem] bg-[#00326B] overflow-hidden shadow-2xl shadow-blue-900/30">
                {{-- Decorative Shapes --}}
                <div
                    class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-[600px] h-[600px] bg-blue-500 rounded-full blur-[140px] opacity-20">
                </div>
                <div
                    class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/4 w-96 h-96 bg-[#fbbf24] rounded-full blur-[100px] opacity-10">
                </div>

                <div class="max-w-7xl mx-auto px-8 py-16 lg:py-24 relative z-10 text-center lg:text-left">
                    <div class="max-w-4xl">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/10 mb-8 backdrop-blur-md">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#fbbf24] animate-pulse"></span>
                            <span class="text-[10px] font-black text-white uppercase tracking-widest text-nowrap">Visual
                                Archive BPR NTB</span>
                        </div>
                        <h1 class="text-5xl md:text-8xl font-black text-white leading-[0.9] tracking-tighter mb-8">
                            Galeri <br><span class="italic font-light text-[#fbbf24]">Kegiatan.</span>
                        </h1>
                        <p
                            class="text-xl md:text-2xl text-blue-100/70 font-medium italic leading-relaxed max-w-2xl border-l-2 border-[#fbbf24]/30 pl-6">
                            "Merekam setiap momen perjalanan, pengabdian, dan kontribusi nyata kami untuk masyarakat Nusa
                            Tenggara Barat."
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- 2. CATEGORY FILTER --}}
        <div class="sticky top-20 lg:top-28 z-30 mb-16 px-4">
            <div
                class="max-w-fit mx-auto bg-white/80 backdrop-blur-xl p-2 rounded-3xl shadow-xl shadow-blue-900/5 border border-slate-100">
                <div class="flex items-center gap-2 overflow-x-auto hide-scrollbar px-2">
                    <a href="#"
                        class="whitespace-nowrap px-6 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-widest bg-[#00326B] text-white shadow-lg shadow-blue-900/20 transition-all">Semua
                        Momen</a>
                    @foreach ($categories as $cat)
                        <a href="#"
                            class="whitespace-nowrap px-6 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-[#00326B] hover:bg-slate-50 transition-all">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- 3. GALLERY BENTO GRID --}}
        <section class="max-w-7xl mx-auto px-6 lg:px-8">
            {{-- Grid 3 Kolom yang Konsisten --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($albums as $album)
                    <div class="relative group">
                        <div
                            class="bg-white rounded-[2.5rem] overflow-hidden shadow-xl shadow-blue-900/5 border border-slate-100 transition-all duration-700 hover:shadow-2xl hover:-translate-y-2 h-full flex flex-col">

                            {{-- Image Wrapper --}}
                            <div class="relative overflow-hidden aspect-square flex-shrink-0">
                                <img src="{{ asset('images/' . $album['cover']) }}" alt="{{ $album['album'] }}"
                                    class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">

                                {{-- Overlay Content --}}
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-[#00326B] via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-8">
                                    <p class="text-white/60 text-[10px] font-black uppercase tracking-widest mb-2">
                                        {{ $album['tanggal'] }}
                                    </p>
                                    <h3 class="text-white text-xl font-black leading-tight mb-4 tracking-tight">
                                        {{ $album['album'] }}
                                    </h3>
                                    <a href="{{ route('galeri.show', $album['id']) }}"
                                        class="inline-flex items-center gap-2 text-[#fbbf24] text-[10px] font-black uppercase tracking-widest hover:text-white transition-colors">
                                        Lihat Album <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>

                                {{-- Image Badge --}}
                                <div class="absolute top-6 left-6">
                                    <span
                                        class="backdrop-blur-md bg-white/20 px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest text-white border border-white/20">
                                        {{ $album['jumlah_foto'] }} Photos
                                    </span>
                                </div>
                            </div>

                            {{-- Bottom Info --}}
                            <div class="p-8 flex-grow flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center justify-between mb-3">
                                        <span
                                            class="text-blue-600 text-[9px] font-black uppercase tracking-widest">{{ $album['kategori'] }}</span>
                                        <i class="bi bi-images text-slate-200"></i>
                                    </div>
                                    <h4
                                        class="text-[#00326B] font-black text-base leading-snug group-hover:text-blue-600 transition-colors">
                                        {{ $album['album'] }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </section>
        {{-- 4. tombol CTA --}}
        <div
            class="mt-24 bg-gradient-to-br from-[#ffc531] to-amber-500 rounded-[3rem] p-10 lg:p-16 text-center relative overflow-hidden shadow-2xl shadow-amber-500/20">
            <div
                class="absolute top-0 left-0 w-64 h-64 bg-white/20 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2">
            </div>

            <h2 class="text-3xl lg:text-4xl font-black text-[#00326B] tracking-tighter uppercase mb-4 relative z-10">
                Punya Dokumentasi Bersama Kami?</h2>
            <p class="text-[#00326B]/70 font-medium italic mb-8 relative z-10">Tag kami di Instagram menggunakan hashtag
                <span class="font-black">#BPRNTB</span> untuk kesempatan tampil di galeri komunitas kami.
            </p>
            <a href="https://instagram.com/your_account"
                class="inline-flex items-center gap-3 px-10 py-5 bg-[#00326B] text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-white hover:text-[#00326B] transition-all active:scale-95 shadow-xl relative z-10">
                Follow @BPRNTB <i class="bi bi-instagram"></i>
            </a>
        </div>
        </section>

    </main>

    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Custom Columns Gap for Masonry */
        @media (min-width: 1024px) {
            .columns-3 {
                column-gap: 2rem;
            }
        }

        .tracking-tighter {
            letter-spacing: -0.05em;
        }
    </style>
@endsection
