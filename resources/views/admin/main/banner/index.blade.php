<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-800">
            Banner Homepage
        </h2>

        <a href="{{ route('admin.main.banner.create') }}"
           class="inline-flex items-center gap-2 rounded-xl
                  bg-[#00326B] px-4 py-2 text-sm font-medium
                  text-white hover:bg-[#002855] transition">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Tambah Banner
        </a>
    </div>

    {{-- CARD --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 w-20 text-left font-semibold text-slate-600">
                            No
                        </th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-600">
                            Preview
                        </th>
                        <th class="px-6 py-3 w-32 text-right font-semibold text-slate-600">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($banners as $banner)
                        <tr class="hover:bg-slate-50 transition">

                            {{-- ID --}}
                            <td class="px-6 py-4 text-slate-700">
                                {{ $banner->id }}
                            </td>

                            {{-- PREVIEW --}}
                            <td class="px-6 py-4">
                                <img
                                    src="{{ asset('storage/' .$banner->image) }}"
                                    alt="Banner {{ $banner->id }}"
                                    class="h-20 w-auto rounded-lg
                                        border border-slate-200 object-contain"
                                >
                            </td>

                            {{-- AKSI --}}
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.main.banner.edit', $banner->id) }}"
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
<form id="delete-form-banner-{{ $banner->id }}" 
      action="{{ route('admin.main.banner.destroy', $banner->id) }}"
      method="POST" 
      class="inline">
    @csrf
    @method('DELETE')

    <button type="button"
            onclick="confirmDeleteBanner('{{ $banner->id }}')"
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
                            <td colspan="3"
                                class="px-6 py-14 text-center text-slate-500">
                                Belum ada banner
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>
<script>
function confirmDeleteBanner(id) {
    Swal.fire({
        title: 'Hapus Banner?',
        text: "Banner yang dihapus tidak dapat dipulihkan kembali.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444', // Merah (Tailwind Red 600)
        cancelButtonColor: '#64748b',  // Abu-abu (Tailwind Slate 500)
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        borderRadius: '1rem'
    }).then((result) => {
        if (result.isConfirmed) {
            // Memanggil submit berdasarkan ID form yang unik
            document.getElementById('delete-form-banner-' + id).submit();
        }
    })
}
</script>