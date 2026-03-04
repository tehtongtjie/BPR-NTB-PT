<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-800">
            Publikasi · Laporan
        </h2>

        <a href="{{ route('admin.publikasi.laporan.create') }}"
           class="inline-flex items-center gap-2 rounded-xl
                  bg-[#00326B] px-4 py-2 text-sm font-medium
                  text-white hover:bg-[#002855] transition">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Tambah Laporan
        </a>
    </div>

    {{-- CARD --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- FILTER (OPSIONAL, TAMPILAN SIAP) --}}
        <form method="GET"
              class="flex flex-wrap items-center gap-3 px-6 py-4 border-b border-slate-200">

            {{-- TIPE --}}
            <select name="tipe"
                class="rounded-lg border border-slate-300 px-3 py-2 text-sm
                       focus:border-[#00326B] focus:ring-[#00326B]">
                <option value="">Semua Tipe</option>
                <option value="keuangan" {{ request('tipe') === 'keuangan' ? 'selected' : '' }}>
                    Keuangan
                </option>
                <option value="tata-kelola" {{ request('tipe') === 'tata-kelola' ? 'selected' : '' }}>
                    Tata Kelola
                </option>
                <option value="berkelanjutan" {{ request('tipe') === 'berkelanjutan' ? 'selected' : '' }}>
                    Berkelanjutan
                </option>
            </select>

            {{-- TAHUN --}}
            <input
                type="text"
                name="tahun"
                value="{{ request('tahun') }}"
                placeholder="Tahun (contoh: 2025)"
                class="w-40 rounded-lg border border-slate-300 px-3 py-2 text-sm
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
                        <th class="px-6 py-3 w-32 text-left font-semibold text-slate-600">
                            Tipe
                        </th>
                        <th class="px-6 py-3 w-28 text-left font-semibold text-slate-600">
                            Tahun
                        </th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-600">
                            Judul Laporan
                        </th>
                        <th class="px-6 py-3 w-40 text-right font-semibold text-slate-600">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($laporans as $item)
                        <tr class="hover:bg-slate-50 transition">

                            {{-- NO --}}
                            <td class="px-6 py-4 text-slate-600">
                                {{ $loop->iteration + ($laporans->currentPage() - 1) * $laporans->perPage() }}
                            </td>

                            {{-- TIPE --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full
                                    px-3 py-1 text-xs font-medium
                                    {{
                                        $item->tipe === 'keuangan'
                                            ? 'bg-blue-50 text-blue-700'
                                            : ($item->tipe === 'tata-kelola'
                                                ? 'bg-amber-50 text-amber-700'
                                                : 'bg-emerald-50 text-emerald-700')
                                    }}">
                                    {{ strtoupper(str_replace('-', ' ', $item->tipe)) }}
                                </span>
                            </td>

                            {{-- TAHUN --}}
                            <td class="px-6 py-4 text-slate-600">
                                {{ $item->tahun }}
                            </td>

                            {{-- JUDUL --}}
                            <td class="px-6 py-4 font-medium text-slate-800">
                                {{ $item->judul }}
                            </td>

                            {{-- AKSI --}}
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">

                                    {{-- DOWNLOAD --}}
                                    <a href="{{ asset('storage/' . $item->file) }}"
                                       target="_blank"
                                       class="inline-flex items-center justify-center
                                              rounded-lg border border-sky-200
                                              bg-sky-50 p-2 text-sky-700
                                              hover:bg-sky-100 transition">
                                        <svg class="h-4 w-4" fill="none"
                                             stroke="currentColor" stroke-width="2"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M12 16.5V3m0 13.5l-4.5-4.5
                                                     M12 16.5l4.5-4.5M3.75 20.25h16.5"/>
                                        </svg>
                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.publikasi.laporan.edit', $item->id) }}"
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

{{-- DELETE LAPORAN --}}
<form id="delete-form-laporan-{{ $item->id }}" 
      action="{{ route('admin.publikasi.laporan.destroy', $item->id) }}"
      method="POST" 
      class="inline">
    @csrf
    @method('DELETE')

    <button type="button"
            {{-- Sesuaikan $item->judul dengan kolom judul laporanmu --}}
            onclick="confirmDeleteLaporan('{{ $item->id }}', '{{ addslashes($item->judul ?? 'Laporan ini') }}')"
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
                            <td colspan="5"
                                class="px-6 py-14 text-center text-slate-500">
                                Belum ada data laporan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="border-t border-slate-200 px-6 py-4">
            {{ $laporans->links() }}
        </div>

    </div>

</div>
<script>
function confirmDeleteLaporan(id, namaLaporan) {
    Swal.fire({
        title: 'Hapus Laporan?',
        // Menggunakan template literal agar nama muncul
        html: `Apakah Anda yakin ingin menghapus <br><strong>"${namaLaporan}"</strong>?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        borderRadius: '1rem'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-laporan-' + id).submit();
        }
    })
}
</script>