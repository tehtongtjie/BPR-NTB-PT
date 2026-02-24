<aside class="fixed left-0 top-0 z-40 h-screen w-64 bg-white border-r border-slate-200 flex flex-col shadow-sm">

    {{-- BRAND SECTION --}}
    <div class="flex items-center gap-3 px-6 py-6 border-b border-slate-100 bg-slate-50/30">
        <div class="bg-white p-2 rounded-xl shadow-sm border border-slate-100 flex-shrink-0">
            <img src="{{ asset('storage/images/logobpr.png') }}" alt="BPR NTB" class="h-7 w-auto">
        </div>
        <div class="flex flex-col leading-tight overflow-hidden">
            <span class="font-black text-[#00326B] tracking-tight text-sm uppercase truncate">BPR NTB</span>
            <span class="text-[10px] font-bold text-slate-400 tracking-widest uppercase italic">Admin Panel</span>
        </div>
    </div>

    {{-- MENU NAVIGATION --}}
    <nav class="flex-1 flex flex-col gap-1 px-4 py-6 overflow-y-auto custom-scrollbar text-[13px]">

        {{-- LABEL: UTAMA --}}
        @can('admin-sekper')
        <div class="px-4 mb-2">
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Utama</span>
        </div>

        <a href="/admin/main"
            class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300 group
            {{ request()->is('admin/main*') ? 'bg-[#00326B] text-white shadow-lg shadow-blue-900/20' : 'text-slate-600 hover:bg-blue-50 hover:text-[#00326B]' }}">
            <svg class="w-5 h-5 transition-colors {{ request()->is('admin/main*') ? 'text-white' : 'text-slate-400 group-hover:text-[#00326B]' }}"
                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 9.75L12 4.5l9 5.25V20a1 1 0 01-1 1h-5.25a.75.75 0 01-.75-.75V15a3 3 0 00-6 0v5.25a.75.75 0 01-.75.75H4a1 1 0 01-1-1V9.75z" />
            </svg>
            <span class="font-bold">Dashboard</span>
        </a>
        @endcan



        {{-- LABEL: MANAJEMEN --}}
        <div class="px-4 mt-6 mb-2">
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Konten & Layanan</span>
        </div>

        {{-- MENU UMKM: IT & BISNIS --}}
        @can('admin-bisnis')
        <a href="/admin/umkms"
            class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300 group
            {{ request()->is('admin/umkms*') ? 'bg-[#00326B] text-white shadow-lg shadow-blue-900/20' : 'text-slate-600 hover:bg-blue-50 hover:text-[#00326B]' }}">
            <svg class="w-5 h-5 transition-colors {{ request()->is('admin/umkms*') ? 'text-white' : 'text-slate-400 group-hover:text-[#00326B]' }}"
                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 7.5l-9 5.25L3 7.5m18 0l-9-5.25L3 7.5m18 0v9l-9 5.25M3 7.5v9l9 5.25m0-9v9" />
            </svg>
            <span class="font-bold">UMKM</span>
        </a>
        @endcan

        {{-- MENU SEKPER: IT & SEKPER --}}
        @can('admin-sekper')
        <a href="/admin/perusahaan"
            class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300 group
            {{ request()->is('admin/perusahaan*') ? 'bg-[#00326B] text-white shadow-lg shadow-blue-900/20' : 'text-slate-600 hover:bg-blue-50 hover:text-[#00326B]' }}">
            <svg class="w-5 h-5 transition-colors {{ request()->is('admin/perusahaan*') ? 'text-white' : 'text-slate-400 group-hover:text-[#00326B]' }}"
                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 21h16.5M4.5 3h15v18h-15zM9 7.5h.01M9 12h.01M9 16.5h.01M15 7.5h.01M15 12h.01M15 16.5h.01" />
            </svg>
            <span class="font-bold">Perusahaan</span>
        </a>

        <a href="/admin/jaringan"
            class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300 group
            {{ request()->is('admin/jaringan*') ? 'bg-[#00326B] text-white shadow-lg shadow-blue-900/20' : 'text-slate-600 hover:bg-blue-50 hover:text-[#00326B]' }}">
            <svg class="w-5 h-5 transition-colors {{ request()->is('admin/jaringan*') ? 'text-white' : 'text-slate-400 group-hover:text-[#00326B]' }}"
                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 8a3 3 0 11-6 0 3 3 0 016 0zm6 12a3 3 0 11-6 0 3 3 0 016 0zM3 20a3 3 0 110-6 3 3 0 010 6zm6-6l6-6" />
            </svg>
            <span class="font-bold">Jaringan Kantor</span>
        </a>

        <a href="/admin/publikasi"
            class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300 group
            {{ request()->is('admin/publikasi*') ? 'bg-[#00326B] text-white shadow-lg shadow-blue-900/20' : 'text-slate-600 hover:bg-blue-50 hover:text-[#00326B]' }}">
            <svg class="w-5 h-5 transition-colors {{ request()->is('admin/publikasi*') ? 'text-white' : 'text-slate-400 group-hover:text-[#00326B]' }}"
                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.5 6h7.5a2.25 2.25 0 012.25 2.25v7.5A2.25 2.25 0 0118 18h-7.5m0-12L3 9v6l7.5 3V6z" />
            </svg>
            <span class="font-bold">Publikasi</span>
        </a>
        @endcan

        {{-- MENU MESSAGE: HANYA IT --}}
        @can('admin-it')
        <a href="{{ route('admin.messages.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300 group
            {{ request()->is('admin/messages*') ? 'bg-[#00326B] text-white shadow-lg shadow-blue-900/20' : 'text-slate-600 hover:bg-blue-50 hover:text-[#00326B]' }}">

            <svg class="w-5 h-5 transition-colors {{ request()->is('admin/messages*') ? 'text-white' : 'text-slate-400 group-hover:text-[#00326B]' }}"
                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2v10z" />
            </svg>

            <div class="flex flex-col leading-tight">
                <span class="font-bold">Message</span>
                <span class="text-[9px] font-medium text-slate-400">
                    Pesan Masuk
                </span>
            </div>
        </a>
        @endcan

        {{-- LOGOUT (DI BAWAH) --}}
        {{-- LOGOUT (DI BAWAH) --}}
        <div class="mt-auto pt-10">
            <div class="my-4 border-t border-slate-100"></div>

            <a href="javascript:void(0)"
                onclick="confirmLogout()"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl text-red-500 font-black uppercase text-[11px] tracking-widest hover:bg-red-50 transition-all duration-300 cursor-pointer">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3-3H9m0 0l3-3m-3 3l3 3" />
                </svg>
                <span>Keluar Panel</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>

    </nav>
</aside>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }
</style>

<script>
function confirmLogout() {
    Swal.fire({
        title: 'Konfirmasi Keluar',
        text: "Apakah Anda yakin ingin mengakhiri sesi admin ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#00326B', // Warna Biru BPR NTB
        cancelButtonColor: '#616e7a', // Warna Slate 100
        confirmButtonText: 'YA, KELUAR',
        cancelButtonText: 'BATAL',
        reverseButtons: true,
        customClass: {
            popup: 'rounded-[2rem]',
            confirmButton: 'rounded-xl font-bold px-6 py-3',
            cancelButton: 'rounded-xl font-bold px-6 py-3 text-slate-600'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Tampilkan loading sebentar sebelum submit
            Swal.fire({
                title: 'Logging out...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            document.getElementById('logout-form').submit();
        }
    })
}
</script>