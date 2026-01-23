<aside
    class="fixed left-0 top-0 z-40 h-screen w-64 bg-white border-r border-slate-200">

    {{-- BRAND --}}
    <div class="flex items-center gap-3 px-6 py-5 border-b border-slate-200">
        <img src="{{ asset('images/logo-bpr-ntb.png') }}"
             alt="BPR NTB"
             class="h-9 w-auto">

        <span class="font-semibold text-slate-800">
            Admin Panel
        </span>
    </div>

    {{-- MENU --}}
    <nav class="flex flex-col gap-1 px-3 py-4 text-sm">

        {{-- MAIN --}}
        <a href="/admin/main"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->is('admin/main')
                ? 'bg-[#00326B] text-white shadow'
                : 'text-slate-600 hover:bg-slate-100' }}">
            {{-- Home icon --}}
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 9.75L12 4.5l9 5.25V20a1 1 0 01-1 1h-5.25a.75.75 0 01-.75-.75V15a3 3 0 00-6 0v5.25a.75.75 0 01-.75.75H4a1 1 0 01-1-1V9.75z"/>
            </svg>
            <span>Main</span>
        </a>

        {{-- PRODUK & LAYANAN --}}
        <a href="/admin/produk"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->is('admin/produk*')
                ? 'bg-[#00326B] text-white shadow'
                : 'text-slate-600 hover:bg-slate-100' }}">
            {{-- Cube icon --}}
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21 7.5l-9 5.25L3 7.5m18 0l-9-5.25L3 7.5m18 0v9l-9 5.25M3 7.5v9l9 5.25m0-9v9"/>
            </svg>
            <span>Produk &amp; Layanan</span>
        </a>

        {{-- PERUSAHAAN --}}
        <a href="/admin/perusahaan"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->is('admin/perusahaan*')
                ? 'bg-[#00326B] text-white shadow'
                : 'text-slate-600 hover:bg-slate-100' }}">
            {{-- Building icon --}}
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3.75 21h16.5M4.5 3h15v18h-15zM9 7.5h.01M9 12h.01M9 16.5h.01M15 7.5h.01M15 12h.01M15 16.5h.01"/>
            </svg>
            <span>Perusahaan</span>
        </a>

        {{-- JARINGAN --}}
        <a href="/admin/jaringan"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->is('admin/jaringan*')
                ? 'bg-[#00326B] text-white shadow'
                : 'text-slate-600 hover:bg-slate-100' }}">
            {{-- Share icon --}}
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 8a3 3 0 11-6 0 3 3 0 016 0zm6 12a3 3 0 11-6 0 3 3 0 016 0zM3 20a3 3 0 110-6 3 3 0 010 6zm6-6l6-6"/>
            </svg>
            <span>Jaringan</span>
        </a>

        {{-- PUBLIKASI --}}
        <a href="/admin/publikasi"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->is('admin/publikasi*')
                ? 'bg-[#00326B] text-white shadow'
                : 'text-slate-600 hover:bg-slate-100' }}">
            {{-- Megaphone icon --}}
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.5 6h7.5a2.25 2.25 0 012.25 2.25v7.5A2.25 2.25 0 0118 18h-7.5m0-12L3 9v6l7.5 3V6z"/>
            </svg>
            <span>Publikasi</span>
        </a>

        {{-- PENGADUAN --}}
        <a href="/admin/pengaduan"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->is('admin/pengaduan*')
                ? 'bg-[#00326B] text-white shadow'
                : 'text-slate-600 hover:bg-slate-100' }}">
            {{-- Chat icon --}}
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M7.5 8.25h9m-9 3h6M3 20l1.5-4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>Pengaduan</span>
        </a>

        {{-- DIVIDER --}}
        <div class="my-3 border-t border-slate-200"></div>

        {{-- LOGOUT --}}
        <a href="/admin/logout"
           onclick="return confirm('Logout admin?')"
           class="flex items-center gap-3 px-4 py-3 rounded-xl
                  text-red-600 hover:bg-red-50 transition">
            {{-- Logout icon --}}
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3-3H9m0 0l3-3m-3 3l3 3"/>
            </svg>
            <span>Logout</span>
        </a>

    </nav>
</aside>
