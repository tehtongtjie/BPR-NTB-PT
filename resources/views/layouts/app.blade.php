<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'BPR NTB')</title>

    @vite('resources/css/app.css')

    <link rel="icon" href="{{ asset('images/favicon.ico') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>



</head>

<body class="bg-base-100 text-base-content antialiased">

    {{-- NAVBAR --}}
    @include('components.navbar')

    {{-- PAGE CONTENT --}}
    <main>
        @yield('content')
    </main>

    <div class="fixed bottom-6 right-6 z-[9999] flex flex-col gap-3">

        <button id="scrollToTop"
            class="hidden w-12 h-12 bg-slate-100 border border-slate-200 rounded-full shadow-lg items-center justify-center text-slate-500 hover:bg-white transition-all">
            <i class="bi bi-arrow-up"></i>
        </button>

        <a href="mailto:info@bprntb.co.id"
            class="group relative flex items-center justify-center w-14 h-14 bg-white border border-slate-200 rounded-2xl shadow-xl hover:-translate-y-1 transition-all duration-300">
            <i class="bi bi-envelope-fill text-xl text-[#00326B]"></i>
            <span
                class="absolute right-full mr-4 px-4 py-2 bg-[#00326B] text-white text-[10px] font-black uppercase tracking-widest rounded-xl opacity-0 group-hover:opacity-100 transition-all whitespace-nowrap shadow-xl">
                Kirim Email
            </span>
        </a>

        <a href="https://wa.me/6281234567890" target="_blank"
            class="group relative flex items-center justify-center w-14 h-14 bg-emerald-500 rounded-2xl shadow-xl shadow-emerald-500/40 hover:bg-emerald-600 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
            <div
                class="absolute inset-0 bg-gradient-to-tr from-white/0 via-white/30 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000">
            </div>

            <i class="bi bi-whatsapp text-2xl text-white"></i>

            <span
                class="absolute right-full mr-4 px-4 py-2 bg-emerald-600 text-white text-[10px] font-black uppercase tracking-widest rounded-xl opacity-0 group-hover:opacity-100 transition-all whitespace-nowrap shadow-xl">
                Chat Customer Service
            </span>

            <span class="absolute top-0 right-0 flex h-3 w-3 mt-2 mr-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-white"></span>
            </span>
        </a>
    </div>
    {{-- FOOTER --}}
    @include('components.footer')

</body>

</html>
