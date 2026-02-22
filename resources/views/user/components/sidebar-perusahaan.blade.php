<div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
    <div class="p-7">
        <div class="flex items-center gap-3 mb-6 px-2">
            <div class="w-1.5 h-6 bg-blue-600 rounded-full"></div>
            <h6 class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Tentang Perusahaan</h6>
        </div>

        <ul class="space-y-2">
            @php
                $perusahaanMenu = [
                    ['slug' => 'sejarah', 'label' => 'Sejarah'],
                    ['slug' => 'visi-misi', 'label' => 'Visi & Misi'],
                    ['slug' => 'budaya', 'label' => 'Budaya Perusahaan'],
                    ['slug' => 'komisaris', 'label' => 'Dewan Komisaris'],
                    ['slug' => 'direksi', 'label' => 'Direksi'],
                    ['slug' => 'tata-kelola', 'label' => 'Tata Kelola'],
                ];
            @endphp

            @foreach ($perusahaanMenu as $menu)
                @php $isActive = ($slug === $menu['slug']); @endphp

                <li>
                    <a href="{{ route('perusahaan.show', $menu['slug']) }}"
                        class="group flex items-center justify-between px-5 py-4 rounded-2xl transition-all duration-300
                       {{ $isActive
                           ? 'bg-blue-600 text-white shadow-lg shadow-blue-200'
                           : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600' }}">

                        <span class="text-sm font-bold tracking-tight">
                            {{ $menu['label'] }}
                        </span>

                        <i
                            class="bi bi-chevron-right text-xs transition-all duration-300 
                           {{ $isActive ? 'translate-x-0 opacity-100' : '-translate-x-2 opacity-0 group-hover:translate-x-0 group-hover:opacity-100' }}">
                        </i>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="mt-8 px-5 py-5 bg-gray-50 rounded-[1.5rem] border border-dashed border-gray-200">
            <p class="text-[9px] text-gray-400 font-bold leading-relaxed uppercase tracking-wider">
                Laporan Tahunan & Publikasi dapat dilihat pada halaman <br>
                <a href="#" class="text-blue-600 hover:underline">Informasi Investor</a>
            </p>
        </div>
    </div>
</div>
