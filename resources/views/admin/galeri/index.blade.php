@extends('admin.layouts.app')

@section('title', 'Galeri')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-800">
                    Galeri
                </h2>
                <p class="text-sm text-slate-500">
                    Kelola dokumentasi foto maupun video kegiatan dengan tetap konsisten seperti daftar konten lain.
                </p>
            </div>

            <a href="{{ route('admin.galeri.create') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-[#00326B] px-4 py-2 text-sm font-semibold text-white hover:bg-[#002855] transition">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Galeri
            </a>
        </div>

        {{-- CARD --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- FILTER --}}
            <form method="GET"
                class="flex flex-wrap items-center gap-3 px-6 py-4 border-b border-slate-200">

                <input type="text" name="q" value="{{ $search }}" placeholder="Cari judul atau deskripsi..."
                    class="w-full md:w-60 rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-[#00326B] focus:ring-[#00326B] focus:ring-2 transition">

                <select name="type"
                    class="rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-[#00326B] focus:ring-[#00326B] focus:ring-2 transition">
                    <option value="">Semua Tipe</option>
                    @foreach (['foto', 'video'] as $option)
                        <option value="{{ $option }}" {{ $type === $option ? 'selected' : '' }}>
                            {{ ucfirst($option) }}
                        </option>
                    @endforeach
                </select>

                <input type="text" name="category" placeholder="Kategori..."
                    value="{{ $category }}"
                    class="w-full md:w-56 rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-[#00326B] focus:ring-[#00326B] focus:ring-2 transition">

                <button type="submit"
                    class="rounded-lg bg-[#00326B] px-4 py-2 text-sm font-semibold text-white hover:bg-[#002855] transition">
                    Filter
                </button>
            </form>

            {{-- TABLE --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 w-16 text-left font-semibold text-slate-600">No</th>
                            <th class="px-6 py-3 text-left font-semibold text-slate-600">Tipe</th>
                            <th class="px-6 py-3 text-left font-semibold text-slate-600">Judul</th>
                            <th class="px-6 py-3 text-left font-semibold text-slate-600">Kategori</th>
                            <th class="px-6 py-3 text-left font-semibold text-slate-600">Dipublikasi</th>
                            <th class="px-6 py-3 text-left font-semibold text-slate-600">Status</th>
                            <th class="px-6 py-3 text-right font-semibold text-slate-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($galeris as $item)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $loop->iteration + ($galeris->currentPage() - 1) * $galeris->perPage() }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold uppercase tracking-wider {{ $item->type === 'foto' ? 'bg-blue-50 text-blue-700' : 'bg-amber-50 text-amber-700' }}">
                                        {{ strtoupper($item->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-semibold text-slate-800">{{ $item->title }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $item->category }}</td>
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $item->published_at?->translatedFormat('d M Y') ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wider {{ $item->is_published ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-50 text-slate-500' }}">
                                        {{ $item->is_published ? 'Terbit' : 'Draft' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.galeri.edit', $item) }}"
                                            class="rounded-lg border border-yellow-200 bg-yellow-50 px-3 py-2 text-yellow-700 hover:bg-yellow-100 transition">
                                            Edit
                                        </a>
                                        <form id="delete-galeri-{{ $item->id }}"
                                            action="{{ route('admin.galeri.destroy', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                onclick="confirmDeleteGaleri('{{ $item->id }}', '{{ addslashes($item->title) }}')"
                                                class="rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-red-600 hover:bg-red-100 transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-14 text-center text-slate-500">
                                    Belum ada data galeri
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            @if ($galeris->hasPages())
                <div class="px-6 py-4 border-t border-slate-200">
                    {{ $galeris->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDeleteGaleri(id, title) {
            Swal.fire({
                title: 'Hapus Galeri?',
                html: `Apakah Anda yakin ingin menghapus galeri <strong>"${title}"</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-galeri-' + id).submit();
                }
            });
        }
    </script>
@endpush
