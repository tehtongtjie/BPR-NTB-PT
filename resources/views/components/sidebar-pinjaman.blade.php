<div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
    <div class="p-7">
        {{-- Heading dengan gaya Sub-label Premium --}}
        <div class="flex items-center gap-3 mb-6 px-2">
            <div class="w-1.5 h-6 bg-blue-600 rounded-full"></div>
            <h6 class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Daftar Pinjaman</h6>
        </div>

        {{-- List Menu --}}
        <ul class="space-y-2">
            @php
                $sidebarItems = [
                    ['slug' => 'kredit-modal-kerja', 'label' => 'Kredit Modal Kerja'],
                    ['slug' => 'kredit-konsumtif', 'label' => 'Kredit Konsumtif'],
                    // Anda bisa menambah item lain di sini jika ada
                ];
            @endphp

            @foreach ($sidebarItems as $item)
                @php $isActive = request()->is('pinjaman/' . $item['slug']); @endphp

                <li>
                    <a href="{{ route('pinjaman.show', $item['slug']) }}"
                        class="group flex items-center justify-between px-5 py-4 rounded-2xl transition-all duration-300
                       {{ $isActive
                           ? 'bg-blue-600 text-white shadow-lg shadow-blue-200'
                           : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600' }}">

                        <span class="text-sm font-bold tracking-tight">
                            {{ $item['label'] }}
                        </span>

                        {{-- Ikon panah yang muncul/berubah saat aktif atau hover --}}
                        <i
                            class="bi bi-chevron-right text-xs transition-transform duration-300 
                           {{ $isActive ? 'translate-x-0 opacity-100' : '-translate-x-2 opacity-0 group-hover:translate-x-0 group-hover:opacity-100' }}">
                        </i>
                    </a>
                </li>
            @endforeach
        </ul>

        {{-- Info Tambahan Mini (Opsional) --}}
        <div class="mt-8 px-4 py-4 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
            <p class="text-[10px] text-gray-400 font-bold leading-relaxed uppercase">
                Butuh bantuan memilih produk? <br>
                <a href="#" class="text-blue-600 hover:underline">Hubungi CS Kami</a>
            </p>
        </div>
    </div>
</div>
