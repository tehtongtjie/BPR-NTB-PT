@extends('user.layouts.app')

@section('title', ($galeri->title ?? 'Galeri') . ' - BPR NTB')

@php
    $album = [
        'album' => $galeri->title,
        'kategori' => $galeri->category,
        'deskripsi' => $galeri->description,
        'tanggal' => $galeri->published_at?->translatedFormat('d M Y'),
    ];
@endphp

@section('content')
    @php
        $coverUrl = public_image_url('storage/' . $galeri->thumbnail);
        $embedUrl = null;
        if (!empty($galeri->video_url)) {
            $video = trim($galeri->video_url);
            if (preg_match('/(?:https?:\\/\\/)?(?:www\\.)?(?:m\\.)?youtube\\.com\\/watch\\?v=([^&]+)/', $video, $matches)) {
                $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
            } elseif (preg_match('/(?:https?:\\/\\/)?(?:www\\.)?youtu\\.be\\/([^?]+)/', $video, $matches)) {
                $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
            } else {
                $embedUrl = $video;
            }
        }
    @endphp

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

        {{-- 2. GALLERY MEDIA --}}
        <section class="max-w-7xl mx-auto px-6 lg:px-8 space-y-10">
            <div class="rounded-[3rem] overflow-hidden shadow-xl border border-slate-200 bg-slate-900">
                @if ($galeri->type === 'video')
                    @if ($embedUrl)
                        <div class="relative w-full aspect-video">
                            <iframe class="absolute inset-0 w-full h-full"
                                src="{{ $embedUrl }}?autoplay=1&mute=1&rel=0"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    @else
                        <div class="flex items-center justify-center px-6 py-12 text-center text-sm text-white/80">
                            Link video tidak valid atau tidak dapat ditampilkan.
                        </div>
                    @endif
                @else
                    <div class="relative h-[420px] overflow-hidden bg-slate-900">
                        <img src="{{ $coverUrl }}" alt="{{ $galeri->title }}"
                            class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 hover:scale-105">
                    </div>
                @endif
            </div>
        </section>

        {{-- 3. NAVIGATION FOOTER --}}
        <section class="max-w-7xl mx-auto px-6 lg:px-8">
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

    <style>
        .tracking-tighter {
            letter-spacing: -0.05em;
        }
    </style>
@endsection
