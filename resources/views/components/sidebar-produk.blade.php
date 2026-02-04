<div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6">
        <div class="flex items-center gap-2 mb-6 px-2">
            <div class="w-1.5 h-6 bg-blue-600 rounded-full"></div>
            <h6 class="text-xs font-black uppercase tracking-widest text-gray-400">
                Daftar Produk
            </h6>
        </div>

        {{-- LIST PRODUK (DINAMIS DARI DATABASE) --}}
        <ul class="space-y-2">
            @forelse ($sidebarPromos as $promo)
                @php
                    /**
                     * Active jika:
                     * - route = tabungan.show
                     * - slug URL = slug promo
                     */
                    $isActive =
                        request()->routeIs('tabungan.show') &&
                        request()->route('slug') === $promo->slug;
                @endphp

                <li>
                    <a href="{{ route('tabungan.show', $promo->slug) }}"
                       class="group flex items-center justify-between px-4 py-3.5 rounded-2xl
                       transition-all duration-300
                       {{ $isActive
                           ? 'bg-blue-600 text-white shadow-lg shadow-blue-200 translate-x-1'
                           : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600 hover:translate-x-1' }}">

                        <div class="flex items-center gap-3">
                            {{-- ICON DEFAULT --}}
                            <i class="bi bi-wallet2
                                {{ $isActive ? 'text-white' : 'text-blue-600 opacity-60' }}
                                group-hover:opacity-100 transition-opacity">
                            </i>

                            <span class="text-sm font-bold tracking-tight">
                                {{ $promo->title }}
                            </span>
                        </div>

                        <i class="bi bi-chevron-right text-[10px]
                           transition-transform duration-300
                           {{ $isActive
                               ? 'translate-x-0 opacity-100'
                               : '-translate-x-2 opacity-0 group-hover:translate-x-0 group-hover:opacity-100' }}">
                        </i>
                    </a>
                </li>
            @empty
                <li class="px-4 py-3 text-sm text-gray-400 italic">
                    Produk belum tersedia
                </li>
            @endforelse
        </ul>
    </div>

    <div class="bg-gray-50 p-6 border-t border-gray-100">
        <p class="text-[10px] text-gray-400 font-medium leading-relaxed italic">
            * Suku bunga dapat berubah sewaktu-waktu sesuai ketentuan penjaminan LPS.
        </p>
    </div>
</div>
