<div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6">
        <div class="flex items-center gap-2 mb-6 px-2">
            <div class="w-1.5 h-6 bg-blue-600 rounded-full"></div>
            <h6 class="text-xs font-black uppercase tracking-widest text-gray-400">Daftar Produk</h6>
        </div>

        <ul class="space-y-2">
            @php
                $sidebarMenus = [
                    ['slug' => 'tabunganku', 'label' => 'TabunganKu', 'icon' => 'bi-wallet2'],
                    ['slug' => 'tabungan-sukses', 'label' => 'Tabungan Sukses', 'icon' => 'bi-graph-up-arrow'],
                    ['slug' => 'simbada', 'label' => 'SIMBADA', 'icon' => 'bi-trophy'],
                    ['slug' => 'tabungan-simpel', 'label' => 'Tabungan Simpel', 'icon' => 'bi-lightning-charge'],
                ];
            @endphp

            @foreach ($sidebarMenus as $menu)
                @php
                    $isActive = request()->is('tabungan/' . $menu['slug']);
                @endphp

                <li>
                    <a href="{{ route('tabungan.show', $menu['slug']) }}"
                        class="group flex items-center justify-between px-4 py-3.5 rounded-2xl transition-all duration-300 
                       {{ $isActive
                           ? 'bg-blue-600 text-white shadow-lg shadow-blue-200 translate-x-1'
                           : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600 hover:translate-x-1' }}">

                        <div class="flex items-center gap-3">
                            <i
                                class="bi {{ $menu['icon'] }} {{ $isActive ? 'text-white' : 'text-blue-600 opacity-60' }} group-hover:opacity-100 transition-opacity"></i>
                            <span class="text-sm font-bold tracking-tight">{{ $menu['label'] }}</span>
                        </div>

                        <i
                            class="bi bi-chevron-right text-[10px] transition-transform duration-300 {{ $isActive ? 'translate-x-0 opacity-100' : '-translate-x-2 opacity-0 group-hover:translate-x-0 group-hover:opacity-100' }}"></i>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="bg-gray-50 p-6 border-t border-gray-100">
        <p class="text-[10px] text-gray-400 font-medium leading-relaxed italic">
            * Suku bunga dapat berubah sewaktu-waktu sesuai ketentuan penjaminan LPS.
        </p>
    </div>
</div>
