<div x-data="{ mobile: false, scrolled: false }" @scroll.window="scrolled = window.pageYOffset > 20" class="relative font-sans">

    <header class="fixed top-0 left-0 w-full z-[100] transition-all duration-500">

        {{-- TOP BAR: Informasi & Sosmed --}}
        <div class="w-full h-10 flex items-center border-b transition-all duration-500"
            :class="scrolled ? 'bg-[#00326B]/95 backdrop-blur-md border-white/5' : 'bg-[#00326B] border-white/10 shadow-inner'">
            <div
                class="max-w-7xl mx-auto px-6 w-full flex justify-between items-center text-[10px] tracking-wider font-bold text-blue-100/90 uppercase">

                <div class="flex items-center gap-3 shrink-0 mr-6 pr-6 border-r border-white/10 h-10">
                    <i class="bi bi-clock-history text-amber-400"></i>
                    <span class="whitespace-nowrap italic tracking-normal">Operational: <span
                            class="text-amber-400 ml-1">08:00 – 15:00 WITA</span></span>
                </div>

                <div class="flex-grow overflow-hidden whitespace-nowrap flex items-center">
                    <div class="animate-marquee inline-block text-white/70 font-medium italic">
                        <span>Dukung produk lokal NTB bersama BPR NTB. • Temukan berbagai produk unggulan dari UMKM
                            binaan kami. • </span>
                        <span>Dukung produk lokal NTB bersama BPR NTB. • Temukan berbagai produk unggulan dari UMKM
                            binaan kami. • </span>
                    </div>
                </div>

                <div class="hidden md:flex items-center gap-4 shrink-0 ml-6 pl-6 border-l border-white/10 h-10">
                    <a href="#" class="text-white/60 hover:text-amber-400 transition-colors"><i
                            class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white/60 hover:text-amber-400 transition-colors"><i
                            class="bi bi-facebook"></i></a>
                </div>
            </div>
        </div>

        {{-- MAIN NAV --}}
        <nav :class="scrolled ? 'bg-white/80 backdrop-blur-xl shadow-lg h-16' : 'bg-white h-24'"
            class="transition-all duration-500 border-b border-gray-100 flex items-center">
            <div class="max-w-7xl mx-auto px-6 h-full w-full flex justify-between items-center">

                {{-- Logo Section --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group transition-all duration-500"
                    :class="scrolled ? 'scale-90' : 'scale-100'">
                    <img src="{{ asset('images/logobpr.png') }}"
                        class="h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-105"
                        alt="BPR NTB">
                    <div class="hidden sm:flex flex-col border-l border-gray-200 pl-3">
                        <span class="text-[15px] font-black text-[#00326B] leading-none uppercase tracking-tighter">BPR
                            NTB</span>
                        <span class="text-[9px] font-bold text-amber-500 uppercase tracking-[0.2em] mt-1">Mitra
                            UMKM</span>
                    </div>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden lg:flex items-center gap-1 h-full">
                    {{-- 1. Beranda --}}
                    <a href="{{ route('home') }}"
                        class="px-5 text-[11px] font-black uppercase tracking-[0.15em] flex items-center gap-2 {{ request()->routeIs('home') ? 'text-amber-500' : 'text-[#00326B]/70 hover:text-[#00326B]' }} transition-all">
                        <i class="bi bi-house-door text-sm"></i>
                        Beranda
                    </a>

                    {{-- 2. Shop --}}
                    <a href="{{ route('umkm.mitra') }}"
                        class="px-5 text-[11px] font-black uppercase tracking-[0.15em] flex items-center gap-2 relative group {{ request()->routeIs('umkm.mitra') ? 'text-amber-500' : 'text-[#00326B]/70 hover:text-[#00326B]' }}">
                        <i class="bi bi-bag-dash text-sm"></i>
                        Shop
                        <span
                            class="absolute -bottom-1 left-5 right-5 h-0.5 bg-amber-500 transition-all duration-500 {{ request()->routeIs('umkm.mitra') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    </a>

                    {{-- 3. Pelatihan UMKM --}}
                    <a href="#"
                        class="px-5 text-[11px] font-black uppercase tracking-[0.15em] flex items-center gap-2 text-[#00326B]/70 hover:text-[#00326B] transition-all">
                        <i class="bi bi-person-video3 text-sm"></i>
                        Pelatihan UMKM
                    </a>

                    {{-- 4. Hubungi Kami --}}
                    <a href="#footer"
                        class="px-5 text-[11px] font-black uppercase tracking-[0.15em] flex items-center gap-2 text-[#00326B]/70 hover:text-[#00326B] transition-all">
                        <i class="bi bi-telephone-outbound text-sm"></i>
                        Hubungi Kami
                    </a>
                </div>

                {{-- Hamburger Mobile --}}
                <button @click="mobile = true"
                    class="lg:hidden w-11 h-11 flex items-center justify-center bg-gray-50 rounded-xl text-[#00326B] hover:bg-[#00326B] hover:text-white transition-all">
                    <i class="bi bi-grid-fill text-2xl"></i>
                </button>
            </div>
        </nav>
    </header>

    {{-- MOBILE MENU --}}
    <template x-teleport="body">
        <div x-show="mobile" x-transition:opacity x-cloak class="fixed inset-0 z-[9999] lg:hidden">
            <div class="absolute inset-0 bg-[#00326B]/60 backdrop-blur-lg" @click="mobile=false"></div>

            <div x-show="mobile" x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                class="absolute right-0 top-0 bottom-0 w-[80%] max-w-[320px] bg-white shadow-2xl flex flex-col p-8">

                <div class="flex justify-between items-center mb-10">
                    <img src="{{ asset('images/logobpr.png') }}" class="h-8 w-auto" alt="Logo">
                    <button @click="mobile=false"
                        class="text-2xl text-gray-400 transition-transform hover:rotate-90 duration-300">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="space-y-8 flex flex-col">
                    <a href="{{ route('home') }}"
                        class="flex items-center gap-4 text-xs font-black uppercase tracking-widest text-[#00326B] hover:text-amber-500 transition-colors">
                        <i class="bi bi-house-door text-lg text-amber-500"></i> Beranda
                    </a>
                    <a href="{{ route('umkm.mitra') }}"
                        class="flex items-center gap-4 text-xs font-black uppercase tracking-widest text-amber-500">
                        <i class="bi bi-bag-dash text-lg text-amber-500"></i> Shop
                    </a>
                    <a href="#"
                        class="flex items-center gap-4 text-xs font-black uppercase tracking-widest text-[#00326B] hover:text-amber-500 transition-colors">
                        <i class="bi bi-person-video3 text-lg text-amber-500"></i> Pelatihan UMKM
                    </a>
                    <a href="#"
                        class="flex items-center gap-4 text-xs font-black uppercase tracking-widest text-[#00326B] hover:text-amber-500 transition-colors">
                        <i class="bi bi-telephone-outbound text-lg text-amber-500"></i> Hubungi Kami
                    </a>
                </div>

                <div class="mt-auto p-6 bg-blue-50 rounded-3xl text-center border border-blue-100">
                    <p class="text-[9px] font-black text-[#00326B]/40 uppercase tracking-widest mb-2 font-black">
                        Pemberdayaan Ekonomi</p>
                    <p class="text-[#00326B] text-[12px] font-bold italic tracking-tighter uppercase">PT. BPR NTB
                        (Perseroda)</p>
                </div>
            </div>
        </div>
    </template>
</div>
