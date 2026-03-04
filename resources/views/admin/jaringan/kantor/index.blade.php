<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-800">
            Jaringan Kantor
        </h2>

        <a href="{{ route('jaringan.create') }}"
           class="inline-flex items-center gap-2 rounded-xl
                  bg-[#00326B] px-4 py-2 text-sm font-medium
                  text-white hover:bg-[#002855] transition">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Tambah Kantor
        </a>
    </div>

    {{-- CARD --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- SEARCH --}}
        <form method="GET" class="flex items-center gap-3 px-6 py-4 border-b border-slate-200">
            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                placeholder="Cari nama, alamat, atau telepon..."
                class="w-72 rounded-lg border border-slate-300 px-3 py-2 text-sm
                       focus:border-[#00326B] focus:ring-[#00326B]"
            >
            <button
                class="rounded-lg bg-[#00326B] px-4 py-2 text-sm text-white
                       hover:bg-[#002855] transition">
                Cari
            </button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 w-16 text-left font-semibold text-slate-600">
                            No
                        </th>
                        <th class="px-6 py-3 w-24 text-left font-semibold text-slate-600">
                            Tipe
                        </th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-600">
                            Nama Kantor
                        </th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-600">
                            Alamat
                        </th>
                        <th class="px-6 py-3 w-36 text-left font-semibold text-slate-600">
                            Telepon
                        </th>
                        <th class="px-6 py-3 w-32 text-right font-semibold text-slate-600">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($kantors as $kantor)
                        <tr class="hover:bg-slate-50 transition">

                            {{-- NO --}}
                            <td class="px-6 py-4 text-slate-600">
                                {{ $loop->iteration + ($kantors->currentPage() - 1) * $kantors->perPage() }}
                            </td>

                            {{-- TIPE --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full
                                    px-3 py-1 text-xs font-medium
                                    @if($kantor->tipe === 'pusat')
                                        bg-blue-50 text-blue-700
                                    @elseif($kantor->tipe === 'kas')
                                        bg-amber-50 text-amber-700
                                    @else
                                        bg-emerald-50 text-emerald-700
                                    @endif
                                ">
                                    {{ strtoupper($kantor->tipe) }}
                                </span>
                            </td>

                            {{-- NAMA --}}
                            <td class="px-6 py-4 font-medium text-slate-800">
                                {{ $kantor->nama }}
                            </td>

                            {{-- ALAMAT --}}
                            <td class="px-6 py-4 text-slate-600">
                                {{ Str::limit($kantor->alamat, 60) }}
                            </td>

                            {{-- TELEPON --}}
                            <td class="px-6 py-4 text-slate-600">
                                {{ $kantor->telepon ?? '-' }}
                            </td>

                            {{-- AKSI --}}
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">

                                    {{-- EDIT --}}
                                    <a href="{{ route('jaringan.edit', $kantor->id) }}"
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

{{-- DELETE KANTOR --}}
<form id="delete-form-kantor-{{ $kantor->id }}" 
      action="{{ route('jaringan.destroy', $kantor->id) }}"
      method="POST" 
      class="inline">
    @csrf
    @method('DELETE')

    <button type="button"
            {{-- Pastikan menggunakan kolom yang benar, misal: $kantor->nama_kantor --}}
            onclick="confirmDeleteKantor('{{ $kantor->id }}', '{{ addslashes($kantor->nama_kantor ?? $kantor->nama) }}')"
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
                                Belum ada data jaringan kantor
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="border-t border-slate-200 px-6 py-4">
            {{ $kantors->links() }}
        </div>

    </div>

</div>
<script>
function confirmDeleteKantor(id, nama) {
    Swal.fire({
        title: 'Hapus Jaringan Kantor?',
        html: `Apakah Anda yakin ingin menghapus kantor <br><strong>"${nama}"</strong>?`,
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
            document.getElementById('delete-form-kantor-' + id).submit();
        }
    })
}
</script>