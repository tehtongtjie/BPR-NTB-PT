@php
    $isStandalone = request()->routeIs('admin.main.lelang.*');
    $actionRoute = $isStandalone ? route('admin.main.index') : route('admin.main.lelang.index');
    $actionLabel = $isStandalone ? 'Kembali ke Dashboard' : 'Kelola Lelang';
    $headerTitle = $isStandalone ? 'Kelola Lelang' : 'Preview Lelang';
@endphp

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-800">
            {{ $headerTitle }}
        </h2>

        <div class="flex items-center gap-2">
            <a href="{{ $actionRoute }}"
               class="inline-flex items-center gap-2 rounded-xl
                      border border-[#00326B] px-4 py-2 text-sm font-medium
                      text-[#00326B] hover:bg-[#00326B] hover:text-white transition">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3.75 9h16.5m-16.5 6.75h16.5"/>
                </svg>
                {{ $actionLabel }}
            </a>

            <a href="{{ route('admin.main.lelang.create') }}"
               class="inline-flex items-center gap-2 rounded-xl
                      bg-[#00326B] px-4 py-2 text-sm font-medium
                      text-white hover:bg-[#002855] transition">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Tambah Lelang
            </a>
        </div>
    </div>

    {{-- CARD --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 w-16 text-left font-semibold text-slate-600">
                            No
                        </th>
                        <th class="px-6 py-3 w-28 text-left font-semibold text-slate-600">
                            Banner
                        </th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-600">
                            Judul
                        </th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-600">
                            Kategori
                        </th>
                        <th class="px-6 py-3 w-32 text-center font-semibold text-slate-600">
                            Status
                        </th>
                        <th class="px-6 py-3 w-32 text-right font-semibold text-slate-600">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($lelangs as $lelang)
                        <tr class="hover:bg-slate-50 transition">

                            {{-- NO --}}
                            <td class="px-6 py-4 text-slate-600">
                                @if(method_exists($lelangs, 'firstItem'))
                                    {{ $lelangs->firstItem() + $loop->index }}
                                @else
                                    {{ $loop->iteration }}
                                @endif
                            </td>

                            {{-- BANNER --}}
                            <td class="px-6 py-4">
                                @if($lelang->banner)
                                    <img
                                        src="{{ public_image_url('storage/' . $lelang->banner) }}"
                                        alt="{{ $lelang->title }}"
                                        class="h-14 w-24 rounded-lg border border-slate-200 object-cover"
                                    />
                                @else
                                    <div class="h-14 w-24 rounded-lg
                                                bg-slate-100 text-slate-400
                                                flex items-center justify-center text-xs">
                                        No Image
                                    </div>
                                @endif
                            </td>

                            {{-- JUDUL --}}
                            <td class="px-6 py-4 font-medium text-slate-800">
                                {{ $lelang->title }}
                            </td>

                            {{-- KATEGORI --}}
                            <td class="px-6 py-4 text-slate-600">
                                {{ $lelang->category ?? '-' }}
                            </td>

                            {{-- STATUS --}}
                            <td class="px-6 py-4 text-center">
                                @if($lelang->status === 'aktif')
                                    <span class="inline-flex items-center rounded-full
                                                 bg-emerald-50 px-3 py-1
                                                 text-xs font-medium text-emerald-700">
                                        Aktif
                                    </span>
                                @elseif($lelang->status === 'ditutup')
                                    <span class="inline-flex items-center rounded-full
                                                 bg-yellow-50 px-3 py-1
                                                 text-xs font-medium text-yellow-700">
                                        Ditutup
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full
                                                 bg-slate-100 px-3 py-1
                                                 text-xs font-medium text-slate-600">
                                        Selesai
                                    </span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.main.lelang.edit', $lelang->id) }}"
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

                                    {{-- DELETE --}}
                                    <form id="delete-form-lelang-{{ $lelang->id }}"
                                          action="{{ route('admin.main.lelang.destroy', $lelang->id) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                                onclick="confirmDeleteLelang('{{ $lelang->id }}', '{{ addslashes($lelang->title) }}')"
                                                class="inline-flex items-center justify-center
                                                       rounded-lg border border-red-200
                                                       bg-red-50 p-2 text-red-600
                                                       hover:bg-red-600 hover:text-white
                                                       hover:border-red-600 transition-all duration-200"
                                                title="Hapus Lelang">
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
                                Belum ada data lelang
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($isStandalone && method_exists($lelangs, 'links'))
            <div class="border-t border-slate-200 px-6 py-4">
                {{ $lelangs->links() }}
            </div>
        @endif

    </div>

</div>
<script>
function confirmDeleteLelang(id, title) {
    Swal.fire({
        title: 'Hapus Data Lelang?',
        html: `Anda akan menghapus lelang: <br><strong>${title}</strong><br><small class="text-gray-500">Data ini tidak dapat dikembalikan.</small>`,
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
            document.getElementById('delete-form-lelang-' + id).submit();
        }
    })
}
</script>
