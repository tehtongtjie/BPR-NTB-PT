<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-800">
            UMKM · Data Mitra
        </h2>

        <a href="{{ route('umkms.create') }}"
           class="inline-flex items-center gap-2 rounded-xl
                  bg-[#00326B] px-4 py-2 text-sm font-medium
                  text-white hover:bg-[#002855] transition">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Tambah UMKM
        </a>
    </div>

    {{-- CARD --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- FILTER --}}
        <form method="GET"
              class="flex flex-wrap items-center gap-3 px-6 py-4 border-b border-slate-200">

            {{-- SKALA --}}
            <select name="skala"
                class="rounded-lg border border-slate-300 px-3 py-2 text-sm
                       focus:border-[#00326B] focus:ring-[#00326B]">
                <option value="">Semua Skala</option>
                <option value="Lokal" {{ request('skala') === 'Lokal' ? 'selected' : '' }}>
                    Lokal
                </option>
                <option value="Nasional" {{ request('skala') === 'Nasional' ? 'selected' : '' }}>
                    Nasional
                </option>
                <option value="Internasional" {{ request('skala') === 'Internasional' ? 'selected' : '' }}>
                    Internasional
                </option>
            </select>

            {{-- SEARCH --}}
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama usaha..."
                class="w-64 rounded-lg border border-slate-300 px-3 py-2 text-sm
                       focus:border-[#00326B] focus:ring-[#00326B]"
            >

            <button
                class="rounded-lg bg-[#00326B] px-4 py-2 text-sm text-white
                       hover:bg-[#002855] transition">
                Filter
            </button>
        </form>

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 w-16 text-left font-semibold text-slate-600">
                            No
                        </th>
                        <th class="px-6 py-3 w-20 text-left font-semibold text-slate-600">
                            Foto
                        </th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-600">
                            Nama Usaha
                        </th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-600">
                            Pemilik
                        </th>
                        <th class="px-6 py-3 w-40 text-left font-semibold text-slate-600">
                            Skala
                        </th>
                        <th class="px-6 py-3 w-40 text-right font-semibold text-slate-600">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($umkms as $item)
                        <tr class="hover:bg-slate-50 transition">

                            {{-- NO --}}
                            <td class="px-6 py-4 text-slate-600">
                                {{ $loop->iteration + ($umkms->currentPage() - 1) * $umkms->perPage() }}
                            </td>

                            {{-- FOTO --}}
                            <td class="px-6 py-4">
                                @php
                                    $thumb = $item->images->where('is_thumbnail', true)->first()
                                              ?? $item->images->first();
                                @endphp

                                @if($thumb)
                                    <img src="{{ asset('storage/' . $thumb->image_path) }}"
                                         class="h-12 w-12 rounded-lg object-cover border border-slate-200">
                                @else
                                    <div class="h-12 w-12 rounded-lg bg-slate-100 flex items-center justify-center text-xs text-slate-400">
                                        No Image
                                    </div>
                                @endif
                            </td>

                            {{-- NAMA USAHA --}}
                            <td class="px-6 py-4 font-medium text-slate-800">
                                {{ $item->nama_usaha }}
                            </td>

                            {{-- PEMILIK --}}
                            <td class="px-6 py-4 text-slate-600">
                                {{ $item->nama_pemilik }}
                            </td>

                            {{-- SKALA --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full
                                    px-3 py-1 text-xs font-medium
                                    {{
                                        $item->skala === 'Internasional'
                                            ? 'bg-emerald-50 text-emerald-700'
                                            : ($item->skala === 'Nasional'
                                                ? 'bg-blue-50 text-blue-700'
                                                : 'bg-amber-50 text-amber-700')
                                    }}">
                                    {{ $item->skala ?? '-' }}
                                </span>
                            </td>

                            {{-- AKSI --}}
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">

                                    {{-- EDIT --}}
                                    <a href="{{ route('umkms.edit', $item->id) }}"
                                       class="inline-flex items-center justify-center
                                              rounded-lg border border-yellow-200
                                              bg-yellow-50 p-2 text-yellow-700
                                              hover:bg-yellow-100 transition">
                                        <svg class="h-4 w-4" fill="none"
                                             stroke="currentColor" stroke-width="2"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M16.862 4.487l1.687-1.687
                                                     a1.875 1.875 0 112.652 2.652
                                                     L7.5 19.125H3.75v-3.75
                                                     L16.862 4.487z"/>
                                        </svg>
                                    </a>

{{-- DELETE UMKM --}}
<form id="delete-form-umkm-{{ $item->id }}" 
      action="{{ route('umkms.destroy', $item->id) }}"
      method="POST" 
      class="inline">
    @csrf
    @method('DELETE')

    <button type="button"
            {{-- PERBAIKAN DI SINI: Gunakan $item->nama_usaha --}}
            onclick="confirmDeleteUmkm('{{ $item->id }}', '{{ addslashes($item->nama_usaha) }}')"
            class="inline-flex items-center justify-center
                   rounded-lg border border-red-200
                   bg-red-50 p-2 text-red-600
                   hover:bg-red-600 hover:text-white 
                   hover:border-red-600 transition-all duration-200">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M6 7.5h12M9 7.5V5.25A1.5 1.5 0 0110.5 3.75h3A1.5 1.5 0 0115 5.25V7.5m-7.5 0v11.25A1.5 1.5 0 009 20.25h6a1.5 1.5 0 001.5-1.5V7.5"/>
        </svg>
    </button>
</form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"
                                class="px-6 py-14 text-center text-slate-500">
                                Belum ada data UMKM
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="border-t border-slate-200 px-6 py-4">
            {{ $umkms->links() }}
        </div>

    </div>

</div>
<script>
function confirmDeleteUmkm(id, nama) {
    Swal.fire({
        title: 'Hapus Data UMKM?',
        // Penting: Gunakan tanda backtick ( ` ) bukan kutip tunggal untuk baris di bawah ini
        html: `Apakah Anda yakin ingin menghapus UMKM <br><strong>"${nama}"</strong>?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        borderRadius: '0.75rem'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-umkm-' + id).submit();
        }
    })
}
</script>