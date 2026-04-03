<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>

    <meta charset="UTF-8">
    <title>@yield('title', 'Admin | BPR NTB')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logobpr.png') }}?v=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logobpr.png') }}?v=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('styles')
</head>

<body class="bg-slate-50 text-slate-800 antialiased">

    <div class="min-h-screen flex">

        {{-- SIDEBAR (NORMAL, BUKAN FIXED) --}}
        <aside class="w-64 shrink-0 bg-white border-r border-slate-200">
            @include('admin.components.sidebar')
        </aside>

        {{-- CONTENT --}}
        <main class="flex-1 p-6 overflow-x-auto">
            <div class="space-y-4">
                @include('admin.components.flash-alerts')
                @yield('content')
            </div>
        </main>

    </div>

    @stack('scripts')
</body>

</html>
