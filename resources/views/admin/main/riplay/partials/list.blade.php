@php
    $isStandalone = request()->routeIs('admin.riplay.*');
    $actionRoute = $isStandalone ? route('admin.main.index') : route('admin.riplay.index');
   
    $headerTitle = $isStandalone ? 'Riplay' : 'Dokumen Riplay';
    $docs = $documents ?? collect();
    $page = method_exists($docs, 'currentPage') ? $docs->currentPage() : 1;
    $perPage = method_exists($docs, 'perPage') ? $docs->perPage() : ($docs->count() ?: 1);
@endphp

<div class="space-y-6">

    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-800">{{ $headerTitle }}</h2>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.riplay.create') }}"
               class="inline-flex items-center gap-2 rounded-xl bg-[#00326B] px-4 py-2 text-sm font-medium text-white hover:bg-[#002855] transition">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Tambah Dokumen
            </a>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 w-16 text-left font-semibold text-slate-600">No</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-600">Tipe</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-600">Judul</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-600">Deskripsi</th>
                        <th class="px-6 py-3 w-28 text-center font-semibold text-slate-600">Status</th>
                        <th class="px-6 py-3 w-32 text-right font-semibold text-slate-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($docs as $doc)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-slate-600">{{ $loop->iteration + ($page - 1) * $perPage }}</td>
                            <td class="px-6 py-4 font-semibold text-slate-600">{{ $doc->type }}</td>
                            <td class="px-6 py-4 font-semibold text-slate-800">{{ $doc->title }}</td>
                            <td class="px-6 py-4 text-slate-600 line-clamp-2">{{ $doc->description }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-[10px] font-semibold {{ $doc->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                    {{ $doc->is_active ? 'Aktif' : 'Arsip' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.riplay.edit', $doc->id) }}"
                                       class="inline-flex items-center justify-center rounded-lg border border-yellow-200 bg-yellow-50 p-2 text-yellow-700 hover:bg-yellow-100 transition">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M16.862 4.487l1.687-1.687a1.875 1.875 0 112.652 2.652L7.5 19.125H3.75v-3.75L16.862 4.487z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.riplay.destroy', $doc->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                onclick="if(confirm('Hapus dokumen ini?')) this.form.submit();"
                                                class="inline-flex items-center justify-center rounded-lg border border-red-200 bg-red-50 p-2 text-red-600 hover:bg-red-600 hover:text-white hover:border-red-600 transition">
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
                            <td colspan="6" class="px-6 py-14 text-center text-slate-500">
                                Belum ada dokumen Riplay
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($isStandalone && method_exists($docs, 'links') && $docs->hasPages())
            <div class="border-t border-slate-200 px-6 py-4">
                {{ $docs->links() }}
            </div>
        @endif
    </div>
</div>
