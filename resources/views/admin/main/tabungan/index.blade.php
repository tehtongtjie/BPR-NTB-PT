<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-800">
            Promo Homepage
        </h2>

        <a href="{{ route('admin.main.promo.create') }}"
           class="inline-flex items-center gap-2 rounded-xl
                  bg-[#00326B] px-4 py-2 text-sm font-medium
                  text-white hover:bg-[#002855] transition">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Tambah Promo
        </a>
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
                            Gambar
                        </th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-600">
                            Judul
                        </th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-600">
                            Deskripsi
                        </th>
                        <th class="px-6 py-3 w-28 text-center font-semibold text-slate-600">
                            Status
                        </th>
                        <th class="px-6 py-3 w-32 text-right font-semibold text-slate-600">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($promos as $promo)
                        <tr class="hover:bg-slate-50 transition">

                            {{-- NO --}}
                            <td class="px-6 py-4 text-slate-600">
                                {{ $loop->iteration }}
                            </td>

                            {{-- GAMBAR --}}
                            <td class="px-6 py-4">
                                <img
                                    src="{{ asset('storage/' .$promo->image) }}"
                                    alt="{{ $promo->title }}"
                                    class="h-14 w-24 rounded-lg border border-slate-200 object-cover"
                                />
                            </td>

                            {{-- JUDUL --}}
                            <td class="px-6 py-4 font-medium text-slate-800">
                                {{ $promo->title }}
                            </td>

                            {{-- DESKRIPSI --}}
                            <td class="px-6 py-4 text-slate-600">
                                {{ Str::limit($promo->short_desc, 60) }}
                            </td>

                            {{-- STATUS --}}
                            <td class="px-6 py-4 text-center">
                                @if($promo->is_active)
                                    <span class="inline-flex items-center rounded-full
                                                 bg-emerald-50 px-3 py-1
                                                 text-xs font-medium text-emerald-700">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full
                                                 bg-slate-100 px-3 py-1
                                                 text-xs font-medium text-slate-600">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.main.promo.edit', $promo->id) }}"
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
                                    <form action="{{ route('admin.main.promo.destroy', $promo->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus promo ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="inline-flex items-center justify-center
                                                   rounded-lg border border-red-200
                                                   bg-red-50 p-2 text-red-600
                                                   hover:bg-red-100 transition">
                                            <svg class="h-4 w-4" fill="none"
                                                 stroke="currentColor" stroke-width="2"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M6 7.5h12M9 7.5V5.25
                                                         A1.5 1.5 0 0110.5 3.75h3
                                                         A1.5 1.5 0 0115 5.25V7.5
                                                         m-7.5 0v11.25
                                                         A1.5 1.5 0 009 20.25h6
                                                         a1.5 1.5 0 001.5-1.5V7.5"/>
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
                                Belum ada promo
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION (jika paginate) --}}
        @if(method_exists($promos, 'links'))
            <div class="border-t border-slate-200 px-6 py-4">
                {{ $promos->links() }}
            </div>
        @endif

    </div>

</div>
