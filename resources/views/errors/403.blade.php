<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>403 - Akses Ditolak</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#F8FAFC] min-h-screen flex items-center justify-center px-6">

<div class="max-w-xl w-full text-center">

    <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 p-10 relative overflow-hidden">

        <div class="absolute -bottom-20 -left-20 w-56 h-56 bg-amber-100 rounded-full blur-3xl opacity-50"></div>

        <div class="relative z-10">

            <h1 class="text-6xl font-black text-[#00326B] mb-4">403</h1>

            <h2 class="text-2xl font-black text-[#00326B] mb-2">
                Akses Ditolak
            </h2>

            <p class="text-slate-500 text-sm italic mb-8">
                Kamu tidak memiliki izin untuk mengakses halaman ini.
            </p>

            <a href="/"
               class="inline-flex items-center gap-3 px-8 py-4 rounded-2xl
                      bg-[#00326B] text-white text-xs font-black uppercase tracking-widest
                      hover:bg-blue-700 transition-all">
                Kembali ke Beranda →
            </a>

        </div>
    </div>

</div>

</body>
</html>