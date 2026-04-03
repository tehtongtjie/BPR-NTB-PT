<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Akses Ditolak - BPR NTB</title>
    @vite('resources/css/app.css') 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-[#F8FAFC] min-h-screen flex items-center justify-center px-6">

    <div class="w-full max-w-xl">

        {{-- CARD --}}
        <div class="relative bg-white rounded-[2.5rem] shadow-xl border border-slate-100 p-10 text-center overflow-hidden">

            {{-- BACKGROUND ACCENT --}}
            <div class="absolute -top-20 -right-20 w-56 h-56 bg-blue-100 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute -bottom-20 -left-20 w-56 h-56 bg-amber-100 rounded-full blur-3xl opacity-40"></div>

            <div class="relative z-10">

                {{-- ICON --}}
                <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-[#00326B]/10 flex items-center justify-center">
                    <i class="bi bi-shield-lock text-3xl text-[#00326B]"></i>
                </div>

                {{-- TITLE --}}
                <h1 class="text-2xl lg:text-3xl font-black text-[#00326B] mb-3">
                    Akses Tidak Valid
                </h1>

                {{-- SUBTITLE --}}
                <p class="text-slate-500 text-sm italic mb-8 leading-relaxed">
                    Halaman login admin hanya dapat diakses melalui link resmi yang diberikan oleh sistem.
                </p>

                {{-- BUTTON --}}
                <a href="/"
                   class="inline-flex items-center justify-center gap-3 px-8 py-4 rounded-2xl
                          bg-[#00326B] text-white text-xs font-black uppercase tracking-widest
                          shadow-lg shadow-blue-900/10 transition-all
                          hover:bg-blue-700 hover:-translate-y-0.5 active:scale-95">

                    <span>Kembali ke Beranda</span>
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>
        </div>

        {{-- FOOTNOTE --}}
        <p class="text-center text-xs text-slate-400 mt-6 italic">
            BPR NTB • Secure Access System
        </p>

    </div>

</body>
</html>