<div x-data="{ mobile: false, scrolled: false }" class="relative">

    <header @scroll.window="scrolled = window.pageYOffset > 20" @keydown.escape.window="mobile = false"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-300">

        <div class="w-full h-9 flex items-center border-b transition-all duration-300"
            :class="scrolled ? 'bg-[#00326B]/90 backdrop-blur-md border-white/5' : 'bg-[#00326B] border-white/10 shadow-inner'">
            <div
                class="max-w-7xl mx-auto px-6 w-full flex justify-between items-center text-[10px] tracking-[0.1em] font-bold text-blue-100/80 uppercase">

                {{-- Kiri: Jam Operasional (Statis) --}}
                <div class="flex items-center gap-3 shrink-0 mr-6 pr-6 border-r border-white/10 h-9">
                    <i class="bi bi-clock-history text-[#fbbf24]"></i>
                    <span class="whitespace-nowrap">Senin – Jumat <span class="text-[#fbbf24] mx-1">|</span> 08.00 –
                        15.00 WITA</span>
                </div>

                <div class="flex-grow overflow-hidden whitespace-nowrap flex items-center">
                    <div class="animate-marquee inline-block text-white/70 italic font-medium">
                        @php
                            $runningText =
                                'Layanan perbankan tetap berjalan normal melalui kantor cabang terdekat selama pemeliharaan sistem. • Harap waspada terhadap penipuan yang mengatasnamakan BPR NTB. • ';
                        @endphp
                        <span>{{ $runningText }}</span>
                        <span>{{ $runningText }}</span>
                    </div>
                </div>
                <div class="hidden md:flex items-center gap-5 shrink-0 ml-6 pl-6 border-l border-white/10 h-9">
                    {{-- Instagram --}}
                    <a href="https://surl.li/cfzadj" target="_blank" rel="noopener noreferrer"
                        class="text-white/60 hover:text-[#fbbf24] transition-all hover:scale-110">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>
            </div>
        </div>

        <nav :class="scrolled ? 'bg-white/80 backdrop-blur-xl shadow-[0_8px_30px_rgb(0,50,107,0.08)] h-16' : 'bg-white h-20'"
            class="transition-all duration-300 border-b border-gray-100 flex items-center">
            <div class="max-w-7xl mx-auto px-6 h-full w-full flex justify-between items-center">

                <a href="/" class="transition-all duration-300 transform"
                    :class="scrolled ? 'scale-90' : 'scale-100'">
                    <img src="{{ asset('storage/images/logobpr.png') }}" class="h-30 w-auto" alt="BPR NTB">
                </a>

                <div class="hidden lg:flex items-center gap-1">
                    <a href="/"
                        class="px-4 py-2 text-[12px] font-bold uppercase tracking-widest text-gray-500 hover:text-[#00326B] transition-colors relative group">
                        Beranda
                        <span
                            class="absolute bottom-0 left-4 right-4 h-0.5 bg-[#fbbf24] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </a>

                    @foreach ($menus as $title => $items)
                        <div x-data="{ open: false }" @mouseenter="open=true" @mouseleave="open=false"
                            class="relative group">
                            <button
                                class="px-4 py-2 text-[12px] font-bold uppercase tracking-widest text-gray-500 group-hover:text-[#00326B] flex items-center gap-1.5 transition-all">
                                {{ $title }}
                                <i class="bi bi-chevron-down text-[9px] transition-transform duration-300"
                                    :class="open ? 'rotate-180 text-[#fbbf24]' : ''"></i>
                            </button>

                            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0" x-cloak
                                class="absolute top-full left-1/2 -translate-x-1/2 mt-0 w-64 bg-white shadow-[0_20px_50px_rgba(0,50,107,0.15)] rounded-2xl border border-gray-50 p-2 overflow-hidden">

                                @foreach ($items as $i)
                                    @if (isset($i['children']))
                                        <div class="px-4 py-3 mt-1">
                                            <p
                                                class="text-[9px] font-black text-[#00326B]/40 uppercase tracking-[0.2em] mb-2">
                                                {{ $i['label'] }}</p>
                                            <div class="space-y-1">
                                                @foreach ($i['children'] as $c)
                                                    <a href="{{ isset($c['param']) ? route($c['route'], $c['param']) : route($c['route']) }}"
                                                        class="block px-3 py-2 text-sm font-semibold text-gray-600 rounded-xl hover:bg-blue-50 hover:text-[#00326B] transition-all">
                                                        {{ $c['label'] }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <a href="{{ isset($i['param']) ? route($i['route'], $i['param']) : (Route::has($i['route']) ? route($i['route']) : '#') }}"
                                            class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-600 rounded-xl hover:bg-blue-50 hover:text-[#00326B] transition-all">
                                            <i class="bi {{ $i['icon'] ?? 'bi-circle' }} text-[#fbbf24] text-xs"></i>
                                            {{ $i['label'] }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex items-center gap-4">
                    <button @click="mobile = true"
                        class="lg:hidden p-2 text-[#00326B] hover:bg-gray-100 rounded-xl transition-colors">
                        <i class="bi bi-grid-fill text-2xl"></i>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <template x-teleport="body">
        <div x-show="mobile" x-transition:opacity x-cloak class="fixed inset-0 z-[9999] lg:hidden">
            <div class="absolute inset-0 bg-[#00326B]/40 backdrop-blur-md" @click="mobile=false"></div>

            <div x-show="mobile" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                class="absolute right-4 top-4 bottom-4 w-[85%] max-w-[320px] bg-white rounded-[2rem] shadow-2xl flex flex-col overflow-hidden border-r-4 border-[#fbbf24]">

                <div class="p-6 flex items-center justify-between border-b border-gray-50">
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-[#00326B]/40">Navigasi
                        Utama</span>
                    <button @click="mobile=false"
                        class="w-10 h-10 flex items-center justify-center bg-gray-50 text-gray-400 rounded-full">
                        <i class="bi bi-x-lg text-sm"></i>
                    </button>
                </div>

                <div class="flex-grow overflow-y-auto p-4 space-y-2">
                    <a href="/" @click="mobile=false"
                        class="flex items-center gap-4 px-5 py-4 font-bold text-[#00326B] bg-blue-50 rounded-2xl">
                        <i class="bi bi-house-door text-lg text-[#fbbf24]"></i> Beranda
                    </a>

                    @foreach ($menus as $title => $items)
                        <div x-data="{ openMob: false }" class="rounded-2xl border border-gray-50 overflow-hidden"
                            :class="openMob ? 'bg-gray-50/50' : ''">
                            <button @click="openMob=!openMob"
                                class="w-full flex justify-between items-center px-5 py-4 text-[13px] font-bold text-[#00326B] uppercase tracking-wider">
                                {{ $title }}
                                <i class="bi bi-chevron-down text-[10px] transition-transform duration-300"
                                    :class="openMob ? 'rotate-180 text-[#fbbf24]' : ''"></i>
                            </button>

                            <div x-show="openMob" x-collapse class="px-4 pb-4 space-y-1">
                                @foreach ($items as $i)
                                    @if (isset($i['children']))
                                        <div
                                            class="px-4 py-2 text-[9px] font-black text-gray-400 uppercase tracking-widest mt-2 border-l-2 border-[#fbbf24] ml-2">
                                            {{ $i['label'] }}</div>
                                        @foreach ($i['children'] as $c)
                                            <a href="{{ isset($c['param']) ? route($c['route'], $c['param']) : (Route::has($c['route']) ? route($c['route']) : '#') }}"
                                                @click="mobile = false"
                                                class="flex items-center gap-3 pl-6 py-2 text-sm font-semibold text-gray-500 hover:text-[#00326B]">
                                                <span class="w-1 h-1 bg-[#fbbf24] rounded-full"></span>
                                                {{ $c['label'] }}
                                            </a>
                                        @endforeach
                                    @else
                                        <a href="{{ isset($i['param']) ? route($i['route'], $i['param']) : (Route::has($i['route']) ? route($i['route']) : '#') }}"
                                            @click="mobile = false"
                                            class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-600 rounded-xl hover:bg-white hover:text-[#00326B]">
                                            <i class="bi {{ $i['icon'] ?? 'bi-dot' }} text-[#fbbf24]/60"></i>
                                            {{ $i['label'] }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="p-6 bg-[#00326B]">
                    <a href="tel:0800123456"
                        class="w-full flex items-center justify-center gap-3 py-4 bg-white rounded-2xl shadow-sm text-sm font-bold text-[#00326B] border-b-4 border-[#fbbf24]">
                        <i class="bi bi-headset text-[#fbbf24]"></i> Bantuan 24 Jam
                    </a>
                </div>
            </div>
        </div>
    </template>
</div>
