<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin | BPR NTB')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind + daisyUI --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Bootstrap Icons (ICON SAJA, TANPA CSS BOOTSTRAP) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    @stack('styles')
</head>

<body class="bg-slate-50 text-slate-800 antialiased">

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        @include('admin.components.sidebar')

        {{-- CONTENT --}}
        <main class="flex-1 ml-64 p-6">
            @yield('content')
        </main>

    </div>

    @stack('scripts')
</body>
</html>
