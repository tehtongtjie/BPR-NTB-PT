@extends('user.layouts.app')

@section('title', $album['album'] . ' - BPR NTB')

@push('styles')
    {{-- GLightbox CSS untuk efek zoom foto --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
@endpush

@section('content')
    <main class="bg-[#F8FAFC] min-h-screen pt-32 lg:pt-40 pb-24 font-sans antialiased">

        {{-- 1. HEADER SECTION (Clean Style) --}}
        <section class="max-w-7xl mx-auto px-6 lg:px-8 mb-12">
            {{-- Breadcrumb --}}
            <nav class="flex mb-8 text-slate-400 text-[10px] font-black uppercase tracking-[0.3em]">
                <ol class="inline-flex items-center space-x-3">
                    <li><a href="/" class="hover:text-[#00326B] transition-colors">Beranda</a></li>
                    <li><i class="bi bi-circle-fill text-[4px]"></i></li>
                    <li><a href="{{ route('galeri.index') }}" class="hover:text-[#00326B] transition-colors">Galeri</a></li>
                    <li><i class="bi bi-circle-fill text-[4px]"></i></li>
                    <li class="text-[#00326B] line-clamp-1">{{ $album['album'] }}</li>
                </ol>
            </nav>

            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8">
                <div class="max-w-3xl">
                    <span
                        class="inline-block px-4 py-1.5 rounded-full bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest border border-blue-100 mb-6">
                        {{ $album['kategori'] }}
                    </span>
                    <h1 class="text-4xl lg:text-6xl font-black text-[#00326B] leading-tight tracking-tighter mb-6">
                        {{ $album['album'] }}
                    </h1>
                    <p class="text-lg text-slate-500 font-medium italic leading-relaxed border-l-4 border-[#fbbf24] pl-6">
                        "{{ $album['deskripsi'] }}"
                    </p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-1">Tanggal Kegiatan</p>
                        <p class="text-sm font-black text-[#00326B]">{{ $album['tanggal'] }}</p>
                    </div>
                    <div
                        class="w-14 h-14 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center justify-center text-[#00326B]">
                        <i class="bi bi-calendar-event text-xl"></i>
                    </div>
                </div>
            </div>
        </section>

        {{-- 2. PHOTO GRID (Bento Masonry) --}}
        <section class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">
                @foreach ($photos as $index => $photo)
                    <a href="{{ asset('images/' . $photo['url']) }}"
                        class="glightbox block relative group overflow-hidden rounded-[2.5rem] bg-white border border-slate-100 shadow-lg shadow-blue-900/5 transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl"
                        data-glightbox="title: {{ $album['album'] }}; description: {{ $photo['caption'] }}">

                        <img src="{{ asset('images/' . $photo['url']) }}" alt="{{ $photo['caption'] }}"
                            class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">

                        {{-- Hover Overlay --}}
                        <div
                            class="absolute inset-0 bg-[#00326B]/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center">
                            <div
                                class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-md border border-white/30 flex items-center justify-center text-white">
                                <i class="bi bi-zoom-in text-xl"></i>
                            </div>
                        </div>

                        {{-- Caption Tag --}}
                        <div
                            class="absolute bottom-6 left-6 right-6 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                            <span
                                class="inline-block px-4 py-2 rounded-xl bg-white/90 backdrop-blur-md text-[10px] font-bold text-[#00326B] shadow-lg">
                                {{ $photo['caption'] }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- 3. NAVIGATION FOOTER --}}
            <div class="mt-20 pt-10 border-t border-slate-100 flex justify-between items-center">
                <a href="{{ route('galeri.index') }}"
                    class="inline-flex items-center gap-3 text-xs font-black uppercase tracking-widest text-slate-400 hover:text-[#00326B] transition-colors">
                    <i class="bi bi-arrow-left"></i> Kembali ke Galeri
                </a>
                <div class="flex gap-2">
                    <button
                        class="w-12 h-12 rounded-2xl bg-white border border-slate-100 text-slate-400 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                        <i class="bi bi-share"></i>
                    </button>
                </div>
            </div>
        </section>

    </main>

    @push('scripts')
        {{-- GLightbox JS --}}
        <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
        <script>
            const lightbox = GLightbox({
                touchNavigation: true,
                loop: true,
                autoplayVideos: true
            });
        </script>
    @endpush

    <style>
        .tracking-tighter {
            letter-spacing: -0.05em;
        }

        .break-inside-avoid {
            break-inside: avoid;
        }

        /* Custom Masonry Gap */
        @media (min-width: 768px) {

            .columns-2,
            .columns-3 {
                column-gap: 1.5rem;
            }
        }
    </style>
@endsection
