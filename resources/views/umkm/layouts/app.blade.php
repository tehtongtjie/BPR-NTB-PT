<!DOCTYPE html>
<html lang="id" data-theme="light" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- 1. TITLE & SEO --}}
    <title>@yield('title', 'Mitra UMKM Hebat - PT. BPR NTB')</title>
    <meta name="description"
        content="Eksplorasi produk lokal unggulan mitra binaan BPR NTB. Kualitas terbaik dari Sasak, Samawa, dan Mbojo.">

    {{-- 2. FAVICON --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logobpr.png') }}?v=1">
    <link rel="apple-touch-icon" href="{{ asset('images/logobpr.png') }}">

    {{-- 3. ASSETS (Vite & CSS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- 5. SWEETALERT2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- 6. SCRIPTS (AlpineJS diletakkan dengan defer) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #00326B;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #fbbf24;
        }
    </style>
</head>

<body class="bg-[#FDFDFD] text-slate-900 antialiased selection:bg-amber-100 selection:text-amber-900">

    {{-- NAVBAR KHUSUS UMKM --}}
    @include('umkm.components.navbar')

    {{-- PAGE CONTENT --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- FLOATING ACTIONS --}}
    <div x-data="{ showScroll: false }" @scroll.window="showScroll = window.pageYOffset > 500"
        class="fixed bottom-6 right-6 z-[9999] flex flex-col gap-3">

        {{-- 1. Tombol Scroll To Top (AlpineJS Powered) --}}
        <button x-show="showScroll" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" @click="window.scrollTo({top: 0, behavior: 'smooth'})"
            class="w-14 h-14 bg-white border border-slate-200 rounded-2xl shadow-xl flex items-center justify-center text-slate-500 hover:bg-gray-50 hover:-translate-y-1 transition-all duration-300 group relative">
            <i class="bi bi-arrow-up text-xl"></i>
            <span
                class="absolute right-full mr-4 px-4 py-2 bg-slate-800 text-white text-[9px] font-black uppercase tracking-[0.2em] rounded-xl opacity-0 translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 whitespace-nowrap shadow-2xl pointer-events-none">
                Kembali ke Atas
            </span>
        </button>

        {{-- 2. Tombol Asisten Cerdas (AI) --}}
        <a href="{{ route('recommender.index') }}"
            class="group relative flex items-center justify-center w-16 h-16 transition-all duration-300 hover:-translate-y-1">
            <div class="absolute inset-0 rounded-2xl overflow-hidden pointer-events-none">
                <div
                    class="absolute inset-0 bg-gradient-to-tr from-white/0 via-white/40 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000">
                </div>
            </div>
            <img src="{{ asset('images/asistenpintar.png') }}" alt="AI Assistant"
                class="w-full h-full object-contain relative z-10 scale-90 group-hover:scale-100 transition-transform duration-300 drop-shadow-lg">
            <span
                class="absolute right-full mr-4 px-4 py-2 bg-[#00326B] text-white text-[9px] font-black uppercase tracking-[0.2em] rounded-xl opacity-0 translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 whitespace-nowrap shadow-2xl pointer-events-none border border-white/10">
                SAHABAT BPR NTB
            </span>
        </a>

        {{-- 3. Tombol WhatsApp --}}
        <a href="https://wa.me/6281234567890" target="_blank"
            class="group relative flex items-center justify-center w-14 h-14 bg-emerald-500 rounded-2xl shadow-xl shadow-emerald-500/40 hover:bg-emerald-600 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
            <div
                class="absolute inset-0 bg-gradient-to-tr from-white/0 via-white/30 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000">
            </div>
            <i class="bi bi-whatsapp text-2xl text-white"></i>
            <span
                class="absolute right-full mr-4 px-4 py-2 bg-emerald-600 text-white text-[9px] font-black uppercase tracking-[0.2em] rounded-xl opacity-0 translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 whitespace-nowrap shadow-2xl pointer-events-none">
                Hubungi CS
            </span>
            <span class="absolute top-0 right-0 flex h-3 w-3 mt-2 mr-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-white"></span>
            </span>
        </a>
    </div>

    {{-- FOOTER KHUSUS UMKM --}}
    @include('umkm.components.footer')

    @stack('scripts')
</body>

</html>
