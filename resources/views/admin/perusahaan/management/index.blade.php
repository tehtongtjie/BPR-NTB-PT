<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-800">
            Manajemen Perusahaan
        </h2>

        <a href="{{ route('perusahaan.create') }}"
            class="inline-flex items-center gap-2 rounded-xl
                  bg-[#00326B] px-4 py-2 text-sm font-medium
                  text-white hover:bg-[#002855] transition">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Manajemen
        </a>
    </div>

    {{-- CARD --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- FILTER --}}
        <form method="GET"
            class="flex flex-wrap items-center gap-3 px-6 py-4 border-b border-slate-200">
            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                placeholder="Cari nama atau jabatan..."
                class="w-64 rounded-lg border border-slate-300 px-3 py-2 text-sm
                       focus:border-[#00326B] focus:ring-[#00326B]">

            <select name="type"
                class="rounded-lg border border-slate-300 px-3 py-2 text-sm
                       focus:border-[#00326B] focus:ring-[#00326B]">
                <option value="">Semua Tipe</option>
                <option value="direksi" {{ request('type') === 'direksi' ? 'selected' : '' }}>
                    Direksi
                </option>
                <option value="komisaris" {{ request('type') === 'komisaris' ? 'selected' : '' }}>
                    Komisaris
                </option>
            </select>

            <button
                class="rounded-lg bg-[#00326B] px-4 py-2 text-sm text-white
                       hover:bg-[#002855] transition">
                Filter
            </button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 w-16 text-left font-semibold text-slate-600">
                            No
                        </th>
                        <th class="px-6 py-3 w-28 text-left font-semibold text-slate-600">
                            Tipe
                        </th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-600">
                            Nama
                        </th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-600">
                            Jabatan
                        </th>
                        <th class="px-6 py-3 w-32 text-right font-semibold text-slate-600">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($managements as $item)
                    <tr class="hover:bg-slate-50 transition">

                        {{-- NO --}}
                        <td class="px-6 py-4 text-slate-600">
                            {{ $loop->iteration + ($managements->currentPage() - 1) * $managements->perPage() }}
                        </td>

                        {{-- TIPE --}}
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-full
                                    px-3 py-1 text-xs font-medium
                                    {{ $item->type === 'direksi'
                                        ? 'bg-blue-50 text-blue-700'
                                        : 'bg-amber-50 text-amber-700' }}">
                                {{ strtoupper($item->type) }}
                            </span>
                        </td>

                        {{-- NAMA --}}
                        <td class="px-6 py-4 font-medium text-slate-800">
                            {{ $item->name }}
                        </td>

                        {{-- JABATAN --}}
                        <td class="px-6 py-4 text-slate-600">
                            {{ $item->position }}
                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">

                                {{-- EDIT --}}
                                <a href="{{ route('perusahaan.edit', $item->id) }}"
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
                                                     L16.862 4.487z" />
                                    </svg>
                                </a>

                                {{-- DELETE --}}
                                <form action="{{ route('perusahaan.destroy', $item->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                        onclick="confirmDeletePerusahaan('{{ $item->id }}', '{{ addslashes($item->nama_perusahaan ?? $item->name) }}')"
                                        class="inline-flex items-center justify-center rounded-lg border border-red-200 bg-red-50 p-2 text-red-600 hover:bg-red-600 hover:text-white transition">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7.5h12M9 7.5V5.25A1.5 1.5 0 0110.5 3.75h3A1.5 1.5 0 0115 5.25V7.5m-7.5 0v11.25A1.5 1.5 0 009 20.25h6a1.5 1.5 0 001.5-1.5V7.5" />
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
                            Belum ada data manajemen
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="border-t border-slate-200 px-6 py-4">
            {{ $managements->links() }}
        </div>

    </div>

</div>
<script>
    function confirmDeletePerusahaan(id, namaItem) {
        // Debugging: Cek di console (F12) apakah nama masuk ke sini
        console.log("Menghapus:", namaItem);

        Swal.fire({
            title: 'Hapus Data?',
            // Gunakan ${namaItem} untuk menampilkan variabel di dalam HTML
            html: `Apakah Anda yakin ingin menghapus <br><strong>"${namaItem}"</strong>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-perusahaan-' + id).submit();
            }
        })
    }
</script>